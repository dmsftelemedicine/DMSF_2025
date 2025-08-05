<?php

namespace App\Http\Controllers;

use App\Models\ComprehensiveHistoryAttachment;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ComprehensiveHistoryAttachmentController extends Controller
{
    public function index(Request $request, Patient $patient)
    {
        $query = ComprehensiveHistoryAttachment::where('patient_id', $patient->id);
        
        if ($request->has('section')) {
            $query->where('section', $request->section);
        }
        
        $files = $query->orderBy('created_at', 'desc')->get();
        
        return response()->json([
            'files' => $files
        ]);
    }
    
    public function store(Request $request, Patient $patient)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|max:10240|mimes:pdf,jpg,jpeg,png,doc,docx', // 10MB max
            'section' => 'required|in:childhood_illness,adult_illness,family_history,previous_medications,current_medications,previous_hospitalization,surgical_history,health_maintenance,psychiatric_history',
            'section_item' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        
        try {
            $file = $request->file('file');
            
            // Generate unique filename
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // Store file in comprehensive_history_attachments directory
            $filePath = $file->storeAs('comprehensive_history_attachments', $fileName, 'public');
            
            // Get the patient's comprehensive history (should always exist now)
            $comprehensiveHistory = $patient->comprehensiveHistory()->firstOrFail();
            
            // Create database record
            $attachment = ComprehensiveHistoryAttachment::create([
                'patient_id' => $patient->id,
                'comprehensive_history_id' => $comprehensiveHistory->id,
                'section' => $request->section,
                'section_item' => $request->section_item,
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $filePath,
                'file_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
                'uploaded_by' => auth()->user()->name ?? 'System',
                'description' => $request->description,
            ]);
            
            return response()->json([
                'message' => 'File uploaded successfully',
                'file' => $attachment
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error uploading file: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function show(Patient $patient, ComprehensiveHistoryAttachment $attachment)
    {
        // Ensure the attachment belongs to the patient
        if ($attachment->patient_id !== $patient->id) {
            return response()->json(['message' => 'File not found'], 404);
        }
        
        return response()->json([
            'file' => $attachment
        ]);
    }
    
    public function download(Patient $patient, ComprehensiveHistoryAttachment $attachment)
    {
        // Ensure the attachment belongs to the patient
        if ($attachment->patient_id !== $patient->id) {
            abort(404);
        }
        
        $filePath = storage_path('app/public/' . $attachment->file_path);
        
        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }
        
        return response()->download($filePath, $attachment->file_name);
    }
    
    public function destroy(Patient $patient, ComprehensiveHistoryAttachment $attachment)
    {
        // Ensure the attachment belongs to the patient
        if ($attachment->patient_id !== $patient->id) {
            return response()->json(['message' => 'File not found'], 404);
        }
        
        try {
            // Delete file from storage
            Storage::disk('public')->delete($attachment->file_path);
            
            // Delete database record
            $attachment->delete();
            
            return response()->json([
                'message' => 'File deleted successfully'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting file: ' . $e->getMessage()
            ], 500);
        }
    }
}
