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
        // Add indexes for dashboard performance (only if they don't exist)
        Schema::table('patients', function (Blueprint $table) {
            // Check if index exists before creating it
            if (!$this->indexExists('patients', 'patients_created_at_index')) {
                $table->index(['created_at']);
            }
        });

        Schema::table('consultations', function (Blueprint $table) {
            if (!$this->indexExists('consultations', 'consultations_consultation_date_index')) {
                $table->index(['consultation_date']);
            }
            if (!$this->indexExists('consultations', 'consultations_created_at_index')) {
                $table->index(['created_at']);
            }
        });
    }

    /**
     * Check if an index exists on a table
     */
    private function indexExists($table, $indexName)
    {
        $indexes = DB::select("SHOW INDEX FROM {$table}");
        foreach ($indexes as $index) {
            if ($index->Key_name === $indexName) {
                return true;
            }
        }
        return false;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
        });

        Schema::table('consultations', function (Blueprint $table) {
            $table->dropIndex(['consultation_date']);
            $table->dropIndex(['created_at']);
        });
    }
};
