<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAnalyse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analyse', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("description")->nullable(true);
            $table->text("detail")->nullable(true);
            $table->date("date")->nullable(true);
            $table->string("code")->nullable(true);
            $table->string("causes")->nullable(true);
            $table->string("conséquences")->nullable(true);
            $table->integer("probabiliteAvant")->nullable(true);
            $table->integer("severiteAvant")->nullable(true);
            $table->integer("planingAvavant")->nullable(true);
            $table->double("coutAvant")->nullable(true);
            $table->integer("probabiliteApres")->nullable(true);
            $table->integer("severiteApres")->nullable(true);
            $table->integer("planingApres")->nullable(true);
            $table->double("coutApres")->nullable(true);
            $table->double("cout")->nullable(true);
            $table->string("brouillon")->nullable(true);

            //les clés étrangères
            $table->unsignedBigInteger("id_user")->nullable(true);
            $table->foreign('id_user')->references('id')->on('users');

            $table->unsignedBigInteger("id_nature")->nullable(true);
            $table->foreign('id_nature')->references('id')->on('nature');

            $table->unsignedBigInteger("id_chantier")->nullable(true);
            $table->foreign('id_chantier')->references('id')->on('chantier');

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
        Schema::dropIfExists('analyse');
    }
}
