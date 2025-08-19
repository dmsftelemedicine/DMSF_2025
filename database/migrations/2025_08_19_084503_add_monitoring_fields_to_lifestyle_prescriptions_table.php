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
            $table->text('blood_sugar_monitoring')->nullable();
            $table->text('weight_management')->nullable();
            $table->text('follow_up_schedule')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lifestyle_prescriptions', function (Blueprint $table) {
            $table->dropColumn(['blood_sugar_monitoring', 'weight_management', 'follow_up_schedule']);
        });
    }
};
