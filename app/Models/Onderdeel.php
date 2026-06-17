<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Onderdeel extends Model
{
    
    protected $table = 'onderdelen';

    protected $fillable = ['naam', 'voorraad'];

    public function bestellingen()
    {
        return $this->hasMany(Bestelling::class);
    }
}