<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComprehensiveHistoryAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'comprehensive_history_id',
        'section',
        'section_item',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
        'uploaded_by',
        'description',
    ];

    protected $casts = [
        'file_size' => 'integer',
    ];

    /**
     * Get the patient that owns the attachment.
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the comprehensive history that owns the attachment.
     */
    public function comprehensiveHistory(): BelongsTo
    {
        return $this->belongsTo(ComprehensiveHistory::class);
    }

    /**
     * Get the file size in human readable format.
     */
    public function getFileSizeFormattedAttribute(): string
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Check if the file is an image.
     */
    public function isImage(): bool
    {
        return in_array(strtolower($this->file_type), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp']);
    }

    /**
     * Check if the file is a PDF.
     */
    public function isPdf(): bool
    {
        return strtolower($this->file_type) === 'pdf';
    }

    /**
     * Get the section display name.
     */
    public function getSectionDisplayNameAttribute(): string
    {
        $sections = [
            'childhood_illness' => 'Childhood Illness',
            'adult_illness' => 'Adult Illness',
            'family_history' => 'Family History',
            'previous_medications' => 'Previous Medications',
            'current_medications' => 'Current Medications',
            'previous_hospitalization' => 'Previous Hospitalization',
            'surgical_history' => 'Surgical History',
            'health_maintenance' => 'Health Maintenance',
            'psychiatric_history' => 'Psychiatric History',
        ];

        return $sections[$this->section] ?? $this->section;
    }
}
