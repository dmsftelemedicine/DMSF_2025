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
        Schema::table('patients', function (Blueprint $table) {
            $table->decimal('temperature', 4, 1)->nullable()->after('neck_circumference');
            $table->integer('heart_rate')->nullable()->after('temperature');
            $table->integer('o2_saturation')->nullable()->after('heart_rate');
            $table->integer('respiratory_rate')->nullable()->after('o2_saturation');
            $table->string('blood_pressure', 10)->nullable()->after('respiratory_rate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn([
                'temperature',
                'heart_rate',
                'o2_saturation',
                'respiratory_rate',
                'blood_pressure'
            ]);
        });
    }
};
