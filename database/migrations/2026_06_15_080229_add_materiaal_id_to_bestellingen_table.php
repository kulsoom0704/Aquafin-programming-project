<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bestellingen', function (Blueprint $table) {
            $table->foreignId('materiaal_id')->nullable()->constrained('materiaal')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('bestellingen', function (Blueprint $table) {
            $table->dropForeign(['materiaal_id']);
            $table->dropColumn('materiaal_id');
        });
    }
};