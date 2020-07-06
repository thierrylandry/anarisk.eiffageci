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
            ->where('id_chantier','=',Auth()->user()->id_chantier_connecte)
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
        //pourcentage des mesures en vert

        $mesures_tab = DB::table('mesure')
            ->groupBy('statut.id')
            ->join('statut','mesure.id_statut','=','statut.id')
            ->join('analyse','mesure.id_analyse','=','analyse.id')
            ->where('analyse.id_chantier','=',Auth()->user()->id_chantier_connecte)
            ->select('statut.libelle',DB::raw('count(mesure.id) as nb'))
            ->get();

        $mesures= Array();
        $mesure_en_vert =New Vardiag();
        $mesure_autre =New Vardiag();
        $mesure_total =New Vardiag();
        foreach ($mesures_tab as $group):

            if($group->libelle=="Fait" ||  $group->libelle=="permanente" ||  $group->libelle=="régulière" ||  $group->libelle=="Prêt"){
                $mesure_en_vert->name="Mesures faites, permanentes, prêtes et régulières";
                $mesure_en_vert->y+=$group->nb;
            }else{
                $mesure_autre->name="Autres mesures";
                $mesure_autre->y+=$group->nb;
        }
                $mesure_total->name='Mesures total';
                $mesure_total->y+=$group->nb;





        endforeach;
        $mesures[]=$mesure_en_vert;
        $mesures[]=$mesure_autre;
        $tableau_recap = Tableau_recap::where('id_chantier','=',Auth()->user()->id_chantier_connecte)->first();
        return view('welcome',compact('effanalyses','tableau_recap','mesures'));
    }
}
