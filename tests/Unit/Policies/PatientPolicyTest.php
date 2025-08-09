<?php

namespace Tests\Unit\Policies;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PatientPolicyTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $clinician;
    protected $staff;
    protected $patient;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->admin = User::factory()->admin()->create();
        $this->clinician = User::factory()->clinician()->create();
        $this->staff = User::factory()->staff()->create();
        $this->patient = Patient::factory()->create();
    }

    /** @test */
    public function admin_can_view_any_patient()
    {
        $this->assertTrue($this->admin->can('viewAny', Patient::class));
    }

    /** @test */
    public function clinician_can_view_any_patient()
    {
        $this->assertTrue($this->clinician->can('viewAny', Patient::class));
    }

    /** @test */
    public function staff_can_view_any_patient()
    {
        $this->assertTrue($this->staff->can('viewAny', Patient::class));
    }

    /** @test */
    public function admin_can_view_specific_patient()
    {
        $this->assertTrue($this->admin->can('view', $this->patient));
    }

    /** @test */
    public function clinician_can_view_specific_patient()
    {
        $this->assertTrue($this->clinician->can('view', $this->patient));
    }

    /** @test */
    public function staff_can_view_specific_patient()
    {
        $this->assertTrue($this->staff->can('view', $this->patient));
    }

    /** @test */
    public function admin_can_create_patient()
    {
        $this->assertTrue($this->admin->can('create', Patient::class));
    }

    /** @test */
    public function clinician_can_create_patient()
    {
        $this->assertTrue($this->clinician->can('create', Patient::class));
    }

    /** @test */
    public function staff_can_create_patient()
    {
        $this->assertTrue($this->staff->can('create', Patient::class));
    }

    /** @test */
    public function admin_can_update_any_patient()
    {
        $this->assertTrue($this->admin->can('update', $this->patient));
    }

    /** @test */
    public function clinician_can_update_any_patient()
    {
        $this->assertTrue($this->clinician->can('update', $this->patient));
    }

    /** @test */
    public function staff_cannot_update_patient()
    {
        // Assuming staff have limited update permissions
        $this->assertFalse($this->staff->can('update', $this->patient));
    }

    /** @test */
    public function admin_can_delete_patient()
    {
        $this->assertTrue($this->admin->can('delete', $this->patient));
    }

    /** @test */
    public function clinician_cannot_delete_patient()
    {
        // Assuming only admins can delete patients
        $this->assertFalse($this->clinician->can('delete', $this->patient));
    }

    /** @test */
    public function staff_cannot_delete_patient()
    {
        $this->assertFalse($this->staff->can('delete', $this->patient));
    }

    /** @test */
    public function admin_can_restore_patient()
    {
        $this->assertTrue($this->admin->can('restore', $this->patient));
    }

    /** @test */
    public function clinician_cannot_restore_patient()
    {
        $this->assertFalse($this->clinician->can('restore', $this->patient));
    }

    /** @test */
    public function staff_cannot_restore_patient()
    {
        $this->assertFalse($this->staff->can('restore', $this->patient));
    }

    /** @test */
    public function admin_can_force_delete_patient()
    {
        $this->assertTrue($this->admin->can('forceDelete', $this->patient));
    }

    /** @test */
    public function clinician_cannot_force_delete_patient()
    {
        $this->assertFalse($this->clinician->can('forceDelete', $this->patient));
    }

    /** @test */
    public function staff_cannot_force_delete_patient()
    {
        $this->assertFalse($this->staff->can('forceDelete', $this->patient));
    }
}