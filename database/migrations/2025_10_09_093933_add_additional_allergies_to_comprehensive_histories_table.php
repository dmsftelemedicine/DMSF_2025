<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('comprehensive_histories', function (Blueprint $table) {
            $table->text('other_allergies')->nullable();
            $table->text('animal_allergies')->nullable();
            $table->text('plant_allergies')->nullable();
            $table->text('substance_allergies')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comprehensive_histories', function (Blueprint $table) {
            $table->dropColumn([
                'other_allergies',
                'animal_allergies',
                'plant_allergies',
                'substance_allergies'
            ]);
        });
    }
};
