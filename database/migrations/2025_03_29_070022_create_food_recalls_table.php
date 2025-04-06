<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('food_recalls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nutrition_id'); // Foreign key to the nutrition table
            $table->text('breakfast')->nullable();
            $table->text('am_snack')->nullable();
            $table->text('lunch')->nullable();
            $table->text('pm_snack')->nullable();
            $table->text('dinner')->nullable();
            $table->text('midnight_snack')->nullable();
            $table->timestamps();

            // Define foreign key
            $table->foreign('nutrition_id')->references('id')->on('nutritions')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('food_recalls');
    }
};
