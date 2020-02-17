<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoutreelNomfichierToAnalyse extends Migration
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
            $table->double('coutreel')->nullable();
            $table->text('nomfichier')->nullable();
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
            $table->removeColumn('coutreel');
            $table->removeColumn('nomfichier');
        });
    }
}
