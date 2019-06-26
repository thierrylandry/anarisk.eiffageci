<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdChantierToResponsable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('responsable', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('id_chantier');
            $table->foreign('id_chantier')->references('id')->on('chantier');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('responsable', function (Blueprint $table) {
            //
            $table->removeColumn('chantier');
        });
    }
}
