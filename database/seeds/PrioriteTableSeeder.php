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
        $priorite->string='Urgent';

        $priorite= new Priorite();
        $priorite->id='1';
        $priorite->string='Très urgent';
    }
}
