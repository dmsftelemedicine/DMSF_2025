<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContinuousIntegrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function all_test_suites_are_executable()
    {
        // This test verifies that the test structure is properly set up
        // and all major test categories are available
        
        $testSuites = [
            'Auth' => 'tests/Feature/Auth',
            'Nutrition' => 'tests/Feature/Nutrition', 
            'Patients' => 'tests/Feature/Patients',
            'ICD10' => 'tests/Feature/ICD10',
            'Consultations' => 'tests/Feature/Consultations',
            'Uploads' => 'tests/Feature/Uploads',
            'Reports' => 'tests/Feature/Reports',
            'Admin' => 'tests/Feature/Admin',
            'Appointments' => 'tests/Feature/Appointments',
            'Policies' => 'tests/Unit/Policies',
        ];

        foreach ($testSuites as $suite => $directory) {
            $this->assertTrue(
                is_dir(base_path($directory)),
                "Test suite directory for {$suite} should exist at {$directory}"
            );
        }

        // Verify key test files exist
        $keyTestFiles = [
            'tests/Feature/Auth/RoleBasedAccessTest.php',
            'tests/Feature/Nutrition/NutritionAssessmentTest.php',
            'tests/Feature/Nutrition/ComprehensiveNutritionFormTest.php',
            'tests/Feature/Patients/PatientManagementTest.php',
            'tests/Feature/ICD10/ICD10IntegrationTest.php',
            'tests/Feature/Consultations/ConsultationNotesTest.php',
            'tests/Feature/Uploads/FileUploadTest.php',
            'tests/Feature/Reports/ReportsAndExportsTest.php',
            'tests/Feature/Admin/AdminMasterDataTest.php',
            'tests/Unit/Policies/PatientPolicyTest.php',
            'tests/Unit/DatabaseIntegrityTest.php',
        ];

        foreach ($keyTestFiles as $testFile) {
            $this->assertTrue(
                file_exists(base_path($testFile)),
                "Key test file should exist: {$testFile}"
            );
        }
    }

    /** @test */
    public function database_factories_are_available()
    {
        // Verify all major model factories exist
        $factories = [
            'UserFactory.php',
            'PatientFactory.php',
            'ConsultationFactory.php',
            'NutritionFactory.php',
            'AssessmentFactory.php',
            'ComprehensiveHistoryFactory.php',
            'Icd10Factory.php',
            'MedicineFactory.php',
        ];

        foreach ($factories as $factory) {
            $this->assertTrue(
                file_exists(base_path("database/factories/{$factory}")),
                "Factory should exist: {$factory}"
            );
        }
    }

    /** @test */
    public function policies_are_properly_structured()
    {
        // Verify policy files exist
        $policies = [
            'PatientPolicy.php',
        ];

        foreach ($policies as $policy) {
            $this->assertTrue(
                file_exists(base_path("app/Policies/{$policy}")),
                "Policy should exist: {$policy}"
            );
        }
    }

    /** @test */
    public function test_environment_is_properly_configured()
    {
        // Verify we're in testing environment
        $this->assertEquals('testing', app()->environment());
        
        // Verify database is using testing configuration
        $this->assertStringContainsString('testing', config('database.default'));
    }
}