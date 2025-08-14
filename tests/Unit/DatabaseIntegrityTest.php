<?php

namespace Tests\Unit;

use App\Models\Assessment;
use App\Models\ComprehensiveHistory;
use App\Models\Consultation;
use App\Models\Nutrition;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabaseIntegrityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function patient_factory_builds_minimal_valid_record()
    {
        $patient = Patient::factory()->minimal()->create();

        $this->assertNotNull($patient->id);
        $this->assertNotNull($patient->first_name);
        $this->assertNotNull($patient->last_name);
        $this->assertNotNull($patient->birth_date);
        $this->assertNotNull($patient->gender);
        $this->assertNotNull($patient->reference_number);
        $this->assertNotNull($patient->created_at);
        $this->assertNotNull($patient->updated_at);

        // Verify required fields are present
        $this->assertNotEmpty($patient->first_name);
        $this->assertNotEmpty($patient->last_name);
        $this->assertNotEmpty($patient->reference_number);
    }

    /** @test */
    public function user_factory_builds_valid_record_with_all_fields()
    {
        $user = User::factory()->create();

        $this->assertNotNull($user->id);
        $this->assertNotNull($user->name);
        $this->assertNotNull($user->email);
        $this->assertNotNull($user->first_name);
        $this->assertNotNull($user->last_name);
        $this->assertNotNull($user->email_verified_at);
        $this->assertNotNull($user->password);

        // Verify email is valid format
        $this->assertStringContainsString('@', $user->email);
        
        // Verify password is hashed
        $this->assertStringStartsWith('$2y$', $user->password);
    }

    /** @test */
    public function consultation_factory_creates_valid_relationships()
    {
        $patient = Patient::factory()->create();
        $consultation = Consultation::factory()->forPatient($patient->id)->create();

        $this->assertEquals($patient->id, $consultation->patient_id);
        $this->assertNotNull($consultation->consultation_number);
        $this->assertNotNull($consultation->consultation_date);

        // Test relationship works
        $this->assertEquals($patient->id, $consultation->patient->id);
        $this->assertTrue($patient->consultations->contains($consultation));
    }

    /** @test */
    public function nutrition_factory_creates_valid_foreign_key_relationships()
    {
        $patient = Patient::factory()->create();
        $consultation = Consultation::factory()->forPatient($patient->id)->create();
        
        $nutrition = Nutrition::factory()->create([
            'patient_id' => $patient->id,
            'consultation_id' => $consultation->id,
        ]);

        // Verify foreign keys are properly set
        $this->assertEquals($patient->id, $nutrition->patient_id);
        $this->assertEquals($consultation->id, $nutrition->consultation_id);

        // Verify relationships work
        $this->assertInstanceOf(Patient::class, $nutrition->patient);
        $this->assertInstanceOf(Consultation::class, $nutrition->consultation);
        
        // Verify patient consultation relationship is consistent
        $this->assertEquals($patient->id, $nutrition->consultation->patient_id);
    }

    /** @test */
    public function assessment_factory_creates_valid_graph_with_patient_and_consultation()
    {
        $patient = Patient::factory()->create();
        $consultation = Consultation::factory()->forPatient($patient->id)->create();
        
        $assessment = Assessment::factory()->create([
            'patient_id' => $patient->id,
            'consultation_id' => $consultation->id,
        ]);

        // Verify complete graph integrity
        $this->assertEquals($patient->id, $assessment->patient_id);
        $this->assertEquals($consultation->id, $assessment->consultation_id);
        $this->assertEquals($patient->id, $assessment->consultation->patient_id);

        // Verify all relationships are traversable
        $this->assertEquals($patient->id, $assessment->patient->id);
        $this->assertEquals($consultation->id, $assessment->consultation->id);
        $this->assertEquals($patient->id, $assessment->consultation->patient->id);
    }

    /** @test */
    public function comprehensive_history_is_auto_created_for_new_patients()
    {
        $patient = Patient::factory()->create();

        // Patient model should auto-create comprehensive history
        $this->assertDatabaseHas('comprehensive_histories', [
            'patient_id' => $patient->id,
        ]);

        $comprehensiveHistory = $patient->comprehensiveHistory;
        $this->assertNotNull($comprehensiveHistory);
        $this->assertEquals($patient->id, $comprehensiveHistory->patient_id);
    }

    /** @test */
    public function foreign_key_constraints_prevent_orphaned_records()
    {
        $patient = Patient::factory()->create();
        $consultation = Consultation::factory()->forPatient($patient->id)->create();
        
        $nutrition = Nutrition::factory()->create([
            'patient_id' => $patient->id,
            'consultation_id' => $consultation->id,
        ]);

        // Verify nutrition exists
        $this->assertDatabaseHas('nutritions', ['id' => $nutrition->id]);

        // Delete patient - should handle dependent records appropriately
        try {
            $patient->delete();
            
            // If using soft deletes, related records should still exist
            if ($patient->trashed()) {
                $this->assertDatabaseHas('nutritions', ['id' => $nutrition->id]);
            } else {
                // If hard delete with cascading, nutrition should be deleted
                $this->assertDatabaseMissing('nutritions', ['id' => $nutrition->id]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // Foreign key constraint prevents deletion - this is also valid
            $this->assertStringContainsString('foreign key constraint', strtolower($e->getMessage()));
        }
    }

    /** @test */
    public function required_not_null_fields_are_enforced()
    {
        // Test that required fields cannot be null
        $this->expectException(\Illuminate\Database\QueryException::class);

        // Attempt to create patient without required fields
        Patient::create([
            'first_name' => null, // Should be required
            'last_name' => 'Test',
            'birth_date' => '1990-01-01',
            'gender' => 'male',
        ]);
    }

    /** @test */
    public function unique_constraints_are_enforced()
    {
        $user1 = User::factory()->create(['email' => 'test@example.com']);

        // Attempt to create user with same email
        $this->expectException(\Illuminate\Database\QueryException::class);
        
        User::factory()->create(['email' => 'test@example.com']);
    }

    /** @test */
    public function patient_reference_number_is_unique()
    {
        $patient1 = Patient::factory()->create(['reference_number' => 'TEST123456']);

        // Attempt to create patient with same reference number
        $this->expectException(\Illuminate\Database\QueryException::class);
        
        Patient::factory()->create(['reference_number' => 'TEST123456']);
    }

    /** @test */
    public function timestamps_are_automatically_managed()
    {
        $patient = Patient::factory()->create();

        $this->assertNotNull($patient->created_at);
        $this->assertNotNull($patient->updated_at);
        $this->assertEquals($patient->created_at, $patient->updated_at);

        // Update record
        $originalUpdatedAt = $patient->updated_at;
        sleep(1); // Ensure timestamp difference
        $patient->update(['first_name' => 'Updated Name']);

        $this->assertNotEquals($originalUpdatedAt, $patient->fresh()->updated_at);
        $this->assertEquals($patient->created_at, $patient->fresh()->created_at); // Should not change
    }

    /** @test */
    public function soft_deletes_work_correctly_where_implemented()
    {
        $nutrition = Nutrition::factory()->create();
        $nutritionId = $nutrition->id;

        // Soft delete
        $nutrition->delete();

        // Should be soft deleted (not physically removed)
        $this->assertSoftDeleted('nutritions', ['id' => $nutritionId]);
        
        // Should not appear in normal queries
        $this->assertNull(Nutrition::find($nutritionId));
        
        // Should appear in queries that include trashed
        $this->assertNotNull(Nutrition::withTrashed()->find($nutritionId));
        
        // Can be restored
        $nutrition->restore();
        $this->assertNotNull(Nutrition::find($nutritionId));
    }

    /** @test */
    public function cascade_relationships_work_correctly()
    {
        $patient = Patient::factory()->create();
        $consultation = Consultation::factory()->forPatient($patient->id)->create();
        
        // Create related records
        $nutrition = Nutrition::factory()->create([
            'patient_id' => $patient->id,
            'consultation_id' => $consultation->id,
        ]);
        
        $assessment = Assessment::factory()->create([
            'patient_id' => $patient->id,
            'consultation_id' => $consultation->id,
        ]);

        // Verify all records exist
        $this->assertDatabaseHas('patients', ['id' => $patient->id]);
        $this->assertDatabaseHas('consultations', ['id' => $consultation->id]);
        $this->assertDatabaseHas('nutritions', ['id' => $nutrition->id]);
        $this->assertDatabaseHas('assessments', ['id' => $assessment->id]);

        // Test cascade behavior when deleting consultation
        $consultation->delete();

        // Related records should handle deletion appropriately
        // (Either cascade delete or set foreign key to null, depending on configuration)
        if (Nutrition::withTrashed()->find($nutrition->id)?->trashed()) {
            // Soft deleted
            $this->assertSoftDeleted('nutritions', ['id' => $nutrition->id]);
        } else {
            // Either hard deleted or foreign key set to null
            $deletedNutrition = Nutrition::find($nutrition->id);
            $this->assertTrue($deletedNutrition === null || $deletedNutrition->consultation_id === null);
        }
    }
}