<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voorraad extends Model
{
    protected $table = 'voorraden';
    protected $fillable = ['materiaal_id', 'depot_naam', 'beschikbaar'];

    public function materiaal()
    {
        return $this->belongsTo(Materiaal::class);
    }
}