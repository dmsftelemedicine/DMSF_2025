<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MealPlan;
use App\Models\Patient;

class MealPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mealPlans = MealPlan::with('patient')->orderBy('date', 'desc')->get();
        return response()->json($mealPlans);
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
        // Validate the request
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'date' => 'required|date',
            'meal_type' => 'required|string',
            'protein' => 'required|numeric',
            'fat' => 'required|numeric',
            'carbohydrates' => 'required|numeric',
        ]);

        // Get the patient
        $patient = Patient::findOrFail($request->patient_id);

        // Save the meal plan entry
        MealPlan::create([
            'patient_id' => $patient->id,
            'date' => $request->date,
            'meal_type' => $request->meal_type,
            'protein' => $request->protein,
            'fat' => $request->fat,
            'carbohydrates' => $request->carbohydrates,
        ]);

        return response()->json(['message' => 'Meal plan saved successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mealPlan = MealPlan::with('patient')->findOrFail($id);
        return response()->json($mealPlan);
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
        // Validate the request
        $request->validate([
            'date' => 'required|date',
            'meal_type' => 'required|string',
            'protein' => 'required|numeric',
            'fat' => 'required|numeric',
            'carbohydrates' => 'required|numeric',
        ]);

        // Find the meal plan entry
        $mealPlan = MealPlan::findOrFail($id);

        // Update the meal plan entry
        $mealPlan->update([
            'date' => $request->date,
            'meal_type' => $request->meal_type,
            'protein' => $request->protein,
            'fat' => $request->fat,
            'carbohydrates' => $request->carbohydrates,
        ]);

        return response()->json(['message' => 'Meal plan updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MealPlan::destroy($id);
        return response()->json(['message' => 'Meal plan deleted successfully!']);
    }

    public function getMealPlans($patientId)
    {
        $mealPlans = MealPlan::where('patient_id', $patientId)->orderBy('date', 'desc')->get();

        return response()->json($mealPlans);
    }

}
