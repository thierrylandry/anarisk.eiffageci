<?php

use Illuminate\Database\Seeder;
use \App\Priorite;
class PrioriteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $priorite= new Priorite();
        $priorite->id='1';
        $priorite->libelle='Urgent';
        $priorite->save();

        $priorite= new Priorite();
        $priorite->id='2';
        $priorite->libelle='Très urgent';
        $priorite->save();
    }
}
