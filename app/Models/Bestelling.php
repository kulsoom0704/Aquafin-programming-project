<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bestelling extends Model
{
    
    protected $table = 'bestellingen';

    protected $fillable = ['user_id', 'onderdeel_id', 'aantal', 'status'];

    public function onderdeel()
    {
        return $this->belongsTo(Onderdeel::class);
    }

    public function technieker()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
