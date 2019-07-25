<?php

namespace App\Http\Controllers;

use App\Mesure;
use Illuminate\Http\Request;
use App\Analyse;
use App\Acteur;
use App\Chantier;
use App\Metier\CauseConsequences;
use App\Nature;
use App\Pays;
use App\Periodicite;
use App\Priorite;
use App\Responsable;
use App\Statut;

class MesuresController extends Controller
{
    //
    public function mesures($id){
        $analyse = Analyse::find($id);
        // dd($analyses[0]->chantier()->get());
        //dd($analyse->nature()->first()->id);
        //dd($analyse->mesures()->get());
        $responsables = Responsable::all();
        $priorites = Priorite::all();
        $statuts = Statut::all();
        $acteurs = Acteur::all();
        $periodicites = Periodicite::all();
        return view('mesures.mesures',compact('analyse','priorites','statuts','periodicites','responsables','acteurs'));

    }
    public function SaveMesure(Request $request){
        $parameters=$request->except(['_token']);
        $statut = $parameters['statut'];
        $libelle = $parameters['libelle'];
        $responsable = $parameters['responsable'];
        $acteur = $parameters['acteur'];
        $id_analyse = $parameters['id_analyse'];
        $dateplanifie = $parameters['datePlanifie'];
        $dateEffective = $parameters['dateEffective'];
        $documentation = $parameters['documentation'];

        $mesure= new Mesure();

        $mesure->datePlanifie=$dateplanifie;
        $mesure->documentation=$documentation;
        $mesure->dateEffective=$dateEffective;
        $mesure->id_statut=$statut;
        $mesure->libelle=$libelle;
        $mesure->id_responsable=$responsable;
        $mesure->id_acteur=$acteur;
        $mesure->id_analyse=$id_analyse;

        $mesure->id_auteur=\Illuminate\Support\Facades\Auth::user()->id;

        $mesure->save();
        // dd($analyses[0]->chantier()->get());
        //dd($analyse->nature()->first()->id);
        return redirect()->route('liste')->with('success',"La mesure  a été enregistré avec succès");

    }
    public function ModifierMesure(Request $request){
        $parameters=$request->except(['_token']);
        $statut = $parameters['statut'];
        $libelle = $parameters['libelle'];
        $responsable = $parameters['responsable'];
        $acteur = $parameters['acteur'];
        $id = $parameters['id'];
        $dateplanifie = $parameters['datePlanifie'];
        $dateEffective = $parameters['dateEffective'];
        $documentation = $parameters['documentation'];

        $mesure=  Mesure::find($id);

        $mesure->datePlanifie=$dateplanifie;
        $mesure->documentation=$documentation;
        $mesure->dateEffective=$dateEffective;
        $mesure->id_statut=$statut;
        $mesure->libelle=$libelle;
        $mesure->id_responsable=$responsable;
        $mesure->id_acteur=$acteur;

        $mesure->id_auteur=\Illuminate\Support\Facades\Auth::user()->id;

        $mesure->save();
        // dd($analyses[0]->chantier()->get());
        //dd($analyse->nature()->first()->id);
        return redirect()->route('liste')->with('success',"La mesure  a été mise à jour avec succès");

    }

    public function pageModifMesure($id){
        $mesure = Mesure::find($id);
        $analyse = Analyse::find($mesure->id_analyse);
        $natures= Nature::all();
        $chantiers = Chantier::all();
        $responsables = Responsable::all();
        $priorites = Priorite::all();
        $analyses = Analyse::all();
        $statuts = Statut::all();
        $acteurs = Acteur::all();
        $periodicites = Periodicite::all();
        return view('mesures.modifier_mesure',compact('analyse','mesure','natures','chantiers','responsables','priorites','analyses','statuts','acteurs','periodicites'));

    }
    public function acteurFonctionResponsable($id){
        $responsable = Responsable::find($id);


        return $responsable->acteur->id;
    }
}
