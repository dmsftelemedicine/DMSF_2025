<?php

namespace App\Http\Controllers;

use App\Models\SCS8Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SCS8AssessmentController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'scs8_q1' => 'required|integer|min:1|max:6',
            'scs8_q2' => 'required|integer|min:1|max:6',
            'scs8_q3' => 'required|integer|min:1|max:6',
            'scs8_q4' => 'required|integer|min:1|max:6',
            'scs8_q5' => 'required|integer|min:1|max:6',
            'scs8_q6' => 'required|integer|min:1|max:6',
            'scs8_q7' => 'required|integer|min:1|max:6',
            'scs8_q8' => 'required|integer|min:1|max:6',
            'total_score' => 'required|integer|min:8|max:48',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        [$level, $category, $remarks] = $this->classify((int) $request->total_score);
        $existing = SCS8Assessment::where('patient_id', $request->patient_id)->first();
        $payload = array_merge($request->all(), [
            'connectedness_level' => $level,
            'connectedness_category' => $category,
            'remarks' => $remarks,
        ]);
        if ($existing) { $existing->update($payload); $rec = $existing; } else { $rec = SCS8Assessment::create($payload); }
        return response()->json(['success' => true, 'message' => 'SCS-8 assessment saved', 'data' => $rec]);
    }

    public function show($patientId)
    {
        $rec = SCS8Assessment::where('patient_id', $patientId)->latest()->first();
        if (!$rec) return response()->json(['success' => false, 'message' => 'No data'], 404);
        return response()->json(['success' => true, 'data' => $rec]);
    }

    private function classify(int $total): array
    {
        if ($total <= 23) return ['Low Connectedness', 'Low', 'Consider support and social activities to improve connectedness.'];
        if ($total <= 35) return ['Moderate Connectedness', 'Moderate', 'Strengthen relationships and consider joining groups.'];
        return ['High Connectedness', 'High', 'Maintain strong social connections.'];
    }
}


