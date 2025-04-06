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
     public function up(): void
    {
        Schema::create('social_connectedness', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->integer('family')->unsigned()->default(1)->comment('Scale 1-10');
            $table->integer('friends')->unsigned()->default(1)->comment('Scale 1-10');
            $table->integer('classmate')->unsigned()->default(1)->comment('Scale 1-10');
            $table->integer('scs_8_Q1')->unsigned()->nullable()->default(0)->comment('Scale 1-6');
            $table->integer('scs_8_Q2')->unsigned()->nullable()->default(0)->comment('Scale 1-6');
            $table->integer('scs_8_Q3')->unsigned()->nullable()->default(0)->comment('Scale 1-6');
            $table->integer('scs_8_Q4')->unsigned()->nullable()->default(0)->comment('Scale 1-6');
            $table->integer('scs_8_Q5')->unsigned()->nullable()->default(0)->comment('Scale 1-6');
            $table->integer('scs_8_Q6')->unsigned()->nullable()->default(0)->comment('Scale 1-6');
            $table->integer('scs_8_Q7')->unsigned()->nullable()->default(0)->comment('Scale 1-6');
            $table->integer('scs_8_Q8')->unsigned()->nullable()->default(0)->comment('Scale 1-6');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_connectedness');
    }
};
