<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePhysicalActivityDetailsTableSetDefaultValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('physical_activity_details', function (Blueprint $table) {
            // Set default value to 0, but allow NULL for these fields
            $table->decimal('met', 4, 1)->default(0)->nullable()->change();
            $table->integer('days')->default(0)->nullable()->change();
            $table->integer('hours')->default(0)->nullable()->change();
            $table->integer('minutes')->default(0)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('physical_activity_details', function (Blueprint $table) {
            $table->decimal('met', 4, 1)->nullable()->change();
            $table->integer('days')->nullable()->change();
            $table->integer('hours')->nullable()->change();
            $table->integer('minutes')->nullable()->change();
        });
    }
}
