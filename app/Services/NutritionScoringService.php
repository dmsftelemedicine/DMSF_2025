<?php

namespace App\Services;

use App\Models\Patient;

class NutritionScoringService
{
    /**
     * Calculate SHEI-22 score based on nutrition data
     */
    public function calculateSheiScore(array $nutritionData, Patient $patient): float
    {
        $gender = strtolower($patient->gender);
        
        // Convert string values to integers for processing
        $components = $this->extractNutritionComponents($nutritionData);
        
        // Calculate each SHEI-22 component
        $scores = [
            'total_fruits' => $this->calculateTotalFruitsScore($components['fruit'], $components['fruit_juice']),
            'whole_fruits' => $this->calculateWholeFruitsScore($components['fruit']),
            'total_vegetables' => $this->calculateTotalVegetablesScore(
                $components['vegetables'], 
                $components['starchy_vegetables'], 
                $components['green_vegetables']
            ),
            'greens_beans' => $this->calculateGreensBeans($components['green_vegetables'], $components['beans']),
            'whole_grains' => $this->calculateWholeGrainsScore($components['whole_grains'], $gender),
            'dairy' => $this->calculateDairyScore($components['milk'], $components['low_fat_milk'], $gender),
            'total_proteins' => $this->calculateTotalProteinsScore($components['seafood'], $gender),
            'seafood_plant' => $this->calculateSeafoodPlantScore($components['nuts_seeds'], $gender),
            'fatty_acid' => $this->calculateFattyAcidScore(
                $components['milk'], 
                $components['low_fat_milk'], 
                $nutritionData['saturated_fat']
            ),
            'refined_grains' => $this->calculateRefinedGrainsScore(
                $components['grains'], 
                $components['seafood'], 
                $components['green_vegetables'], 
                $components['nuts_seeds']
            ),
            'sodium' => $this->calculateSodiumScore(
                $components['fruit'], 
                $components['grains'], 
                $nutritionData['water']
            ),
            'added_sugars' => $this->calculateAddedSugarsScore(
                $components['ssb'], 
                $nutritionData['added_sugars']
            ),
            'saturated_fats' => $this->calculateSaturatedFatsScore(
                $components['ssb'], 
                $components['grains'], 
                $components['nuts_seeds']
            ),
        ];
        
        // Sum all component scores and ensure within 0-100 range
        $totalScore = array_sum($scores);
        return max(0, min(100, round($totalScore, 2)));
    }

    /**
     * Extract and convert nutrition components to integers
     */
    private function extractNutritionComponents(array $data): array
    {
        return [
            'fruit' => (int) $data['fruit'],
            'fruit_juice' => (int) $data['fruit_juice'],
            'vegetables' => (int) $data['vegetables'],
            'green_vegetables' => (int) $data['green_vegetables'],
            'starchy_vegetables' => (int) $data['starchy_vegetables'],
            'grains' => (int) $data['grains'],
            'whole_grains' => (int) $data['whole_grains'],
            'milk' => (int) $data['milk'],
            'low_fat_milk' => (int) $data['low_fat_milk'],
            'beans' => (int) $data['beans'],
            'nuts_seeds' => (int) $data['nuts_seeds'],
            'seafood' => (int) $data['seafood'],
            'ssb' => (int) $data['ssb'],
        ];
    }

    /**
     * Calculate Total Fruits Component (0-5)
     */
    private function calculateTotalFruitsScore(int $fruit, int $fruitJuice): float
    {
        $fruitScore = match($fruit) {
            1 => 0,
            2 => 2,
            3 => 3.5,
            4, 5, 6, 7 => 5,
            default => 0
        };

        $juiceScore = match($fruitJuice) {
            1 => 0,
            2 => 2,
            3 => 3.5,
            4, 5, 6, 7 => 5,
            default => 0
        };

        return min(5, $fruitScore + $juiceScore);
    }

