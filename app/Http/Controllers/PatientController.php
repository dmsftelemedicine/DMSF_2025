<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\Patient;
use Carbon\Carbon;


class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $patients = Patient::all(); // Adjust to your pagination needs

        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', 'in:male,female'],
            'street' => ['required', 'string', 'max:255'],
            'brgy_address' => ['required', 'string', 'max:255'],
            'address_landmark' => ['nullable', 'string', 'max:255'],
            'occupation' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'in:active,inactive,pending'],  // Status field validation
            'highest_educational_attainment' => ['required', 'string', 'max:255'],
            'marital_status' => ['required', 'string', 'max:50'],
            'monthly_household_income' => ['required', 'string', 'max:50'],
            'religion' => ['required', 'string', 'max:50'],
        ]);

        $patient = Patient::create($request->all());

        return redirect()->route('patients.show', $patient->id)->with('success', 'Patient added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        $age = Carbon::parse($patient->birth_date)->age;
        return view('patients.show', compact('patient', 'age'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:male,female',
            'street' => 'required|string|max:255',
            'brgy_address' => 'required|string|max:255',
            'address_landmark' => 'nullable|string|max:255',
            'occupation' => 'nullable|string|max:255',
            'highest_educational_attainment' => 'required|string|max:255',
            'marital_status' => 'required|string|max:50',
            'monthly_household_income' => 'required|string|max:50',
            'religion' => 'required|string|max:50',
        ]);
        
        // Manually update the record using Query Builder
        $updated = Patient::where('id', $patient->id)->update($validated);

        // Debugging: Check if update was successful
        if (!$updated) {
            return back()->with('error', 'Failed to update patient. Please try again.');
        }

        return redirect()->route('patients.show', $patient->id)->with('success', 'Patient updated successfully');
    }


    public function getMacronutrients($patient_id)
    {
        $patient = Patient::findOrFail($patient_id); // Fetch patient by ID
        $tdee = $patient->tdee ? $patient->tdee->tdee : null;

        if (!$tdee) {
            return response()->json(['error' => 'TDEE data missing'], 400);
        }

        // Computation
        $protein_grams = 0.8 * $patient->weight_kg;
        $protein_calories = $protein_grams * 4;

        $fat_calories = 0.15 * $tdee;
        $fat_grams = $fat_calories / 9;

        $carbs_calories = $tdee - ($protein_calories + $fat_calories);
        $carbs_grams = $carbs_calories / 4;

        return response()->json([
            'tdee' => round($tdee, 0),
            'weight_kg' => round($patient->weight_kg, 1),
            'protein_grams' => round($protein_grams, 1),
            'protein_calories' => round($protein_calories, 1),
            'fat_grams' => round($fat_grams, 1),
            'fat_calories' => round($fat_calories, 1),
            'carbs_grams' => round($carbs_grams, 1),
            'carbs_calories' => round($carbs_calories, 1),
        ]);
    }

    /**
     * Update the patient's diagnosis.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function updateDiagnosis(Request $request, Patient $patient)
    {
        $request->validate([
            'diagnosis' => 'required|string|max:1000'
        ]);

        $patient->update([
            'diagnosis' => $request->diagnosis
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Diagnosis updated successfully',
            'diagnosis' => $patient->diagnosis
        ]);
    }

    /**
     * Update the patient's height.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function updateHeight(Request $request, Patient $patient)
    {
        $request->validate([
            'height' => 'required|numeric|min:0.5|max:3.0' // Height in meters
        ]);

        $patient->update([
            'height' => $request->height
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Height updated successfully',
            'height' => $patient->getHeightInMeters()
        ]);
    }

    /**
     * Update the patient's weight.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function updateWeight(Request $request, Patient $patient)
    {
        $request->validate([
            'weight_kg' => 'required|numeric|min:20|max:300' // Weight in kg
        ]);

        $patient->update([
            'weight_kg' => $request->weight_kg
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Weight updated successfully',
            'weight_kg' => $patient->weight_kg
        ]);
    }

    public function updateWaist(Request $request, Patient $patient)
    {
        $request->validate([
            'waist_circumference' => 'required|numeric|min:0|max:300',
        ]);

        $patient->update([
            'waist_circumference' => $request->waist_circumference
        ]);

        return response()->json(['message' => 'Waist circumference updated successfully']);
    }

    public function updateHip(Request $request, Patient $patient)
    {
        $request->validate([
            'hip_circumference' => 'required|numeric|min:0|max:300',
        ]);

        $patient->update([
            'hip_circumference' => $request->hip_circumference
        ]);

        return response()->json(['message' => 'Hip circumference updated successfully']);
    }

    public function updateNeck(Request $request, Patient $patient)
    {
        $request->validate([
            'neck_circumference' => 'required|numeric|min:0|max:100',
        ]);

        $patient->update([
            'neck_circumference' => $request->neck_circumference
        ]);

        return response()->json(['message' => 'Neck circumference updated successfully']);
    }

    public function updateTemperature(Request $request, Patient $patient)
    {
        $request->validate([
            'temperature' => 'required|numeric|min:35|max:42',
        ]);

        $patient->update([
            'temperature' => $request->temperature
        ]);

        return response()->json(['message' => 'Temperature updated successfully']);
    }

    public function updateHeartRate(Request $request, Patient $patient)
    {
        $request->validate([
            'heart_rate' => 'required|integer|min:40|max:200',
        ]);

        $patient->update([
            'heart_rate' => $request->heart_rate
        ]);

        return response()->json(['message' => 'Heart rate updated successfully']);
    }

    public function updateO2Saturation(Request $request, Patient $patient)
    {
        $request->validate([
            'o2_saturation' => 'required|integer|min:70|max:100',
        ]);

        $patient->update([
            'o2_saturation' => $request->o2_saturation
        ]);

        return response()->json(['message' => 'O2 saturation updated successfully']);
    }

    public function updateRespiratoryRate(Request $request, Patient $patient)
    {
        $request->validate([
            'respiratory_rate' => 'required|integer|min:8|max:40',
        ]);

        $patient->update([
            'respiratory_rate' => $request->respiratory_rate
        ]);

        return response()->json(['message' => 'Respiratory rate updated successfully']);
    }

    public function updateBloodPressure(Request $request, Patient $patient)
    {
        $request->validate([
            'blood_pressure' => ['required', 'string', 'regex:/^\d{2,3}\/\d{2,3}$/'],
        ]);

        $patient->update([
            'blood_pressure' => $request->blood_pressure
        ]);

        return response()->json(['message' => 'Blood pressure updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
