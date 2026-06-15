<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Levering extends Model
{
    protected $table = 'leveringen';

    protected $fillable = [
        'materiaal_id',
        'aantal',
    ];
}