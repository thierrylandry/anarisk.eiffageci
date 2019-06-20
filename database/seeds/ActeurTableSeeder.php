<?php

use Illuminate\Database\Seeder;
use App\Acteur;

class ActeurTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $acteur= new Acteur();
        $acteur->id=1;
        $acteur->libelle="Direction";
        $acteur->save();


        $acteur= new Acteur();
        $acteur->id=2;
        $acteur->libelle="Travaux";
        $acteur->save();

        $acteur= new Acteur();
        $acteur->id=3;
        $acteur->libelle="DAF";
        $acteur->save();

        $acteur= new Acteur();
        $acteur->id=4;
        $acteur->libelle="Achat";
        $acteur->save();

        $acteur= new Acteur();
        $acteur->id=5;
        $acteur->libelle="Technique";
        $acteur->save();

        $acteur= new Acteur();
        $acteur->id=6;
        $acteur->libelle="Contrat";
        $acteur->save();

        $acteur= new Acteur();
        $acteur->id=8;
        $acteur->libelle="Qualité";
        $acteur->save();

        $acteur= new Acteur();
        $acteur->id=9;
        $acteur->libelle="HSE";
        $acteur->save();

        $acteur= new Acteur();
        $acteur->id=10;
        $acteur->libelle="SPIE F";
        $acteur->save();

        $acteur= new Acteur();
        $acteur->id=11;
        $acteur->libelle="SRH";
        $acteur->save();
    }
}
