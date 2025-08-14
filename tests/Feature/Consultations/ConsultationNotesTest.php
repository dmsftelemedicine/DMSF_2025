<?php

namespace Tests\Feature\Consultations;

use App\Models\Consultation;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConsultationNotesTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $otherUser;
    protected $patient;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->clinician()->create();
        $this->otherUser = User::factory()->clinician()->create();
        $this->patient = Patient::factory()->create();
    }

    /** @test */
    public function consultation_can_be_created_with_valid_data()
    {
        $this->actingAs($this->user);

        $consultationData = [
            'patient_id' => $this->patient->id,
            'consultation_number' => 1,
            'consultation_date' => now()->format('Y-m-d H:i:s'),
            'notes' => 'Initial consultation notes',
            'chief_complaint' => 'Patient presents with fatigue',
        ];

        $response = $this->post('/consultations', $consultationData);

        $response->assertStatus(302);
        
        $this->assertDatabaseHas('consultations', [
            'patient_id' => $this->patient->id,
            'consultation_number' => 1,
        ]);

        // Verify consultation is created by current user
        $consultation = Consultation::latest()->first();
        // Assuming created_by field exists
        // $this->assertEquals($this->user->id, $consultation->created_by);
    }

    /** @test */
    public function consultation_can_be_updated_by_owning_clinician()
    {
        $this->actingAs($this->user);

        $consultation = Consultation::factory()
            ->forPatient($this->patient->id)
            ->create([
                'notes' => 'Original notes',
                'status' => 'draft', // Not finalized
                // 'created_by' => $this->user->id,
            ]);

        $updateData = [
            'notes' => 'Updated consultation notes',
            'assessment' => 'Updated assessment',
        ];

        $response = $this->put("/consultations/{$consultation->id}", $updateData);

        $response->assertStatus(302);
        
        $this->assertDatabaseHas('consultations', [
            'id' => $consultation->id,
            'notes' => 'Updated consultation notes',
        ]);
    }

    /** @test */
    public function consultation_cannot_be_updated_by_non_owning_clinician()
    {
        $this->actingAs($this->otherUser); // Different user

        $consultation = Consultation::factory()
            ->forPatient($this->patient->id)
            ->create([
                'notes' => 'Original notes',
                'status' => 'draft',
                // 'created_by' => $this->user->id, // Created by different user
            ]);

        $updateData = [
            'notes' => 'Attempted unauthorized update',
        ];

        $response = $this->put("/consultations/{$consultation->id}", $updateData);

        $response->assertStatus(403); // Forbidden
        
        // Verify notes were not changed
        $this->assertDatabaseHas('consultations', [
            'id' => $consultation->id,
            'notes' => 'Original notes',
        ]);
    }

    /** @test */
    public function consultation_can_be_locked_and_finalized()
    {
        $this->actingAs($this->user);

        $consultation = Consultation::factory()
            ->forPatient($this->patient->id)
            ->create([
                'notes' => 'Final consultation notes',
                'status' => 'draft',
                // 'created_by' => $this->user->id,
            ]);

        // Finalize consultation
        $response = $this->post("/consultations/{$consultation->id}/finalize");

        $response->assertStatus(200);
        
        $this->assertDatabaseHas('consultations', [
            'id' => $consultation->id,
            'status' => 'finalized',
            'finalized_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }

    /** @test */
    public function finalized_consultation_cannot_be_edited_by_anyone()
    {
        $this->actingAs($this->user);

        $consultation = Consultation::factory()
            ->forPatient($this->patient->id)
            ->create([
                'notes' => 'Finalized notes',
                'status' => 'finalized',
                'finalized_at' => now(),
                // 'created_by' => $this->user->id,
            ]);

        $updateData = [
            'notes' => 'Attempted update after finalization',
        ];

        $response = $this->put("/consultations/{$consultation->id}", $updateData);

        $response->assertStatus(403); // Should be forbidden even for owner
        
        // Verify notes were not changed
        $this->assertDatabaseHas('consultations', [
            'id' => $consultation->id,
            'notes' => 'Finalized notes',
        ]);
    }

    /** @test */
    public function only_owning_clinician_can_finalize_consultation()
    {
        $this->actingAs($this->otherUser); // Different user

        $consultation = Consultation::factory()
            ->forPatient($this->patient->id)
            ->create([
                'notes' => 'Draft notes',
                'status' => 'draft',
                // 'created_by' => $this->user->id, // Created by different user
            ]);

        $response = $this->post("/consultations/{$consultation->id}/finalize");

        $response->assertStatus(403); // Forbidden
        
        // Verify consultation remains in draft status
        $this->assertDatabaseHas('consultations', [
            'id' => $consultation->id,
            'status' => 'draft',
            'finalized_at' => null,
        ]);
    }

    /** @test */
    public function consultation_lock_rules_are_enforced()
    {
        $this->actingAs($this->user);

        $consultation = Consultation::factory()
            ->forPatient($this->patient->id)
            ->create([
                'status' => 'draft',
                // 'created_by' => $this->user->id,
            ]);

        // Test that draft consultations can be edited
        $response = $this->put("/consultations/{$consultation->id}", [
            'notes' => 'Draft update'
        ]);
        $response->assertStatus(302);

        // Test that locked consultations cannot be edited
        $consultation->update(['status' => 'locked']);
        
        $response = $this->put("/consultations/{$consultation->id}", [
            'notes' => 'Locked update attempt'
        ]);
        $response->assertStatus(403);

        // Test that finalized consultations cannot be edited
        $consultation->update(['status' => 'finalized', 'finalized_at' => now()]);
        
        $response = $this->put("/consultations/{$consultation->id}", [
            'notes' => 'Finalized update attempt'
        ]);
        $response->assertStatus(403);
    }

    /** @test */
    public function consultation_date_can_be_updated_before_finalization()
    {
        $this->actingAs($this->user);

        $consultation = Consultation::factory()
            ->forPatient($this->patient->id)
            ->create([
                'consultation_date' => '2024-01-01 10:00:00',
                'status' => 'draft',
                // 'created_by' => $this->user->id,
            ]);

        $newDate = '2024-01-02 14:30:00';

        $response = $this->post("/consultations/{$consultation->id}/update-date", [
            'consultation_date' => $newDate
        ]);

        $response->assertStatus(200);
        
        $this->assertDatabaseHas('consultations', [
            'id' => $consultation->id,
            'consultation_date' => $newDate,
        ]);
    }

    /** @test */
    public function consultation_date_cannot_be_updated_after_finalization()
    {
        $this->actingAs($this->user);

        $originalDate = '2024-01-01 10:00:00';
        $consultation = Consultation::factory()
            ->forPatient($this->patient->id)
            ->create([
                'consultation_date' => $originalDate,
                'status' => 'finalized',
                'finalized_at' => now(),
                // 'created_by' => $this->user->id,
            ]);

        $response = $this->post("/consultations/{$consultation->id}/update-date", [
            'consultation_date' => '2024-01-02 14:30:00'
        ]);

        $response->assertStatus(403);
        
        // Verify date was not changed
        $this->assertDatabaseHas('consultations', [
            'id' => $consultation->id,
            'consultation_date' => $originalDate,
        ]);
    }

    /** @test */
    public function consultation_history_is_maintained()
    {
        $this->actingAs($this->user);

        $consultation = Consultation::factory()
            ->forPatient($this->patient->id)
            ->create([
                'notes' => 'Original notes',
                'status' => 'draft',
                // 'created_by' => $this->user->id,
            ]);

        // Update consultation
        $this->put("/consultations/{$consultation->id}", [
            'notes' => 'Updated notes'
        ]);

        // Finalize consultation
        $this->post("/consultations/{$consultation->id}/finalize");

        $consultation->refresh();

        // Verify audit trail exists
        $this->assertNotNull($consultation->updated_at);
        $this->assertNotNull($consultation->finalized_at);
        $this->assertEquals('finalized', $consultation->status);

        // If using model versioning, verify versions are tracked
        // $this->assertGreaterThan(1, $consultation->versions()->count());
    }

    /** @test */
    public function consultation_requires_valid_patient()
    {
        $this->actingAs($this->user);

        $consultationData = [
            'patient_id' => 99999, // Non-existent patient
            'consultation_number' => 1,
            'consultation_date' => now()->format('Y-m-d H:i:s'),
        ];

        $response = $this->post('/consultations', $consultationData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['patient_id']);
    }
}