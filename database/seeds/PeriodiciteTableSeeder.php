<?php

use Illuminate\Database\Seeder;
use App\Periodicite;
class PeriodiciteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $periodicite = new Periodicite();
        $periodicite->id=1;
        $periodicite->libelle='Régulière';
        $periodicite->save();
        $periodicite = new Periodicite();
        $periodicite->id=2;
        $periodicite->libelle='Permanante';
        $periodicite->save();
    }
}
