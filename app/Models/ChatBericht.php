<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatBericht extends Model
{
    protected $table = 'chat_berichten';

    protected $fillable = [
        'noodoproep_id',
        'afzender_rol',
        'bericht',
        'gelezen'
    ];

    // Een bericht behoort tot een noodoproep (ticket)
    public function noodoproep()
    {
        return $this->belongsTo(Noodoproep::class);
    }
}
