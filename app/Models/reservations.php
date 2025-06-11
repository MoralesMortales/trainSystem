<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reservations extends Model
{
public function reservation()
{
    return $this->belongsTo(reservations::class, 'reservationNumber', 'reservationNumber');
}
}
