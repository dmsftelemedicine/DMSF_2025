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
        Schema::create('physical_activity_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('physical_activity_id')->constrained('physical_activities')->onDelete('cascade');
            $table->foreignId('activity_description_id')->constrained('physical_activity_descriptions')->onDelete('cascade');
            $table->decimal('met', 4, 1); // e.g., 3.5
            $table->integer('days');
            $table->integer('hours');
            $table->integer('minutes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('physical_activity_details');
    }
};
