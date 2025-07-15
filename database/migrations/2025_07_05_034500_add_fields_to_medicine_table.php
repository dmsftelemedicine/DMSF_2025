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
        Schema::table('medicines', function (Blueprint $table) {
            $table->string('drug_image')->nullable()->after('quantity'); // You can change to text if storing base64 or long paths
            $table->string('drug_classification')->nullable()->after('drug_image');
            $table->string('indication')->nullable()->after('drug_classification');
            $table->text('rx_english_instructions')->nullable()->after('indication');
            $table->text('brief_description')->nullable()->after('rx_english_instructions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medicines', function (Blueprint $table) {
            $table->dropColumn([
                'drug_image',
                'drug_classification',
                'indication',
                'rx_english_instructions',
                'brief_description',
            ]);
        });
    }
};
