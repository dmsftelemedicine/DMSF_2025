<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformedConsent extends Model
{
    use HasFactory;

    protected $table = 'informed_consent';

    protected $fillable = [
        'patient_id',
        'date',
        'session',
        'participant_signed',
        'witness_signed',
        'witness_name',
        'copy_given',
        'copy_reason',
    ];
    
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

}
