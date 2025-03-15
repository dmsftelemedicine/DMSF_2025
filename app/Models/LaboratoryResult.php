<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoryResult extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'test_type', 'date', 'result', 'image_path'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
