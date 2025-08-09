<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // First, drop unnecessary columns from medicines table
        Schema::table('medicines', function (Blueprint $table) {
            $table->dropColumn([
                'quantity',
                'drug_image',
                'drug_classification',
                'indication',
                'brief_description',
                'rx_english_instructions' // Remove this too since it will be in the new table
            ]);
        });

        // Create the new medicine_instructions table
        Schema::create('medicine_instructions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicine_id')->constrained()->onDelete('cascade');
            $table->text('rx_english_instructions'); // All the prescription instructions/indication/strength info
            $table->timestamps();
            
            // Add index for better performance
            $table->index('medicine_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop the medicine_instructions table first (due to foreign key constraint)
        Schema::dropIfExists('medicine_instructions');

        // Re-add all the dropped columns to medicines table
        Schema::table('medicines', function (Blueprint $table) {
            $table->integer('quantity')->after('name');
            $table->string('drug_image')->nullable()->after('quantity');
            $table->string('drug_classification')->nullable()->after('drug_image');
            $table->string('indication')->nullable()->after('drug_classification');
            $table->text('rx_english_instructions')->nullable()->after('indication');
            $table->text('brief_description')->nullable()->after('rx_english_instructions');
        });
    }
};
