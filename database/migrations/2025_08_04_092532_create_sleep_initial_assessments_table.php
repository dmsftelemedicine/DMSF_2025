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
        Schema::create('sleep_initial_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            
            // Basic Sleep Metrics
            $table->time('sleep_time')->nullable();
            $table->time('wake_up_time')->nullable();
            $table->decimal('usual_sleep_duration', 4, 1)->nullable(); // hours with decimal
            $table->integer('sleep_quality_rating')->nullable(); // 1-10 scale
            
            // Sleep Hygiene Activities (stored as JSON)
            $table->json('hygiene_activities')->nullable();
            
            // Daytime Sleepiness
            $table->enum('daytime_sleepiness', ['yes', 'no'])->nullable();
            
            // Physical Measurements for STOP-BANG
            $table->string('blood_pressure')->nullable();
            $table->decimal('bmi', 5, 2)->nullable();
            $table->integer('age')->nullable();
            $table->decimal('neck_circumference', 5, 1)->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sleep_initial_assessments');
    }
};
