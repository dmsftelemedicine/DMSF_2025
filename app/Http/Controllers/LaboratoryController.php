<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\LaboratoryResult;

class LaboratoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'date' => 'required|date',
            'result' => 'required|numeric|min:3|max:15',
            'test_type' => 'required|string',
        ]);

        $result = LaboratoryResult::create([
            'patient_id' => $request->patient_id,
            'date' => $request->date,
            'result' => $request->result,
            'test_type' => $request->test_type,
        ]);

        // Convert HbA1c (%) to estimated average blood sugar (mg/dL)
        $bloodSugar = round((28.7 * $request->result) - 46.7, 0);
        
        // Determine remarks
        if ($request->result < 5.7) {
            $remarks = '<span class="text-green-600 font-bold">Normal</span>';
        } elseif ($request->result < 6.5) {
            $remarks = '<span class="text-yellow-600 font-bold">Prediabetes</span>';
        } else {
            $remarks = '<span class="text-red-600 font-bold">High</span>';
        }

        return response()->json([
            'success' => true,
            'date' => \Carbon\Carbon::parse($result->date)->format('M d, Y'),
            'result' => $result->result,
            'blood_sugar' => $bloodSugar,
            'remarks' => $remarks,
        ]);
    }

    public function uploadLabResult(Request $request, Patient $patient)
    {
        $request->validate([
            'lab_type' => 'required|string|max:255',
            'lab_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $filePath = $request->file('lab_image')->store('lab_results', 'public');

        $labResult = new LaboratoryResult();
        $labResult->patient_id = $patient->id;
        $labResult->test_type = $request->lab_type;
        $labResult->date = $request->date_of_procedure;
        $labResult->result = 0;
        $labResult->image_path = $filePath;
        $labResult->save();

        return response()->json([
            'success' => true,
            'test_type' => $labResult->test_type,
            'date' => $labResult->date,
            'image_url' => asset('storage/' . $filePath),
        ]);
    }

}
