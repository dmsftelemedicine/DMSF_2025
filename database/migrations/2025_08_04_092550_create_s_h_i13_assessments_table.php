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
        Schema::create('s_h_i13_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            
            // SHI-13 Questions (1-5 scale for each)
            $table->integer('shi_q1')->nullable(); // Exercise 6 hours before bed
            $table->integer('shi_q2')->nullable(); // Daytime napping
            $table->integer('shi_q3')->nullable(); // Bedtime/wake time consistency
            $table->integer('shi_q4')->nullable(); // Bedroom environment
            $table->integer('shi_q5')->nullable(); // Noise in bedroom
            $table->integer('shi_q6')->nullable(); // Light in bedroom
            $table->integer('shi_q7')->nullable(); // Temperature in bedroom
            $table->integer('shi_q8')->nullable(); // Hunger before bed
            $table->integer('shi_q9')->nullable(); // Thirst before bed
            $table->integer('shi_q10')->nullable(); // Bedtime routine
            $table->integer('shi_q11')->nullable(); // Thinking/worrying in bed
            $table->integer('shi_q12')->nullable(); // Clock watching
            $table->integer('shi_q13')->nullable(); // Alcohol before bed
            
            // Assessment Results
            $table->integer('total_score')->nullable();
            $table->string('severity')->nullable(); // Good, Average, Poor
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
        Schema::dropIfExists('s_h_i13_assessments');
    }
};
