<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Nutrition;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

        // 5. Whole Grains Component (0-10)
        $whole_grains_score = 0;
        if ($whole_grains == 1) {
            $whole_grains_score = 0.51;
        } elseif ($gender == 'male' && in_array($whole_grains, [2, 3, 4, 5, 6, 7])) {
            $whole_grains_score = 2.97;
        } elseif ($gender == 'female' && in_array($whole_grains, [2, 3])) {
            $whole_grains_score = 5.20;
        } elseif ($gender == 'female' && in_array($whole_grains, [4, 5, 6, 7])) {
            $whole_grains_score = 6.94;
        }

        // 6. Dairy Component (0-10)
        $dairy = 0;
        if ($gender == 'male' && in_array($milk, [1, 2, 3])) {
            $dairy = 3.22;
        } elseif ($gender == 'female' && in_array($milk, [1, 2, 3]) && $low_fat_milk == 1) {
            $dairy = 3.32;
        } elseif ($gender == 'female' && in_array($milk, [1, 2, 3]) && in_array($low_fat_milk, [2, 3, 4, 5, 6, 7])) {
            $dairy = 4.81;
        } elseif (in_array($milk, [4, 5, 6, 7])) {
            $dairy = 6.51;
        }

        // 7. Total Protein Foods Component (0-5)
        $tot_proteins = 0;
        if ($gender == 'male' && in_array($seafood, [1, 2, 3, 4])) {
            $tot_proteins = 4.11;
        } elseif ($gender == 'male' && in_array($seafood, [5, 6, 7])) {
            $tot_proteins = 4.98;
        } elseif ($gender == 'female') {
            $tot_proteins = 4.97;
        }

        // 8. Seafood and Plant Protein Component (0-5)
        $seafood_plant = 0;
        if ($gender == 'male' && in_array($nuts_seeds, [1, 2])) {
            $seafood_plant = 0.49;
        } elseif ($gender == 'female' && in_array($nuts_seeds, [1, 2])) {
            $seafood_plant = 1.50;
        } elseif (in_array($nuts_seeds, [3, 4, 5, 6, 7])) {
            $seafood_plant = 4.20;
        }

        // 9. Fatty Acid Ratio Component (0-10) - Map string values to research paper numbers  
        $fatty_acid = 0;
        if (in_array($milk, [4, 5, 6, 7])) {
            $fatty_acid = 2.56;
        } elseif (in_array($saturated_fat, ['some', 'a_lot']) && in_array($milk, [1, 2, 3]) && $low_fat_milk == 1) {
            $fatty_acid = 2.63; // Q21 satfat = 2,3 (some/a_lot)
        } elseif (in_array($saturated_fat, ['some', 'a_lot']) && in_array($milk, [1, 2, 3]) && in_array($low_fat_milk, [2, 3, 4, 5, 6, 7])) {
            $fatty_acid = 4.54; // Q21 satfat = 2,3 (some/a_lot)  
        } elseif ($saturated_fat == 'none' && in_array($milk, [1, 2, 3])) {
            $fatty_acid = 5.93; // Q21 satfat = 1 (none)
        }

        // 10. Refined Grains Component (0-10) - Simplified version
        $refined_grains = 0;
        if ($green_vegetables == 1) {
            $refined_grains = 2.13;
        } elseif (in_array($grains, [3, 4, 5, 6, 7]) && in_array($seafood, [2, 3, 4, 5, 6, 7]) && in_array($green_vegetables, [2, 3, 4, 5, 6, 7])) {
            $refined_grains = 2.27;
        } elseif (in_array($grains, [3, 4, 5, 6, 7]) && in_array($nuts_seeds, [1, 2]) && $seafood == 1 && in_array($green_vegetables, [2, 3, 4, 5, 6, 7])) {
            $refined_grains = 4.73;
        } elseif (in_array($grains, [1, 2])) {
            $refined_grains = 10;
        }

        // 11. Sodium Component (0-10) - Map string values to research paper numbers
        $sodium = 0;
        if (in_array($fruit, [1, 2]) && in_array($grains, [3, 4, 5, 6, 7]) && $water == 'a_lot') {
            $sodium = 0.70; // Q22 water = 3 (a_lot)
        } elseif (in_array($fruit, [3, 4, 5, 6, 7]) && in_array($grains, [3, 4, 5, 6, 7]) && $water == 'a_lot') {
            $sodium = 2.30; // Q22 water = 3 (a_lot)
        } elseif (in_array($grains, [3, 4, 5, 6, 7]) && in_array($water, ['none', 'some'])) {
            $sodium = 4.94; // Q22 water = 1,2 (none/some)
        } elseif (in_array($grains, [1, 2])) {
            $sodium = 6.07;
        }

        // 12. Added Sugars Component (0-10) - Map string values to research paper numbers
        $sugar_calories_Q18 = 0;
        if ($ssb == 1) $sugar_calories_Q18 = 0;
        elseif ($ssb == 2) $sugar_calories_Q18 = 156;
        elseif ($ssb == 3) $sugar_calories_Q18 = 312;
        elseif ($ssb == 4) $sugar_calories_Q18 = 468;
        elseif ($ssb == 5) $sugar_calories_Q18 = 624;
        elseif ($ssb == 6) $sugar_calories_Q18 = 780;
        elseif ($ssb == 7) $sugar_calories_Q18 = 936;

        $sugar_calories_Q20 = 0;
        if ($added_sugars == 'none') $sugar_calories_Q20 = 0;        // Q20=1 -> 130, but "none" should be lowest
        elseif ($added_sugars == 'some') $sugar_calories_Q20 = 260;  // Q20=2 -> 260
        elseif ($added_sugars == 'a_lot') $sugar_calories_Q20 = 520; // Q20=3 -> 520

        $total_sugar_calories = $sugar_calories_Q18 + $sugar_calories_Q20;
        $added_sugars_score = max(0, 10 - ($total_sugar_calories / 100)); // Simplified scoring

        // 13. Saturated Fats Component (0-10)
        $sat_fat = 0;
        if (in_array($ssb, [3, 4, 5, 6, 7])) {
            $sat_fat = 1.82;
        } elseif (in_array($grains, [1, 2]) && in_array($ssb, [1, 2])) {
            $sat_fat = 3.20;
        } elseif (in_array($grains, [3, 4, 5, 6, 7]) && in_array($nuts_seeds, [1, 2]) && in_array($ssb, [1, 2])) {
            $sat_fat = 4.64;
        } elseif (in_array($grains, [3, 4, 5, 6, 7]) && in_array($nuts_seeds, [3, 4, 5, 6, 7]) && in_array($ssb, [1, 2])) {
            $sat_fat = 6.56;
        }

        // Compute total SHEI-22 score (0-100)
        $tot_score = round($total_fruits + $whole_fruits + $tot_veg + $greens_beans + $whole_grains_score +
            $dairy + $tot_proteins + $seafood_plant + $fatty_acid + $refined_grains +
            $sodium + $added_sugars_score + $sat_fat, 2);

        // Ensure score is within 0-100 range
        $tot_score = max(0, min(100, $tot_score));

        // Create the nutrition record with calculated SHEI-22 scores
        $nutrition = Nutrition::create([
            'patient_id'               => $validatedData['patient_id'],
            'consultation_id' => $request->consultation_id,
            'fruit'                    => $validatedData['fruit'],
            'fruit_juice'              => $validatedData['fruit_juice'],
            'vegetables'               => $validatedData['vegetables'],
            'green_vegetables'         => $validatedData['green_vegetables'],
            'starchy_vegetables'       => $validatedData['starchy_vegetables'],
            'grains'                   => $validatedData['grains'],
            'grains_frequency'         => $validatedData['grains_frequency']       ?? 'N/A',
            'whole_grains'             => $validatedData['whole_grains'],
            'whole_grains_frequency'   => $validatedData['whole_grains_frequency'] ?? 'N/A',
            'milk'                     => $validatedData['milk'],
            'milk_frequency'           => $validatedData['milk_frequency']        ?? 'N/A',
            'low_fat_milk'             => $validatedData['low_fat_milk'],
            'low_fat_milk_frequency'   => $validatedData['low_fat_milk_frequency'] ?? 'N/A',
            'beans'                    => $validatedData['beans'],
            'nuts_seeds'               => $validatedData['nuts_seeds'],
            'seafood'                  => $validatedData['seafood'],
            'seafood_frequency'        => $validatedData['seafood_frequency']    ?? 'N/A',
            'ssb'                      => $validatedData['ssb'],
            'ssb_frequency'            => $validatedData['ssb_frequency']        ?? 'N/A',
            'added_sugars'             => $validatedData['added_sugars'],
            'saturated_fat'            => $validatedData['saturated_fat'],
            'water'                    => $validatedData['water'],
            'dq_score'            => $tot_score,
        ]);


        return response()->json([
            'success' => true,
            'message' => 'Nutrition added successfully!',
            'data' => $nutrition,
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

    /**
     * Get latest nutrition by consultation ID
     */
    public function getLatestByConsultation($consultationId)
    {
        $nutrition = Nutrition::where('consultation_id', $consultationId)
            ->orderBy('created_at', 'desc')
            ->first();

        return response()->json($nutrition);
    }

    /**
     * Get latest nutrition by patient ID
     */
    public function getLatestByPatient($patientId)
    {
        $nutrition = Nutrition::where('patient_id', $patientId)
            ->orderBy('created_at', 'desc')
            ->first();

        return response()->json($nutrition);
    }
}
