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
        Schema::create('installaties', function (Blueprint $table) {
            $table->id();
            $table->string('naam'); 
            $table->string('locatie')->nullable();
            $table->date('laatste_onderhoud_datum')->nullable(); 
            $table->integer('onderhoudsinterval_dagen')->default(365); 
            $table->timestamps();
            $table->unsignedBigInteger('technieker_id')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installaties');
    }
};
