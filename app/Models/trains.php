<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class trains extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $primaryKey = 'train_id';

    protected $fillable = [
        'type',
        'name',
        'capacity',
        'maxVelocity',
        'vipCapacity',
        'turistCapacity',
        'economicCapacity',
        'status',
    ];
    public $incrementing = true; // Si train_id es auto-incremental 
}

