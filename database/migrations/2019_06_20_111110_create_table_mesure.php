<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMesure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesure', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('priorite');
            $table->date('dateplanifie');
            $table->date('dateEffective');
            $table->string('documentation');

            // les clées étrangères
            $table->unsignedBigInteger('id_responsable');
            $table->foreign('id_responsable')->references('id')->on('responsable');

            $table->unsignedBigInteger('id_statut');
            $table->foreign('id_statut')->references('id')->on('statut');


            $table->unsignedBigInteger('id_priorite');
            $table->foreign('id_priorite')->references('id')->on('priorite');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mesure');
    }
}
