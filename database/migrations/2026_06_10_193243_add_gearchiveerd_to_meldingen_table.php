<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('meldingen', function (Blueprint $table) {
            $table->boolean('gearchiveerd')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('meldingen', function (Blueprint $table) {
            $table->dropColumn('gearchiveerd');
        });
    }
};