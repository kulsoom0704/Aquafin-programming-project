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
            $table->string('titel');
            $table->text('bericht');
            $table->boolean('gelezen')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meldingen');
    }
};