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
        Schema::create('diagnostics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->date('diagnostic_date');
            $table->string('requesting_physician')->nullable();
            $table->json('hematology')->nullable();
            $table->json('clinical_microscopy')->nullable();
            $table->json('blood_chemistry')->nullable();
            $table->json('microbiology')->nullable();
            $table->json('immunology_serology')->nullable();
            $table->text('others')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostics');
    }
};
