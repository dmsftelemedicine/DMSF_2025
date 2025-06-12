<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\InformedConsent;

class InformedConsentController extends Controller
{
    public function checkConsentSubmitted($patientId)
    {
        $existingForm = InformedConsent::where('patient_id', $patientId)->first();

        return response()->json([
            'form_exists' => $existingForm ? true : false,
            'data' => $existingForm ? [
                'date' => $existingForm->date,
                'session' => $existingForm->session,
                'participant_signed' => (bool)$existingForm->participant_signed,
                'witness_signed' => (bool)$existingForm->witness_signed,
                'witness_name' => $existingForm->witness_name,
                'copy_given' => (bool)$existingForm->copy_given,
                'copy_reason' => $existingForm->copy_reason
            ] : null
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'date' => 'required|date',
            'session' => 'required',
            'participant_signed' => 'nullable|boolean',
            'witness_signed' => 'nullable|boolean',
            'witness_name' => 'nullable|string',
            'copy_given' => 'required|boolean',
            'copy_reason' => 'nullable|string',
        ]);
        

        $existingForm = InformedConsent::where('patient_id', $request->patient_id)->first();

        if ($existingForm) {
            return response()->json(['message' => 'Form already exists.'], 409);
        }

        InformedConsent::create($validated);

        return response()->json(['message' => 'Form saved successfully.']);
    }

}
