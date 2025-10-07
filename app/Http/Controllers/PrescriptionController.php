<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\PrescriptionDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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
        ]);

        // Create a new prescription in the database
        $prescription = Prescription::create([
            'patient_id' => $request->input('patient_id'),
            'doctor_name' => "Dr. Jose Rizal MD",
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
        $prescriptions = $patient->prescriptions()->with('details.medicine')->latest()->get();

        $data = [];
        foreach ($prescriptions as $prescription) {
            $data[] = [
                'id' => $prescription->id,
                'created_at' => $prescription->created_at->toDateTimeString(),
                'medicines' => $prescription->details->map(function ($detail) {
                    return [
                        'medicine_name' => $detail->medicine->name,
                        'medicine_id' => $detail->medicine->id,
                        'medicine_details_id' => $detail->id,
                        'rx_english_instructions' => $detail->medicine->rx_english_instructions,
                        'image_url' => $detail->medicine->drug_image, // optional if you want to show the actual image
                    ];
                }),
            ];
        }

        return response()->json(['prescriptions' => $data]);
    }


    public function print($prescriptionId)
    {
        $prescription = Prescription::with(['patient', 'details.medicine'])->findOrFail($prescriptionId);

        $pdf = Pdf::loadView('patients.management.components.drug_prescription.print', compact('prescription'))
                ->setPaper([0, 0, 420, 595], 'portrait'); // approx. 1/4 of A4 (in points)

        return $pdf->stream('prescription.pdf');
    }

    // Controller method
    public function update(Request $request, $prescriptionId)
    {
        // Find the prescription
        $prescription = Prescription::findOrFail($prescriptionId);
        
        // Update the medicines (this assumes you have a relationship set up for medicines)
        foreach ($request->medicines as $medicine) {
            $existingMedicine = PrescriptionDetail::findOrFail($medicine['medicine_details_id']);
            $existingMedicine->update([
                'medicine_id' => $medicine['medicine_id']
            ]);
        }

        return response()->json(['success' => true]);
    }

}

