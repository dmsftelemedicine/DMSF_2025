<?php

namespace App\Http\Controllers;

use App\Models\ASSIST8Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ASSIST8AssessmentController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'data_json' => 'required|array',
            'injection_use' => 'nullable|integer|in:0,1',
        ]);
        if ($validator->fails()) return response()->json(['success' => false, 'errors' => $validator->errors()], 422);

        $existing = ASSIST8Assessment::where('patient_id', $request->patient_id)->first();
        $payload = [
            'patient_id' => $request->patient_id,
            'data_json' => $request->data_json,
            'injection_use' => $request->injection_use ?? 0,
        ];
        if ($existing) { $existing->update($payload); $rec = $existing; } else { $rec = ASSIST8Assessment::create($payload); }
        return response()->json(['success' => true, 'message' => 'ASSIST-8 saved', 'data' => $rec]);
    }

    public function show($patientId)
    {
        $rec = ASSIST8Assessment::where('patient_id', $patientId)->latest()->first();
        if (!$rec) return response()->json(['success' => false, 'message' => 'No data'], 404);
        return response()->json(['success' => true, 'data' => $rec]);
    }
}


