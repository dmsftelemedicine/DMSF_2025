<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('comprehensive_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            
            // Informant Section
            $table->json('informant')->nullable();
            $table->string('informant_other')->nullable();
            $table->integer('percent_reliability')->nullable();
            
            // Chief Concern & History
            $table->string('chief_concern')->nullable();
            $table->text('history_present_illness')->nullable();
            
            // Past Medical History
            $table->json('childhood_illness')->nullable();
            $table->boolean('completed_vaccinations')->default(false);
            $table->json('adult_illness')->nullable();
            $table->json('other_conditions')->nullable();
            
            // Family History
            $table->json('family_illness')->nullable();
            $table->json('family_other_conditions')->nullable();
            
            // Allergies
            $table->string('food_allergies')->nullable();
            $table->string('drug_allergies')->nullable();
            
            // Medications
            $table->text('medications')->nullable();
            
            // Hospitalization
            $table->json('hospitalization')->nullable();
            
            // Surgical History
            $table->json('surgical_history')->nullable();
            
            // Health Maintenance
            $table->json('covid_vaccination')->nullable();
            $table->json('other_vaccinations')->nullable();
            
            // OBGYN History
            $table->date('lmp')->nullable();
            $table->date('pmp')->nullable();
            $table->string('ob_g')->nullable();
            $table->string('ob_p')->nullable();
            $table->string('ob_t')->nullable();
            $table->string('ob_p2')->nullable();
            $table->string('ob_a')->nullable();
            $table->string('ob_l')->nullable();
            $table->string('menarche')->nullable();
            $table->string('menstrual_interval')->nullable();
            $table->string('menstrual_duration')->nullable();
            $table->integer('menstrual_pads')->nullable();
            $table->string('menstrual_amount')->nullable();
            $table->json('menstrual_symptoms')->nullable();
            $table->string('coitarche')->nullable();
            $table->string('pap_smear')->nullable();
            $table->json('contraceptive_methods')->nullable();
            $table->string('contraceptive_other')->nullable();
            
            // Psychiatric Illness
            $table->json('psychiatric_illness')->nullable();
            $table->string('psychiatric_others_details')->nullable();
            
            // Personal-Social History
            $table->boolean('cigarette_user')->default(false);
            $table->string('cigarette_year_started')->nullable();
            $table->string('cigarette_year_discontinued')->nullable();
            $table->boolean('current_smoker')->default(false);
            $table->integer('sticks_per_day')->nullable();
            $table->integer('years_smoking')->nullable();
            $table->decimal('pack_years', 8, 2)->nullable();
            
            $table->boolean('alcohol_drinker')->default(false);
            $table->string('alcohol_year_started')->nullable();
            $table->string('alcohol_year_discontinued')->nullable();
            $table->boolean('current_drinker')->default(false);
            $table->string('alcohol_type')->nullable();
            $table->integer('alcohol_sd')->nullable();
            $table->string('alcohol_frequency')->nullable();
            
            $table->boolean('drug_user')->default(false);
            $table->string('drug_type')->nullable();
            $table->string('drug_year_started')->nullable();
            $table->string('drug_year_discontinued')->nullable();
            $table->boolean('current_drug_user')->default(false);
            
            $table->boolean('coffee_user')->default(false);
            $table->string('coffee_type')->nullable();
            $table->string('coffee_amount')->nullable();
            $table->string('coffee_cups')->nullable();
            
            $table->json('alternative_therapies')->nullable();
            $table->string('therapy_other')->nullable();
            
            $table->text('schooling')->nullable();
            $table->text('job_history')->nullable();
            $table->text('financial_situation')->nullable();
            $table->text('marriage_children')->nullable();
            $table->text('home_situation')->nullable();
            $table->text('daily_activities')->nullable();
            $table->text('environment')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comprehensive_histories');
    }
}; 