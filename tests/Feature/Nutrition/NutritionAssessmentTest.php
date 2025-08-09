<?php

namespace Tests\Feature\Nutrition;

use App\Models\Consultation;
use App\Models\Nutrition;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NutritionAssessmentTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $patient;
    protected $consultation;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->clinician()->create();
        $this->patient = Patient::factory()->create();
        $this->consultation = Consultation::factory()
            ->forPatient($this->patient->id)
            ->create();
    }

    /** @test */
    public function nutrition_assessment_form_renders_successfully()
    {
        $this->actingAs($this->user);

        // Assuming nutrition form is accessed via patient show page
        $response = $this->get("/patients/{$this->patient->id}");
        
        $response->assertStatus(200);
        $response->assertSee('nutrition'); // Should contain nutrition assessment section
    }

    /** @test */
    public function nutrition_assessment_can_be_submitted_with_valid_data()
    {
        $this->actingAs($this->user);

        $validData = [
            'patient_id' => $this->patient->id,
            'consultation_id' => $this->consultation->id,
            'fruit' => 3,
            'fruit_juice' => 1,
            'vegetables' => 4,
            'green_vegetables' => 2,
            'starchy_vegetables' => 2,
            'grains' => 6,
            'grains_frequency' => 'daily',
            'whole_grains' => 2,
            'whole_grains_frequency' => 'weekly',
            'milk' => 2,
            'milk_frequency' => 'daily',
            'low_fat_milk' => 1,
            'low_fat_milk_frequency' => 'daily',
            'beans' => 1,
            'nuts_seeds' => 1,
            'seafood' => 2,
            'seafood_frequency' => 'weekly',
            'ssb' => 1,
            'ssb_frequency' => 'rarely',
            'added_sugars' => 2,
            'saturated_fat' => 2,
            'water' => 8,
            'dq_score' => 75,
            'icd_diagnosis' => 'Normal nutritional status',
        ];

        $response = $this->post('/nutrition/store', $validData);

        $response->assertStatus(302); // Should redirect after successful submission
        
        // Verify data was stored in database
        $this->assertDatabaseHas('nutritions', [
            'patient_id' => $this->patient->id,
            'consultation_id' => $this->consultation->id,
            'fruit' => 3,
            'vegetables' => 4,
            'water' => 8,
        ]);
    }

    /** @test */
    public function nutrition_assessment_returns_422_for_invalid_data()
    {
        $this->actingAs($this->user);

        $invalidData = [
            'patient_id' => null, // Missing required field
            'fruit' => 'invalid', // Should be numeric
            'vegetables' => -1, // Should be positive
            'water' => 20, // Should be reasonable amount
        ];

        $response = $this->post('/nutrition/store', $invalidData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['patient_id']);
        
        // Verify no invalid data was stored
        $this->assertDatabaseMissing('nutritions', [
            'fruit' => 'invalid',
        ]);
    }

    /** @test */
    public function nutrition_assessment_enforces_conditional_field_validation()
    {
        $this->actingAs($this->user);

        // Test conditional validation - if grains is provided, frequency should be required
        $dataWithMissingFrequency = [
            'patient_id' => $this->patient->id,
            'consultation_id' => $this->consultation->id,
            'grains' => 5,
            // Missing grains_frequency which should be required when grains > 0
        ];

        $response = $this->post('/nutrition/store', $dataWithMissingFrequency);

        // Should validate that frequency is required when quantity is provided
        $response->assertStatus(422);
    }

    /** @test */
    public function nutrition_assessment_validates_numeric_ranges()
    {
        $this->actingAs($this->user);

        $outOfRangeData = [
            'patient_id' => $this->patient->id,
            'consultation_id' => $this->consultation->id,
            'fruit' => 10, // Typically should be 0-5
            'vegetables' => -2, // Should not be negative
            'water' => 50, // Unrealistic high amount
            'dq_score' => 150, // Should be 0-100
        ];

        $response = $this->post('/nutrition/store', $outOfRangeData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['fruit', 'vegetables', 'water', 'dq_score']);
    }

    /** @test */
    public function nutrition_assessment_can_be_retrieved_by_consultation()
    {
        $this->actingAs($this->user);

        // Create a nutrition assessment
        $nutrition = Nutrition::factory()
            ->forPatient($this->patient->id)
            ->withConsultation()
            ->create([
                'consultation_id' => $this->consultation->id,
            ]);

        $response = $this->get("/consultations/{$this->consultation->id}/nutrition");

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $nutrition->id,
            'patient_id' => $this->patient->id,
            'consultation_id' => $this->consultation->id,
        ]);
    }

    /** @test */
    public function nutrition_assessment_database_state_is_correct_after_submission()
    {
        $this->actingAs($this->user);

        $nutritionData = Nutrition::factory()->make([
            'patient_id' => $this->patient->id,
            'consultation_id' => $this->consultation->id,
        ])->toArray();

        $response = $this->post('/nutrition/store', $nutritionData);

        $response->assertStatus(302);

        // Verify exact database state
        $storedNutrition = Nutrition::where('patient_id', $this->patient->id)->first();
        
        $this->assertNotNull($storedNutrition);
        $this->assertEquals($this->patient->id, $storedNutrition->patient_id);
        $this->assertEquals($this->consultation->id, $storedNutrition->consultation_id);
        $this->assertNotNull($storedNutrition->created_at);
        $this->assertNotNull($storedNutrition->updated_at);
        
        // Verify specific nutrition values
        $this->assertEquals($nutritionData['fruit'], $storedNutrition->fruit);
        $this->assertEquals($nutritionData['vegetables'], $storedNutrition->vegetables);
        $this->assertEquals($nutritionData['water'], $storedNutrition->water);
    }

    /** @test */
    public function nutrition_assessment_requires_valid_patient_id()
    {
        $this->actingAs($this->user);

        $dataWithInvalidPatient = [
            'patient_id' => 99999, // Non-existent patient
            'consultation_id' => $this->consultation->id,
            'fruit' => 3,
            'vegetables' => 4,
        ];

        $response = $this->post('/nutrition/store', $dataWithInvalidPatient);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['patient_id']);
    }

    /** @test */
    public function nutrition_assessment_requires_valid_consultation_id()
    {
        $this->actingAs($this->user);

        $dataWithInvalidConsultation = [
            'patient_id' => $this->patient->id,
            'consultation_id' => 99999, // Non-existent consultation
            'fruit' => 3,
            'vegetables' => 4,
        ];

        $response = $this->post('/nutrition/store', $dataWithInvalidConsultation);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['consultation_id']);
    }
}