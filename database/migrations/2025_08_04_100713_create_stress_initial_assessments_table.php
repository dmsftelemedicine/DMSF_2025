<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stress_initial_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('stress_rating'); // 1-10
            $table->timestamps();
            $table->unique('patient_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stress_initial_assessments');
    }
};


