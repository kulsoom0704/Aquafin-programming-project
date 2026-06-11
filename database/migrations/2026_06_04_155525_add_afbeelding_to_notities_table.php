<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('notities', function (Blueprint $table) {
        
        $table->string('afbeelding')->nullable()->after('opmerking');
    });
}

public function down()
{
    Schema::table('notities', function (Blueprint $table) {
        $table->dropColumn('afbeelding');
    });
}
};
