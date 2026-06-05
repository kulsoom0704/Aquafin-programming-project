<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wijzigingsverzoek extends Model
{
    protected $table = 'wijzigingsverzoeken';

    protected $fillable = [
        'materiaal_id',
        'nieuw_artikelnummer',
        'nieuwe_omschrijving',
        'nieuwe_locatie',
        'nieuwe_beschikbaar',
        'status',
    ];
}