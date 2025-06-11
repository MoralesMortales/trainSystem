<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cities extends Model
{
    use HasFactory;
    protected $table = 'cities'; 
    
    protected $fillable = ['name']; // O los campos que tenga tu tabla cities
}