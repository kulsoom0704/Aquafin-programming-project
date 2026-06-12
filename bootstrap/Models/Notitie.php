<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notitie extends Model
{
    use HasFactory;

    // 1. On donne l'autorisation stricte à Laravel de remplir ces colonnes
    protected $fillable = [
        'installatie_id',
        'user_id',
        'opmerking',
        'afbeelding'
    ];

    // 2. La relation avec la machine
    public function installatie()
    {
        return $this->belongsTo(Installatie::class);
    }

    // 3. 🚀 LA fameuse relation qui manquait sûrement pour l'affichage !
    public function technieker()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}