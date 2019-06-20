<?php

use Illuminate\Database\Seeder;
use App\Nature;

class NatureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $nature = new Nature();
        $nature->id=1;
        $nature->nature="Risque";

        $nature = new Nature();
        $nature->id=2;
        $nature->nature="Opportunité";
    }
}
