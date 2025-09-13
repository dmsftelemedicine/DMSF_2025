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