    /**
     * Calculate Whole Fruits Component (0-5)
     */
    private function calculateWholeFruitsScore(int $fruit): float
    {
        return match($fruit) {
            1 => 0,
            2 => 2.5,
            3, 4, 5, 6, 7 => 5,
            default => 0
        };
    }

    /**
     * Calculate Total Vegetables Component (0-5)
     */
    private function calculateTotalVegetablesScore(int $vegetables, int $starchyVegetables, int $greenVegetables): float
    {
        if (in_array($vegetables, [2, 3, 4, 5, 6, 7]) && 
            in_array($starchyVegetables, [2, 3, 4, 5, 6, 7]) && 
            $greenVegetables == 1) {
            return 5;
        }
        
        if ($greenVegetables == 1) {
            return 1.60;
        }
        
        if (in_array($starchyVegetables, [2, 3, 4, 5, 6, 7]) && $greenVegetables == 2) {
            return 2.46;
        }
        
        if (in_array($starchyVegetables, [2, 3, 4, 5, 6, 7]) && 
            in_array($greenVegetables, [3, 4, 5, 6, 7])) {
            return 3.24;
        }
        
        if ($starchyVegetables == 1 && in_array($greenVegetables, [2, 3, 4, 5, 6, 7])) {
            return 3.56;
        }

        return 0;
    }

    /**
     * Calculate Greens and Beans Component (0-5)
     */
    private function calculateGreensBeans(int $greenVegetables, int $beans): float
    {
        $greensScore = $greenVegetables == 1 ? 0 : 5;
        $beansScore = $beans == 1 ? 0 : 5;
        
        return min(5, $greensScore + $beansScore);
    }

    /**
     * Calculate Whole Grains Component (0-10)
     */
    private function calculateWholeGrainsScore(int $wholeGrains, string $gender): float
    {
        if ($wholeGrains == 1) {
            return 0.51;
        }
        
        if ($gender == 'male' && in_array($wholeGrains, [2, 3, 4, 5, 6, 7])) {
            return 2.97;
        }
        
        if ($gender == 'female' && in_array($wholeGrains, [2, 3])) {
            return 5.20;
        }
        
        if ($gender == 'female' && in_array($wholeGrains, [4, 5, 6, 7])) {
            return 6.94;
        }

        return 0;
    }

    /**
     * Calculate Dairy Component (0-10)
     */
    private function calculateDairyScore(int $milk, int $lowFatMilk, string $gender): float
    {
        if ($gender == 'male' && in_array($milk, [1, 2, 3])) {
            return 3.22;
        }
        
        if ($gender == 'female' && in_array($milk, [1, 2, 3]) && $lowFatMilk == 1) {
            return 3.32;
        }
        
        if ($gender == 'female' && in_array($milk, [1, 2, 3]) && 
            in_array($lowFatMilk, [2, 3, 4, 5, 6, 7])) {
            return 4.81;
        }
        
        if (in_array($milk, [4, 5, 6, 7])) {
            return 6.51;
        }

        return 0;
    }

    /**
     * Calculate Total Protein Foods Component (0-5)
     */
    private function calculateTotalProteinsScore(int $seafood, string $gender): float
    {
        if ($gender == 'male' && in_array($seafood, [1, 2, 3, 4])) {
            return 4.11;
        }
        
        if ($gender == 'male' && in_array($seafood, [5, 6, 7])) {
            return 4.98;
        }
        
        if ($gender == 'female') {
            return 4.97;
        }

        return 0;
    }

    /**
     * Calculate Seafood and Plant Protein Component (0-5)
     */
    private function calculateSeafoodPlantScore(int $nutsSeeds, string $gender): float
    {
        if ($gender == 'male' && in_array($nutsSeeds, [1, 2])) {
            return 0.49;
        }
        
        if ($gender == 'female' && in_array($nutsSeeds, [1, 2])) {
            return 1.50;
        }
        
        if (in_array($nutsSeeds, [3, 4, 5, 6, 7])) {
            return 4.20;
        }

        return 0;
    }

