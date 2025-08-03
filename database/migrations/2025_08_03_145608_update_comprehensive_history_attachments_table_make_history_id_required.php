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
        // First, create comprehensive history records for any patients that don't have them
        $patientsWithoutHistory = \App\Models\Patient::whereDoesntHave('comprehensiveHistory')->get();
        foreach ($patientsWithoutHistory as $patient) {
            \App\Models\ComprehensiveHistory::create(['patient_id' => $patient->id]);
        }
        
        // Update any existing attachments that have null comprehensive_history_id
        // to link them to their patient's comprehensive history
        \App\Models\ComprehensiveHistoryAttachment::whereNull('comprehensive_history_id')
            ->get()
            ->each(function ($attachment) {
                $comprehensiveHistory = $attachment->patient->comprehensiveHistory;
                if ($comprehensiveHistory) {
                    $attachment->update(['comprehensive_history_id' => $comprehensiveHistory->id]);
                }
            });
        
        // Now make the column required
        Schema::table('comprehensive_history_attachments', function (Blueprint $table) {
            $table->foreignId('comprehensive_history_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comprehensive_history_attachments', function (Blueprint $table) {
            $table->foreignId('comprehensive_history_id')->nullable()->change();
        });
    }
};
