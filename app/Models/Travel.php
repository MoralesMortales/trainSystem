<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;

    protected $table = 'travels'; // Asegúrate de que esto sea correcto si tu tabla no es 'travels'

    protected $fillable = [
        'travelCode', // Si generas travelCode en el controlador
        'train_id',
        'departureDay',
        'departureHour',
        'origin',
        'destiny',
        'status', // Si 'status' tiene un valor por defecto o se maneja en el backend
        'cost_vip',
        'cost_normal',
        'cost_turist',
    ];
    // No necesitas created_at y updated_at aquí si Laravel los gestiona automáticamente
}