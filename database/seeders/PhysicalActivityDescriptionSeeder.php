<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PhysicalActivityDescription;

class PhysicalActivityDescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activities = [
            ['name' => 'Walking, to work or class', 'order' => 1],
            ['name' => 'Walking from house to car or bus, from car or bus to go places, from car or bus to and from the worksite', 'order' => 2],
            ['name' => 'Bicycling for transportation, light/high effort', 'order' => 3],
            ['name' => 'Horseback riding, walking', 'order' => 4],
            ['name' => 'Motor scooter, motorcycle', 'order' => 5],
            ['name' => 'Riding in a car or bus or jeep', 'order' => 6],
            ['name' => 'Automobile or light truck (not a semi) driving', 'order' => 7],
            ['name' => 'Truck, semi, tractor, ≥1 ton, or bus, driving', 'order' => 8],
            ['name' => 'Other mode of transportation:', 'order' => 9],
            ['name' => 'Walking for pleasure', 'order' => 10],
            ['name' => 'Sit, watch television', 'order' => 11],
            ['name' => 'Video game, handheld controller (light effort)', 'order' => 12],
            ['name' => 'Sitting: reading, book, newspaper, magazine', 'order' => 13],
            ['name' => 'Lying quietly and watching television/cellphone', 'order' => 14],
            ['name' => 'Watering lawn or garden, standing or walking', 'order' => 15],
            ['name' => 'Bicycling, general', 'order' => 16],
            ['name' => 'Weeding, cultivating garden, moderate effort', 'order' => 17],
            ['name' => 'Chopping wood, splitting logs, moderate effort ', 'order' => 18],
            ['name' => 'Planting crops or garden, stooping, moderate effort', 'order' => 19],
            ['name' => 'Harvesting Produce, Picking fruit off trees, gleaning fruits, picking fruits/vegetables, climbing ladder to pick fruit, vigorous effort', 'order' => 20],
            ['name' => 'Yardwork, general, moderate effort', 'order' => 21],
            ['name' => 'Yardwork, general, vigorous effort', 'order' => 22],
            ['name' => 'Odd Jobs:', 'order' => 23],
            ['name' => 'Sports:, general', 'order' => 24],
            ['name' => 'Multiple household tasks all at once, light effort', 'order' => 25],
            ['name' => 'Multiple household tasks all at once, moderate effort', 'order' => 26],
            ['name' => 'Multiple household tasks all at once, vigorous effort ', 'order' => 27],
            ['name' => 'Sitting, child care, only active periods', 'order' => 28],
            ['name' => 'Child care, infant, general', 'order' => 29],
            ['name' => 'Walk/run play with children, moderate, only active periods', 'order' => 30],
            ['name' => 'Walk/run play with children, vigorous, only active periods', 'order' => 31],
            ['name' => 'Food shopping with or without a grocery cart; carrying a 10 lb bag; standing or walking ', 'order' => 32],
            ['name' => 'Sitting - in class, general, including note-taking or class discussion', 'order' => 33],
            ['name' => 'Standing: miscellaneous', 'order' => 34],
            ['name' => 'Sitting, light office work, in general', 'order' => 35],
            ['name' => 'Sitting, computer work', 'order' => 36],
            ['name' => 'Sitting tasks, moderate effort (e.g. pushing heavy levers, riding mower/forklift, crane operation)', 'order' => 37],
            ['name' => 'Standing tasks, light effort (e.g., bartending, store clerk, assembling, filing, duplicating, librarian)', 'order' => 38],
            ['name' => 'Standing, light/moderate work (e.g., assemble/repair heavy parts, welding, stocking parts, auto repair, packing boxes, set up chairs/furniture, nursing patient care, laundry)', 'order' => 39],
            ['name' => 'Standing, moderate/heavy work  (e.g., lifting more than 50 lbs, masonry, painting, paper hanging)', 'order' => 40],
            ['name' => 'Stair climbing, slow pace', 'order' => 41],
            ['name' => 'Stair climbing, fast pace, one step at a time', 'order' => 42],
            ['name' => 'Descending stairs', 'order' => 43],
            ['name' => 'Walking, 3.5 to 3.9 mph, level, brisk, firm surface, walking for exercise', 'order' => 44],
            ['name' => 'Home exercise, general', 'order' => 45],
            ['name' => 'Jogging, in place', 'order' => 46],
            ['name' => 'Other Exercise:', 'order' => 47],
        ];

        foreach ($activities as $activity) {
            PhysicalActivityDescription::create($activity);
        }
    }
}
