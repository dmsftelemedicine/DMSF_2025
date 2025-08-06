<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ISI7Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'isi_q1',
        'isi_q2',
        'isi_q3',
        'isi_q4',
        'isi_q5',
        'isi_q6',
        'isi_q7',
        'total_score',
        'severity',
        'interpretation',
        'recommendations',
    ];

    protected $casts = [
        'isi_q1' => 'integer',
        'isi_q2' => 'integer',
        'isi_q3' => 'integer',
        'isi_q4' => 'integer',
        'isi_q5' => 'integer',
        'isi_q6' => 'integer',
        'isi_q7' => 'integer',
        'total_score' => 'integer',
    ];

    /**
     * Get the patient that owns the ISI-7 assessment.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
