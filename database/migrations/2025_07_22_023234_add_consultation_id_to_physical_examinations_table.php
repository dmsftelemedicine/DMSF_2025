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
        Schema::table('physical_examinations', function (Blueprint $table) {
            // Add consultation_id as nullable foreign key
            $table->foreignId('consultation_id')->nullable()->after('patient_id')->constrained()->onDelete('cascade');
            
            // Add index for better performance
            $table->index(['patient_id', 'consultation_id'], 'pe_patient_consultation_idx');
        });
    }

    /**
     * Run the migrations down.
     */
    public function down(): void
    {
        Schema::table('physical_examinations', function (Blueprint $table) {
            $table->dropForeign(['consultation_id']);
            $table->dropIndex('pe_patient_consultation_idx');
            $table->dropColumn('consultation_id');
        });
    }
}; 