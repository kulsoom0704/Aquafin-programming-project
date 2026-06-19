<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notitie extends Model
{
    use HasFactory;

    // 1. Geef Laravel toestemming om deze velden te vullen
    protected $fillable = [
        'installatie_id',
        'user_id',
        'opmerking',
        'afbeelding'
    ];

    // 2. Relatie naar de installatie
    public function installatie()
    {
        return $this->belongsTo(Installatie::class);
    }

    // 3. Relatie naar de technieker voor het tonen van auteurgegevens
    public function technieker()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}