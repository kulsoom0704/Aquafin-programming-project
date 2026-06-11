<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materiaal', function (Blueprint $table) {
            $table->id();
            $table->string('artikelnummer');
            $table->string('omschrijving');
            $table->string('locatie');
            $table->integer('beschikbaar');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materiaal');
    }
};