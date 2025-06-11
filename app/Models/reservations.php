<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reservations extends Model
{
    protected $primaryKey = 'reservationNumber';
    public $incrementing = true;


       protected $fillable = [
        'fullname',
        'travelCode',
        'gender',
        'passportNumber',
        'cedula',
        'status'
    ];
public function reservation()
{
    return $this->belongsTo(reservations::class, 'reservationNumber', 'reservationNumber');
}
}
