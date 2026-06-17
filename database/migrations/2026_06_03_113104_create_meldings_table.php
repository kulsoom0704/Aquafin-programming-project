<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('meldingen', function (Blueprint $table) {
            $table->id();
            
            
            $table->foreignId('installatie_id')->nullable()->constrained('installaties')->onDelete('cascade');
            $table->string('status')->default('ongelezen');
            
            
            $table->string('titel')->nullable();
            $table->text('bericht')->nullable();
            $table->boolean('gelezen')->default(false);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meldingen');
    }
};