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
            // Use very short field sizes to avoid row size limit
            $table->char('psychiatric_year', 4)->nullable(); // Year only needs 4 characters
            $table->text('psychiatric_medications')->nullable(); // TEXT type doesn't count toward row size limit
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comprehensive_histories', function (Blueprint $table) {
            $table->dropColumn([
                'psychiatric_year',
                'psychiatric_medications'
            ]);
        });
    }
};
