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
    Schema::create('chat_berichten', function (Blueprint $table) {
        $table->id();
        // Koppeling naar het oorspronkelijke ticket (noodoproep)
        $table->foreignId('noodoproep_id')->constrained('noodoproepen')->onDelete('cascade');
        
        // Wie stuurt het bericht? (Technieker, Admin, Magazijnier)
        $table->string('afzender_rol'); 
        
        // Inhoud van het chatbericht
        $table->text('bericht');
        
        // Dit zorgt voor het '+1' (rode badge)!
        $table->boolean('gelezen')->default(false); 
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_berichten');
    }
};
