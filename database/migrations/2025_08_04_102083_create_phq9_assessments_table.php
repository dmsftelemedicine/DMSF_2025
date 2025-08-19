<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('phq9_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('phq9_q1');
            $table->unsignedTinyInteger('phq9_q2');
            $table->unsignedTinyInteger('phq9_q3');
            $table->unsignedTinyInteger('phq9_q4');
            $table->unsignedTinyInteger('phq9_q5');
            $table->unsignedTinyInteger('phq9_q6');
            $table->unsignedTinyInteger('phq9_q7');
            $table->unsignedTinyInteger('phq9_q8');
            $table->unsignedTinyInteger('phq9_q9');
            $table->unsignedTinyInteger('total_score');
            $table->string('severity')->nullable();
            $table->string('suicide_risk')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->unique('patient_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('phq9_assessments');
    }
};


