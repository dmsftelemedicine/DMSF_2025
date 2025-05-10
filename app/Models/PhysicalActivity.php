<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysicalActivity extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id'];

    public function details()
    {
        return $this->hasMany(PhysicalActivityDetail::class);
    }
}
