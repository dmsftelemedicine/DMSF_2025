<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blood_sugar_tests', function (Blueprint $table) {
            $table->decimal('blood_sugar_mgdl', 5, 1)->after('patient_id');
            $table->decimal('blood_sugar_mmol', 5, 2)->after('blood_sugar_mgdl');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blood_sugar_tests', function (Blueprint $table) {
            $table->dropColumn(['blood_sugar_mgdl', 'blood_sugar_mmol']);
        });
    }
};
