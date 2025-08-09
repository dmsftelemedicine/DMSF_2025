<?php

namespace Tests\Feature\ICD10;

use App\Models\Assessment;
use App\Models\Consultation;
use App\Models\Icd10;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ICD10IntegrationTest extends TestCase
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
    public function icd10_ajax_search_returns_json_results()
    {
        $this->actingAs($this->user);

        // Create sample ICD-10 codes
        Icd10::create([
            'code' => 'E11.9',
            'description' => 'Type 2 diabetes mellitus without complications',
            'category' => 'Endocrine',
        ]);
        
        Icd10::create([
            'code' => 'E11.0',
            'description' => 'Type 2 diabetes mellitus with hyperosmolarity',
            'category' => 'Endocrine',
        ]);

        Icd10::create([
            'code' => 'I10',
            'description' => 'Essential hypertension',
            'category' => 'Circulatory',
        ]);

        // Test search by description
        $response = $this->get('/assessments/icd10/search?q=diabetes');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');
        
        $data = $response->json();
        $this->assertIsArray($data);
        $this->assertGreaterThan(0, count($data));
        
        // Verify structure contains required fields
        $this->assertArrayHasKey('code', $data[0]);
        $this->assertArrayHasKey('description', $data[0]);
        $this->assertStringContainsString('diabetes', strtolower($data[0]['description']));

        // Test search by code
        $response = $this->get('/assessments/icd10/search?q=E11');

        $response->assertStatus(200);
        $data = $response->json();
        $this->assertGreaterThan(0, count($data));
        $this->assertStringContainsString('E11', $data[0]['code']);
    }

    /** @test */
    public function icd10_search_returns_limited_results()
    {
        $this->actingAs($this->user);

        // Create many ICD-10 codes
        for ($i = 1; $i <= 20; $i++) {
            Icd10::create([
                'code' => "E11.{$i}",
                'description' => "Type 2 diabetes mellitus variant {$i}",
                'category' => 'Endocrine',
            ]);
        }

        $response = $this->get('/assessments/icd10/search?q=diabetes');

        $response->assertStatus(200);
        $data = $response->json();
        
        // Should limit results (typically 10-15 results max)
        $this->assertLessThanOrEqual(15, count($data));
    }

    /** @test */
    public function icd10_search_handles_empty_query()
    {
        $this->actingAs($this->user);

        $response = $this->get('/assessments/icd10/search?q=');

        $response->assertStatus(200);
        $data = $response->json();
        
        // Should return empty array or limited default set
        $this->assertIsArray($data);
        $this->assertLessThanOrEqual(10, count($data));
    }

    /** @test */
    public function icd10_search_handles_no_results()
    {
        $this->actingAs($this->user);

        $response = $this->get('/assessments/icd10/search?q=nonexistentcondition');

        $response->assertStatus(200);
        $data = $response->json();
        
        $this->assertIsArray($data);
        $this->assertEmpty($data);
    }

    /** @test */
    public function valid_icd10_code_can_be_attached_to_encounter()
    {
        $this->actingAs($this->user);

        // Create valid ICD-10 code
        $icd10 = Icd10::create([
            'code' => 'E11.9',
            'description' => 'Type 2 diabetes mellitus without complications',
            'category' => 'Endocrine',
        ]);

        // Create assessment/encounter
        $assessmentData = [
            'patient_id' => $this->patient->id,
            'consultation_id' => $this->consultation->id,
            'chief_complaint' => 'Diabetes management',
            'diagnosis_codes' => [$icd10->code], // Attach ICD-10 code
        ];

        $response = $this->post('/assessments', $assessmentData);

        $response->assertStatus(302); // Successful creation
        
        // Verify ICD-10 code is attached
        $assessment = Assessment::latest()->first();
        $this->assertNotNull($assessment);
        
        // Check if diagnosis relationship exists
        $this->assertTrue($assessment->diagnoses()->where('icd10_code', $icd10->code)->exists());
    }

    /** @test */
    public function invalid_icd10_code_cannot_be_attached_to_encounter()
    {
        $this->actingAs($this->user);

        // Attempt to attach non-existent ICD-10 code
        $assessmentData = [
            'patient_id' => $this->patient->id,
            'consultation_id' => $this->consultation->id,
            'chief_complaint' => 'Test complaint',
            'diagnosis_codes' => ['INVALID.CODE'], // Invalid ICD-10 code
        ];

        $response = $this->post('/assessments', $assessmentData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['diagnosis_codes']);
    }

    /** @test */
    public function multiple_icd10_codes_can_be_attached_to_encounter()
    {
        $this->actingAs($this->user);

        // Create multiple valid ICD-10 codes
        $icd10_diabetes = Icd10::create([
            'code' => 'E11.9',
            'description' => 'Type 2 diabetes mellitus without complications',
            'category' => 'Endocrine',
        ]);

        $icd10_hypertension = Icd10::create([
            'code' => 'I10',
            'description' => 'Essential hypertension',
            'category' => 'Circulatory',
        ]);

        $assessmentData = [
            'patient_id' => $this->patient->id,
            'consultation_id' => $this->consultation->id,
            'chief_complaint' => 'Multiple conditions',
            'diagnosis_codes' => [$icd10_diabetes->code, $icd10_hypertension->code],
        ];

        $response = $this->post('/assessments', $assessmentData);

        $response->assertStatus(302);
        
        $assessment = Assessment::latest()->first();
        
        // Verify both codes are attached
        $this->assertEquals(2, $assessment->diagnoses()->count());
        $this->assertTrue($assessment->diagnoses()->where('icd10_code', $icd10_diabetes->code)->exists());
        $this->assertTrue($assessment->diagnoses()->where('icd10_code', $icd10_hypertension->code)->exists());
    }

    /** @test */
    public function icd10_code_can_be_removed_from_encounter()
    {
        $this->actingAs($this->user);

        // Create ICD-10 code and assessment
        $icd10 = Icd10::create([
            'code' => 'E11.9',
            'description' => 'Type 2 diabetes mellitus without complications',
            'category' => 'Endocrine',
        ]);

        $assessment = Assessment::create([
            'patient_id' => $this->patient->id,
            'consultation_id' => $this->consultation->id,
            'chief_complaint' => 'Diabetes management',
        ]);

        // Initially attach diagnosis
        $assessment->diagnoses()->create([
            'icd10_code' => $icd10->code,
            'description' => $icd10->description,
        ]);

        $this->assertEquals(1, $assessment->diagnoses()->count());

        // Remove diagnosis
        $response = $this->delete("/assessments/{$assessment->id}/diagnoses/{$icd10->code}");

        $response->assertStatus(200);
        
        // Verify diagnosis is removed
        $this->assertEquals(0, $assessment->fresh()->diagnoses()->count());
    }

    /** @test */
    public function icd10_validation_prevents_duplicate_codes_on_same_encounter()
    {
        $this->actingAs($this->user);

        $icd10 = Icd10::create([
            'code' => 'E11.9',
            'description' => 'Type 2 diabetes mellitus without complications',
            'category' => 'Endocrine',
        ]);

        // Create assessment with ICD-10 code
        $assessment = Assessment::create([
            'patient_id' => $this->patient->id,
            'consultation_id' => $this->consultation->id,
            'chief_complaint' => 'Diabetes management',
        ]);

        $assessment->diagnoses()->create([
            'icd10_code' => $icd10->code,
            'description' => $icd10->description,
        ]);

        // Attempt to add same code again
        $response = $this->post("/assessments/{$assessment->id}/diagnoses", [
            'icd10_code' => $icd10->code,
        ]);

        $response->assertStatus(422);
        
        // Should still have only one diagnosis
        $this->assertEquals(1, $assessment->fresh()->diagnoses()->count());
    }

    /** @test */
    public function icd10_search_is_case_insensitive()
    {
        $this->actingAs($this->user);

        Icd10::create([
            'code' => 'E11.9',
            'description' => 'Type 2 diabetes mellitus without complications',
            'category' => 'Endocrine',
        ]);

        // Test with different cases
        foreach (['DIABETES', 'diabetes', 'Diabetes', 'dIaBeTes'] as $query) {
            $response = $this->get('/assessments/icd10/search?q=' . $query);

            $response->assertStatus(200);
            $data = $response->json();
            $this->assertGreaterThan(0, count($data));
        }
    }

    /** @test */
    public function icd10_search_supports_partial_matching()
    {
        $this->actingAs($this->user);

        Icd10::create([
            'code' => 'E11.9',
            'description' => 'Type 2 diabetes mellitus without complications',
            'category' => 'Endocrine',
        ]);

        // Test partial matches
        $partialQueries = ['diab', 'type 2', 'mellitus', 'E11'];

        foreach ($partialQueries as $query) {
            $response = $this->get('/assessments/icd10/search?q=' . $query);

            $response->assertStatus(200);
            $data = $response->json();
            $this->assertGreaterThan(0, count($data), "Query '{$query}' should return results");
        }
    }
}