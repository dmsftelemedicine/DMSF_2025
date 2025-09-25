<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Consultation;
use App\Models\Prescription;
use App\Models\PrescriptionDetail;
use App\Models\Diagnostic;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get default date range (today)
        $startDate = now()->format('Y-m-d');
        $endDate = now()->format('Y-m-d');
        
        // Cache dashboard data for 5 minutes to improve performance
        $cacheKey = 'dashboard_data_' . md5($startDate . '_' . $endDate);
        $dashboardData = Cache::remember($cacheKey, 300, function () use ($startDate, $endDate) {
            return $this->getDashboardData($startDate, $endDate);
        });

        return view('dashboard.index', $dashboardData);
    }

    public function getData()
    {
        try {
            // Get date range from request parameters
            $startDate = request('start_date');
            $endDate = request('end_date');
            $dateRange = request('date_range', 'today'); // Default to today

            // Set default date range if not provided
            if (!$startDate || !$endDate) {
                switch ($dateRange) {
                    case 'today':
                        $startDate = now()->format('Y-m-d');
                        $endDate = now()->format('Y-m-d');
                        break;
                    case 'currentMonth':
                        $startDate = now()->startOfMonth()->format('Y-m-d');
                        $endDate = now()->endOfMonth()->format('Y-m-d');
                        break;
                    case 'last3Months':
                        $startDate = now()->subMonths(2)->startOfMonth()->format('Y-m-d');
                        $endDate = now()->endOfMonth()->format('Y-m-d');
                        break;
                    case 'lastYear':
                        $startDate = now()->subYear()->startOfYear()->format('Y-m-d');
                        $endDate = now()->subYear()->endOfYear()->format('Y-m-d');
                        break;
                    case 'currentYear':
                    default:
                        $startDate = now()->startOfYear()->format('Y-m-d');
                        $endDate = now()->endOfYear()->format('Y-m-d');
                        break;
                }
            }

            // Create cache key with date range
            $cacheKey = 'dashboard_data_' . md5($startDate . '_' . $endDate);
            
            // Return JSON data for AJAX requests
            $dashboardData = Cache::remember($cacheKey, 300, function () use ($startDate, $endDate) {
                return $this->getDashboardData($startDate, $endDate);
            });

            // Add debug info
            $dashboardData['debug'] = [
                'timestamp' => now(),
                'cache_key' => $cacheKey,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'total_patients_debug' => Patient::count()
            ];

            return response()->json($dashboardData);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }
    }

    private function getDashboardData($startDate = null, $endDate = null)
    {
        try {
            // Set default date range to current year if not provided
            if (!$startDate || !$endDate) {
                $startDate = now()->startOfYear()->format('Y-m-d');
                $endDate = now()->endOfYear()->format('Y-m-d');
            }
            
            $currentYear = now()->year;
            $currentMonth = now()->month;

            // Apply date range filter to all queries
            
            // Use a single query to get basic counts with date filters
            $basicCounts = Cache::remember('dashboard_basic_counts_' . md5($startDate . '_' . $endDate), 300, function () use ($startDate, $endDate) {
                return [
                    'totalPatients' => Patient::whereBetween('created_at', [$startDate, $endDate . ' 23:59:59'])->count(),
                    'totalConsultations' => Consultation::whereBetween('consultation_date', [$startDate, $endDate])->count(),
                    'patientsWithPrescriptions' => Prescription::whereBetween('created_at', [$startDate, $endDate . ' 23:59:59'])
                        ->distinct('patient_id')->count('patient_id'),
                    'diagnosticRequests' => Diagnostic::whereBetween('diagnostic_date', [$startDate, $endDate])->count(),
                ];
            });

            // Get monthly data for current month in a single query (still useful for "this month" comparisons)
            $monthlyData = Cache::remember("dashboard_monthly_data_{$currentYear}_{$currentMonth}", 300, function () use ($currentYear, $currentMonth) {
                return [
                    'newPatientsThisMonth' => Patient::whereMonth('created_at', $currentMonth)
                        ->whereYear('created_at', $currentYear)
                        ->count(),
                    'consultationsThisMonth' => Consultation::whereMonth('consultation_date', $currentMonth)
                        ->whereYear('consultation_date', $currentYear)
                        ->count(),
                ];
            });

            // Get patient registration data for the selected date range
            $monthlyPatientsData = Cache::remember("dashboard_patients_data_" . md5($startDate . '_' . $endDate), 600, function () use ($startDate, $endDate) {
                $start = new \DateTime($startDate);
                $end = new \DateTime($endDate);
                
                // Calculate the difference in days
                $interval = $start->diff($end);
                $daysDiff = $interval->days;
                
                $startYear = date('Y', strtotime($startDate));
                $endYear = date('Y', strtotime($endDate));
                
                // If it's the same day (today only), return hourly data
                if ($daysDiff === 0) {
                    $hourlyData = Patient::selectRaw('HOUR(created_at) as hour, COUNT(*) as count')
                        ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
                        ->groupBy(DB::raw('HOUR(created_at)'))
                        ->pluck('count', 'hour')
                        ->toArray();

                    // Fill in missing hours with 0
                    $result = [];
                    for ($hour = 0; $hour <= 23; $hour++) {
                        $result[] = $hourlyData[$hour] ?? 0;
                    }
                    
                    return $result;
                }
                
                // If it's 31 days or less, return daily data
                if ($daysDiff <= 31) {
                    $dailyData = Patient::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                        ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
                        ->groupBy(DB::raw('DATE(created_at)'))
                        ->pluck('count', 'date')
                        ->toArray();

                    // Fill in missing days with 0
                    $result = [];
                    $current = clone $start;
                    
                    while ($current <= $end) {
                        $dateKey = $current->format('Y-m-d');
                        $result[] = $dailyData[$dateKey] ?? 0;
                        $current->add(new \DateInterval('P1D'));
                    }
                    
                    return $result;
                }
                
                if ($startYear === $endYear) {
                    // Single year - return monthly data for the specific date range
                    $startMonth = (int)$start->format('n');
                    $endMonth = (int)$end->format('n');
                    
                    $monthlyData = Patient::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                        ->whereBetween('created_at', [$startDate, $endDate . ' 23:59:59'])
                        ->groupBy(DB::raw('MONTH(created_at)'))
                        ->pluck('count', 'month')
                        ->toArray();

                    // Fill in missing months with 0 only for the requested range
                    $result = [];
                    for ($month = $startMonth; $month <= $endMonth; $month++) {
                        $result[] = $monthlyData[$month] ?? 0;
                    }
                    
                    return $result;
                } else {
                    // Multiple years - return yearly data
                    $yearlyData = Patient::selectRaw('YEAR(created_at) as year, COUNT(*) as count')
                        ->whereBetween('created_at', [$startDate, $endDate . ' 23:59:59'])
                        ->groupBy(DB::raw('YEAR(created_at)'))
                        ->pluck('count', 'year')
                        ->toArray();

                    $result = [];
                    for ($year = $startYear; $year <= $endYear; $year++) {
                        $result[] = $yearlyData[$year] ?? 0;
                    }
                    
                    return $result;
                }
            });

            // Get diabetes status distribution with date filter
            $diabetesData = Cache::remember('dashboard_diabetes_data_' . md5($startDate . '_' . $endDate), 300, function () use ($startDate, $endDate) {
                return Patient::selectRaw('
                    SUM(CASE WHEN diabetes_status = "Not Diabetic" THEN 1 ELSE 0 END) as not_diabetic,
                    SUM(CASE WHEN diabetes_status = "Prediabetes" THEN 1 ELSE 0 END) as prediabetes,
                    SUM(CASE WHEN diabetes_status = "DM Type I" THEN 1 ELSE 0 END) as dm_type_1,
                    SUM(CASE WHEN diabetes_status = "DM Type II" THEN 1 ELSE 0 END) as dm_type_2,
                    SUM(CASE WHEN diabetes_status = "Gestational DM" THEN 1 ELSE 0 END) as gestational_dm,
                    SUM(CASE WHEN diabetes_status = "Other Hyperglycemic States" THEN 1 ELSE 0 END) as other_hyperglycemic,
                    SUM(CASE WHEN diabetes_status = "Pending" THEN 1 ELSE 0 END) as pending,
                    COUNT(*) as total_count
                ')->whereBetween('created_at', [$startDate, $endDate . ' 23:59:59'])->first();
            });

            // Get demographic data for charts with date filter
            $demographicData = Cache::remember('dashboard_demographic_data_' . md5($startDate . '_' . $endDate), 600, function () use ($startDate, $endDate) {
                $result = [
                    'ageGroups' => [],
                    'gender' => [],
                    'maritalStatus' => [],
                    'education' => [],
                    'income' => [],
                    'religion' => [],
                ];
                
                try {
                    $baseQuery = Patient::whereBetween('created_at', [$startDate, $endDate . ' 23:59:59']);
                    
                    // Age groups (calculated from birth_date)
                    $result['ageGroups'] = (clone $baseQuery)->selectRaw('
                        CASE 
                            WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) < 18 THEN "Under 18"
                            WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 18 AND 29 THEN "18-29"
                            WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 30 AND 39 THEN "30-39"
                            WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 40 AND 49 THEN "40-49"
                            WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 50 AND 59 THEN "50-59"
                            WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) >= 60 THEN "60+"
                            ELSE "Unknown"
                        END as age_group,
                        COUNT(*) as count
                    ')->whereNotNull('birth_date')
                    ->groupBy('age_group')
                    ->pluck('count', 'age_group')
                    ->toArray();

                    // Gender distribution
                    $result['gender'] = (clone $baseQuery)->selectRaw('gender, COUNT(*) as count')
                        ->whereNotNull('gender')
                        ->groupBy('gender')
                        ->pluck('count', 'gender')
                        ->toArray();

                    // Marital status
                    $result['maritalStatus'] = (clone $baseQuery)->selectRaw('marital_status, COUNT(*) as count')
                        ->whereNotNull('marital_status')
                        ->groupBy('marital_status')
                        ->pluck('count', 'marital_status')
                        ->toArray();

                    // Education level
                    $result['education'] = (clone $baseQuery)->selectRaw('highest_educational_attainment, COUNT(*) as count')
                        ->whereNotNull('highest_educational_attainment')
                        ->groupBy('highest_educational_attainment')
                        ->pluck('count', 'highest_educational_attainment')
                        ->toArray();

                    // Income brackets
                    $result['income'] = (clone $baseQuery)->selectRaw('monthly_household_income, COUNT(*) as count')
                        ->whereNotNull('monthly_household_income')
                        ->groupBy('monthly_household_income')
                        ->pluck('count', 'monthly_household_income')
                        ->toArray();

                    // Religion
                    $result['religion'] = (clone $baseQuery)->selectRaw('religion, COUNT(*) as count')
                        ->whereNotNull('religion')
                        ->groupBy('religion')
                        ->pluck('count', 'religion')
                        ->toArray();
                } catch (\Exception $e) {
                    // If there's an error getting demographic data, use empty arrays
                }
                
                return $result;
            });

            // Get consultation trends data with date filter
            $consultationTrendsData = Cache::remember("dashboard_consultation_trends_" . md5($startDate . '_' . $endDate), 600, function () use ($startDate, $endDate) {
                $start = new \DateTime($startDate);
                $end = new \DateTime($endDate);
                
                // Calculate the difference in days
                $interval = $start->diff($end);
                $daysDiff = $interval->days;
                
                $startYear = date('Y', strtotime($startDate));
                $endYear = date('Y', strtotime($endDate));
                
                // If it's the same day (today only), return hourly data
                if ($daysDiff === 0) {
                    $hourlyData = Consultation::selectRaw('HOUR(consultation_date) as hour, COUNT(*) as count')
                        ->whereBetween('consultation_date', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
                        ->groupBy(DB::raw('HOUR(consultation_date)'))
                        ->pluck('count', 'hour')
                        ->toArray();

                    // Fill in missing hours with 0
                    $result = [];
                    for ($hour = 0; $hour <= 23; $hour++) {
                        $result[] = $hourlyData[$hour] ?? 0;
                    }
                    
                    return $result;
                }
                
                // If it's 31 days or less, return daily data
                if ($daysDiff <= 31) {
                    $dailyData = Consultation::selectRaw('DATE(consultation_date) as date, COUNT(*) as count')
                        ->whereBetween('consultation_date', [$startDate, $endDate])
                        ->groupBy(DB::raw('DATE(consultation_date)'))
                        ->pluck('count', 'date')
                        ->toArray();

                    // Fill in missing days with 0
                    $result = [];
                    $current = clone $start;
                    
                    while ($current <= $end) {
                        $dateKey = $current->format('Y-m-d');
                        $result[] = $dailyData[$dateKey] ?? 0;
                        $current->add(new \DateInterval('P1D'));
                    }
                    
                    return $result;
                }
                
                if ($startYear === $endYear) {
                    // Single year - return monthly data for the specific date range
                    $startMonth = (int)$start->format('n');
                    $endMonth = (int)$end->format('n');
                    
                    $monthlyData = Consultation::selectRaw('MONTH(consultation_date) as month, COUNT(*) as count')
                        ->whereBetween('consultation_date', [$startDate, $endDate])
                        ->groupBy(DB::raw('MONTH(consultation_date)'))
                        ->pluck('count', 'month')
                        ->toArray();

                    // Fill in missing months with 0 only for the requested range
                    $result = [];
                    for ($month = $startMonth; $month <= $endMonth; $month++) {
                        $result[] = $monthlyData[$month] ?? 0;
                    }
                    
                    return $result;
                    
                } else {
                    // Multiple years - return yearly data
                    $yearlyData = Consultation::selectRaw('YEAR(consultation_date) as year, COUNT(*) as count')
                        ->whereBetween('consultation_date', [$startDate, $endDate])
                        ->groupBy(DB::raw('YEAR(consultation_date)'))
                        ->pluck('count', 'year')
                        ->toArray();

                    $result = [];
                    for ($year = $startYear; $year <= $endYear; $year++) {
                        $result[] = $yearlyData[$year] ?? 0;
                    }
                    
                    return $result;
                }
            });

            // Calculate derived values
            $totalPatients = $basicCounts['totalPatients'];
            
            return [
                'totalPatients' => $totalPatients,
                'totalConsultations' => $basicCounts['totalConsultations'],
                'newPatientsThisMonth' => $monthlyData['newPatientsThisMonth'],
                'consultationsThisMonth' => $monthlyData['consultationsThisMonth'],
                'dateRange' => [
                    'start' => $startDate,
                    'end' => $endDate
                ],
                
                // Age distribution for charts
                'age_18_30' => ($demographicData['ageGroups']['18-29'] ?? 0),
                'age_31_45' => ($demographicData['ageGroups']['30-39'] ?? 0) + ($demographicData['ageGroups']['40-49'] ?? 0),
                'age_46_60' => ($demographicData['ageGroups']['50-59'] ?? 0),
                'age_60_plus' => ($demographicData['ageGroups']['60+'] ?? 0),
                
                // Gender distribution
                'male' => $demographicData['gender']['Male'] ?? $demographicData['gender']['male'] ?? 0,
                'female' => $demographicData['gender']['Female'] ?? $demographicData['gender']['female'] ?? 0,
                'other' => $demographicData['gender']['Other'] ?? $demographicData['gender']['other'] ?? 0,
                
                // Other demographic data
                'maritalStatus' => $demographicData['maritalStatus'],
                'education' => $demographicData['education'],
                'income' => $demographicData['income'],
                'religion' => $demographicData['religion'],
                
                // Patient trends data (labels will be dynamic based on date range)
                'patientTrends' => [
                    'months' => $this->getTrendLabels($startDate, $endDate),
                    'counts' => $monthlyPatientsData
                ],
                
                // Consultation trends data
                'consultationTrends' => [
                    'months' => $this->getTrendLabels($startDate, $endDate),
                    'counts' => $consultationTrendsData
                ],
                
                // Prescription data
                'withPrescription' => $basicCounts['patientsWithPrescriptions'],
                'withoutPrescription' => $totalPatients - $basicCounts['patientsWithPrescriptions'],
                
                // Prescription trends data
                'prescriptionTrends' => [
                    'months' => $this->getTrendLabels($startDate, $endDate),
                    'counts' => $this->getMonthlyPrescriptionData($startDate, $endDate)
                ],
                
                // Latest medicines prescribed (from the date range)
                'latestMedicines' => $this->getLatestMedicinesData($startDate, $endDate),
                
                // Diagnostic data
                'withDiagnostics' => $basicCounts['diagnosticRequests'],
                'withoutDiagnostics' => $totalPatients - $basicCounts['diagnosticRequests'],
                
                // Diagnostic types data
                'diagnosticTypes' => $this->getDiagnosticTypesData($startDate, $endDate),
                
                // Monthly diagnostic requests
                'diagnosticTrends' => [
                    'months' => $this->getTrendLabels($startDate, $endDate),
                    'counts' => $this->getMonthlyDiagnosticData($startDate, $endDate)
                ],
                
                // Diabetes status distribution data
                'diabetesStatus' => [
                    'Not Diabetic' => $diabetesData->not_diabetic ?? 0,
                    'Prediabetes' => $diabetesData->prediabetes ?? 0,
                    'DM Type I' => $diabetesData->dm_type_1 ?? 0,
                    'DM Type II' => $diabetesData->dm_type_2 ?? 0,
                    'Gestational DM' => $diabetesData->gestational_dm ?? 0,
                    'Other Hyperglycemic States' => $diabetesData->other_hyperglycemic ?? 0,
                    'Pending' => $diabetesData->pending ?? 0,
                ],
            ];
        } catch (\Exception $e) {
            // Return minimal fallback data
            return [
                'totalPatients' => 0,
                'totalConsultations' => 0,
                'newPatientsThisMonth' => 0,
                'consultationsThisMonth' => 0,
                'dateRange' => [
                    'start' => $startDate,
                    'end' => $endDate
                ],
                'age_18_30' => 0,
                'age_31_45' => 0,
                'age_46_60' => 0,
                'age_60_plus' => 0,
                'male' => 0,
                'female' => 0,
                'other' => 0,
                'maritalStatus' => [],
                'education' => [],
                'income' => [],
                'religion' => [],
                'patientTrends' => [
                    'months' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    'counts' => [0,0,0,0,0,0,0,0,0,0,0,0]
                ],
                'consultationTrends' => [
                    'months' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    'counts' => [0,0,0,0,0,0,0,0,0,0,0,0]
                ],
                'withPrescription' => 0,
                'withoutPrescription' => 0,
                'prescriptionTrends' => [
                    'months' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    'counts' => [0,0,0,0,0,0,0,0,0,0,0,0]
                ],
                'latestMedicines' => [],
                'withDiagnostics' => 0,
                'withoutDiagnostics' => 0,
                'diagnosticTypes' => [],
                'diagnosticTrends' => [
                    'months' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    'counts' => [0,0,0,0,0,0,0,0,0,0,0,0]
                ],
                'diabetesStatus' => [
                    'Not Diabetic' => 0,
                    'Prediabetes' => 0,
                    'DM Type I' => 0,
                    'DM Type II' => 0,
                    'Gestational DM' => 0,
                    'Other Hyperglycemic States' => 0,
                    'Pending' => 0,
                ],
                'error' => true,
                'error_message' => $e->getMessage()
            ];
        }
    }

    private function getTrendLabels($startDate, $endDate)
    {
        $start = new \DateTime($startDate);
        $end = new \DateTime($endDate);
        
        // Calculate the difference in days
        $interval = $start->diff($end);
        $daysDiff = $interval->days;
        
        $startYear = $start->format('Y');
        $endYear = $end->format('Y');

        // If it's the same day (today only), return hourly labels
        if ($daysDiff === 0) {
            $labels = [];
            for ($hour = 0; $hour <= 23; $hour++) {
                $labels[] = sprintf('%02d:00', $hour);
            }
            return $labels;
        }
        
        // If it's 31 days or less (roughly a month), return daily labels
        if ($daysDiff <= 31) {
            $labels = [];
            $current = clone $start;
            
            while ($current <= $end) {
                $labels[] = $current->format('M j'); // e.g., "Sep 6"
                $current->add(new \DateInterval('P1D'));
            }
            
            return $labels;
        }
        
        // Month names short form
        $months = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];

        if ($startYear === $endYear) {
            // Same year → return affected months
            $startMonth = (int)$start->format('n'); // 1–12
            $endMonth   = (int)$end->format('n');

            return array_slice($months, $startMonth - 1, $endMonth - $startMonth + 1);
        } else {
            // Multiple years → return year labels
            $labels = [];
            for ($year = $startYear; $year <= $endYear; $year++) {
                $labels[] = (string)$year;
            }
            return $labels;
        }
    }


    private function getDiagnosticTypesData($startDate = null, $endDate = null)
    {
        $cacheKey = 'dashboard_diagnostic_types_data';
        if ($startDate && $endDate) {
            $cacheKey .= '_' . md5($startDate . '_' . $endDate);
        }
        
        return Cache::remember($cacheKey, 300, function () use ($startDate, $endDate) {
            try {
                $diagnosticTypes = [];
                
                // Define the diagnostic types
                $types = [
                    'hematology' => 'Hematology',
                    'clinical_microscopy' => 'Clinical Microscopy',
                    'blood_chemistry' => 'Blood Chemistry',
                    'microbiology' => 'Microbiology',
                    'immunology_serology' => 'Immunology/Serology',
                    'stool_tests' => 'Stool Tests',
                    'blood_typing_bsmp' => 'Blood Typing/BSMP',
                    'others' => 'Others'
                ];

                // Apply date filter if provided
                $baseQuery = Diagnostic::query();
                if ($startDate && $endDate) {
                    $baseQuery->whereBetween('diagnostic_date', [$startDate, $endDate]);
                }

                // Process diagnostics in chunks to avoid loading all into memory
                foreach ($types as $field => $label) {
                    $count = 0;
                    (clone $baseQuery)->chunk(500, function ($diagnosticsChunk) use ($field, &$count) {
                        foreach ($diagnosticsChunk as $diagnostic) {
                            $value = $diagnostic->$field;
                            // Check if the field has content
                            if ($field === 'others') {
                                // For 'others' field, it's a string
                                if (!empty($value) && trim($value) !== '') {
                                    $count++;
                                }
                            } else {
                                // For array fields, check if array has elements
                                if (is_array($value) && !empty($value)) {
                                    $count++;
                                }
                            }
                        }
                    });
                    $diagnosticTypes[$label] = $count;
                }

                return $diagnosticTypes;
            } catch (\Exception $e) {
                // Return empty array on error
                return [];
            }
        });
    }

    private function getMonthlyDiagnosticData($startDate, $endDate)
    {
        $cacheKey = "dashboard_diagnostics_data_" . md5($startDate . '_' . $endDate);
        
        return Cache::remember($cacheKey, 600, function () use ($startDate, $endDate) {
            $start = new \DateTime($startDate);
            $end = new \DateTime($endDate);
            
            // Calculate the difference in days
            $interval = $start->diff($end);
            $daysDiff = $interval->days;
            
            $startYear = date('Y', strtotime($startDate));
            $endYear = date('Y', strtotime($endDate));
            
            // If it's the same day (today only), return hourly data
            if ($daysDiff === 0) {
                $hourlyData = Diagnostic::selectRaw('HOUR(diagnostic_date) as hour, COUNT(*) as count')
                    ->whereBetween('diagnostic_date', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
                    ->groupBy(DB::raw('HOUR(diagnostic_date)'))
                    ->pluck('count', 'hour')
                    ->toArray();

                // Fill in missing hours with 0
                $result = [];
                for ($hour = 0; $hour <= 23; $hour++) {
                    $result[] = $hourlyData[$hour] ?? 0;
                }
                
                return $result;
            }
            
            // If it's 31 days or less, return daily data
            if ($daysDiff <= 31) {
                $dailyData = Diagnostic::selectRaw('DATE(diagnostic_date) as date, COUNT(*) as count')
                    ->whereBetween('diagnostic_date', [$startDate, $endDate])
                    ->groupBy(DB::raw('DATE(diagnostic_date)'))
                    ->pluck('count', 'date')
                    ->toArray();

                // Fill in missing days with 0
                $result = [];
                $current = clone $start;
                
                while ($current <= $end) {
                    $dateKey = $current->format('Y-m-d');
                    $result[] = $dailyData[$dateKey] ?? 0;
                    $current->add(new \DateInterval('P1D'));
                }
                
                return $result;
            }
            
            if ($startYear === $endYear) {
                // Single year - return monthly data for the specific date range
                $startMonth = (int)$start->format('n');
                $endMonth = (int)$end->format('n');
                
                $monthlyData = Diagnostic::selectRaw('MONTH(diagnostic_date) as month, COUNT(*) as count')
                    ->whereBetween('diagnostic_date', [$startDate, $endDate])
                    ->groupBy(DB::raw('MONTH(diagnostic_date)'))
                    ->pluck('count', 'month')
                    ->toArray();

                // Fill in missing months with 0 only for the requested range
                $result = [];
                for ($month = $startMonth; $month <= $endMonth; $month++) {
                    $result[] = $monthlyData[$month] ?? 0;
                }
                
                return $result;
            } else {
                // Multiple years - return yearly data
                $yearlyData = Diagnostic::selectRaw('YEAR(diagnostic_date) as year, COUNT(*) as count')
                    ->whereBetween('diagnostic_date', [$startDate, $endDate])
                    ->groupBy(DB::raw('YEAR(diagnostic_date)'))
                    ->pluck('count', 'year')
                    ->toArray();

                $result = [];
                for ($year = $startYear; $year <= $endYear; $year++) {
                    $result[] = $yearlyData[$year] ?? 0;
                }
                
                return $result;
            }
        });
    }

    private function getMonthlyPrescriptionData($startDate, $endDate)
    {
        $cacheKey = "dashboard_prescriptions_data_" . md5($startDate . '_' . $endDate);
        
        return Cache::remember($cacheKey, 600, function () use ($startDate, $endDate) {
            $start = new \DateTime($startDate);
            $end = new \DateTime($endDate);
            
            // Calculate the difference in days
            $interval = $start->diff($end);
            $daysDiff = $interval->days;
            
            $startYear = date('Y', strtotime($startDate));
            $endYear = date('Y', strtotime($endDate));
            
            // If it's the same day (today only), return hourly data
            if ($daysDiff === 0) {
                $hourlyData = Prescription::selectRaw('HOUR(created_at) as hour, COUNT(*) as count')
                    ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
                    ->groupBy(DB::raw('HOUR(created_at)'))
                    ->pluck('count', 'hour')
                    ->toArray();

                // Fill in missing hours with 0
                $result = [];
                for ($hour = 0; $hour <= 23; $hour++) {
                    $result[] = $hourlyData[$hour] ?? 0;
                }
                
                return $result;
            }
            
            // If it's 31 days or less, return daily data
            if ($daysDiff <= 31) {
                $dailyData = Prescription::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                    ->whereBetween('created_at', [$startDate, $endDate . ' 23:59:59'])
                    ->groupBy(DB::raw('DATE(created_at)'))
                    ->pluck('count', 'date')
                    ->toArray();

                // Fill in missing days with 0
                $result = [];
                $current = clone $start;
                
                while ($current <= $end) {
                    $dateKey = $current->format('Y-m-d');
                    $result[] = $dailyData[$dateKey] ?? 0;
                    $current->add(new \DateInterval('P1D'));
                }
                
                return $result;
            }
            
            if ($startYear === $endYear) {
                // Single year - return monthly data for the specific date range
                $startMonth = (int)$start->format('n');
                $endMonth = (int)$end->format('n');
                
                $monthlyData = Prescription::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                    ->whereBetween('created_at', [$startDate, $endDate . ' 23:59:59'])
                    ->groupBy(DB::raw('MONTH(created_at)'))
                    ->pluck('count', 'month')
                    ->toArray();

                // Fill in missing months with 0 only for the requested range
                $result = [];
                for ($month = $startMonth; $month <= $endMonth; $month++) {
                    $result[] = $monthlyData[$month] ?? 0;
                }
                
                return $result;
            } else {
                // Multiple years - return yearly data
                $yearlyData = Prescription::selectRaw('YEAR(created_at) as year, COUNT(*) as count')
                    ->whereBetween('created_at', [$startDate, $endDate . ' 23:59:59'])
                    ->groupBy(DB::raw('YEAR(created_at)'))
                    ->pluck('count', 'year')
                    ->toArray();

                $result = [];
                for ($year = $startYear; $year <= $endYear; $year++) {
                    $result[] = $yearlyData[$year] ?? 0;
                }
                
                return $result;
            }
        });
    }

    private function getLatestMedicinesData($startDate = null, $endDate = null)
    {
        $cacheKey = 'dashboard_latest_medicines';
        if ($startDate && $endDate) {
            $cacheKey .= '_' . md5($startDate . '_' . $endDate);
        }
        
        return Cache::remember($cacheKey, 300, function () use ($startDate, $endDate) {
            try {
                // Build base query
                $baseQuery = PrescriptionDetail::with(['prescription.patient', 'medicine'])
                    ->orderByDesc(
                        Prescription::select('created_at')
                            ->whereColumn('prescriptions.id', 'prescription_details.prescription_id')
                    );

                // Apply date filter if provided
                if ($startDate && $endDate) {
                    $baseQuery->whereHas('prescription', function ($query) use ($startDate, $endDate) {
                        $query->whereBetween('created_at', [$startDate, $endDate . ' 23:59:59']);
                    });
                }

                // Get the most recent prescription details with medicine and patient info
                $latestMedicines = $baseQuery->limit(10)
                    ->get()
                    ->map(function ($detail) {
                        return [
                            'medicine_name' => $detail->medicine->name ?? 'Unknown Medicine',
                            'patient_name' => $detail->prescription->patient ? 
                                $detail->prescription->patient->first_name . ' ' . $detail->prescription->patient->last_name : 
                                'Unknown Patient',
                            'doctor_name' => $detail->prescription->doctor_name ?? 'Unknown Doctor',
                            'prescribed_date' => $detail->prescription->created_at->format('M d, Y'),
                            'prescribed_time' => $detail->prescription->created_at->format('H:i A'),
                        ];
                    })
                    ->toArray();

                return $latestMedicines;
            } catch (\Exception $e) {
                return [];
            }
        });
    }
}
