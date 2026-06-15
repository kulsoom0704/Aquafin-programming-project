<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bestelling extends Model
{
    protected $table = 'bestellingen';

    protected $fillable = ['user_id', 'onderdeel_id', 'aantal', 'status', 'materiaal_id'];

    public function onderdeel()
    {
        return $this->belongsTo(Onderdeel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function technieker()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}