<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdActeurToMesure extends Migration
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
            $table->unsignedBigInteger('id_acteur');
            $table->foreign('id_acteur')->references('id')->on('acteur');
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
            $table->removeColumn('id_acteur');
        });
    }
}
