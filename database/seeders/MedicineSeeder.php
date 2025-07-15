<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Medicine;
use Illuminate\Support\Facades\DB;
class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('medicines')->insert([
            [
                'name' => 'Acetylcysteine 100 mg/sachet',
                'quantity' => 20,
                'drug_image' => '',
                'drug_classification' => 'Mucolytic',
                'indication' => 'Productive Cough',
                'rx_english_instructions' => 'Acetylcysteine 100 mg/sachet #20<br/>Sig. Completely dissolve 2 sachets in half glass of water and drink 2 times a day after meals for 5 days.',
                'brief_description' => 'Acetylcysteine belongs to the class of mucolytics. For adults, this is used as an adjunctive therapy for respiratory tract disorders associated with excessive, viscous mucus. It is also used to reverse the toxicity of high doses of acetaminophen.',
            ],
            [
                'name' => 'Acetylcysteine 200 mg/sachet',
                'quantity' => 10,
                'drug_image' => '',
                'drug_classification' => 'Mucolytic',
                'indication' => 'Productive Cough',
                'rx_english_instructions' => 'Acetylcysteine 200mg Sachet #10 <br/>Sig. Dissolve 1 sachet in one glass of water, 2 times a day, for 5 days. Drink the medicine with food.',
                'brief_description' => 'Acetylcysteine belongs to the class of mucolytics. For adults, this is used as an adjunctive therapy for respiratory tract disorders associated with excessive, viscous mucus. It is also used to reverse the toxicity of high doses of acetaminophen.',
            ],
            [
                'name' => 'Acetylcysteine 200 mg/sachet',
                'quantity' => 14,
                'drug_image' => '',
                'drug_classification' => 'Mucolytic',
                'indication' => 'Productive Cough',
                'rx_english_instructions' => 'Acetylcysteine 200mg Sachet #14 <br/>Sig. Dissolve 1 sachet in one glass of water, 2 times a day, for 7 days. Drink the medicine with food.',
                'brief_description' => 'Acetylcysteine belongs to the class of mucolytics. For adults, this is used as an adjunctive therapy for respiratory tract disorders associated with excessive, viscous mucus. It is also used to reverse the toxicity of high doses of acetaminophen.',
            ],
            [
                'name' => 'Acetylcysteine 200 mg/sachet',
                'quantity' => 75,
                'drug_image' => '',
                'drug_classification' => 'Mucolytic',
                'indication' => 'Productive Cough',
                'rx_english_instructions' => 'Acetylcysteine 200mg Sachet #20 <br/>Sig. Dissolve 1 sachet in one glass of water, 2 times a day, for 10 days. Drink the medicine with food.',
                'brief_description' => 'Acetylcysteine belongs to the class of mucolytics. For adults, this is used as an adjunctive therapy for respiratory tract disorders associated with excessive, viscous mucus. It is also used to reverse the toxicity of high doses of acetaminophen.',
            ],
        ]);
    }
}
