<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('comprehensive_histories', function (Blueprint $table) {
            // Adult illness details
            $table->string('hypertension_type')->nullable();
            $table->string('hypertension_stage')->nullable();
            $table->string('hypertension_control')->nullable();
            $table->string('hypertension_year')->nullable();
            $table->string('hypertension_med_status')->nullable();
            $table->text('hypertension_medications')->nullable();
            $table->string('hypertension_compliance')->nullable();
            
            $table->string('diabetes_type')->nullable();
            $table->string('diabetes_insulin')->nullable();
            $table->string('diabetes_control')->nullable();
            $table->string('diabetes_year')->nullable();
            $table->string('diabetes_med_status')->nullable();
            $table->text('diabetes_medications')->nullable();
            $table->string('diabetes_compliance')->nullable();
            
            $table->string('asthma_control')->nullable();
            $table->string('asthma_year')->nullable();
            $table->string('asthma_med_status')->nullable();
            $table->text('asthma_medications')->nullable();
            $table->string('asthma_compliance')->nullable();
            
            // Family illness details
            $table->string('hypertension_relation')->nullable();
            $table->string('hypertension_side')->nullable();
            $table->string('hypertension_family_year')->nullable();
            $table->text('hypertension_family_medications')->nullable();
            $table->string('hypertension_family_status')->nullable();
            
            $table->string('diabetes_relation')->nullable();
            $table->string('diabetes_side')->nullable();
            $table->string('diabetes_family_year')->nullable();
            $table->text('diabetes_family_medications')->nullable();
            $table->string('diabetes_family_status')->nullable();
            
            $table->string('asthma_relation')->nullable();
            $table->string('asthma_side')->nullable();
            $table->string('asthma_family_year')->nullable();
            
            $table->string('cancer_relation')->nullable();
            $table->string('cancer_side')->nullable();
            $table->string('cancer_family_year')->nullable();
            $table->text('cancer_family_medications')->nullable();
            $table->string('cancer_family_status')->nullable();
            
            // Condition details
            $table->text('cancer_details')->nullable();
            $table->text('dyslipidemia_details')->nullable();
            $table->text('neurologic_details')->nullable();
            $table->text('liver_details')->nullable();
            $table->text('kidney_details')->nullable();
            $table->text('other_condition_details')->nullable();
            
            // Family condition details
            $table->text('family_dyslipidemia_details')->nullable();
            $table->text('family_neurologic_details')->nullable();
            $table->text('family_liver_details')->nullable();
            $table->text('family_kidney_details')->nullable();
            $table->text('family_other_details')->nullable();
        });
    }

    public function down()
    {
        Schema::table('comprehensive_histories', function (Blueprint $table) {
            $table->dropColumn([
                'hypertension_type', 'hypertension_stage', 'hypertension_control', 'hypertension_year',
                'hypertension_med_status', 'hypertension_medications', 'hypertension_compliance',
                'diabetes_type', 'diabetes_insulin', 'diabetes_control', 'diabetes_year',
                'diabetes_med_status', 'diabetes_medications', 'diabetes_compliance',
                'asthma_control', 'asthma_year', 'asthma_med_status', 'asthma_medications', 'asthma_compliance',
                'hypertension_relation', 'hypertension_side', 'hypertension_family_year', 
                'hypertension_family_medications', 'hypertension_family_status',
                'diabetes_relation', 'diabetes_side', 'diabetes_family_year', 
                'diabetes_family_medications', 'diabetes_family_status',
                'asthma_relation', 'asthma_side', 'asthma_family_year',
                'cancer_relation', 'cancer_side', 'cancer_family_year', 
                'cancer_family_medications', 'cancer_family_status',
                'cancer_details', 'dyslipidemia_details', 'neurologic_details', 
                'liver_details', 'kidney_details', 'other_condition_details',
                'family_dyslipidemia_details', 'family_neurologic_details', 
                'family_liver_details', 'family_kidney_details', 'family_other_details'
            ]);
        });
    }
}; 