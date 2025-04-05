<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialConnectedness extends Model
{
    use HasFactory;
    protected $table = 'social_connectedness';
    protected $fillable = [
        'patient_id', 'family', 'friends', 'classmate',
        'scs_8_Q1', 'scs_8_Q2', 'scs_8_Q3', 'scs_8_Q4',
        'scs_8_Q5', 'scs_8_Q6', 'scs_8_Q7', 'scs_8_Q8',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
