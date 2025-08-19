<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assist8_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->json('data_json');
            $table->unsignedTinyInteger('injection_use')->default(0);
            $table->timestamps();
            $table->unique('patient_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assist8_assessments');
    }
};


