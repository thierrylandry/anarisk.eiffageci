<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreatedAtToTableauRecap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tableau_recap', function (Blueprint $table) {
            //
            $table->dateTime('created_at')->nullable();
            //$table->dateTime('updated_at')->nullable();
            $table->integer('id_chantier')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tableau_recap', function (Blueprint $table) {
            //
            $table->removeColumn('created_at');
            $table->removeColumn('updated_at');
        });
    }
}
