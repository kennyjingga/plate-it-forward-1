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
        Schema::table('supports', function (Blueprint $table) {
            $table->boolean('handled')->default(false);
        });
    }

    public function down()
    {
        Schema::table('supports', function (Blueprint $table) {
            $table->dropColumn('handled');
        });
    }
};
