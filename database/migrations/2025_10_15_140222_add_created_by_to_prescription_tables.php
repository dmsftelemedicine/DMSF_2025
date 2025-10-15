<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Delete all existing records since we can't track who created them
        DB::table('lifestyle_prescriptions')->delete();
        DB::table('prescriptions')->delete();
        DB::table('diagnostics')->delete();
        DB::table('medical_certificates')->delete();
        DB::table('referral_forms')->delete();

        // Add created_by to lifestyle_prescriptions (NOT NULL - required field)
        Schema::table('lifestyle_prescriptions', function (Blueprint $table) {
            $table->foreignId('created_by')->after('patient_id')->constrained('users')->onDelete('cascade');
        });

        // Add created_by to prescriptions (drug prescriptions)
        Schema::table('prescriptions', function (Blueprint $table) {
            $table->foreignId('created_by')->after('patient_id')->constrained('users')->onDelete('cascade');
        });

        // Add created_by to diagnostics (diagnostic requests)
        Schema::table('diagnostics', function (Blueprint $table) {
            $table->foreignId('created_by')->after('patient_id')->constrained('users')->onDelete('cascade');
        });

        // Add created_by to medical_certificates
        Schema::table('medical_certificates', function (Blueprint $table) {
            $table->foreignId('created_by')->after('patient_id')->constrained('users')->onDelete('cascade');
        });

        // Add created_by to referral_forms
        Schema::table('referral_forms', function (Blueprint $table) {
            $table->foreignId('created_by')->after('patient_id')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lifestyle_prescriptions', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
        });

        Schema::table('prescriptions', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
        });

        Schema::table('diagnostics', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
        });

        Schema::table('medical_certificates', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
        });

        Schema::table('referral_forms', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
        });
    }
};
