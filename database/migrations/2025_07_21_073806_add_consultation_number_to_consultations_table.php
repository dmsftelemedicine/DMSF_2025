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
        Schema::table('consultations', function (Blueprint $table) {
            $table->tinyInteger('consultation_number')->nullable()->after('consultation_date')->comment('1=First, 2=Second, 3=Third consultation');
            $table->index(['patient_id', 'consultation_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->dropIndex(['patient_id', 'consultation_number']);
            $table->dropColumn('consultation_number');
        });
    }
};
