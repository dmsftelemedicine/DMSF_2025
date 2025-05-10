<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysicalActivityDescription extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'order'];
}
