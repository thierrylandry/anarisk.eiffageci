<?php

use Illuminate\Database\Seeder;

use App\Statut;
class StatutTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $Statut= new Statut();
        $Statut->id="1";
        $Statut->libelle="Débuté";
        $Statut->save();

        $Statut= new Statut();
        $Statut->id="2";
        $Statut->libelle="En cours";
        $Statut->save();

        $Statut= new Statut();
        $Statut->id="3";
        $Statut->libelle="Fait";
        $Statut->save();

        $Statut= new Statut();
        $Statut->id="4";
        $Statut->libelle="Permanente";
        $Statut->save();

        $Statut= new Statut();
        $Statut->id="5";
        $Statut->libelle="Régulière";
        $Statut->save();
    }
}
