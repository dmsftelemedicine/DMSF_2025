<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SleepScreening;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SleepScreeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sleepScreenings = SleepScreening::with('patient')->latest()->paginate(10);
        return view('sleep_screenings.index', compact('sleepScreenings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patient::all();
        return view('sleep_screenings.create', compact('patients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        // Determine the type of assessment being submitted
        $assessmentType = $this->determineAssessmentType($data);
        
        if ($assessmentType === 'initial') {
            return $this->storeInitialAssessment($data);
        } else {
            return $this->storeSpecificAssessment($data, $assessmentType);
        }
    }

    /**
     * Determine the type of assessment based on the submitted data
     */
    private function determineAssessmentType($data)
    {
        // Check for specific assessment indicators
        if (isset($data['total_score']) && isset($data['assessment_type'])) {
            return $data['assessment_type'];
        }
        
        // Check for ISI-7 specific fields
        if (isset($data['isi_question_1']) || isset($data['isi_question_2'])) {
            return 'isi7';
        }
        
        // Check for ESS-8 specific fields
        if (isset($data['ess_question_1']) || isset($data['ess_question_2'])) {
            return 'ess8';
        }
        
        // Check for SHI-13 specific fields
        if (isset($data['shi_question_1']) || isset($data['shi_question_2'])) {
            return 'shi13';
        }
        
        // Check for STOP-BANG specific fields
        if (isset($data['stopbang_question_1']) || isset($data['stopbang_question_2'])) {
            return 'stopbang';
        }
        
        // Default to initial assessment
        return 'initial';
    }

    /**
     * Store initial sleep assessment data
     */
    private function storeInitialAssessment($data)
    {
        // Map frontend field names to expected field names
        if (isset($data['wake_up_time'])) {
            $data['wake_time'] = $data['wake_up_time'];
        }
        if (isset($data['usual_sleep_duration'])) {
            $data['sleep_duration'] = $data['usual_sleep_duration'];
        }
        if (isset($data['sleep_quality_rating'])) {
            $data['sleep_quality'] = $data['sleep_quality_rating'];
        }
        if (isset($data['hygiene_activities'])) {
            $data['sleep_activities'] = $data['hygiene_activities'];
        }

        $validator = Validator::make($data, [
        $data = $request->all();
        
        // Determine the type of assessment being submitted
        $assessmentType = $this->determineAssessmentType($data);
        
        if ($assessmentType === 'initial') {
            return $this->storeInitialAssessment($data);
        } else {
            return $this->storeSpecificAssessment($data, $assessmentType);
        }
    }

    /**
     * Determine the type of assessment based on the submitted data
     */
    private function determineAssessmentType($data)
    {
        // Check for specific assessment indicators
        if (isset($data['total_score']) && isset($data['assessment_type'])) {
            return $data['assessment_type'];
        }
        
        // Check for ISI-7 specific fields
        if (isset($data['isi_question_1']) || isset($data['isi_question_2'])) {
            return 'isi7';
        }
        
        // Check for ESS-8 specific fields
        if (isset($data['ess_question_1']) || isset($data['ess_question_2'])) {
            return 'ess8';
        }
        
        // Check for SHI-13 specific fields
        if (isset($data['shi_question_1']) || isset($data['shi_question_2'])) {
            return 'shi13';
        }
        
        // Check for STOP-BANG specific fields
        if (isset($data['stopbang_question_1']) || isset($data['stopbang_question_2'])) {
            return 'stopbang';
        }
        
        // Default to initial assessment
        return 'initial';
    }

    /**
     * Store initial sleep assessment data
     */
    private function storeInitialAssessment($data)
    {
        // Map frontend field names to expected field names
        if (isset($data['wake_up_time'])) {
            $data['wake_time'] = $data['wake_up_time'];
        }
        if (isset($data['usual_sleep_duration'])) {
            $data['sleep_duration'] = $data['usual_sleep_duration'];
        }
        if (isset($data['sleep_quality_rating'])) {
            $data['sleep_quality'] = $data['sleep_quality_rating'];
        }
        if (isset($data['hygiene_activities'])) {
            $data['sleep_activities'] = $data['hygiene_activities'];
        }

        $validator = Validator::make($data, [
            'patient_id' => 'required|exists:patients,id',
            'sleep_time' => 'required|date_format:H:i',
            'wake_time' => 'required|date_format:H:i',
            'sleep_duration' => 'required|numeric|min:0|max:24',
            'sleep_quality' => 'required|integer|min:1|max:10',
            'sleep_activities' => 'nullable|array',
            'sleep_activities.*' => 'string|in:alcohol,large_meal,coffee,gadgets,intense_exercise',
            'daytime_sleepiness' => 'required|in:yes,no',
            'blood_pressure' => 'nullable|string',
            'bmi' => 'nullable|numeric|min:15|max:60',
            'age' => 'nullable|integer|min:18|max:120',
            'neck_circumference' => 'nullable|numeric|min:20|max:60',
            'gender' => 'nullable|in:male,female',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Process recommended assessments based on screening data
        $recommendedAssessments = $this->evaluateSleepScreening($data);

        $sleepScreening = SleepScreening::create([

            'patient_id' => $data['patient_id'],
            'sleep_time' => $data['sleep_time'],
            'wake_time' => $data['wake_time'],
            'sleep_duration' => $data['sleep_duration'],
            'sleep_quality' => $data['sleep_quality'],
            'sleep_activities' => $data['sleep_activities'] ?? null,
            'daytime_sleepiness' => $data['daytime_sleepiness'],
            'blood_pressure' => $data['blood_pressure'] ?? null,
            'bmi' => $data['bmi'] ?? null,
            'age' => $data['age'] ?? null,
            'neck_circumference' => $data['neck_circumference'] ?? null,
            'gender' => $data['gender'] ?? null,
            'recommended_assessments' => $recommendedAssessments,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Sleep screening saved successfully',
            'data' => $sleepScreening,
            'recommended_assessments' => $recommendedAssessments
        ]);
    }

    /**
     * Store specific assessment results (ISI-7, ESS-8, SHI-13, STOP-BANG)
     */
    private function storeSpecificAssessment($data, $assessmentType)
    {
        $validator = Validator::make($data, [
            'patient_id' => 'required|exists:patients,id',
            'total_score' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Find existing sleep screening for this patient or create a new one
        $sleepScreening = SleepScreening::where('patient_id', $data['patient_id'])->first();
        
        if (!$sleepScreening) {
            $sleepScreening = SleepScreening::create([
                'patient_id' => $data['patient_id'],
                'sleep_time' => null,
                'wake_time' => null,
                'sleep_duration' => null,
                'sleep_quality' => null,
                'sleep_activities' => null,
                'daytime_sleepiness' => null,
                'blood_pressure' => null,
                'bmi' => null,
                'age' => null,
                'neck_circumference' => null,
                'gender' => null,
                'recommended_assessments' => [],
            ]);
        }

        // Store the specific assessment results
        $assessmentResults = $sleepScreening->assessment_results ?? [];
        $assessmentResults[$assessmentType] = [
            'total_score' => $data['total_score'],
            'submitted_at' => now()->toISOString(),
            'questions' => $this->extractQuestions($data, $assessmentType)
        ];

        $sleepScreening->update([
            'assessment_results' => $assessmentResults
        ]);

        return response()->json([
            'success' => true,
            'message' => ucfirst($assessmentType) . ' assessment saved successfully',
            'data' => $sleepScreening
        ]);
    }

    /**
     * Extract question responses from the submitted data
     */
    private function extractQuestions($data, $assessmentType)
    {
        $questions = [];
        
        switch ($assessmentType) {
            case 'isi7':
                for ($i = 1; $i <= 7; $i++) {
                    if (isset($data["isi_question_$i"])) {
                        $questions["question_$i"] = $data["isi_question_$i"];
                    }
                }
                break;
            case 'ess8':
                for ($i = 1; $i <= 8; $i++) {
                    if (isset($data["ess_question_$i"])) {
                        $questions["question_$i"] = $data["ess_question_$i"];
                    }
                }
                break;
            case 'shi13':
                for ($i = 1; $i <= 13; $i++) {
                    if (isset($data["shi_question_$i"])) {
                        $questions["question_$i"] = $data["shi_question_$i"];
                    }
                }
                break;
            case 'stopbang':
                for ($i = 1; $i <= 8; $i++) {
                    if (isset($data["stopbang_question_$i"])) {
                        $questions["question_$i"] = $data["stopbang_question_$i"];
                    }
                }
                break;
        }
        
        return $questions;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sleepScreening = SleepScreening::with('patient')->findOrFail($id);
        return view('sleep_screenings.show', compact('sleepScreening'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sleepScreening = SleepScreening::findOrFail($id);
        $patients = Patient::all();
        return view('sleep_screenings.edit', compact('sleepScreening', 'patients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sleepScreening = SleepScreening::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'sleep_time' => 'required|date_format:H:i',
            'wake_time' => 'required|date_format:H:i',
            'sleep_duration' => 'required|numeric|min:0|max:24',
            'sleep_quality' => 'required|integer|min:1|max:10',
            'sleep_activities' => 'nullable|array',
            'sleep_activities.*' => 'string|in:alcohol,large_meal,coffee,gadgets',
            'daytime_sleepiness' => 'required|in:yes,no',
            'blood_pressure' => 'required|string',
            'bmi' => 'required|numeric|min:15|max:60',
            'age' => 'required|integer|min:18|max:120',
            'neck_circumference' => 'required|numeric|min:20|max:60',
            'gender' => 'required|in:male,female',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Process recommended assessments based on screening data
        $recommendedAssessments = $this->evaluateSleepScreening($request);

        $sleepScreening->update([
            'patient_id' => $request->patient_id,
            'sleep_time' => $request->sleep_time,
            'wake_time' => $request->wake_time,
            'sleep_duration' => $request->sleep_duration,
            'sleep_quality' => $request->sleep_quality,
            'sleep_activities' => $request->sleep_activities,
            'daytime_sleepiness' => $request->daytime_sleepiness,
            'blood_pressure' => $request->blood_pressure,
            'bmi' => $request->bmi,
            'age' => $request->age,
            'neck_circumference' => $request->neck_circumference,
            'gender' => $request->gender,
            'recommended_assessments' => $recommendedAssessments,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Sleep screening updated successfully',
            'data' => $sleepScreening,
            'recommended_assessments' => $recommendedAssessments
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sleepScreening = SleepScreening::findOrFail($id);
        $sleepScreening->delete();

        return response()->json([
            'success' => true,
            'message' => 'Sleep screening deleted successfully'
        ]);
    }

    /**
     * Evaluate sleep screening and determine recommended assessments
     */
    private function evaluateSleepScreening($data)
    {
        $recommendedAssessments = [];

        // 1. If <7 hours sleep or rating <6 ➔ Show ISI-7
        if (($data['sleep_duration'] && $data['sleep_duration'] < 7) || 
            ($data['sleep_quality'] && $data['sleep_quality'] < 6)) {
            $recommendedAssessments[] = 'Insomnia Severity Index (ISI-7)';
        }

        // 2. If "Yes" to daytime sleepiness ➔ Show ESS-8
        if ($data['daytime_sleepiness'] === 'yes') {
            $recommendedAssessments[] = 'Epworth Sleepiness Scale (ESS-8)';
        }

        // 3. If poor sleep hygiene activity is marked ➔ Show SHI-13
        if (isset($data['sleep_activities']) && count($data['sleep_activities']) > 0) {
            $recommendedAssessments[] = 'Sleep Hygiene Index (SHI-13)';
        }

        // 4. If P-BANG features (HTN >130/90, BMI >35, Age >50, Neck >40cm, Male) ➔ Show STOP-BANG
        $pBangScore = 0;
        
        // Check blood pressure (format: "140/90" or any string)
        if (isset($data['blood_pressure']) && $data['blood_pressure'] && $data['blood_pressure'] !== 'Provide Data') {
            $bpParts = explode('/', $data['blood_pressure']);
            if (count($bpParts) === 2) {
                $systolic = intval($bpParts[0]);
                $diastolic = intval($bpParts[1]);
                if ($systolic > 130 || $diastolic > 90) $pBangScore++;
            }
        }
        
        if (isset($data['bmi']) && $data['bmi'] && $data['bmi'] > 35) $pBangScore++;
        if (isset($data['age']) && $data['age'] && $data['age'] > 50) $pBangScore++;
        if (isset($data['neck_circumference']) && $data['neck_circumference'] && $data['neck_circumference'] > 40) $pBangScore++;
        if (isset($data['gender']) && $data['gender'] === 'male') $pBangScore++;

        if ($pBangScore >= 2) {
            $recommendedAssessments[] = 'STOP-BANG Score for Obstructive Sleep Apnea';
        }

        return $recommendedAssessments;
    }

    /**
     * Get sleep screening by patient ID
     */
    public function getByPatient($patientId)
    {
        $sleepScreening = SleepScreening::where('patient_id', $patientId)->latest()->first();
        
        if (!$sleepScreening) {
            return response()->json([
                'success' => false,
                'message' => 'No sleep screening found for this patient'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $sleepScreening
        ]);
    }
}
