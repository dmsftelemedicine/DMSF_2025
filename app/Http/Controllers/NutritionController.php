<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Nutrition;
use App\Http\Requests\NutritionStoreRequest;
use App\Services\NutritionScoringService;
use Illuminate\Support\Str;


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
     * @param  \App\Http\Requests\NutritionStoreRequest  $request
     * @param  \App\Services\NutritionScoringService  $scoringService
     * @return \Illuminate\Http\Response
     */
    public function store(NutritionStoreRequest $request, NutritionScoringService $scoringService)
    {

        // Get validated data from Form Request
        $validatedData = $request->validated();

        // Find the patient
        $patient = Patient::findOrFail($validatedData['patient_id']);

        $validatedData = $request->validate([
            'consultation_id' => 'nullable|exists:consultations,id',
            'patient_id' => 'required|exists:patients,id',
            'fruit' => 'required|string',
            'fruit_juice' => 'required|string',
            'vegetables' => 'required|string',
            'green_vegetables' => 'required|string',
            'starchy_vegetables' => 'required|string',
            'grains' => 'required|string',
            'grains_frequency' => 'required|string',
            'whole_grains' => 'required|string',
            'whole_grains_frequency' => 'required|string',
            'milk' => 'required|string',
            'milk_frequency' => 'required|string',
            'low_fat_milk' => 'required|string',
            'low_fat_milk_frequency' => 'required|string',
            'beans' => 'required|string',
            'nuts_seeds' => 'required|string',
            'seafood' => 'required|string',
            'seafood_frequency' => 'required|string',
            'ssb' => 'required|string',
            'ssb_frequency' => 'required|string',
            'added_sugars' => 'required|string',
            'saturated_fat' => 'required|string',
            'water' => 'required|string',
        ]);

        // Find the patient
        $patient = Patient::findOrFail($request->patient_id);

        // Get patient gender for calculations
        $gender = Str::lower($patient->gender);

        // Convert string values to integers for processing (only for numeric questions)
        $fruit = (int) $request->fruit;
        $fruit_juice = (int) $request->fruit_juice;
        $vegetables = (int) $request->vegetables;
        $green_vegetables = (int) $request->green_vegetables;
        $starchy_vegetables = (int) $request->starchy_vegetables;
        $grains = (int) $request->grains;
        $whole_grains = (int) $request->whole_grains;
        $milk = (int) $request->milk;
        $low_fat_milk = (int) $request->low_fat_milk;
        $beans = (int) $request->beans;
        $nuts_seeds = (int) $request->nuts_seeds;
        $seafood = (int) $request->seafood;
        $ssb = (int) $request->ssb;
        
        // Keep string values as strings for categorical questions
        $grains_frequency = $request->grains_frequency;
        $whole_grains_frequency = $request->whole_grains_frequency;
        $milk_frequency = $request->milk_frequency;
        $low_fat_milk_frequency = $request->low_fat_milk_frequency;
        $seafood_frequency = $request->seafood_frequency;
        $ssb_frequency = $request->ssb_frequency;
        $added_sugars = $request->added_sugars; // "none", "some", "a_lot"
        $saturated_fat = $request->saturated_fat; // "none", "some", "a_lot"  
        $water = $request->water; // "none", "some", "a_lot"

        // Calculate SHEI-22 components according to the research paper

        // 1. Total Fruits Component (0-5)
        $total_fruits_Q1 = 0;
        if ($fruit == 1) $total_fruits_Q1 = 0;
        elseif ($fruit == 2) $total_fruits_Q1 = 2;
        elseif ($fruit == 3) $total_fruits_Q1 = 3.5;
        elseif (in_array($fruit, [4, 5, 6, 7])) $total_fruits_Q1 = 5;

        $total_fruits_Q2 = 0;
        if ($fruit_juice == 1) $total_fruits_Q2 = 0;
        elseif ($fruit_juice == 2) $total_fruits_Q2 = 2;
        elseif ($fruit_juice == 3) $total_fruits_Q2 = 3.5;
        elseif (in_array($fruit_juice, [4, 5, 6, 7])) $total_fruits_Q2 = 5;

        $total_fruits = $total_fruits_Q1 + $total_fruits_Q2;
        if ($total_fruits > 5) $total_fruits = 5;

        // 2. Whole Fruits Component (0-5)
        $whole_fruits = 0;
        if ($fruit == 1) $whole_fruits = 0;
        elseif ($fruit == 2) $whole_fruits = 2.5;
        elseif (in_array($fruit, [3, 4, 5, 6, 7])) $whole_fruits = 5;

        // 3. Total Vegetables Component (0-5) - Complex logic based on combinations
        $tot_veg = 0;
        if (in_array($vegetables, [2, 3, 4, 5, 6, 7]) && in_array($starchy_vegetables, [2, 3, 4, 5, 6, 7]) && $green_vegetables == 1) {
            $tot_veg = 5;
        } elseif ($green_vegetables == 1) {
            $tot_veg = 1.60;
        } elseif (in_array($starchy_vegetables, [2, 3, 4, 5, 6, 7]) && $green_vegetables == 2) {
            $tot_veg = 2.46;
        } elseif (in_array($starchy_vegetables, [2, 3, 4, 5, 6, 7]) && in_array($green_vegetables, [3, 4, 5, 6, 7])) {
            $tot_veg = 3.24;
        } elseif ($starchy_vegetables == 1 && in_array($green_vegetables, [2, 3, 4, 5, 6, 7])) {
            $tot_veg = 3.56;
        }

        // 4. Greens and Beans Component (0-5)
        $greens_beans_Q4 = 0;
        if ($green_vegetables == 1) $greens_beans_Q4 = 0;
        elseif (in_array($green_vegetables, [2, 3, 4, 5, 6, 7])) $greens_beans_Q4 = 5;

        $greens_beans_Q14 = 0;
        if ($beans == 1) $greens_beans_Q14 = 0;
        elseif (in_array($beans, [2, 3, 4, 5, 6, 7])) $greens_beans_Q14 = 5;

        $greens_beans = $greens_beans_Q4 + $greens_beans_Q14;
        if ($greens_beans > 5) $greens_beans = 5;

        // Calculate SHEI-22 score using the service
        $sheiScore = $scoringService->calculateSheiScore($validatedData, $patient);

        // Create the nutrition record
        $nutrition = Nutrition::create([
            'patient_id' => $validatedData['patient_id'],
            'consultation_id' => $validatedData['consultation_id'] ?? null,
            'fruit' => $validatedData['fruit'],
            'fruit_juice' => $validatedData['fruit_juice'],
            'vegetables' => $validatedData['vegetables'],
            'green_vegetables' => $validatedData['green_vegetables'],
            'starchy_vegetables' => $validatedData['starchy_vegetables'],
            'grains' => $validatedData['grains'],
            'whole_grains' => $validatedData['whole_grains'],
            'milk' => $validatedData['milk'],
            'low_fat_milk' => $validatedData['low_fat_milk'],
            'beans' => $validatedData['beans'],
            'nuts_seeds' => $validatedData['nuts_seeds'],
            'seafood' => $validatedData['seafood'],
            'ssb' => $validatedData['ssb'],
            'added_sugars' => $validatedData['added_sugars'],
            'saturated_fat' => $validatedData['saturated_fat'],
            'water' => $validatedData['water'],
            'dq_score' => $sheiScore,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Nutrition assessment completed successfully!',
            'data' => $nutrition,
            'shei_score' => $sheiScore,
        ]);
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

    /**
     * Get nutrition records by consultation ID
     */
    public function getByConsultation($consultationId)
    {
        $nutritionRecords = Nutrition::where('consultation_id', $consultationId)
            ->with('consultation')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($nutritionRecords);
    }
}
