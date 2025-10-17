<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, clean up duplicate nutrition records
        // Keep only the most recent nutrition record for each consultation
        DB::statement("
            DELETE n1 FROM nutritions n1
            INNER JOIN nutritions n2 
            WHERE n1.consultation_id = n2.consultation_id
            AND n1.id < n2.id
        ");

        Schema::table('nutritions', function (Blueprint $table) {
            // Add unique constraint to ensure only one nutrition record per consultation
            // This prevents duplicate nutrition entries for the same consultation
            $table->unique('consultation_id', 'unique_nutrition_per_consultation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nutritions', function (Blueprint $table) {
            // Drop the unique constraint
            $table->dropUnique('unique_nutrition_per_consultation');
        });
    }
};
