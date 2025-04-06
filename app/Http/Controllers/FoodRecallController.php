<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Nutrition;
use App\Models\FoodRecall;

class FoodRecallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'nutrition_id' => 'required|exists:nutritions,id',
            'breakfast' => 'nullable|string',
            'am_snack' => 'nullable|string',
            'lunch' => 'nullable|string',
            'pm_snack' => 'nullable|string',
            'dinner' => 'nullable|string',
            'midnight_snack' => 'nullable|string',
        ]);

        // Find the patient
        $nutrition_details = Nutrition::findOrFail($request->nutrition_id);

        $foodRecall = FoodRecall::create([
            'nutrition_id' => $request->nutrition_id,
            'breakfast' => $request->breakfast,
            'am_snack' => $request->am_snack,
            'lunch' => $request->lunch,
            'pm_snack' => $request->pm_snack,
            'dinner' => $request->dinner,
            'midnight_snack' => $request->midnight_snack,
        ]);

        return response()->json(['message' => 'Food Recall entry added successfully!']);
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
        //
    }

    public function getFoodRecalls($nutritionId)
    {
        $foodRecalls = FoodRecall::where('nutrition_id', $nutritionId)->get();
        return response()->json(['foodRecalls' => $foodRecalls]);
    }
}
