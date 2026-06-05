<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Melding extends Model
{
    protected $table = 'meldingen';

    // On combine tous vos champs
    protected $fillable = [
        'titel',
        'bericht',
        'gelezen',
        'installatie_id',
        'status'
    ];

    public function installatie()
    {
        return $this->belongsTo(Installatie::class);
    }
}