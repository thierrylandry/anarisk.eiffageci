<?php

namespace App\Http\Controllers;

use App\Analyse;
use App\Chantier;
use App\Metier\CauseConsequences;
use App\Nature;
use App\Pays;
use App\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class AnalysesController extends Controller
{
    //
    public function ajouter_analyse(){
        $natures= Nature::all();
        $payss = Pays::all();
        $chantiers = Chantier::all();
        $responsables = Responsable::all();

        return view('analyses.analyses',compact('natures','payss','chantiers','responsables'));

    }

    public function liste(){
        $natures= Nature::all();
        $payss = Pays::all();
        $chantiers = Chantier::all();
        $responsables = Responsable::all();

        return view('analyses.liste',compact('natures','payss','chantiers','responsables'));

    }

    /**
     * @param Request $request
     * @return $this
     */
    public function save_analyse(Request $request){
        $parameters=$request->except(['_token']);
        $nature = $parameters['nature'];
        $date = $parameters['date'];
        $pays = $parameters['pays'];
        $chantier = $parameters['chantier'];
        $proprietaire = $parameters['proprietaire'];
        $code = $parameters['code'];
        $probabiliteAvant = $parameters['probabiliteAvant'];
        $severiteAvant = $parameters['severiteAvant'];
        $planingAvant = $parameters['planingAvant'];
        $coutAvant = $parameters['coutAvant'];
        $niveauAvant = $parameters['niveauAvant'];
        $probabiliteApres = $parameters['probabiliteApres'];
        $severiteApres = $parameters['severiteApres'];
        $planingApres = $parameters['planingApres'];
        $coutApres = $parameters['coutApres'];
        $brouillon = $parameters['brouillon'];
        $cout = $parameters['cout'];

        //les causes
        $causes = new Collection();

        for($i = 0; $i <= count($request->input("causes"))-1; $i++ )
        {
            $cause = new CauseConsequences();

            if( !empty($request->input("causes")[$i]) ){
            $cause->libelle = $request->input("causes")[$i];

                $causes->add($cause);
            }

        }

        $raw = $request->except("_token", "type_p","num_p",'date_exp');
      //  dd($raw);
        $var["cause"] = json_encode($causes->toArray());

        //les conséqauences
        $consequences = new Collection();
        for($i = 0; $i <= count($request->input("consequences"))-1; $i++ )
        {
            $consequence = new CauseConsequences();

            if( !empty($request->input("consequences")[$i]) ){
                $consequence->libelle = $request->input("consequences")[$i];

                $consequences->add($consequence);
            }

        }

        $raw = $request->except("_token", "type_p","num_p",'date_exp');
        //  dd($raw);
        $var["consequences"] = json_encode($causes->toArray());
        $analyse = new Analyse();

        $analyse->id_nature=$nature;
        $analyse->date=$date;
        $analyse->id_pays=$pays;
        $analyse->id_chantier=$chantier;
        $analyse->id_proprietaire=$proprietaire;
        $analyse->code=$code;
        $analyse->probabiliteAvant=$probabiliteAvant;
        $analyse->severiteAvant=$severiteAvant;
        $analyse->planingAvant=$planingAvant;
        $analyse->coutAvant=$coutAvant;
        $analyse->probabiliteApres=$probabiliteApres;
        $analyse->severiteApres=$severiteApres;
        $analyse->planingApres=$planingApres;
        $analyse->coutApres=$coutApres;
        $analyse->brouillon=nl2br(e($brouillon));
        $analyse->causes=$var["cause"];
        $analyse->causes=$var["consequences"];
        $analyse->cout=$cout;
        $analyse->id_auteur=\Illuminate\Support\Facades\Auth::user()->id;
        $analyse->save();

        return redirect()->route('analyses')->with('success',"La personne a été ajoutée avec succès");

    }
}
