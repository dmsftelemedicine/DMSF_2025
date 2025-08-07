<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Consultation;
use App\Models\Prescription;
use App\Models\Diagnostic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Cache dashboard data for 5 minutes to improve performance
        $dashboardData = Cache::remember('dashboard_data', 300, function () {
            return $this->getDashboardData();
        });

        return view('dashboard', $dashboardData);
    }

    private function getDashboardData()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        // Use a single query to get basic counts
        $basicCounts = Cache::remember('dashboard_basic_counts', 300, function () {
            return [
                'totalPatients' => Patient::count(),
                'totalConsultations' => Consultation::count(),
                'prescribedCount' => Prescription::count(),
                'diagnosticRequests' => Diagnostic::count(),
            ];
        });

        // Get monthly data for current month in a single query
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

        // Get monthly patient registration data using a single optimized query
        $monthlyPatientsData = Cache::remember("dashboard_monthly_patients_{$currentYear}", 600, function () use ($currentYear) {
            $monthlyData = Patient::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->whereYear('created_at', $currentYear)
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->pluck('count', 'month')
                ->toArray();

            // Fill in missing months with 0
            $result = [];
            for ($month = 1; $month <= 12; $month++) {
                $result[] = $monthlyData[$month] ?? 0;
            }
            
            return $result;
        });

        // Get diabetes patient count with optimized query
        $diabetesData = Cache::remember('dashboard_diabetes_data', 300, function () {
            return Patient::selectRaw('
                SUM(CASE WHEN diagnosis LIKE "%diabetes%" OR diagnosis LIKE "%diabetic%" THEN 1 ELSE 0 END) as diabetic_count,
                COUNT(*) as total_count
            ')->first();
        });

        // Calculate derived values
        $totalPatients = $basicCounts['totalPatients'];
        $diabeticPatients = $diabetesData->diabetic_count ?? 0;
        
        return [
            'totalPatients' => $totalPatients,
            'totalConsultations' => $basicCounts['totalConsultations'],
            'newPatientsThisMonth' => $monthlyData['newPatientsThisMonth'],
            'consultationsThisMonth' => $monthlyData['consultationsThisMonth'],
            'monthlyPatientsData' => $monthlyPatientsData,
            'prescribedCount' => $basicCounts['prescribedCount'],
            'notPrescribedCount' => $totalPatients - $basicCounts['prescribedCount'],
            'diagnosticRequests' => $basicCounts['diagnosticRequests'],
            'noDiagnosticRequests' => $totalPatients - $basicCounts['diagnosticRequests'],
            'diabeticPatients' => $diabeticPatients,
            'nonDiabeticPatients' => $totalPatients - $diabeticPatients,
        ];
    }
}
