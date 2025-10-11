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
            $table->text('diagnostic_test_results')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comprehensive_histories', function (Blueprint $table) {
            $table->dropColumn('diagnostic_test_results');
        });
    }
};
