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
        Schema::create('patient_station_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->json('completed_stations'); // Store array of completed station numbers
            $table->integer('current_station')->default(1); // Current active station
            $table->timestamp('last_updated')->useCurrent();
            $table->timestamps();
            
            // Ensure only one progress record per patient
            $table->unique('patient_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_station_progress');
    }
};
