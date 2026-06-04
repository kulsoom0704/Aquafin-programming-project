<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wijzigingsverzoeken', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materiaal_id')->constrained('materiaal');
            $table->string('nieuw_artikelnummer');
            $table->string('nieuwe_omschrijving');
            $table->string('nieuwe_locatie');
            $table->integer('nieuwe_beschikbaar');
            $table->string('status')->default('wachtend'); // wachtend, geaccepteerd, geweigerd
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wijzigingsverzoeken');
    }
};