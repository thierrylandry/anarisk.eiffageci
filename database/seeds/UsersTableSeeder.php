<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new User();
        $user->nom = 'administrateur';
        $user->prenoms = 'admin';
        $user->email = 'admin@eiffage.com';
        $user->password = bcrypt('Administrateur');
        $user->save();
    }
}
