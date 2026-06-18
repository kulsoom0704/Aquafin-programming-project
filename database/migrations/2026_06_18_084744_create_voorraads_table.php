<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('voorraden', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('materiaal_id')->constrained('materiaal')->onDelete('cascade');
            
            $table->string('depot_naam'); 
            
            $table->integer('beschikbaar')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voorraads');
    }
};
