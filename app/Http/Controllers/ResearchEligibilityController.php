<?php

namespace App\Http\Controllers;

use App\Models\ResearchEligibilityCriteria;
use App\Models\Patient;
use Illuminate\Http\Request;

class ResearchEligibilityController extends Controller
{
    public function showForm($patientId)
    {
        // You can return a partial or a modal view
        $patient = Patient::findOrFail($patientId);
        return view('research-eligibility.form', compact('patient'));
    }

    public function check($patientId)
    {
        // Check if the patient has already submitted the form
        $eligibility = ResearchEligibilityCriteria::where('patient_id', $patientId)->first();

        if ($eligibility) {
            // Return the existing data if it exists
            return response()->json(['form_exists' => true, 'data' => $eligibility]);
        }

        // Return false if the form has not been submitted yet
        return response()->json(['form_exists' => false]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'read_and_write_consent' => 'required|boolean',
            'consent_for_info' => 'required|boolean',
            'consent_for_teleconsultation' => 'required|boolean',
            'laboratory_finding' => 'required|boolean',
            'hba1c_result' => 'nullable|numeric',
            'rbs_result' => 'nullable|integer',
            'polyuria' => 'required|boolean',
            'polydipsia' => 'required|boolean',
            'polyphagia' => 'required|boolean',
        ]);

        ResearchEligibilityCriteria::create($validated);

        return response()->json(['message' => 'Data saved successfully!']);
    }
}
