<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Melding extends Model
{
    protected $table = 'meldingen';

    protected $fillable = [
        'titel',
        'bericht',
        'gelezen',
    ];
}