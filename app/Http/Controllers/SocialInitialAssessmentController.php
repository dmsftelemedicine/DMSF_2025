<?php

namespace App\Http\Controllers;

use App\Models\SocialInitialAssessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SocialInitialAssessmentController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'family_rating' => 'required|integer|min:1|max:10',
            'friends_rating' => 'required|integer|min:1|max:10',
            'colleagues_rating' => 'required|integer|min:1|max:10',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $existing = SocialInitialAssessment::where('patient_id', $request->patient_id)->first();
        if ($existing) {
            $existing->update($request->all());
            $rec = $existing;
        } else {
            $rec = SocialInitialAssessment::create($request->all());
        }
        return response()->json(['success' => true, 'message' => 'Social initial assessment saved', 'data' => $rec]);
    }

    public function show($patientId)
    {
        $rec = SocialInitialAssessment::where('patient_id', $patientId)->latest()->first();
        if (!$rec) return response()->json(['success' => false, 'message' => 'No data'], 404);
        return response()->json(['success' => true, 'data' => $rec]);
    }
}