    /**
     * Calculate Fatty Acid Ratio Component (0-10)
     */
    private function calculateFattyAcidScore(int $milk, int $lowFatMilk, string $saturatedFat): float
    {
        if (in_array($milk, [4, 5, 6, 7])) {
            return 2.56;
        }
        
        if (in_array($saturatedFat, ['some', 'a_lot']) && 
            in_array($milk, [1, 2, 3]) && $lowFatMilk == 1) {
            return 2.63;
        }
        
        if (in_array($saturatedFat, ['some', 'a_lot']) && 
            in_array($milk, [1, 2, 3]) && in_array($lowFatMilk, [2, 3, 4, 5, 6, 7])) {
            return 4.54;
        }
        
        if ($saturatedFat == 'none' && in_array($milk, [1, 2, 3])) {
            return 5.93;
        }

        return 0;
    }

    /**
     * Calculate Refined Grains Component (0-10)
     */
    private function calculateRefinedGrainsScore(int $grains, int $seafood, int $greenVegetables, int $nutsSeeds): float
    {
        if ($greenVegetables == 1) {
            return 2.13;
        }
        
        if (in_array($grains, [3, 4, 5, 6, 7]) && 
            in_array($seafood, [2, 3, 4, 5, 6, 7]) && 
            in_array($greenVegetables, [2, 3, 4, 5, 6, 7])) {
            return 2.27;
        }
        
        if (in_array($grains, [3, 4, 5, 6, 7]) && 
            in_array($nutsSeeds, [1, 2]) && 
            $seafood == 1 && 
            in_array($greenVegetables, [2, 3, 4, 5, 6, 7])) {
            return 4.73;
        }
        
        if (in_array($grains, [1, 2])) {
            return 10;
        }

        return 0;
    }

    /**
     * Calculate Sodium Component (0-10)
     */
    private function calculateSodiumScore(int $fruit, int $grains, string $water): float
    {
        if (in_array($fruit, [1, 2]) && in_array($grains, [3, 4, 5, 6, 7]) && $water == 'a_lot') {
            return 0.70;
        }
        
        if (in_array($fruit, [3, 4, 5, 6, 7]) && in_array($grains, [3, 4, 5, 6, 7]) && $water == 'a_lot') {
            return 2.30;
        }
        
        if (in_array($grains, [3, 4, 5, 6, 7]) && in_array($water, ['none', 'some'])) {
            return 4.94;
        }
        
        if (in_array($grains, [1, 2])) {
            return 6.07;
        }

        return 0;
    }

    /**
     * Calculate Added Sugars Component (0-10)
     */
    private function calculateAddedSugarsScore(int $ssb, string $addedSugars): float
    {
        $ssbCalories = match($ssb) {
            1 => 0,
            2 => 156,
            3 => 312,
            4 => 468,
            5 => 624,
            6 => 780,
            7 => 936,
            default => 0
        };

        $addedSugarCalories = match($addedSugars) {
            'none' => 0,
            'some' => 260,
            'a_lot' => 520,
            default => 0
        };

        $totalSugarCalories = $ssbCalories + $addedSugarCalories;
        return max(0, 10 - ($totalSugarCalories / 100));
    }

    /**
     * Calculate Saturated Fats Component (0-10)
     */
    private function calculateSaturatedFatsScore(int $ssb, int $grains, int $nutsSeeds): float
    {
        if (in_array($ssb, [3, 4, 5, 6, 7])) {
            return 1.82;
        }
        
        if (in_array($grains, [1, 2]) && in_array($ssb, [1, 2])) {
            return 3.20;
        }
        
        if (in_array($grains, [3, 4, 5, 6, 7]) && 
            in_array($nutsSeeds, [1, 2]) && 
            in_array($ssb, [1, 2])) {
            return 4.64;
        }
        
        if (in_array($grains, [3, 4, 5, 6, 7]) && 
            in_array($nutsSeeds, [3, 4, 5, 6, 7]) && 
            in_array($ssb, [1, 2])) {
            return 6.56;
        }

        return 0;
    }
}