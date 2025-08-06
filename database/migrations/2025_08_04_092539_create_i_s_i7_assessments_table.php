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
        Schema::create('i_s_i7_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            
            // ISI-7 Questions (0-4 scale for each)
            $table->integer('isi_q1')->nullable(); // Difficulty falling asleep
            $table->integer('isi_q2')->nullable(); // Difficulty staying asleep
            $table->integer('isi_q3')->nullable(); // Problems waking up too early
            $table->integer('isi_q4')->nullable(); // Sleep satisfaction
            $table->integer('isi_q5')->nullable(); // Noticeable to others
            $table->integer('isi_q6')->nullable(); // Worry/distress
            $table->integer('isi_q7')->nullable(); // Interference with daily functioning
            
            // Assessment Results
            $table->integer('total_score')->nullable();
            $table->string('severity')->nullable(); // None, Mild, Moderate, Severe
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
        Schema::dropIfExists('i_s_i7_assessments');
    }
};
