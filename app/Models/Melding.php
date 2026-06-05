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
        'installatie_id',
        'status',
        'bericht'
    ];

    public function installatie()
    {
        return $this->belongsTo(Installatie::class);
    }
}
