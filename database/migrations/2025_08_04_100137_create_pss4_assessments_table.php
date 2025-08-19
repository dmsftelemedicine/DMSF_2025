<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pss4_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('pss4_q1');
            $table->unsignedTinyInteger('pss4_q2');
            $table->unsignedTinyInteger('pss4_q3');
            $table->unsignedTinyInteger('pss4_q4');
            $table->unsignedTinyInteger('total_score');
            $table->string('stress_level')->nullable();
            $table->string('stress_category')->nullable();
            $table->text('interpretation')->nullable();
            $table->timestamps();
            $table->unique('patient_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pss4_assessments');
    }
};


