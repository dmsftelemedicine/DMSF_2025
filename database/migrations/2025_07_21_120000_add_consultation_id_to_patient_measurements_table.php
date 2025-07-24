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
        Schema::table('patient_measurements', function (Blueprint $table) {
            // Add consultation_id as nullable foreign key
            $table->foreignId('consultation_id')->nullable()->after('patient_id')->constrained()->onDelete('cascade');
            
            // Add index for better performance
            $table->index(['patient_id', 'consultation_id'], 'pm_patient_consultation_idx');
            
            // Make tab_number nullable since we're moving to consultation-based system
            $table->integer('tab_number')->nullable()->change();
            
            // Drop the old unique constraint
            $table->dropUnique('patient_measurements_unique');
            
            // Add new unique constraint for consultation-based measurements
            $table->unique(['patient_id', 'consultation_id'], 'patient_measurements_consultation_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patient_measurements', function (Blueprint $table) {
            // Drop new constraint and index
            $table->dropUnique('patient_measurements_consultation_unique');
            $table->dropIndex('pm_patient_consultation_idx');
            
            // Remove consultation_id
            $table->dropForeign(['consultation_id']);
            $table->dropColumn('consultation_id');
            
            // Restore tab_number to not nullable
            $table->integer('tab_number')->nullable(false)->change();
            
            // Restore old unique constraint
            $table->unique(['patient_id', 'tab_number'], 'patient_measurements_unique');
        });
    }
}; 