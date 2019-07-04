<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(ActeurTableSeeder::class);
         $this->call(ChantierTableSeeder::class);
         $this->call(NatureTableSeeder::class);
         $this->call(PrioritesTableSeeder::class);
         $this->call(ResponsableTableSeeder::class);
         $this->call(StatutTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(PeriodiciteTableSeeder::class);
         $this->call(UsersTableSeeder::class);
    }
}
