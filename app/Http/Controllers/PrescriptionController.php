<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\PrescriptionDetail;
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
            'medicine_id' => 'required|array',
            'medicine_id.*' => 'required|integer|exists:medicines,id',
            'quantity' => 'required|array',
            'quantity.*' => 'required|integer|min:1',
        ]);

        // Create a new prescription in the database
        $prescription = Prescription::create([
            'patient_id' => $request->input('patient_id'),
            'doctor_name' => "Dr. William",
        ]);

        $prescriptionId = $prescription->id;

        foreach ($request->medicine_id as $index => $medicineId) {
            PrescriptionDetail::create([
                'prescription_id' => $prescriptionId,
                'medicine_id' => $medicineId,
            ]);
        }


        return response()->json([
            'success' => true,
            'message' => 'Prescription added successfully!',
            'data' => $prescription, // Optional: include the newly created prescription
        ]);

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

    public function getByPatient(Patient $patient)
    {
        // Eager load prescriptions with their details
        $prescriptions = $patient->prescriptions()->with('details.medicine')->latest()->get();

        // Build the array manually
        $data = [];
        foreach ($prescriptions as $prescription) {
            $data[] = [
                'id' => $prescription->id,
                'created_at' => $prescription->created_at->toDateTimeString(),
                'medicines' => $prescription->details->map(function ($detail) {
                    return [
                        'medicine_name' => $detail->medicine->name, // Assuming there's a 'name' field on the 'medicine' table
                    ];
                }),
            ];
        }

        return response()->json(['prescriptions' => $data]);
    }

}

