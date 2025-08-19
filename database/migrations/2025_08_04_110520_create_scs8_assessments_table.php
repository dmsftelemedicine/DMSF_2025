<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scs8_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('scs8_q1');
            $table->unsignedTinyInteger('scs8_q2');
            $table->unsignedTinyInteger('scs8_q3');
            $table->unsignedTinyInteger('scs8_q4');
            $table->unsignedTinyInteger('scs8_q5');
            $table->unsignedTinyInteger('scs8_q6');
            $table->unsignedTinyInteger('scs8_q7');
            $table->unsignedTinyInteger('scs8_q8');
            $table->unsignedTinyInteger('total_score');
            $table->string('connectedness_level')->nullable();
            $table->string('connectedness_category')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->unique('patient_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scs8_assessments');
    }
};


