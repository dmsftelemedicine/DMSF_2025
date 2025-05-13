<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhysicalActivity;
use App\Models\PhysicalActivityDetail;
use App\Models\PhysicalActivityDescription;
use Illuminate\Support\Facades\Validator;

class PhysicalActivityController extends Controller
{
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'activity_description_id.*' => 'required|exists:physical_activity_descriptions,id',
        ]);

        // Create a new physical activity record
        $activity = PhysicalActivity::create([
            'patient_id' => $request->patient_id,
        ]);

        // Loop through the form data and save details
        foreach ($request->days as $key => $day) {
            PhysicalActivityDetail::create([
                'physical_activity_id' => $activity->id,
                'activity_description_id' => $request->activity_description_id[$key],
                'days' => $day,
                'hours' => $request->hours[$key],
                'minutes' => $request->minutes[$key],
                'other_value' => $request->other_value[$key] ?? null,
                'met' => $request->met[$key],
            ]);
        }

        return response()->json(['message' => 'Physical activity saved successfully']);
    }
}

