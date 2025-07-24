<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Icd10 extends Model
{
    use HasFactory;

    protected $table = 'icd10';

    protected $fillable = [
        'code',
        'description',
        'is_category'
    ];

    protected $casts = [
        'is_category' => 'boolean'
    ];

    // Scope for searchable codes (excluding chapter headers)
    public function scopeSearchable($query)
    {
        return $query->where('is_category', false);
    }

    // Scope for searching by code or description
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('code', 'LIKE', "%{$term}%")
              ->orWhere('description', 'LIKE', "%{$term}%");
        });
    }
}
