<?php

namespace Tests\Feature\Nutrition;

use App\Models\ComprehensiveHistory;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ComprehensiveNutritionFormTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $patient;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->clinician()->create();
        $this->patient = Patient::factory()->create();
        
        Storage::fake('local');
    }

    /** @test */
    public function comprehensive_history_form_renders_with_sections()
    {
        $this->actingAs($this->user);

        $response = $this->get("/patients/{$this->patient->id}/comprehensive-history");

        $response->assertStatus(200);
        $response->assertSee('comprehensive-history'); // Should contain comprehensive history form
    }

    /** @test */
    public function comprehensive_history_supports_section_paging()
    {
        $this->actingAs($this->user);

        $response = $this->get("/patients/{$this->patient->id}/comprehensive-history");

        $response->assertStatus(200);
        // Should contain navigation elements for different sections
        $response->assertSee(['section', 'page', 'next', 'previous'], false);
    }

    /** @test */
    public function comprehensive_history_can_be_saved_as_draft()
    {
        $this->actingAs($this->user);

        $draftData = [
            'patient_id' => $this->patient->id,
            'chief_complaint' => 'Test complaint - draft',
            'history_of_present_illness' => 'Partial history...',
            // Partial data to simulate draft save
            'status' => 'draft'
        ];

        $response = $this->post("/patients/{$this->patient->id}/comprehensive-history", $draftData);

        $response->assertStatus(302);
        
        // Verify draft is saved
        $this->assertDatabaseHas('comprehensive_histories', [
            'patient_id' => $this->patient->id,
            'chief_complaint' => 'Test complaint - draft',
            // Should allow partial data for drafts
        ]);
    }

    /** @test */
    public function comprehensive_history_can_be_submitted_complete()
    {
        $this->actingAs($this->user);

        $completeData = [
            'patient_id' => $this->patient->id,
            'chief_complaint' => 'Complete chief complaint',
            'history_of_present_illness' => 'Complete history of present illness',
            'past_medical_history' => 'Complete past medical history',
            'family_history' => 'Complete family history',
            'social_history' => 'Complete social history',
            'allergies' => 'No known allergies',
            'medications' => 'Current medications list',
            'status' => 'complete'
        ];

        $response = $this->post("/patients/{$this->patient->id}/comprehensive-history", $completeData);

        $response->assertStatus(302);
        
        // Verify complete history is saved
        $this->assertDatabaseHas('comprehensive_histories', [
            'patient_id' => $this->patient->id,
            'chief_complaint' => 'Complete chief complaint',
            'history_of_present_illness' => 'Complete history of present illness',
        ]);
    }

    /** @test */
    public function comprehensive_history_persists_large_text_fields()
    {
        $this->actingAs($this->user);

        $largeText = str_repeat('This is a very long medical history. ', 100); // ~3000 characters

        $dataWithLargeFields = [
            'patient_id' => $this->patient->id,
            'chief_complaint' => $largeText,
            'history_of_present_illness' => $largeText,
            'past_medical_history' => $largeText,
            'family_history' => $largeText,
            'social_history' => $largeText,
        ];

        $response = $this->post("/patients/{$this->patient->id}/comprehensive-history", $dataWithLargeFields);

        $response->assertStatus(302);
        
        // Verify large text fields are properly stored
        $storedHistory = ComprehensiveHistory::where('patient_id', $this->patient->id)->first();
        $this->assertNotNull($storedHistory);
        $this->assertEquals($largeText, $storedHistory->chief_complaint);
        $this->assertEquals($largeText, $storedHistory->history_of_present_illness);
        $this->assertEquals(strlen($largeText), strlen($storedHistory->past_medical_history));
    }

    /** @test */
    public function comprehensive_history_print_route_returns_200()
    {
        $this->actingAs($this->user);

        // Create a comprehensive history first
        $history = ComprehensiveHistory::create([
            'patient_id' => $this->patient->id,
            'chief_complaint' => 'Test complaint for printing',
            'history_of_present_illness' => 'Test history for printing',
        ]);

        // Test print route
        $response = $this->get("/patients/{$this->patient->id}/comprehensive-history/print");

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }

    /** @test */
    public function comprehensive_history_export_route_returns_200()
    {
        $this->actingAs($this->user);

        // Create a comprehensive history first
        $history = ComprehensiveHistory::create([
            'patient_id' => $this->patient->id,
            'chief_complaint' => 'Test complaint for export',
            'history_of_present_illness' => 'Test history for export',
        ]);

        // Test export route
        $response = $this->get("/patients/{$this->patient->id}/comprehensive-history/export");

        $response->assertStatus(200);
        // Should return downloadable file
        $this->assertTrue(in_array($response->headers->get('content-type'), [
            'application/pdf',
            'application/vnd.ms-excel',
            'text/csv'
        ]));
    }

    /** @test */
    public function comprehensive_history_validates_required_fields_for_complete_submission()
    {
        $this->actingAs($this->user);

        $incompleteData = [
            'patient_id' => $this->patient->id,
            'chief_complaint' => '', // Required field empty
            'status' => 'complete'
        ];

        $response = $this->post("/patients/{$this->patient->id}/comprehensive-history", $incompleteData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['chief_complaint']);
    }

    /** @test */
    public function comprehensive_history_allows_partial_data_for_drafts()
    {
        $this->actingAs($this->user);

        $partialData = [
            'patient_id' => $this->patient->id,
            'chief_complaint' => 'Just the complaint for now',
            // Missing other fields
            'status' => 'draft'
        ];

        $response = $this->post("/patients/{$this->patient->id}/comprehensive-history", $partialData);

        $response->assertStatus(302); // Should accept partial data for drafts
        
        $this->assertDatabaseHas('comprehensive_histories', [
            'patient_id' => $this->patient->id,
            'chief_complaint' => 'Just the complaint for now',
        ]);
    }

    /** @test */
    public function comprehensive_history_can_be_updated_preserving_existing_data()
    {
        $this->actingAs($this->user);

        // Create initial history
        $initialData = [
            'patient_id' => $this->patient->id,
            'chief_complaint' => 'Initial complaint',
            'history_of_present_illness' => 'Initial history',
        ];

        $this->post("/patients/{$this->patient->id}/comprehensive-history", $initialData);

        // Update with additional data
        $updateData = [
            'patient_id' => $this->patient->id,
            'chief_complaint' => 'Updated complaint',
            'past_medical_history' => 'Added past medical history',
        ];

        $response = $this->post("/patients/{$this->patient->id}/comprehensive-history", $updateData);

        $response->assertStatus(302);
        
        // Verify update preserves and adds data
        $this->assertDatabaseHas('comprehensive_histories', [
            'patient_id' => $this->patient->id,
            'chief_complaint' => 'Updated complaint',
            'past_medical_history' => 'Added past medical history',
        ]);
    }

    /** @test */
    public function comprehensive_history_data_can_be_retrieved()
    {
        $this->actingAs($this->user);

        // Create history
        $history = ComprehensiveHistory::create([
            'patient_id' => $this->patient->id,
            'chief_complaint' => 'Test complaint',
            'history_of_present_illness' => 'Test history',
        ]);

        $response = $this->get("/patients/{$this->patient->id}/comprehensive-history/data");

        $response->assertStatus(200);
        $response->assertJson([
            'patient_id' => $this->patient->id,
            'chief_complaint' => 'Test complaint',
            'history_of_present_illness' => 'Test history',
        ]);
    }
}