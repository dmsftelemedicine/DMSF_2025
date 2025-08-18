<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubstanceScreenerRecommendationController extends Controller
{
    public function recommend(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            // Optional overrides coming from Personal-Social History section (live form)
            'current_smoker' => 'nullable|boolean',
            'current_drinker' => 'nullable|boolean',
            'current_drug_user' => 'nullable|boolean',
            'alcohol_sd' => 'nullable|numeric|min:0',
            'alcohol_frequency' => 'nullable|in:per_day,per_week,per_session',
            'gender' => 'nullable|in:Male,Female',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $patient = Patient::find($request->patient_id);
        $history = $patient ? $patient->comprehensiveHistory : null;

        // Build base from DB fields (fallbacks) using Comprehensive History
        $dbIsSmoker = (bool) ($history->current_smoker ?? false);
        $dbIsDrinker = (bool) ($history->current_drinker ?? false);
        $dbIsDrugUser = (bool) ($history->current_drug_user ?? false);
        // Compute daily drinks from stored sd + frequency if present
        $dbSd = $history ? (float) ($history->alcohol_sd ?? 0) : 0.0;
        $dbFreq = $history ? (string) ($history->alcohol_frequency ?? 'per_day') : 'per_day';
        $dbStdDrinksPerDay = $dbFreq === 'per_week' ? ($dbSd / 7.0) : $dbSd;
        $dbSex = (strtolower((string) ($patient->gender ?? 'Male')) === 'female') ? 'Female' : 'Male';

        // Optional overrides from request (live form state)
        $isSmoker = $request->has('current_smoker') ? (bool) $request->boolean('current_smoker') : $dbIsSmoker;
        $isDrinker = $request->has('current_drinker') ? (bool) $request->boolean('current_drinker') : $dbIsDrinker;
        $isDrugUser = $request->has('current_drug_user') ? (bool) $request->boolean('current_drug_user') : $dbIsDrugUser;

        // Compute daily standard drinks from overrides if provided
        $stdDrinksPerDay = $dbStdDrinksPerDay;
        if ($request->filled('alcohol_sd')) {
            $sd = (float) $request->alcohol_sd;
            $freq = $request->input('alcohol_frequency', 'per_day');
            if ($freq === 'per_week') {
                $stdDrinksPerDay = $sd / 7.0;
            } else {
                // per_day or per_session treated as daily intake estimate
                $stdDrinksPerDay = $sd;
            }
        }

        $sex = $request->filled('gender') ? ($request->gender === 'Female' ? 'Female' : 'Male') : $dbSex;

        // Build recommendations
        $recommendations = [];

        // FND-6: recommend for current smoker
        if ($isSmoker) {
            $recommendations[] = [
                'type' => 'info',
                'message' => 'Suggest to assess Nicotine Dependence with Fagerstrom Test (FND-6).',
                'action' => 'showFND6()'
            ];
        }

        // CAGE-4: based on alcohol daily intake thresholds
        $needsCAGE = false;
        $cageMessage = 'Suggest to screen for Alcohol Dependence with CAGE questionnaire (CAGE-4).';
        // Identify binge-drinker if >4 per session or per day in overrides
        $overrideFreq = $request->input('alcohol_frequency');
        if (($overrideFreq === 'per_session' && $request->filled('alcohol_sd') && (float)$request->alcohol_sd > 4)
            || ($overrideFreq === 'per_day' && $request->filled('alcohol_sd') && (float)$request->alcohol_sd > 4)) {
            $needsCAGE = true;
            $cageMessage = 'Patient is a binge-drinker. Suggest to screen for Alcohol Dependence with CAGE questionnaire (CAGE-4).';
        } elseif ($stdDrinksPerDay > 4) {
            $needsCAGE = true;
        } elseif ($sex === 'Male' && $stdDrinksPerDay > 2) {
            $needsCAGE = true;
        } elseif ($sex === 'Female' && $stdDrinksPerDay > 1) {
            $needsCAGE = true;
        }
        if ($needsCAGE) {
            $recommendations[] = [
                'type' => 'warning',
                'message' => $cageMessage,
                'action' => 'showCAGE4()'
            ];
        }

        // ASSIST-8: for drug user or combination of smoking + drinking
        $needsASSIST = false;
        if ($isDrugUser) {
            $needsASSIST = true;
        } elseif ($isSmoker && $isDrinker) {
            $needsASSIST = true;
        }
        if ($needsASSIST) {
            $recommendations[] = [
                'type' => 'info',
                'message' => 'Suggest to use Alcohol, Smoking, Substance Involvement Screening Test (ASSIST-8).',
                'action' => 'showASSIST8()'
            ];
        }

        return response()->json([
            'success' => true,
            'data' => [
                'is_current_smoker' => $isSmoker,
                'is_current_drinker' => $isDrinker,
                'is_current_drug_user' => $isDrugUser,
                'standard_drinks_per_day' => round($stdDrinksPerDay, 2),
                'user_sex' => $sex,
            ],
            'recommendations' => $recommendations,
        ]);
    }
}


