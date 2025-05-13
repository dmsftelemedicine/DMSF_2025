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
        Schema::table('patients', function (Blueprint $table) {
            // Add new columns
            $table->string('brgy_address')->nullable();
            $table->string('address_landmark')->nullable();
            $table->string('highest_educational_attainment')->nullable();
            $table->string('monthly_household_income')->nullable();
            $table->string('religion')->nullable();

            // Remove old columns
            $table->dropColumn([
                'email',
                'house_no',
                'barangay',
                'city_municipality',
                'province',
                'zip_code',
                'country',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
            // Add removed columns back
            $table->string('email')->nullable();
            $table->string('house_no')->nullable();
            $table->string('barangay')->nullable();
            $table->string('city_municipality')->nullable();
            $table->string('province')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('country')->nullable();

            // Remove newly added columns
            $table->dropColumn([
                'brgy_address',
                'address_landmark',
                'highest_educational_attainment',
                'monthly_household_income',
                'religion',
            ]);
        });
    }
};
