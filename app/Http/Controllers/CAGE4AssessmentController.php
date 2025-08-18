<?php

namespace App\Http\Controllers;

use App\Models\CAGE4Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CAGE4AssessmentController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'q1' => 'required|integer|in:0,1',
            'q2' => 'required|integer|in:0,1',
            'q3' => 'required|integer|in:0,1',
            'q4' => 'required|integer|in:0,1',
            'total_score' => 'required|integer|min:0|max:4',
        ]);
        if ($validator->fails()) return response()->json(['success' => false, 'errors' => $validator->errors()], 422);

        $total = (int) $request->total_score;
        $interpretation = $total >= 2 ? 'High likelihood of alcohol dependence' : 'Low likelihood of alcohol dependence';

        $existing = CAGE4Assessment::where('patient_id', $request->patient_id)->first();
        $payload = array_merge($request->all(), ['interpretation' => $interpretation]);
        if ($existing) { $existing->update($payload); $rec = $existing; } else { $rec = CAGE4Assessment::create($payload); }
        return response()->json(['success' => true, 'message' => 'CAGE-4 saved', 'data' => $rec]);
    }

    public function show($patientId)
    {
        $rec = CAGE4Assessment::where('patient_id', $patientId)->latest()->first();
        if (!$rec) return response()->json(['success' => false, 'message' => 'No data'], 404);
        return response()->json(['success' => true, 'data' => $rec]);
    }
}


