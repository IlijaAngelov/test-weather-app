<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    protected $table = 'weathers';
    protected $fillable = [
        'latitude',
        'longitude',
        'description',
        'temperature',
        'country',
        'city',
        'timezone',
        'updated_at',
    ];
}
