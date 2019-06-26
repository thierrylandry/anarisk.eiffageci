<?php

use Illuminate\Database\Seeder;
use App\Chantier;

class ChantierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $chantier= new Chantier();
        $chantier->id=1;
        $chantier->libelle="PHB";
        $chantier->id_pays=110;
        $chantier->save();

        $chantier= new Chantier();
        $chantier->id=2;
        $chantier->libelle="AZITO";
        $chantier->id_pays=110;
        $chantier->save();

        $chantier= new Chantier();
        $chantier->id=3;
        $chantier->libelle="PAHSA";
        $chantier->id_pays=110;
        $chantier->save();
    }
}
