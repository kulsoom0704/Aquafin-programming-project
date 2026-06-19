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

    public function voorraden()
    {
        return $this->hasMany(Voorraad::class, 'materiaal_id');
    }

    
    public function getBeschikbaarAttribute()
    {
        $depot = session('depot', 'Antwerpen');
        $stock = $this->voorraden()->where('depot_naam', $depot)->first();
        
        return $stock ? $stock->beschikbaar : 0;
    }
}