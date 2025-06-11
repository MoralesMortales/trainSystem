<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens; // <--- Elimina o comenta si no usas tokens API

class User extends Authenticatable
{
    use HasFactory, Notifiable; // <--- Asegúrate que HasApiTokens no esté aquí si lo eliminaste

    protected $fillable = [
        'cedula',    // Columna para la cédula
        'email',     // Columna para el email
        'password',
        'isEmployee', // Columna para el estado de empleado
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'isEmployee' => 'integer', // Para que Laravel trate 'tinyint(4)' como booleano
    ];
}