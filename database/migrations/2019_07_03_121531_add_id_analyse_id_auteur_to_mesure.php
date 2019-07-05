<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdAnalyseIdAuteurToMesure extends Migration
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
            $table->unsignedBigInteger('id_analyse');
            $table->foreign('id_analyse')->references('id')->on('analyse');
            $table->unsignedBigInteger('id_auteur');
            $table->foreign('id_auteur')->references('id')->on('users');
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
            $table->removeColumn('id_analyse');
            $table->removeColumn('id_auteur');
        });
    }
}
