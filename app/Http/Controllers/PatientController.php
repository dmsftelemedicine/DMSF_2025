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
        //
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'gender' => ['nullable', 'string', 'max:255'],
            'marital_status' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'], // Ensure unique for patients
            'house_no' => ['nullable', 'string', 'max:50'],
            'street' => ['nullable', 'string', 'max:255'],
            'barangay' => ['nullable', 'string', 'max:255'],
            'city_municipality' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'zip_code' => ['required', 'string', 'max:10'],
            'blood_type' => ['nullable', 'string', 'max:5'],
            'height' => ['nullable', 'numeric', 'min:0'],
            'weight_kg' => ['nullable', 'numeric', 'min:0'],
            'occupation' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'in:active,inactive,pending'],  // Status field validation
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
        // Validate input
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:male,female',
            'blood_type' => 'required|string|max:3',
            'marital_status' => 'required|string|in:single,married,divorced,widowed',
            'email' => 'required|email|max:255',
            'house_no' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city_municipality' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
            'zip_code' => 'nullable|string|max:10',
            'height' => 'nullable|numeric',
            'weight_kg' => 'nullable|numeric',
            'occupation' => 'nullable|string|max:255',
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
