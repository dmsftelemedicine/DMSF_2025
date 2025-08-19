<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('family_apgar_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('apgar_q1');
            $table->unsignedTinyInteger('apgar_q2');
            $table->unsignedTinyInteger('apgar_q3');
            $table->unsignedTinyInteger('apgar_q4');
            $table->unsignedTinyInteger('apgar_q5');
            $table->unsignedTinyInteger('total_score');
            $table->string('family_functioning')->nullable();
            $table->string('functioning_category')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->unique('patient_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('family_apgar_assessments');
    }
};


