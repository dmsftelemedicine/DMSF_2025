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
        Schema::create('e_s_s8_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            
            // ESS-8 Questions (0-3 scale for each)
            $table->integer('ess_q1')->nullable(); // Sitting and reading
            $table->integer('ess_q2')->nullable(); // Watching TV
            $table->integer('ess_q3')->nullable(); // Sitting inactive in public place
            $table->integer('ess_q4')->nullable(); // As passenger in car
            $table->integer('ess_q5')->nullable(); // Lying down to rest
            $table->integer('ess_q6')->nullable(); // Sitting and talking
            $table->integer('ess_q7')->nullable(); // Sitting quietly after lunch
            $table->integer('ess_q8')->nullable(); // In car while stopped
            
            // Assessment Results
            $table->integer('total_score')->nullable();
            $table->string('severity')->nullable(); // Normal, Mild, Moderate, Severe
            $table->text('interpretation')->nullable();
            $table->text('recommendations')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_s_s8_assessments');
    }
};
