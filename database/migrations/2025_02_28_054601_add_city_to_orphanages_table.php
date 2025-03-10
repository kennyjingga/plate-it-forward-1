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
    Schema::table('orphanages', function (Blueprint $table) {
        $table->string('city')->after('address');
    });
}

public function down()
{
    Schema::table('orphanages', function (Blueprint $table) {
        $table->dropColumn('city');
    });
}

};
