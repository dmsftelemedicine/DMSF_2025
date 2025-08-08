<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineInstruction extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine_id',
        'rx_english_instructions'
    ];

    /**
     * Get the medicine that owns this instruction
     */
    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}
