<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Patient extends Model
{
    use HasFactory;
    protected $appends = ['age'];
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'birth_date',
        'gender',
        'marital_status',
        'email',
        'house_no',
        'street',
        'barangay',
        'city_municipality',
        'province',
        'zip_code',
        'country',
        'blood_type',
        'height',
        'occupation',
        'status',  // Add this line
    ];


    public function getAgeAttribute()
    {
        return Carbon::parse($this->birth_date)->age;
    }

    public function bloodSugarTests()
    {
        return $this->hasMany(BloodSugarTest::class, 'patient_id');
    }

    public function laboratoryResults()
    {
        return $this->hasMany(LaboratoryResult::class);
    }



}
