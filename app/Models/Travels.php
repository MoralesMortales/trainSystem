<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Travels extends Model
{

    protected $primaryKey = 'travelCode';

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
}
