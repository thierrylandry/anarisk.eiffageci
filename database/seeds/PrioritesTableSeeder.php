<?php

use Illuminate\Database\Seeder;
use \App\Priorite;
class PrioritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $priorite = new Priorite();
        $priorite->id=1;
        $priorite->libelle='Faible';
        $priorite->save();
        $priorite = new Priorite();
        $priorite->id=2;
        $priorite->libelle='Normal';
        $priorite->save();
        $priorite = new Priorite();
        $priorite->id=3;
        $priorite->libelle='Haute';
        $priorite->save();
    }
}
