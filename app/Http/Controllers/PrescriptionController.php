<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\Medicine;
use App\Models\Patient;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    /**
     * Show the form to create a new prescription.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created prescription in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'medicine_id' => 'required|exists:medicines,id',
            'doctor_name' => 'required|string|max:255',
        ]);

        // Create a new prescription in the database
        Prescription::create([
            'patient_id' => $request->input('patient_id'),
            'medicine_id' => $request->input('medicine_id'),
            'doctor_name' => $request->input('doctor_name'),
        ]);

        // Redirect back with a success message
        return redirect()->route('prescriptions.create')->with('success', 'Prescription added successfully!');
    }

    /**
     * Display a list of prescriptions.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        
    }

    /**
     * Show the details of a specific prescription.
     *
     * @param \App\Models\Prescription $prescription
     * @return \Illuminate\View\View
     */
    public function show(Prescription $prescription)
    {
       
    }
}

