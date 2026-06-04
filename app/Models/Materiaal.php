<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materiaal extends Model
{
    protected $table = 'materiaal';

    protected $fillable = [
        'artikelnummer',
        'omschrijving',
        'locatie',
        'beschikbaar',
        'foto',
    ];
}