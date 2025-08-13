<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleBasedAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create test users with different roles
        $this->admin = User::factory()->admin()->create();
        $this->clinician = User::factory()->clinician()->create();
        $this->staff = User::factory()->staff()->create();
    }

    /** @test */
    public function unauthenticated_users_are_redirected_to_login()
    {
        $protectedRoutes = [
            '/dashboard',
            '/patients',
            '/patients/create',
            '/profile',
        ];

        foreach ($protectedRoutes as $route) {
            $response = $this->get($route);
            $response->assertRedirect('/login');
        }
    }

    /** @test */
    public function authenticated_users_can_access_dashboard()
    {
        $this->actingAs($this->clinician);

        $response = $this->get('/dashboard');
        $response->assertStatus(200);
    }

    /** @test */
    public function all_authenticated_users_can_access_basic_patient_routes()
    {
        $basicRoutes = [
            '/patients',
            '/dashboard',
        ];

        foreach ([$this->admin, $this->clinician, $this->staff] as $user) {
            $this->actingAs($user);
            
            foreach ($basicRoutes as $route) {
                $response = $this->get($route);
                $response->assertStatus(200);
            }
        }
    }

    /** @test */
    public function middleware_auth_is_applied_to_protected_routes()
    {
        // Test routes that should require authentication
        $protectedRoutes = [
            ['GET', '/dashboard'],
            ['GET', '/patients'],
            ['POST', '/patients'],
            ['GET', '/profile'],
            ['POST', '/nutrition/store'],
            ['POST', '/prescription-add'],
        ];

        foreach ($protectedRoutes as [$method, $route]) {
            $response = $this->call($method, $route);
            $this->assertTrue(
                in_array($response->getStatusCode(), [302, 401, 403]),
                "Route {$method} {$route} should require authentication but returned {$response->getStatusCode()}"
            );
        }
    }

    /** @test */
    public function verified_middleware_is_applied_to_dashboard()
    {
        $unverifiedUser = User::factory()->unverified()->create();
        
        $this->actingAs($unverifiedUser);
        
        $response = $this->get('/dashboard');
        
        // Should redirect to email verification
        $response->assertRedirect('/verify-email');
    }

    /** @test */
    public function csrf_protection_is_enabled_for_state_changing_routes()
    {
        $this->actingAs($this->clinician);

        $stateChangingRoutes = [
            ['POST', '/patients'],
            ['POST', '/nutrition/store'],
            ['POST', '/prescription-add'],
            ['PUT', '/patients/1'],
            ['DELETE', '/profile'],
        ];

        foreach ($stateChangingRoutes as [$method, $route]) {
            $response = $this->call($method, $route, [], [], [], [
                'HTTP_X-Requested-With' => 'XMLHttpRequest'
            ]);
            
            // Should get 419 for missing CSRF token
            $this->assertEquals(419, $response->getStatusCode(), 
                "Route {$method} {$route} should require CSRF token");
        }
    }

    // TODO: Implement role-specific access tests when roles are added to the system
    // /** @test */
    // public function only_admins_can_access_admin_routes()
    // {
    //     // Will be implemented when role system is in place
    // }
}