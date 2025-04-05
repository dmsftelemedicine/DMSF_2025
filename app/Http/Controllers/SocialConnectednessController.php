<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\SocialConnectedness;

class SocialConnectednessController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'patient_id' => 'required|integer', // Ensure patient_id is present
            'family' => 'required|integer|between:1,10',
            'friends' => 'required|integer|between:1,10',
            'classmate' => 'required|integer|between:1,10'
        ]);

        // Create the SocialConnectedness record
        $socialConnectedness = new SocialConnectedness();
        $socialConnectedness->patient_id = $request->patient_id;
        $socialConnectedness->family = $request->family;
        $socialConnectedness->friends = $request->friends;
        $socialConnectedness->classmate = $request->classmate;
        $socialConnectedness->scs_8_Q1 = $request->scs_8_Q1;
        $socialConnectedness->scs_8_Q2 = $request->scs_8_Q2;
        $socialConnectedness->scs_8_Q3 = $request->scs_8_Q3;
        $socialConnectedness->scs_8_Q4 = $request->scs_8_Q4;
        $socialConnectedness->scs_8_Q5 = $request->scs_8_Q5;
        $socialConnectedness->scs_8_Q6 = $request->scs_8_Q6;
        $socialConnectedness->scs_8_Q7 = $request->scs_8_Q7;
        $socialConnectedness->scs_8_Q8 = $request->scs_8_Q8;

        // Save the data to the database
        $socialConnectedness->save();

        // Return a success response
        return response()->json(['message' => 'Form submitted successfully!']);
    }

    public function show($patient_id)
    {
        // Retrieve the data from the SocialConnectedness table for the specific patient
        $socialConnectedness = SocialConnectedness::where('patient_id', $patient_id)->first();

        if ($socialConnectedness) {
            return response()->json($socialConnectedness);
        } else {
            return response()->json(['message' => 'Data not found'], 404);
        }
    }
}
