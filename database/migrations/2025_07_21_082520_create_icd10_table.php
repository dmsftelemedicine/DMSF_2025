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
        Schema::create('icd10', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique()->index();
            $table->text('description');
            $table->boolean('is_category')->default(false); // true for chapter headers like "I"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('icd10');
    }
};
