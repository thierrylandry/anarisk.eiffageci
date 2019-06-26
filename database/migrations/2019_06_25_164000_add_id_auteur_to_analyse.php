<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdAuteurToAnalyse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('analyse', function (Blueprint $table) {
            //
            $table->integer('id_auteur')->nullable(true);
            $table->foreign('id_auteur')->references('users')->on('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('analyse', function (Blueprint $table) {
            //
            $table->removeColumn('id_auteur');
        });
    }
}
