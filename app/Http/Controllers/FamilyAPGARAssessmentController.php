<?php

namespace App\Http\Controllers;

use App\Models\FamilyAPGARAssessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FamilyAPGARAssessmentController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'apgar_q1' => 'required|integer|min:0|max:2',
            'apgar_q2' => 'required|integer|min:0|max:2',
            'apgar_q3' => 'required|integer|min:0|max:2',
            'apgar_q4' => 'required|integer|min:0|max:2',
            'apgar_q5' => 'required|integer|min:0|max:2',
            'total_score' => 'required|integer|min:0|max:10',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        [$functioning, $category, $remarks] = $this->classify((int) $request->total_score);
        $existing = FamilyAPGARAssessment::where('patient_id', $request->patient_id)->first();
        $payload = array_merge($request->all(), [
            'family_functioning' => $functioning,
            'functioning_category' => $category,
            'remarks' => $remarks,
        ]);
        if ($existing) { $existing->update($payload); $rec = $existing; } else { $rec = FamilyAPGARAssessment::create($payload); }
        return response()->json(['success' => true, 'message' => 'Family APGAR assessment saved', 'data' => $rec]);
    }

    public function show($patientId)
    {
        $rec = FamilyAPGARAssessment::where('patient_id', $patientId)->latest()->first();
        if (!$rec) return response()->json(['success' => false, 'message' => 'No data'], 404);
        return response()->json(['success' => true, 'data' => $rec]);
    }

    private function classify(int $total): array
    {
        if ($total >= 7) return ['Highly Functional Family', 'Highly Functional', 'Positive functioning; maintain healthy dynamics.'];
        if ($total >= 4) return ['Moderately Functional Family', 'Moderately Functional', 'Consider improving communication and support.'];
        return ['Severely Dysfunctional Family', 'Severely Dysfunctional', 'Recommend professional family therapy.'];
    }
}


