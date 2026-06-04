<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notitie extends Model
{
    
    protected $fillable = ['installatie_id', 'user_id', 'opmerking', 'afbeelding'];

    public function installatie()
    {
        return $this->belongsTo(Installatie::class);
    }

    public function technieker()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}