<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('retours', function (Blueprint $table) {
            $table->string('technieker_naam')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('retours', function (Blueprint $table) {
            $table->dropColumn('technieker_naam');
        });
    }
};