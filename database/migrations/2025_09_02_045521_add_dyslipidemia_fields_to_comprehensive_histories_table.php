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
            $table->text('dyslipidemia_year')->nullable();
            $table->text('dyslipidemia_med_status')->nullable();
            $table->text('dyslipidemia_medications')->nullable();
            $table->text('dyslipidemia_compliance')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comprehensive_histories', function (Blueprint $table) {
            $table->dropColumn([
                'dyslipidemia_year',
                'dyslipidemia_med_status',
                'dyslipidemia_medications',
                'dyslipidemia_compliance',
            ]);
        });
    }
};
