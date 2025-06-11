<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $keyType = 'string';

    protected $fillable = [
        'travelCode',
        'class',
        'seat',
        'gender',
        'fullname',
        'age',
        'reservationNumber',
        'status',
    ];
}
