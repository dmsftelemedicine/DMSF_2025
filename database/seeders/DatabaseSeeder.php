<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PhysicalActivityDescriptionSeeder::class,
            Icd10Seeder::class,
            MedicineSeeder::class,
        ]);
        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'first_name' => 'Test',
                'last_name' => 'User',
                'role' => 'admin',
            ]);
        }
    }
}
