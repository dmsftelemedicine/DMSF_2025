<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    /**
     * Get all instructions for this medicine
     */
    public function instructions()
    {
        return $this->hasMany(MedicineInstruction::class);
    }

    /**
     * Get the latest instruction for this medicine
     */
    public function latestInstruction()
    {
        return $this->hasOne(MedicineInstruction::class)->latest();
    }
}
