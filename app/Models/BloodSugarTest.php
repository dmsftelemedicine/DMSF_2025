<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodSugarTest extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'blood_sugar_mgdl', 'blood_sugar_mmol', 'test_date'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
