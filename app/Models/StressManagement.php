<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StressManagement extends Model
{
    use HasFactory;

    protected $table = 'stress_management';
    protected $fillable = [
        'patient_id', 'stress_level',
        'GAD_7_Q1', 'GAD_7_Q2', 'GAD_7_Q3', 'GAD_7_Q4', 'GAD_7_Q5', 'GAD_7_Q6', 'GAD_7_Q7', 'GAD_7_total',
        'PHQ_9_Q1', 'PHQ_9_Q2', 'PHQ_9_Q3', 'PHQ_9_Q4', 'PHQ_9_Q5', 'PHQ_9_Q6', 'PHQ_9_Q7', 'PHQ_9_Q8', 'PHQ_9_Q9', 'PHQ_9_total',
        'PSS_4_Q1', 'PSS_4_Q2', 'PSS_4_Q3', 'PSS_4_Q4'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
