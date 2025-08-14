<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $firstName = fake()->firstName();
        $lastName = fake()->lastName();
        
        return [
            'name' => $firstName . ' ' . $lastName,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'suffix' => fake()->optional(0.1)->randomElement(['Jr.', 'Sr.', 'III']),
            'email' => fake()->unique()->safeEmail(),
            'phone_number' => fake()->optional()->phoneNumber(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Create a user with specific role (for future role implementation)
     *
     * @return static
     */
    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Admin ' . $attributes['last_name'],
                'email' => 'admin@' . fake()->domainName(),
            ];
        });
    }

    /**
     * Create a clinician user
     *
     * @return static
     */
    public function clinician()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Dr. ' . $attributes['first_name'] . ' ' . $attributes['last_name'],
                'suffix' => fake()->randomElement(['MD', 'RN', 'NP']),
            ];
        });
    }

    /**
     * Create a staff user
     *
     * @return static
     */
    public function staff()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => $attributes['first_name'] . ' ' . $attributes['last_name'] . ' (Staff)',
            ];
        });
    }
}
