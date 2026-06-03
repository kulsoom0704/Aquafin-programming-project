<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Installatie extends Model
{
    
    protected $fillable = [
        'naam',
        'locatie',
        'laatste_onderhoud_datum',
        'onderhoudsinterval_dagen',
        'technieker_id'
    ];

    
    public function meldingen()
    {
        return $this->hasMany(Melding::class);
    }

    public function notities()
    {
        return $this->hasMany(Notitie::class);
    }
}