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
        Schema::table('lifestyle_prescriptions', function (Blueprint $table) {
            // Remove old monitoring columns
            $table->dropColumn([
                'blood_sugar_monitoring',
                'weight_management', 
                'follow_up_schedule'
            ]);
            
            // Add new recommendation columns
            $table->text('sleep_recommendations')->nullable();
            $table->text('stress_recommendations')->nullable();
            $table->text('social_connectedness_recommendations')->nullable();
            $table->text('substance_avoidance_recommendations')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lifestyle_prescriptions', function (Blueprint $table) {
            // Remove new recommendation columns
            $table->dropColumn([
                'sleep_recommendations',
                'stress_recommendations',
                'social_connectedness_recommendations',
                'substance_avoidance_recommendations'
            ]);
            
            // Restore old monitoring columns
            $table->text('blood_sugar_monitoring')->nullable();
            $table->text('weight_management')->nullable();
            $table->text('follow_up_schedule')->nullable();
        });
    }
};
