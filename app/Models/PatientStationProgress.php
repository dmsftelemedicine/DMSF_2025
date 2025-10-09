<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientStationProgress extends Model
{
    use HasFactory;

    protected $table = 'patient_station_progress';

    protected $fillable = [
        'patient_id',
        'completed_stations',
        'current_station',
        'last_updated'
    ];

    protected $casts = [
        'completed_stations' => 'array',
        'last_updated' => 'datetime'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // Helper method to add a completed station
    public function addCompletedStation($stationNumber)
    {
        $stations = $this->completed_stations ?? [];
        
        // Add all stations up to and including the clicked station
        $allStations = [1, 3, 4, 5, 6];
        $clickedIndex = array_search($stationNumber, $allStations);
        
        if ($clickedIndex !== false) {
            $newStations = array_slice($allStations, 0, $clickedIndex + 1);
            $this->completed_stations = $newStations;
            $this->current_station = $stationNumber;
            $this->last_updated = now();
            $this->save();
        }
    }

    // Helper method to check if a station is completed
    public function isStationCompleted($stationNumber)
    {
        return in_array($stationNumber, $this->completed_stations ?? []);
    }
}
