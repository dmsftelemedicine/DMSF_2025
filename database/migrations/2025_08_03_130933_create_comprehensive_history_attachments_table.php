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
        Schema::create('comprehensive_history_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('comprehensive_history_id')->nullable()->constrained('comprehensive_histories', 'id', 'cha_comp_hist_id_foreign')->onDelete('cascade');
            $table->enum('section', [
                'childhood_illness',
                'adult_illness',
                'family_history',
                'previous_medications',
                'current_medications',
                'previous_hospitalization',
                'surgical_history',
                'health_maintenance',
                'psychiatric_history'
            ]);
            $table->string('section_item')->nullable(); // specific illness or condition
            $table->string('file_name');
            $table->string('file_path');
            $table->string('file_type');
            $table->bigInteger('file_size'); // Changed to bigInteger for larger files
            $table->string('uploaded_by')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index(['patient_id', 'section']);
            $table->index(['comprehensive_history_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comprehensive_history_attachments');
    }
};
