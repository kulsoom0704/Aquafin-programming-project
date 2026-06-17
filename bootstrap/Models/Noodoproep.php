<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noodoproep extends Model
{
    use HasFactory;

    protected $table = 'noodoproepen';

    protected $fillable = ['user_id', 'type', 'bericht', 'status'];

    
    public function technieker()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
