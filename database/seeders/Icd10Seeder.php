<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Icd10;
use Illuminate\Support\Facades\File;

class Icd10Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Starting ICD-10 seeding...');

        // Path to the ICD-10 data file
        $filePath = resource_path('data/code-description-pairs.txt');

        if (!File::exists($filePath)) {
            $this->command->error("ICD-10 data file not found at: {$filePath}");
            return;
        }

        // Clear existing data
        Icd10::truncate();

        // Read and parse the file
        $lines = File::lines($filePath);
        $data = [];
        $batchSize = 1000; // Process in batches for better performance

        foreach ($lines as $line) {
            $line = trim($line);
            
            if (empty($line)) {
                continue;
            }

            // Split by tab
            $parts = explode("\t", $line);
            
            if (count($parts) >= 2) {
                $code = trim($parts[0]);
                $description = trim($parts[1]);
                
                // Determine if it's a category (single letter or range like "A00-A09")
                $isCategory = $this->isCategory($code);
                
                $data[] = [
                    'code' => $code,
                    'description' => $description,
                    'is_category' => $isCategory,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // Insert in batches
                if (count($data) >= $batchSize) {
                    Icd10::insert($data);
                    $data = [];
                    $this->command->info('Processed ' . ($batchSize) . ' records...');
                }
            }
        }

        // Insert remaining data
        if (!empty($data)) {
            Icd10::insert($data);
        }

        $totalRecords = Icd10::count();
        $this->command->info("ICD-10 seeding completed! Total records: {$totalRecords}");
    }

    /**
     * Determine if a code is a category (chapter header or range)
     */
    private function isCategory(string $code): bool
    {
        // Single letters (chapters like "I", "II", "III")
        if (preg_match('/^[A-Z]+$/', $code)) {
            return true;
        }

        // Ranges like "A00-A09"
        if (preg_match('/^[A-Z]\d{2}-[A-Z]\d{2}$/', $code)) {
            return true;
        }

        return false;
    }
}
