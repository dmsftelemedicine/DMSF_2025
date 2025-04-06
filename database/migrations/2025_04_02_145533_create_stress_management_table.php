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
        Schema::create('stress_management', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade'); // Foreign key from patients table
            $table->integer('stress_level')->default(0)->comment('Stress level (0-10)');
            
            // GAD-7 Questions (nullable integers 0-3)
            $table->integer('GAD_7_Q1')->nullable()->default(0)->comment('GAD-7 Question 1 (0-3)');
            $table->integer('GAD_7_Q2')->nullable()->default(0)->comment('GAD-7 Question 2 (0-3)');
            $table->integer('GAD_7_Q3')->nullable()->default(0)->comment('GAD-7 Question 3 (0-3)');
            $table->integer('GAD_7_Q4')->nullable()->default(0)->comment('GAD-7 Question 4 (0-3)');
            $table->integer('GAD_7_Q5')->nullable()->default(0)->comment('GAD-7 Question 5 (0-3)');
            $table->integer('GAD_7_Q6')->nullable()->default(0)->comment('GAD-7 Question 6 (0-3)');
            $table->integer('GAD_7_Q7')->nullable()->default(0)->comment('GAD-7 Question 7 (0-3)');
            $table->integer('GAD_7_total')->nullable()->default(0)->comment('Total GAD-7 Score');
            
            // PHQ-9 Questions (nullable integers 0-3)
            $table->integer('PHQ_9_Q1')->nullable()->default(0)->comment('PHQ-9 Question 1 (0-3)');
            $table->integer('PHQ_9_Q2')->nullable()->default(0)->comment('PHQ-9 Question 2 (0-3)');
            $table->integer('PHQ_9_Q3')->nullable()->default(0)->comment('PHQ-9 Question 3 (0-3)');
            $table->integer('PHQ_9_Q4')->nullable()->default(0)->comment('PHQ-9 Question 4 (0-3)');
            $table->integer('PHQ_9_Q5')->nullable()->default(0)->comment('PHQ-9 Question 5 (0-3)');
            $table->integer('PHQ_9_Q6')->nullable()->default(0)->comment('PHQ-9 Question 6 (0-3)');
            $table->integer('PHQ_9_Q7')->nullable()->default(0)->comment('PHQ-9 Question 7 (0-3)');
            $table->integer('PHQ_9_Q8')->nullable()->default(0)->comment('PHQ-9 Question 8 (0-3)');
            $table->integer('PHQ_9_Q9')->nullable()->default(0)->comment('PHQ-9 Question 9 (0-3)');
            $table->integer('PHQ_9_total')->nullable()->default(0)->comment('Total PHQ-9 Score');
            
            // PSS-4 Questions (nullable integers 0-4)
            $table->integer('PSS_4_Q1')->nullable()->default(0)->comment('PSS-4 Question 1 (0-4)');
            $table->integer('PSS_4_Q2')->nullable()->default(0)->comment('PSS-4 Question 2 (0-4)');
            $table->integer('PSS_4_Q3')->nullable()->default(0)->comment('PSS-4 Question 3 (0-4)');
            $table->integer('PSS_4_Q4')->nullable()->default(0)->comment('PSS-4 Question 4 (0-4)');

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
        Schema::dropIfExists('stress_management');
    }
};
