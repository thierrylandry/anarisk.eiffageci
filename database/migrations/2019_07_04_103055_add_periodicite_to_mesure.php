<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPeriodiciteToMesure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mesure', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('id_periodicite');
            $table->foreign('id_periodicite')->references('id')->on('periodicite');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mesure', function (Blueprint $table) {
            //
            $table->removeColumn('id_periodicite');
        });
    }
}
