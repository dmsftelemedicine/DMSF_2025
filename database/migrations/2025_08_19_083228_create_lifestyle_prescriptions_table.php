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
        Schema::create('lifestyle_prescriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->string('diet_type')->nullable();
            $table->text('diet_notes')->nullable();
            $table->string('exercise_type')->nullable();
            $table->text('exercise_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lifestyle_prescriptions');
    }
};
