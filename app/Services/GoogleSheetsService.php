<?php

namespace App\Services;

use Google\Client;
use Google\Service\Sheets;
use Illuminate\Support\Facades\Log;

class GoogleSheetsService
{
    private $client;
    private $sheetsService;
    private $spreadsheetId;

    public function __construct()
    {
        $this->spreadsheetId = config('services.google_sheets.spreadsheet_id');
        $this->initializeClient();
    }

    private function initializeClient()
    {
        $this->client = new Client();
        
        // Set up service account authentication
        $credentialsPath = config('services.google_sheets.credentials_path');
        
        if (!$credentialsPath || !file_exists($credentialsPath)) {
            throw new \Exception('Google service account credentials file not found.');
        }

        $this->client->setAuthConfig($credentialsPath);
        $this->client->addScope(Sheets::SPREADSHEETS_READONLY);
        
        $this->sheetsService = new Sheets($this->client);
    }

    /**
     * Fetch medicines data from Google Sheets
     *
     * @param string $range The range to fetch (e.g., 'Sheet1!A:E')
     * @return array
     */
    public function getMedicinesData($range = null)
    {
        try {
            // If no range specified, try to detect the correct sheet name and range
            if (!$range) {
                $spreadsheet = $this->sheetsService->spreadsheets->get($this->spreadsheetId);
                $sheets = $spreadsheet->getSheets();
                
                // Use the first sheet available
                $firstSheet = $sheets[0];
                $sheetTitle = $firstSheet->getProperties()->getTitle();
                $range = "'{$sheetTitle}'!A:F"; // Use single quotes to handle special characters
                
                Log::info("Using detected sheet: {$sheetTitle} with range: {$range}");
            }

            $response = $this->sheetsService->spreadsheets_values->get(
                $this->spreadsheetId,
                $range
            );

            $values = $response->getValues();
            
            if (empty($values)) {
                Log::info('No data found in Google Sheets.');
                return [];
            }

            Log::info('Raw data from sheets:', ['total_rows' => count($values)]);
            
            // Process the data
            $medicines = [];
            $headers = array_shift($values); // Remove header row
            
            Log::info('Headers found:', $headers ?? []);
            
            $currentMedicineName = null;
            
            foreach ($values as $rowIndex => $row) {
                $medicineName = trim($row[1] ?? ''); // Column B: GENERIC NAME/DOSE/DOSAGE FORM
                $rxInstructions = trim($row[5] ?? ''); // Column F: RX ENGLISH INSTRUCTIONS (try column F instead)
                
                // If medicine name is provided, update the current medicine name
                if (!empty($medicineName)) {
                    $currentMedicineName = $medicineName;
                }
                
                // Skip if no current medicine name or no instructions
                if (empty($currentMedicineName) || empty($rxInstructions)) {
                    Log::info("Row {$rowIndex}: Skipping - Medicine={$medicineName}, CurrentMedicine={$currentMedicineName}, Instructions={$rxInstructions}");
                    continue;
                }
                
                Log::info("Row {$rowIndex}: Medicine={$currentMedicineName}, Instructions={$rxInstructions}");

                $medicines[] = [
                    'name' => $currentMedicineName,
                    'rx_english_instructions' => $rxInstructions,
                ];
            }

            Log::info('Successfully fetched ' . count($medicines) . ' medicine instructions from Google Sheets.');
            return $medicines;

        } catch (\Exception $e) {
            Log::error('Error fetching data from Google Sheets: ' . $e->getMessage());
            Log::error('Attempted range: ' . ($range ?? 'auto-detect'));
            throw $e;
        }
    }

    /**
     * Test the connection to Google Sheets and get sheet info
     *
     * @return bool
     */
    public function testConnection()
    {
        try {
            $response = $this->sheetsService->spreadsheets->get($this->spreadsheetId);
            $sheets = $response->getSheets();
            
            Log::info('Google Sheets connection test successful. Sheet title: ' . $response->getProperties()->getTitle());
            Log::info('Available sheets:');
            
            foreach ($sheets as $sheet) {
                $sheetTitle = $sheet->getProperties()->getTitle();
                Log::info("- Sheet: {$sheetTitle}");
                echo "Available sheet: {$sheetTitle}\n";
            }
            
            return true;
        } catch (\Exception $e) {
            Log::error('Google Sheets connection test failed: ' . $e->getMessage());
            return false;
        }
    }
}
