<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\TelemedicinePerception;

class TelemedicinePerceptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($patient_id)
    {
        $patient = Patient::findOrFail($patient_id);
        $TelemedicinePerceptionResults = TelemedicinePerception::where('patient_id', $patient_id)
            ->orderBy('date', 'desc') // Sort by latest results
            ->get();

        return view('patients.Telemedicine_Perception.index', compact('patient', 'TelemedicinePerceptionResults'));
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
            'question_1' => 'required|integer|min:1|max:5',
            'question_2' => 'required|integer|min:1|max:5',
            'question_3' => 'required|integer|min:1|max:5',
            'question_4' => 'required|integer|min:1|max:5',
            'question_5' => 'required|integer|min:1|max:5',
            'first_time' => 'required|in:yes,no',
        ]);

         // Find the patient
        $patient = Patient::findOrFail($request->patient_id);

        // Calculate the total satisfaction score
        $totalScore = $request->question_1 + 
                      $request->question_2 + 
                      $request->question_3 + 
                      $request->question_4 + 
                      $request->question_5;

        // Determine the satisfaction level
        if ($totalScore >= 5 && $totalScore <= 11) {
            $satisfaction = "Low Satisfaction";
        } elseif ($totalScore >= 12 && $totalScore <= 18) {
            $satisfaction = "Moderate Satisfaction";
        } else {
            $satisfaction = "High Satisfaction";
        }

        $telemedicinePerception = TelemedicinePerception::create([
            'patient_id' => $patient->id,
            'consultation_id' => $request->consultation_id,
            'first_time' => $request->first_time,
            'question_1' => $request->question_1,
            'question_2' => $request->question_2,
            'question_3' => $request->question_3,
            'question_4' => $request->question_4,
            'question_5' => $request->question_5,
            'satisfaction' => $satisfaction, // Store satisfaction level instead of raw score
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Telemedicine perception submitted successfully!',
            'data' => $telemedicinePerception
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
        $response = TelemedicineResponse::findOrFail($id);
        $response->delete();

        return response()->json(['message' => 'Response deleted successfully!']);
    }

    /**
     * Get telemedicine perception records by consultation ID
     */
    public function getByConsultation($consultationId)
    {
        $telemedicineRecords = TelemedicinePerception::where('consultation_id', $consultationId)
            ->with('consultation')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($telemedicineRecords);
    }
}
