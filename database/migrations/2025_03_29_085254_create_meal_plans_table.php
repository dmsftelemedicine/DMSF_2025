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
        Schema::create('meal_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade'); // Foreign key to patients table
            $table->date('date');
            $table->string('meal_type'); // Breakfast, Lunch, etc.
            $table->integer('protein'); // in grams
            $table->integer('fat'); // in grams
            $table->integer('carbohydrates'); // in grams
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
        Schema::dropIfExists('meal_plans');
    }
};
