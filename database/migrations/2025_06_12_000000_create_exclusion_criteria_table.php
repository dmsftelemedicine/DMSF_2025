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
        Schema::create('exclusion_criteria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->enum('emergency_unstable_case', ['yes', 'no', 'na'])->nullable();
            $table->enum('psychiatric_neuro_condition', ['yes', 'no', 'na'])->nullable();
            $table->enum('unable_complete_data', ['yes', 'no', 'na'])->nullable();
            $table->enum('confined_or_no_activity', ['yes', 'no', 'na'])->nullable();
            $table->enum('unable_feed_cook_decide', ['yes', 'no', 'na'])->nullable();
            $table->enum('pregnant_woman', ['yes', 'no', 'na'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exclusion_criteria');
    }
}; 