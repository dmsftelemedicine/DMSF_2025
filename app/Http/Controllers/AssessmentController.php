<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Patient;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
   public function index()
    {
        $patients = Patient::all();
        return view('assessments', compact('patients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'ICD_10' => 'required|string|max:255',
            'medical_diagnosis' => 'required|string',
            'lifestyle_diagnosis' => 'required|string',
        ]);

        $assessment = Assessment::create($validated);
        $assessment->load('patient'); // Eager load patient for response

        return response()->json($assessment);
    }

    public function getByPatient($patientId)
    {
        $assessments = Assessment::with('patient')
            ->where('patient_id', $patientId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($assessments);
    }
}
