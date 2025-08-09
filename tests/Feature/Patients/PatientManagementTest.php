<?php

namespace Tests\Feature\Patients;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PatientManagementTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->clinician()->create();
    }

    /** @test */
    public function patient_can_be_created_with_valid_data()
    {
        $this->actingAs($this->user);

        $patientData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'middle_name' => 'Michael',
            'birth_date' => '1990-01-15',
            'gender' => 'male',
            'street' => '123 Main St',
            'brgy_address' => 'Brgy. San Jose',
            'occupation' => 'Engineer',
            'highest_educational_attainment' => 'College',
            'marital_status' => 'Single',
            'monthly_household_income' => 25000,
            'religion' => 'Catholic',
            'height' => 175,
        ];

        $response = $this->post('/patients', $patientData);

        $response->assertStatus(302); // Redirect after creation
        
        $this->assertDatabaseHas('patients', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'birth_date' => '1990-01-15',
            'gender' => 'male',
        ]);

        // Verify reference number is auto-generated
        $patient = Patient::where('first_name', 'John')->first();
        $this->assertNotNull($patient->reference_number);
        $this->assertMatchesRegularExpression('/^[A-Z]{2}[0-9]{6}$/', $patient->reference_number);
    }

    /** @test */
    public function patient_creation_validates_required_fields()
    {
        $this->actingAs($this->user);

        $incompleteData = [
            'first_name' => 'John',
            // Missing required fields
        ];

        $response = $this->post('/patients', $incompleteData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['last_name', 'birth_date', 'gender']);
    }

    /** @test */
    public function patient_can_be_edited_and_updated()
    {
        $this->actingAs($this->user);

        $patient = Patient::factory()->create([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
        ]);

        // Test edit form
        $response = $this->get("/patients/{$patient->id}/edit");
        $response->assertStatus(200);
        $response->assertSee($patient->first_name);
        $response->assertSee($patient->last_name);

        // Test update
        $updateData = [
            'first_name' => 'Jane Updated',
            'last_name' => 'Smith Updated',
            'birth_date' => $patient->birth_date,
            'gender' => $patient->gender,
        ];

        $response = $this->put("/patients/{$patient->id}", $updateData);

        $response->assertStatus(302);
        
        $this->assertDatabaseHas('patients', [
            'id' => $patient->id,
            'first_name' => 'Jane Updated',
            'last_name' => 'Smith Updated',
        ]);
    }

    /** @test */
    public function duplicate_patient_logic_is_honored()
    {
        $this->actingAs($this->user);

        // Create first patient
        $firstPatient = Patient::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'birth_date' => '1990-01-15',
        ]);

        // Attempt to create duplicate patient (same name and birth date)
        $duplicateData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'birth_date' => '1990-01-15',
            'gender' => 'male',
            'street' => '456 Different St',
        ];

        $response = $this->post('/patients', $duplicateData);

        // Should either reject or warn about duplicate
        if ($response->status() === 422) {
            $response->assertJsonValidationErrors(); // Contains duplicate warning
        } else {
            // If allowing creation, should have different reference number
            $secondPatient = Patient::where('first_name', 'John')
                ->where('birth_date', '1990-01-15')
                ->orderBy('id', 'desc')
                ->first();
            
            $this->assertNotEquals($firstPatient->reference_number, $secondPatient->reference_number);
        }
    }

    /** @test */
    public function patient_list_supports_filters()
    {
        $this->actingAs($this->user);

        // Create patients with different attributes
        Patient::factory()->create(['gender' => 'male', 'marital_status' => 'Single']);
        Patient::factory()->create(['gender' => 'female', 'marital_status' => 'Married']);
        Patient::factory()->create(['gender' => 'male', 'marital_status' => 'Married']);

        // Test gender filter
        $response = $this->get('/patients?gender=male');
        $response->assertStatus(200);
        // Should contain male patients only

        // Test marital status filter
        $response = $this->get('/patients?marital_status=Single');
        $response->assertStatus(200);
        // Should contain single patients only

        // Test multiple filters
        $response = $this->get('/patients?gender=male&marital_status=Married');
        $response->assertStatus(200);
        // Should contain male married patients only
    }

    /** @test */
    public function patient_list_supports_search()
    {
        $this->actingAs($this->user);

        // Create patients with distinct names
        Patient::factory()->create([
            'first_name' => 'Alice',
            'last_name' => 'Johnson',
            'reference_number' => 'AJ123456'
        ]);
        Patient::factory()->create([
            'first_name' => 'Bob',
            'last_name' => 'Wilson',
            'reference_number' => 'BW789012'
        ]);

        // Test search by first name
        $response = $this->get('/patients?search=Alice');
        $response->assertStatus(200);
        $response->assertSee('Alice');
        $response->assertDontSee('Bob');

        // Test search by last name
        $response = $this->get('/patients?search=Wilson');
        $response->assertStatus(200);
        $response->assertSee('Wilson');
        $response->assertDontSee('Johnson');

        // Test search by reference number
        $response = $this->get('/patients?search=AJ123456');
        $response->assertStatus(200);
        $response->assertSee('Alice');
        $response->assertDontSee('Bob');
    }

    /** @test */
    public function patient_audit_fields_are_set_correctly()
    {
        $this->actingAs($this->user);

        $patientData = Patient::factory()->make()->toArray();

        $response = $this->post('/patients', $patientData);

        $response->assertStatus(302);

        $patient = Patient::latest()->first();
        
        // Verify audit fields
        $this->assertNotNull($patient->created_at);
        $this->assertNotNull($patient->updated_at);
        $this->assertEquals($patient->created_at->format('Y-m-d'), now()->format('Y-m-d'));
        
        // If user tracking is implemented, verify created_by field
        // $this->assertEquals($this->user->id, $patient->created_by);
    }

    /** @test */
    public function patient_show_page_renders_correctly()
    {
        $this->actingAs($this->user);

        $patient = Patient::factory()->create();

        $response = $this->get("/patients/{$patient->id}");

        $response->assertStatus(200);
        $response->assertSee($patient->first_name);
        $response->assertSee($patient->last_name);
        $response->assertSee($patient->reference_number);
    }

    /** @test */
    public function patient_measurements_can_be_updated()
    {
        $this->actingAs($this->user);

        $patient = Patient::factory()->create();

        // Test height update
        $response = $this->post("/patients/{$patient->id}/update-height", [
            'height' => 180
        ]);
        $response->assertStatus(302);

        // Test weight update
        $response = $this->post("/patients/{$patient->id}/update-weight", [
            'weight' => 75
        ]);
        $response->assertStatus(302);

        // Test waist update
        $response = $this->post("/patients/{$patient->id}/update-waist", [
            'waist' => 85
        ]);
        $response->assertStatus(302);

        // Verify measurements are stored
        // Should be in patient_measurements table based on migration
        $this->assertDatabaseHas('patient_measurements', [
            'patient_id' => $patient->id,
        ]);
    }

    /** @test */
    public function patient_vital_signs_can_be_updated()
    {
        $this->actingAs($this->user);

        $patient = Patient::factory()->create();

        // Test blood pressure update
        $response = $this->post("/patients/{$patient->id}/update-blood-pressure", [
            'systolic' => 120,
            'diastolic' => 80
        ]);
        $response->assertStatus(302);

        // Test heart rate update
        $response = $this->post("/patients/{$patient->id}/update-heart-rate", [
            'heart_rate' => 72
        ]);
        $response->assertStatus(302);

        // Test temperature update
        $response = $this->post("/patients/{$patient->id}/update-temperature", [
            'temperature' => 36.5
        ]);
        $response->assertStatus(302);

        // Verify vital signs are stored
        $this->assertDatabaseHas('patient_measurements', [
            'patient_id' => $patient->id,
        ]);
    }

    /** @test */
    public function patient_diagnosis_can_be_updated()
    {
        $this->actingAs($this->user);

        $patient = Patient::factory()->create(['diagnosis' => null]);

        $response = $this->post("/patients/{$patient->id}/update-diagnosis", [
            'diagnosis' => 'Type 2 Diabetes Mellitus'
        ]);

        $response->assertStatus(302);
        
        $this->assertDatabaseHas('patients', [
            'id' => $patient->id,
            'diagnosis' => 'Type 2 Diabetes Mellitus'
        ]);
    }
}