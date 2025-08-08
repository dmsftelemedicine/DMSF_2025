<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleSheetsService;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class GoogleSheetsController extends Controller
{
    /**
     * Test Google Sheets connection
     */
    public function testConnection()
    {
        try {
            $googleSheetsService = new GoogleSheetsService();
            $success = $googleSheetsService->testConnection();
            
            if ($success) {
                return response()->json([
                    'success' => true,
                    'message' => 'Google Sheets connection successful!'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Google Sheets connection failed!'
                ], 500);
            }
        } catch (\Exception $e) {
            Log::error('Google Sheets connection test error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Connection error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Manually trigger medicines sync
     */
    public function syncMedicines()
    {
        try {
            // Run the sync command
            Artisan::call('medicines:sync');
            $output = Artisan::output();
            
            return response()->json([
                'success' => true,
                'message' => 'Medicines sync completed successfully!',
                'output' => $output
            ]);
        } catch (\Exception $e) {
            Log::error('Manual medicines sync error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Sync failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get sync status and logs
     */
    public function getSyncStatus()
    {
        try {
            $logPath = storage_path('logs/medicines-sync.log');
            $lastSync = null;
            $logContent = '';
            
            if (file_exists($logPath)) {
                $lastSync = date('Y-m-d H:i:s', filemtime($logPath));
                $logContent = file_get_contents($logPath);
            }
            
            return response()->json([
                'success' => true,
                'last_sync' => $lastSync,
                'log_content' => $logContent
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error getting sync status: ' . $e->getMessage()
            ], 500);
        }
    }
}
