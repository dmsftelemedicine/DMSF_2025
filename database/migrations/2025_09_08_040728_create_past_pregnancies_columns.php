<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('comprehensive_histories', function (Blueprint $table) {
            // Store multiple rows (number, sex, manner_of_delivery, disposition/complications) as an array of objects
            // Example value:
            // [
            //   {"number":"1","sex":"Male","manner_of_delivery":"Normal Spontaneous Delivery","disposition_complications":"none"},
            //   {"number":"2","sex":"Female","manner_of_delivery":"Cesarean Section","disposition_complications":"PPH"}
            // ]
            $table->json('past_pregnancies')->nullable();

            $table->text('symptom_other_details')->nullable()->after('menstrual_symptoms');

            // Partners
            $table->unsignedSmallInteger('total_number_of_partners')->nullable();

            // Dropdown choices from your screenshot
            $table->string('current_partner', 50)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('comprehensive_histories', function (Blueprint $table) {
            $table->dropColumn([
                'past_pregnancies',
                'symptom_other_details',
                'total_number_of_partners',
                'current_partner',
            ]);
        });
    }
};
