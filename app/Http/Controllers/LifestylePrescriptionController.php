<?php

namespace App\Http\Controllers;

use App\Models\LifestylePrescription;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;

class LifestylePrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $patientId = $request->query('patient_id');
        if ($patientId) {
            $prescriptions = LifestylePrescription::where('patient_id', $patientId)
                ->orderByDesc('created_at')
                ->get();
            return response()->json(['prescriptions' => $prescriptions]);
        }

        $prescriptions = LifestylePrescription::orderByDesc('created_at')->paginate(20);
        return response()->json($prescriptions);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'diet_type' => 'nullable|string|max:255',
            'diet_notes' => 'nullable|string',
            'exercise_type' => 'nullable|string|max:255',
            'exercise_notes' => 'nullable|string',
            'blood_sugar_monitoring' => 'nullable|string',
            'weight_management' => 'nullable|string',
            'follow_up_schedule' => 'nullable|string',
        ]);

        $prescription = LifestylePrescription::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Lifestyle prescription saved successfully.',
            'data' => $prescription,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(LifestylePrescription $lifestylePrescription)
    {
        return response()->json($lifestylePrescription);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LifestylePrescription $lifestylePrescription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LifestylePrescription $lifestylePrescription)
    {
        $validated = $request->validate([
            'diet_type' => 'nullable|string|max:255',
            'diet_notes' => 'nullable|string',
            'exercise_type' => 'nullable|string|max:255',
            'exercise_notes' => 'nullable|string',
            'blood_sugar_monitoring' => 'nullable|string',
            'weight_management' => 'nullable|string',
            'follow_up_schedule' => 'nullable|string',
        ]);

        $lifestylePrescription->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Lifestyle prescription updated successfully.',
            'data' => $lifestylePrescription,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LifestylePrescription $lifestylePrescription)
    {
        $lifestylePrescription->delete();
        return response()->json(['success' => true]);
    }
}
