<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysicalActivityDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'physical_activity_id', 
        'activity_description_id', 
        'met', 
        'days', 
        'hours', 
        'minutes', 
        'other_value'
    ];

    public function activity()
    {
        return $this->belongsTo(PhysicalActivity::class);
    }

    public function description()
    {
        return $this->belongsTo(PhysicalActivityDescription::class, 'activity_description_id');
    }
}
