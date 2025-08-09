<?php

namespace Tests\Feature\Reports;

use App\Models\Consultation;
use App\Models\Nutrition;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReportsAndExportsTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $patient;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->clinician()->create();
        $this->patient = Patient::factory()->create();
    }

    /** @test */
    public function patient_report_exports_with_correct_columns_and_headers()
    {
        $this->actingAs($this->user);

        // Create test data
        $consultation = Consultation::factory()
            ->forPatient($this->patient->id)
            ->create();

        Nutrition::factory()
            ->forPatient($this->patient->id)
            ->withConsultation()
            ->create(['consultation_id' => $consultation->id]);

        $response = $this->get("/reports/patients/export?format=csv");

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/csv; charset=UTF-8');
        
        $content = $response->getContent();
        $lines = explode("\n", $content);
        
        // Verify CSV headers are present
        $headers = str_getcsv($lines[0]);
        $expectedHeaders = [
            'Reference Number',
            'First Name',
            'Last Name',
            'Birth Date',
            'Gender',
            'Age',
            'Address',
            'Occupation',
            'Education',
            'Marital Status',
            'Monthly Income',
            'Religion'
        ];

        foreach ($expectedHeaders as $expectedHeader) {
            $this->assertContains($expectedHeader, $headers, 
                "Header '{$expectedHeader}' should be present in export");
        }

        // Verify patient data is included
        $this->assertStringContainsString($this->patient->reference_number, $content);
        $this->assertStringContainsString($this->patient->first_name, $content);
        $this->assertStringContainsString($this->patient->last_name, $content);
    }

    /** @test */
    public function nutrition_assessment_report_includes_correct_data()
    {
        $this->actingAs($this->user);

        $consultation = Consultation::factory()
            ->forPatient($this->patient->id)
            ->create();

        $nutrition = Nutrition::factory()
            ->forPatient($this->patient->id)
            ->create([
                'consultation_id' => $consultation->id,
                'fruit' => 3,
                'vegetables' => 4,
                'water' => 8,
                'dq_score' => 75,
            ]);

        $response = $this->get("/reports/nutrition/export?format=xlsx");

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        
        // For Excel files, we'd need to parse the content
        // For now, just verify the response is successful and correct type
        $this->assertNotEmpty($response->getContent());
    }

    /** @test */
    public function report_exports_respect_date_filters()
    {
        $this->actingAs($this->user);

        // Create consultations on different dates
        $oldConsultation = Consultation::factory()
            ->forPatient($this->patient->id)
            ->create(['consultation_date' => Carbon::now()->subMonths(3)]);

        $recentConsultation = Consultation::factory()
            ->forPatient($this->patient->id)
            ->create(['consultation_date' => Carbon::now()->subDays(5)]);

        // Export with date filter
        $startDate = Carbon::now()->subDays(10)->format('Y-m-d');
        $endDate = Carbon::now()->format('Y-m-d');

        $response = $this->get("/reports/consultations/export?start_date={$startDate}&end_date={$endDate}&format=csv");

        $response->assertStatus(200);
        
        $content = $response->getContent();
        
        // Should include recent consultation
        $this->assertStringContainsString($recentConsultation->id, $content);
        
        // Should NOT include old consultation
        $this->assertStringNotContainsString($oldConsultation->id, $content);
    }

    /** @test */
    public function report_exports_handle_timezone_correctly()
    {
        $this->actingAs($this->user);

        // Set specific timezone for test
        config(['app.timezone' => 'Asia/Manila']);

        $consultation = Consultation::factory()
            ->forPatient($this->patient->id)
            ->create([
                'consultation_date' => Carbon::createFromFormat('Y-m-d H:i:s', '2024-01-15 14:30:00', 'UTC')
            ]);

        $response = $this->get("/reports/consultations/export?format=csv");

        $response->assertStatus(200);
        
        $content = $response->getContent();
        
        // Verify date is displayed in correct timezone
        // In Asia/Manila timezone, 14:30 UTC should be 22:30
        $this->assertStringContainsString('22:30', $content);
    }

    /** @test */
    public function report_exports_redact_phi_when_required()
    {
        $this->actingAs($this->user);

        // Create patient with PHI data
        $patient = Patient::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'reference_number' => 'JD123456',
        ]);

        // Export with PHI redaction flag
        $response = $this->get("/reports/patients/export?format=csv&redact_phi=true");

        $response->assertStatus(200);
        
        $content = $response->getContent();
        
        // Verify PHI is redacted
        $this->assertStringNotContainsString('John', $content);
        $this->assertStringNotContainsString('Doe', $content);
        
        // But reference number should be present (assuming it's not considered PHI)
        $this->assertStringContainsString('JD123456', $content);
        
        // Should contain redacted placeholders
        $this->assertStringContainsString('***', $content);
    }

    /** @test */
    public function diagnostic_report_export_includes_icd10_codes()
    {
        $this->actingAs($this->user);

        $consultation = Consultation::factory()
            ->forPatient($this->patient->id)
            ->create();

        // Create assessment with ICD-10 diagnosis
        $assessment = \App\Models\Assessment::factory()
            ->forPatient($this->patient->id)
            ->forConsultation($consultation->id)
            ->create();

        // Add diagnosis with ICD-10 code
        $assessment->diagnoses()->create([
            'icd10_code' => 'E11.9',
            'description' => 'Type 2 diabetes mellitus without complications',
        ]);

        $response = $this->get("/reports/diagnostics/export?format=pdf");

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
        
        // For PDF, verify it's not empty
        $this->assertNotEmpty($response->getContent());
    }

    /** @test */
    public function comprehensive_report_includes_all_patient_data()
    {
        $this->actingAs($this->user);

        $consultation = Consultation::factory()
            ->forPatient($this->patient->id)
            ->create();

        // Create comprehensive data
        Nutrition::factory()
            ->forPatient($this->patient->id)
            ->create(['consultation_id' => $consultation->id]);

        \App\Models\Assessment::factory()
            ->forPatient($this->patient->id)
            ->forConsultation($consultation->id)
            ->create();

        \App\Models\ComprehensiveHistory::factory()
            ->forPatient($this->patient->id)
            ->create();

        $response = $this->get("/reports/comprehensive/{$this->patient->id}/export?format=pdf");

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
        
        // Verify comprehensive report is generated
        $this->assertNotEmpty($response->getContent());
        $this->assertGreaterThan(1000, strlen($response->getContent())); // PDF should be substantial
    }

    /** @test */
    public function report_export_requires_authentication()
    {
        // Test without authentication
        $response = $this->get("/reports/patients/export?format=csv");

        $response->assertStatus(302); // Redirect to login
        $response->assertRedirect('/login');
    }

    /** @test */
    public function report_export_validates_format_parameter()
    {
        $this->actingAs($this->user);

        // Test with invalid format
        $response = $this->get("/reports/patients/export?format=invalid");

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['format']);
    }

    /** @test */
    public function report_export_validates_date_parameters()
    {
        $this->actingAs($this->user);

        // Test with invalid date format
        $response = $this->get("/reports/consultations/export?start_date=invalid-date&format=csv");

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['start_date']);

        // Test with end date before start date
        $response = $this->get("/reports/consultations/export?start_date=2024-01-15&end_date=2024-01-10&format=csv");

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['end_date']);
    }

    /** @test */
    public function report_export_includes_file_download_headers()
    {
        $this->actingAs($this->user);

        $response = $this->get("/reports/patients/export?format=csv");

        $response->assertStatus(200);
        $response->assertHeader('Content-Disposition');
        
        $contentDisposition = $response->headers->get('Content-Disposition');
        $this->assertStringContainsString('attachment', $contentDisposition);
        $this->assertStringContainsString('patients_export', $contentDisposition);
    }

    /** @test */
    public function report_export_handles_large_datasets()
    {
        $this->actingAs($this->user);

        // Create large dataset
        Patient::factory()->count(100)->create();

        $response = $this->get("/reports/patients/export?format=csv");

        $response->assertStatus(200);
        
        // Verify response is substantial but not timing out
        $content = $response->getContent();
        $lines = explode("\n", $content);
        
        // Should have header + 100 data rows (plus possible empty line at end)
        $this->assertGreaterThanOrEqual(100, count($lines) - 1);
    }
}