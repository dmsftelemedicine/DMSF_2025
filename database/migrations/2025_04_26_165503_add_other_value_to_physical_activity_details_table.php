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
        Schema::table('physical_activity_details', function (Blueprint $table) {
            $table->string('other_value', 250)->nullable()->after('minutes');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('physical_activity_details', function (Blueprint $table) {
            $table->dropColumn('other_value');
        });
    }

};
