<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gad7_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('gad7_q1');
            $table->unsignedTinyInteger('gad7_q2');
            $table->unsignedTinyInteger('gad7_q3');
            $table->unsignedTinyInteger('gad7_q4');
            $table->unsignedTinyInteger('gad7_q5');
            $table->unsignedTinyInteger('gad7_q6');
            $table->unsignedTinyInteger('gad7_q7');
            $table->string('gad7_difficulty')->nullable();
            $table->unsignedTinyInteger('total_score');
            $table->string('severity')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->unique('patient_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gad7_assessments');
    }
};


