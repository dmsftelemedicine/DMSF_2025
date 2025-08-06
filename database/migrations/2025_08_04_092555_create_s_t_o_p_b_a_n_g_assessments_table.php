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
        Schema::create('s_t_o_p_b_a_n_g_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            
            // STOP-BANG Questions (Yes/No for each)
            $table->enum('stopbang_q1', ['yes', 'no'])->nullable(); // Snore loudly
            $table->enum('stopbang_q2', ['yes', 'no'])->nullable(); // Tired during day
            $table->enum('stopbang_q3', ['yes', 'no'])->nullable(); // Observed stop breathing
            $table->enum('stopbang_q4', ['yes', 'no'])->nullable(); // High blood pressure
            $table->enum('stopbang_q5', ['yes', 'no'])->nullable(); // BMI > 35
            $table->enum('stopbang_q6', ['yes', 'no'])->nullable(); // Age > 50
            $table->enum('stopbang_q7', ['yes', 'no'])->nullable(); // Neck circumference > 40cm
            $table->enum('stopbang_q8', ['yes', 'no'])->nullable(); // Male gender
            
            // Assessment Results
            $table->integer('total_score')->nullable();
            $table->string('risk_level')->nullable(); // Low, Intermediate, High
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
        Schema::dropIfExists('s_t_o_p_b_a_n_g_assessments');
    }
};
