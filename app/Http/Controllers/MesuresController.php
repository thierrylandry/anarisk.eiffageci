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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MesuresController extends Controller
{
    //
    public function mesures($id){
        $analyse = Analyse::find($id);
        // dd($analyses[0]->chantier()->get());
        //dd($analyse->nature()->first()->id);
      //  dd($analyse->mesures()->first()->acteur);
        $responsables =DB::select('call responsable('.Auth::user()->id_chantier_connecte.')');
        $priorites = Priorite::all();
        $statuts = Statut::all();
        $acteurs = Acteur::all();
        $periodicites = Periodicite::all();
        return view('mesures.mesures',compact('analyse','priorites','statuts','periodicites','responsables','acteurs'));

    }
    public function supprimer_mesure($id){
        $mesure = Mesure::find($id);
        $mesure->delete();

        return redirect()->back()->with('error',"La mesure  a été supprimée avec succès");

    }
    public function tableau_recap_mesure(){
        $mesures =  DB::table('mesure')
            ->join('analyse','analyse.id','=','mesure.id_analyse')
            ->join('acteur','acteur.id','=','mesure.id_acteur')
            ->join('statut','statut.id','=','mesure.id_statut')
            ->join('users','users.id','=','mesure.id_auteur')
            ->join('nature','nature.id','=','analyse.id_nature')
            ->select('mesure.id','dateplanifie','dateEffective','documentation','id_responsable','id_statut','id_priorite','mesure.libelle','id_proprietaire','mesure.id_statut',DB::raw('statut.libelle as libellestatut'),'nom','prenoms','code','description','causes','consequences','nature','cout','etat')->get();
        $responsables =DB::select('call responsable('.Auth::user()->id_chantier_connecte.')');

        $priorites = Priorite::all();
        $statuts = Statut::all();
        $acteurs = Acteur::all();
        $periodicites = Periodicite::all();

        return view('mesures.liste',compact('mesures','responsables','priorites','statuts','periodicites','acteurs'));

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

        if($request->file('nomfichier')){
            $mesure->nomfichier=Str::ascii('mesure_'.$mesure->id.'_'.$request->file('nomfichier')->getClientOriginalName());

            $path = Storage::putFileAs(
                'images'.DIRECTORY_SEPARATOR.'document', $request->file('nomfichier'), $mesure->nomfichier
            );
        }else{
           // $mesure->image="";
        }

        $mesure->save();
        // dd($analyses[0]->chantier()->get());
        //dd($analyse->nature()->first()->id);
        return redirect()->back()->with('success',"La mesure  a été enregistré avec succès");

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

        if($request->file('nomfichier')){
            $mesure->nomfichier=Str::ascii('mesure'.$mesure->id.'_'.$request->file('nomfichier')->getClientOriginalName());

            $path = Storage::putFileAs(
                'images'.DIRECTORY_SEPARATOR.'document', $request->file('nomfichier'), $mesure->nomfichier
            );
        }else{
            //$analyse->nomfichier="";
        }
        $mesure->save();
        // dd($analyses[0]->chantier()->get());
        //dd($analyse->nature()->first()->id);
        return redirect()->back()->with('success',"La mesure  a été mise à jour avec succès");

    }
    public function supprimer_pj_mesure($id){
        $mesure =Mesure::find($id);

        $mesure->nomfichier="";
        $mesure->save();
        return redirect()->back()->with('success',"La pièce jointe de la mesure à été supprimée avec succès");
    }
    public function terminer_mesure(Request $request){
        $parameters=$request->except(['_token']);
        $dateEffective = $parameters['dateEffective'];
        $id= $parameters['id_mesure'];
        $mesure=  Mesure::find($id);
        $mesure->dateEffective=$dateEffective;
        $mesure->id_statut=10;
      //  $mesure->id_auteur=\Illuminate\Support\Facades\Auth::user()->id;

        $mesure->save();
        // dd($analyses[0]->chantier()->get());
        //dd($analyse->nature()->first()->id);
        $colleguemesures=$mesure->analyse->mesures()->get();
        $tab =  array();
        foreach ($colleguemesures as $mes){
            if($mes->id_statut==10){
                $tab[]='ok';
            }else{
                $tab[]='impret';
            }
        }
        if (!in_array("impret", $tab))
        {
            $analyse= Analyse::find($mesure->analyse->id);
           // $analyse->etat=2;
            $analyse->save();

        }
        else
        {

        }
        return redirect()->back()->with('success',"La mesure  a été éffectué");

    }

    public function pageModifMesure($id){
        $mesure = Mesure::find($id);
        $analyse = Analyse::find($mesure->id_analyse);
        $natures= Nature::all();
        $chantiers = Auth::user()->chantiers()->get();
        $responsables =DB::select('call responsable('.Auth::user()->id_chantier_connecte.')');
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
