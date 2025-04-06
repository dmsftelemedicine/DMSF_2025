<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\StressManagement;

class StressManagementController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'patient_id' => 'required|integer', // Ensure patient_id is present
            'stress_level' => 'required|integer|between:0,10',
            
        ]);

        // Create a new StressManagement record
        $stressManagement = new StressManagement();
        $stressManagement->patient_id = $request->patient_id;
        $stressManagement->stress_level = $request->stress_level;
        $stressManagement->GAD_7_Q1 = $request->GAD_7_Q1;
        $stressManagement->GAD_7_Q2 = $request->GAD_7_Q2;
        $stressManagement->GAD_7_Q3 = $request->GAD_7_Q3;
        $stressManagement->GAD_7_Q4 = $request->GAD_7_Q4;
        $stressManagement->GAD_7_Q5 = $request->GAD_7_Q5;
        $stressManagement->GAD_7_Q6 = $request->GAD_7_Q6;
        $stressManagement->GAD_7_Q7 = $request->GAD_7_Q7;
        $stressManagement->GAD_7_total = $request->GAD_7_total;
        $stressManagement->PHQ_9_Q1 = $request->PHQ_9_Q1;
        $stressManagement->PHQ_9_Q2 = $request->PHQ_9_Q2;
        $stressManagement->PHQ_9_Q3 = $request->PHQ_9_Q3;
        $stressManagement->PHQ_9_Q4 = $request->PHQ_9_Q4;
        $stressManagement->PHQ_9_Q5 = $request->PHQ_9_Q5;
        $stressManagement->PHQ_9_Q6 = $request->PHQ_9_Q6;
        $stressManagement->PHQ_9_Q7 = $request->PHQ_9_Q7;
        $stressManagement->PHQ_9_Q8 = $request->PHQ_9_Q8;
        $stressManagement->PHQ_9_Q9 = $request->PHQ_9_Q9;
        $stressManagement->PHQ_9_total = $request->PHQ_9_total;
        $stressManagement->PSS_4_Q1 = $request->PSS_4_Q1;
        $stressManagement->PSS_4_Q2 = $request->PSS_4_Q2;
        $stressManagement->PSS_4_Q3 = $request->PSS_4_Q3;
        $stressManagement->PSS_4_Q4 = $request->PSS_4_Q4;

         // Save the data to the database
        $stressManagement->save();

        // Return a success response
        return response()->json(['message' => 'Form submitted successfully!']);
    }

    public function getDataByPatient($patientId)
    {
        // Fetch the stress management data by patient ID
        $stressManagementData = StressManagement::where('patient_id', $patientId)->get();

        // Return the data in JSON format
        return response()->json($stressManagementData);
    }

}
