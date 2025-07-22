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
        Schema::table('assessments', function (Blueprint $table) {
            $table->dropColumn(['ICD_10', 'medical_diagnosis', 'lifestyle_diagnosis']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assessments', function (Blueprint $table) {
            $table->string('ICD_10')->nullable();
            $table->text('medical_diagnosis')->nullable();
            $table->text('lifestyle_diagnosis')->nullable();
        });
    }
};
