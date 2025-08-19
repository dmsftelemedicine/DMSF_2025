<?php

namespace App\Http\Controllers;

use App\Models\FND6Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FND6AssessmentController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'q1' => 'required|integer|min:0|max:3',
            'q2' => 'required|integer|min:0|max:1',
            'q3' => 'required|integer|min:0|max:1',
            'q4' => 'required|integer|min:0|max:3',
            'q5' => 'required|integer|min:0|max:1',
            'q6' => 'required|integer|min:0|max:1',
            'total_score' => 'required|integer|min:0|max:10',
        ]);
        if ($validator->fails()) return response()->json(['success' => false, 'errors' => $validator->errors()], 422);

        $total = (int) $request->total_score;
        $level = 'Low';
        if ($total >= 8) $level = 'High'; elseif ($total >= 5) $level = 'Moderate'; elseif ($total >= 3) $level = 'Low-Moderate';

        $existing = FND6Assessment::where('patient_id', $request->patient_id)->first();
        $payload = array_merge($request->all(), ['dependence_level' => $level]);
        if ($existing) { $existing->update($payload); $rec = $existing; } else { $rec = FND6Assessment::create($payload); }
        return response()->json(['success' => true, 'message' => 'FND-6 saved', 'data' => $rec]);
    }

    public function show($patientId)
    {
        $rec = FND6Assessment::where('patient_id', $patientId)->latest()->first();
        if (!$rec) return response()->json(['success' => false, 'message' => 'No data'], 404);
        return response()->json(['success' => true, 'data' => $rec]);
    }
}


