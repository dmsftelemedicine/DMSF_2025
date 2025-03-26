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
        Schema::create('table_nutritions', function (Blueprint $table) {
           $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->integer('question_1');
            $table->integer('question_2');
            $table->integer('question_3');
            $table->integer('question_4');
            $table->integer('question_5');
            $table->integer('question_6');
            $table->integer('question_7');
            $table->integer('question_8');
            $table->integer('question_9');
            $table->integer('question_10');
            $table->integer('question_11');
            $table->integer('question_12');
            $table->integer('question_13');
            $table->integer('question_14');
            $table->integer('question_15');
            $table->integer('question_16');
            $table->integer('question_17');
            $table->integer('question_18');
            $table->integer('question_19');
            $table->integer('question_20');
            $table->integer('question_21');
            $table->integer('question_22');
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
        Schema::dropIfExists('table_nutritions');
    }
};
