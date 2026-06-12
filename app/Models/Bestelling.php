<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bestelling extends Model
{
    // Specifieke tabelnaam omdat het model niet standaard wordt afgeleid
    protected $table = 'bestellingen';

    // Velden die veilig massaal kunnen worden ingevuld
    protected $fillable = [
        'user_id', 
        'onderdeel_id', 
        'aantal', 
        'status'
    ];

    // Materialen-relatie voor de bestelling
    public function materiaal()
    {
        return $this->belongsTo(Materiaal::class, 'onderdeel_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}