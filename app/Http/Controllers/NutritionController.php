<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Nutrition;

class NutritionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($patient_id)
    {
        $patient = Patient::findOrFail($patient_id);
        $NutritionResults = Nutrition::where('patient_id', $patient_id)
            ->orderBy('date', 'desc') // Sort by latest results
            ->get();

        return view('patients.Nutrition.index', compact('patient', 'NutritionResults'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'question_1' => 'required|integer',
            'question_2' => 'required|integer',
            'question_3' => 'required|integer',
            'question_4' => 'required|integer',
            'question_5' => 'required|integer',
            'question_6' => 'required|integer',
            'question_7' => 'required|integer',
            'question_8' => 'required|integer',
            'question_9' => 'required|integer',
            'question_10' => 'required|integer',
            'question_11' => 'required|integer',
            'question_12' => 'required|integer',
            'question_13' => 'required|integer',
            'question_14' => 'required|integer',
            'question_15' => 'required|integer',
            'question_16' => 'required|integer',
            'question_17' => 'required|integer',
            'question_18' => 'required|integer',
            'question_19' => 'required|integer',
            'question_20' => 'required|integer',
            'question_21' => 'required|integer',
            'question_22' => 'required|integer',
        ]);

        // Find the patient
        $patient = Patient::findOrFail($request->patient_id);


        TelemedicinePerception::create([
            'patient_id' => $patient->id,
            'question_1' => $request->question_1,
            'question_2' => $request->question_2,
            'question_3' => $request->question_3,
            'question_4' => $request->question_4,
            'question_5' => $request->question_5,
            'question_6' => $request->question_6,
            'question_7' => $request->question_7,
            'question_8' => $request->question_8,
            'question_9' => $request->question_9,
            'question_10' => $request->question_10,
            'question_11' => $request->question_11,
            'question_12' => $request->question_12,
            'question_13' => $request->question_13,
            'question_14' => $request->question_14,
            'question_15' => $request->question_15,
            'question_16' => $request->question_16,
            'question_17' => $request->question_17,
            'question_18' => $request->question_18,
            'question_19' => $request->question_19,
            'question_20' => $request->question_20,
            'question_21' => $request->question_21,
            'question_22' => $request->question_22,
        ]);

        return redirect()->back()->with('success', 'Nutrition added successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Nutrition::findOrFail($id);
        $response->delete();

        return response()->json(['message' => 'Response deleted successfully!']);
    }
}
