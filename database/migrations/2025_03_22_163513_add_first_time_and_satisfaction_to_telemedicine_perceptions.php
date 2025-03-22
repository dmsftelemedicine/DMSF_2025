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
        Schema::table('telemedicine_perceptions', function (Blueprint $table) {
            $table->enum('first_time', ['yes', 'no'])->after('patient_id')->nullable();
            $table->string('satisfaction', 250)->after('question_5')->nullable(); // Changed to VARCHAR(250)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('telemedicine_perceptions', function (Blueprint $table) {
            $table->dropColumn(['first_time', 'satisfaction']);
        });
    }
};
