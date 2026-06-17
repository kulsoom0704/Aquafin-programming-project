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
    Schema::create('notities', function (Blueprint $table) {
        $table->id();
        
        $table->foreignId('installatie_id')->constrained('installaties')->onDelete('cascade');
        
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        
        $table->text('opmerking');
        
        $table->timestamps(); 
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notities');
    }
};
