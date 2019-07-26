<?php

namespace App\Http\Controllers;

use App\Tableau_recap;
use App\Vardiag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $effanalyses_tab = DB::table('analyse')
            ->groupBy('nature.id')
            ->join('nature','analyse.id_nature','=','nature.id')
            ->select('nature.nature',DB::raw('count(analyse.id) as nb'))
            ->get();
       // dd($effanalyses);

        $effanalyses= Array();
        foreach ($effanalyses_tab as $group):
            $vardiag = New Vardiag();
            $vardiag->name=$group->nature;
            $vardiag->y=$group->nb;

            $effanalyses[]=$vardiag;
        endforeach;
        $tableau_recap = Tableau_recap::find(1);
        return view('welcome',compact('effanalyses','tableau_recap'));
    }
}
