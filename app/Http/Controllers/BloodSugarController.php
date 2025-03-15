<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\BloodSugarTest;

class BloodSugarController extends Controller
{
    public function store(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'blood_sugar_mgdl' => 'required|numeric|min:10|max:600', // mg/dL range
            'blood_sugar_mmol' => 'required|numeric|min:0.5|max:33.3', // mmol/L range
            'test_date' => 'required|date',
        ]);

        // Find the patient
        $patient = Patient::findOrFail($id);

        // Save the blood sugar test result
        BloodSugarTest::create([
            'patient_id' => $patient->id,
            'blood_sugar_mgdl' => $request->blood_sugar_mgdl,
            'blood_sugar_mmol' => $request->blood_sugar_mmol,
            'test_date' => $request->test_date,
        ]);

        return redirect()->back()->with('success', 'Blood sugar test result added successfully!');
    }

    public function index($patient_id)
    {
        $patient = Patient::findOrFail($patient_id);
        $bloodSugarResults = BloodSugarTest::where('patient_id', $patient_id)
            ->orderBy('date', 'desc') // Sort by latest results
            ->get();

        return view('patients.blood_sugar.index', compact('patient', 'bloodSugarResults'));
    }
}
