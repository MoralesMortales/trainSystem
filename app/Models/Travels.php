<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use App\Models\trains;

class Travels extends Model
{

    protected $primaryKey = 'travelCode';
    public $incrementing = false;

    protected $fillable = [
        'travelCode',
        'train_id',
        'departureDay',
        'departureHour',
        'origin',
        'destiny',
        'CostVIP',
        'CostNormal',
        'CostTurists',
        'status',
    ];

    public function train()
    {
        return $this->belongsTo(trains::class, 'train_id', 'train_id');
    }

    // Relación con reservas
    public function reservations()
    {
        return $this->hasMany(Reservations::class, 'travelCode', 'travelCode');
    }
}
