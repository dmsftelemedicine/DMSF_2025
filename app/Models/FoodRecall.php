<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodRecall extends Model
{
    use HasFactory;

    protected $fillable = [
        'nutrition_id',
        'breakfast',
        'am_snack',
        'lunch',
        'pm_snack',
        'dinner',
        'midnight_snack',
    ];

    // Relationship with Nutrition model
    public function nutrition()
    {
        return $this->belongsTo(Nutrition::class);
    }
}
