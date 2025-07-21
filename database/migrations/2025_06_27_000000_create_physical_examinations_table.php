<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('physical_examinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            
            // General Survey
            $table->json('general_survey')->nullable();
            
            // Skin/Hair
            $table->json('skin_hair')->nullable();
            
            // Finger & Nails
            $table->json('finger_nails')->nullable();
            
            // Head
            $table->json('head')->nullable();
            
            // Eyes
            $table->json('eyes')->nullable();
            
            // Ear
            $table->json('ear')->nullable();
            
            // Neck
            $table->json('neck')->nullable();
            
            // Back & Posture
            $table->json('back_posture')->nullable();
            
            // Posterior Thorax & Lungs
            $table->json('thorax_lungs')->nullable();
            
            // Cardiac Exam
            $table->json('cardiac_exam')->nullable();
            
            // Abdomen
            $table->json('abdomen')->nullable();
            
            // Breast & Axillae
            $table->json('breast_axillae')->nullable();
            
            // Male Genitalia
            $table->json('male_genitalia')->nullable();
            
            // Female Genitalia
            $table->json('female_genitalia')->nullable();
            
            // Extremities
            $table->json('extremities')->nullable();
            
            // Nervous System
            $table->json('nervous_system')->nullable();
            
            $table->timestamps();
            
            // Ensure one physical examination record per patient
            $table->unique('patient_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('physical_examinations');
    }
}; 