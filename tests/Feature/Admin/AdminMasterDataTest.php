<?php

namespace Tests\Feature\Admin;

use App\Models\Medicine;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminMasterDataTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $clinician;
    protected $staff;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->admin = User::factory()->admin()->create();
        $this->clinician = User::factory()->clinician()->create();
        $this->staff = User::factory()->staff()->create();
    }

    /** @test */
    public function admin_can_access_medicine_management()
    {
        $this->actingAs($this->admin);

        $response = $this->get('/admin/medicines');
        $response->assertStatus(200);
    }

    /** @test */
    public function non_admin_cannot_access_medicine_management()
    {
        $this->actingAs($this->clinician);

        $response = $this->get('/admin/medicines');
        $response->assertStatus(403); // Forbidden
    }

    /** @test */
    public function admin_can_create_medicine_with_validation()
    {
        $this->actingAs($this->admin);

        $validMedicineData = [
            'generic_name' => 'Metformin',
            'brand_name' => 'Glucophage',
            'strength' => '500mg',
            'dosage_form' => 'Tablet',
            'therapeutic_class' => 'Antidiabetic',
            'indication' => 'Type 2 Diabetes Mellitus',
        ];

        $response = $this->post('/admin/medicines', $validMedicineData);

        $response->assertStatus(302); // Redirect after creation
        
        $this->assertDatabaseHas('medicines', [
            'generic_name' => 'Metformin',
            'brand_name' => 'Glucophage',
            'strength' => '500mg',
        ]);
    }

    /** @test */
    public function medicine_creation_validates_required_fields()
    {
        $this->actingAs($this->admin);

        $invalidData = [
            'brand_name' => 'Test Brand',
            // Missing required generic_name
        ];

        $response = $this->post('/admin/medicines', $invalidData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['generic_name']);
    }

    /** @test */
    public function medicine_creation_enforces_unique_constraints()
    {
        $this->actingAs($this->admin);

        // Create first medicine
        Medicine::create([
            'generic_name' => 'Metformin',
            'brand_name' => 'Glucophage',
            'strength' => '500mg',
            'dosage_form' => 'Tablet',
        ]);

        // Attempt to create duplicate
        $duplicateData = [
            'generic_name' => 'Metformin',
            'brand_name' => 'Glucophage',
            'strength' => '500mg',
            'dosage_form' => 'Tablet',
        ];

        $response = $this->post('/admin/medicines', $duplicateData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(); // Should contain uniqueness error
    }

    /** @test */
    public function admin_can_update_medicine()
    {
        $this->actingAs($this->admin);

        $medicine = Medicine::create([
            'generic_name' => 'Metformin',
            'brand_name' => 'Glucophage',
            'strength' => '500mg',
            'dosage_form' => 'Tablet',
        ]);

        $updateData = [
            'generic_name' => 'Metformin HCl',
            'brand_name' => 'Glucophage XR',
            'strength' => '750mg',
            'dosage_form' => 'Extended Release Tablet',
        ];

        $response = $this->put("/admin/medicines/{$medicine->id}", $updateData);

        $response->assertStatus(302);
        
        $this->assertDatabaseHas('medicines', [
            'id' => $medicine->id,
            'generic_name' => 'Metformin HCl',
            'brand_name' => 'Glucophage XR',
            'strength' => '750mg',
        ]);
    }

    /** @test */
    public function admin_can_delete_medicine()
    {
        $this->actingAs($this->admin);

        $medicine = Medicine::create([
            'generic_name' => 'Test Medicine',
            'brand_name' => 'Test Brand',
            'strength' => '100mg',
            'dosage_form' => 'Tablet',
        ]);

        $response = $this->delete("/admin/medicines/{$medicine->id}");

        $response->assertStatus(200);
        
        // Verify soft delete or hard delete depending on implementation
        $this->assertDatabaseMissing('medicines', [
            'id' => $medicine->id,
            'deleted_at' => null,
        ]);
    }

    /** @test */
    public function non_admin_cannot_create_medicine()
    {
        $this->actingAs($this->clinician);

        $medicineData = [
            'generic_name' => 'Unauthorized Medicine',
            'brand_name' => 'Unauthorized Brand',
            'strength' => '100mg',
            'dosage_form' => 'Tablet',
        ];

        $response = $this->post('/admin/medicines', $medicineData);

        $response->assertStatus(403);
        
        $this->assertDatabaseMissing('medicines', [
            'generic_name' => 'Unauthorized Medicine',
        ]);
    }

    /** @test */
    public function non_admin_cannot_update_medicine()
    {
        $this->actingAs($this->staff);

        $medicine = Medicine::create([
            'generic_name' => 'Protected Medicine',
            'brand_name' => 'Protected Brand',
            'strength' => '100mg',
            'dosage_form' => 'Tablet',
        ]);

        $updateData = [
            'generic_name' => 'Unauthorized Update',
        ];

        $response = $this->put("/admin/medicines/{$medicine->id}", $updateData);

        $response->assertStatus(403);
        
        // Verify no changes were made
        $this->assertDatabaseHas('medicines', [
            'id' => $medicine->id,
            'generic_name' => 'Protected Medicine',
        ]);
    }

    /** @test */
    public function non_admin_cannot_delete_medicine()
    {
        $this->actingAs($this->clinician);

        $medicine = Medicine::create([
            'generic_name' => 'Protected Medicine',
            'brand_name' => 'Protected Brand',
            'strength' => '100mg',
            'dosage_form' => 'Tablet',
        ]);

        $response = $this->delete("/admin/medicines/{$medicine->id}");

        $response->assertStatus(403);
        
        // Verify medicine still exists
        $this->assertDatabaseHas('medicines', [
            'id' => $medicine->id,
            'generic_name' => 'Protected Medicine',
        ]);
    }

    /** @test */
    public function medicine_search_returns_filtered_results()
    {
        $this->actingAs($this->admin);

        // Create test medicines
        Medicine::create([
            'generic_name' => 'Metformin',
            'brand_name' => 'Glucophage',
            'strength' => '500mg',
            'dosage_form' => 'Tablet',
        ]);

        Medicine::create([
            'generic_name' => 'Insulin',
            'brand_name' => 'Lantus',
            'strength' => '100 units/mL',
            'dosage_form' => 'Injection',
        ]);

        // Test search functionality
        $response = $this->get('/medicines/search?q=metformin');

        $response->assertStatus(200);
        $response->assertJson([
            [
                'generic_name' => 'Metformin',
                'brand_name' => 'Glucophage',
            ]
        ]);
    }

    /** @test */
    public function admin_routes_are_protected_by_middleware()
    {
        // Test without authentication
        $adminRoutes = [
            ['GET', '/admin/medicines'],
            ['POST', '/admin/medicines'],
            ['PUT', '/admin/medicines/1'],
            ['DELETE', '/admin/medicines/1'],
        ];

        foreach ($adminRoutes as [$method, $route]) {
            $response = $this->call($method, $route);
            
            $this->assertTrue(
                in_array($response->getStatusCode(), [302, 401, 403]),
                "Admin route {$method} {$route} should require authentication"
            );
        }
    }

    /** @test */
    public function medicine_validation_prevents_invalid_data()
    {
        $this->actingAs($this->admin);

        $invalidDatasets = [
            [
                'generic_name' => '', // Empty required field
                'strength' => '500mg',
                'expected_errors' => ['generic_name']
            ],
            [
                'generic_name' => 'Test Medicine',
                'strength' => '', // Empty strength
                'expected_errors' => ['strength']
            ],
            [
                'generic_name' => str_repeat('a', 300), // Too long
                'strength' => '500mg',
                'expected_errors' => ['generic_name']
            ],
        ];

        foreach ($invalidDatasets as $dataset) {
            $response = $this->post('/admin/medicines', $dataset);
            
            $response->assertStatus(422);
            
            foreach ($dataset['expected_errors'] as $field) {
                $response->assertJsonValidationErrors([$field]);
            }
        }
    }
}