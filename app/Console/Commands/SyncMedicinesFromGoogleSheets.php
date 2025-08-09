<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\GoogleSheetsService;
use App\Models\Medicine;
use App\Models\MedicineInstruction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SyncMedicinesFromGoogleSheets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'medicines:sync {--test : Test the connection without syncing data}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync medicines data from Google Sheets';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting medicines sync from Google Sheets...');
        
        try {
            $googleSheetsService = new GoogleSheetsService();
            
            // Test connection if --test flag is used
            if ($this->option('test')) {
                $this->info('Testing Google Sheets connection...');
                if ($googleSheetsService->testConnection()) {
                    $this->info('✅ Connection successful!');
                    return 0;
                } else {
                    $this->error('❌ Connection failed!');
                    return 1;
                }
            }
            
            // Fetch data from Google Sheets
            $this->info('Fetching medicines data from Google Sheets...');
            $medicinesData = $googleSheetsService->getMedicinesData();
            
            if (empty($medicinesData)) {
                $this->warn('No medicines data found in Google Sheets.');
                return 0;
            }
            
            $this->info('Found ' . count($medicinesData) . ' medicines in Google Sheets.');
            
            // Start database transaction
            DB::beginTransaction();
            
            try {
                $created = 0;
                $updated = 0;
                $instructionsCreated = 0;
                
                foreach ($medicinesData as $medicineData) {
                    // Skip if name is empty
                    if (empty($medicineData['name'])) {
                        continue;
                    }
                    
                    // Find or create the medicine
                    $medicine = Medicine::firstOrCreate(
                        ['name' => $medicineData['name']]
                    );
                    
                    if ($medicine->wasRecentlyCreated) {
                        $created++;
                        $this->line("➕ Created medicine: {$medicine->name}");
                    }
                    
                    // Create the instruction for this medicine
                    $instruction = MedicineInstruction::create([
                        'medicine_id' => $medicine->id,
                        'rx_english_instructions' => $medicineData['rx_english_instructions']
                    ]);
                    
                    $instructionsCreated++;
                    $this->line("� Added instruction for: {$medicine->name}");
                }
                
                DB::commit();
                
                $this->info("✅ Sync completed successfully!");
                $this->info("📊 Summary:");
                $this->info("   - Medicines created: {$created}");
                $this->info("   - Instructions created: {$instructionsCreated}");
                $this->info("   - Total processed: " . count($medicinesData));
                
                Log::info("Medicines sync completed", [
                    'medicines_created' => $created,
                    'instructions_created' => $instructionsCreated,
                    'total' => count($medicinesData)
                ]);
                
                return 0;
                
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
            
        } catch (\Exception $e) {
            $this->error('❌ Error during medicines sync: ' . $e->getMessage());
            Log::error('Medicines sync failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return 1;
        }
    }
}
