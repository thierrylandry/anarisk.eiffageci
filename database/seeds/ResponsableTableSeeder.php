<?php

use Illuminate\Database\Seeder;
use \App\Responsable;

class ResponsableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $responsable= new Responsable();
        $responsable->id="1";
        $responsable->nom="Descamps";
        $responsable->prenoms="Nicolas";
        $responsable->id_acteur="1";
        $responsable->id_chantier=1;
        $responsable->save();

        $responsable= new Responsable();
        $responsable->id="2";
        $responsable->nom="Decultieux";
        $responsable->prenoms="Sylvain";
        $responsable->id_acteur="2";
        $responsable->id_chantier=1;
        $responsable->save();

        $responsable= new Responsable();
        $responsable->id="3";
        $responsable->nom="Vigna";
        $responsable->prenoms="Christian";
        $responsable->id_acteur="3";
        $responsable->id_chantier=1;
        $responsable->save();

        $responsable= new Responsable();
        $responsable->id="4";
        $responsable->nom="Costecalde";
        $responsable->prenoms="Claudiane";
        $responsable->id_acteur="4";
        $responsable->id_chantier=1;
        $responsable->save();

        $responsable= new Responsable();
        $responsable->id="5";
        $responsable->nom="Kompaniiets";
        $responsable->prenoms="Oleksandr";
        $responsable->id_acteur="5";
        $responsable->id_chantier=1;
        $responsable->save();

        $responsable= new Responsable();
        $responsable->id="6";
        $responsable->nom="Galea";
        $responsable->prenoms="Benoit";
        $responsable->id_acteur="6";
        $responsable->id_chantier=1;
        $responsable->save();

        $responsable= new Responsable();
        $responsable->id="7";
        $responsable->nom="Logbo";
        $responsable->prenoms="Franck";
        $responsable->id_acteur="7";
        $responsable->id_chantier=1;
        $responsable->save();

        $responsable= new Responsable();
        $responsable->id="8";
        $responsable->nom="Kouehie";
        $responsable->prenoms="Gnimy Yves";
        $responsable->id_acteur="8";
        $responsable->id_chantier=1;
        $responsable->save();

        $responsable= new Responsable();
        $responsable->id="9";
        $responsable->nom="Brisset";
        $responsable->prenoms="Franck";
        $responsable->id_acteur="9";
        $responsable->id_chantier=1;
        $responsable->save();

        $responsable= new Responsable();
        $responsable->id="10";
        $responsable->nom="Orsot";
        $responsable->prenoms="Lydie";
        $responsable->id_acteur="10";
        $responsable->id_chantier=1;
        $responsable->save();
    }
}
