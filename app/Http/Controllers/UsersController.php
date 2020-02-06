<?php

namespace App\Http\Controllers;

use App\Chantier;
use App\Nature;
use App\Pays;
use App\Responsable;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function utilisateurs(){


        return view('utilisateurs.utilisateur');
    }
}
