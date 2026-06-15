<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bestelling extends Model
{
    
    protected $table = 'bestellingen';

    protected $fillable = [
        'user_id', 
        'onderdeel_id', 
        'aantal', 
        'status'
    ];

    public function materiaal()
    {
        return $this->belongsTo(Materiaal::class, 'onderdeel_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}