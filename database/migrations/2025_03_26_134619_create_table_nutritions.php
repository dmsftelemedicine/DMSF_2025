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
        Schema::create('nutritions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->string('fruit')->nullable();
            $table->string('fruit_juice')->nullable();
            $table->string('vegetables')->nullable();
            $table->string('green_vegetables')->nullable();
            $table->string('starchy_vegetables')->nullable();
            $table->string('grains')->nullable();
            $table->string('grains_frequency')->nullable();
            $table->string('whole_grains')->nullable();
            $table->string('whole_grains_frequency')->nullable();
            $table->string('milk')->nullable();
            $table->string('milk_frequency')->nullable();
            $table->string('low_fat_milk')->nullable();
            $table->string('low_fat_milk_frequency')->nullable();
            $table->string('beans')->nullable();
            $table->string('nuts_seeds')->nullable();
            $table->string('seafood')->nullable();
            $table->string('seafood_frequency')->nullable();
            $table->string('ssb')->nullable();
            $table->string('ssb_frequency')->nullable();
            $table->string('added_sugars')->nullable();
            $table->string('saturated_fat')->nullable();
            $table->string('water')->nullable();
            $table->string('dq_score')->nullable();
            $table->string('icd_diagnosis')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Enables logical deletion
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nutritions');
    }
};
