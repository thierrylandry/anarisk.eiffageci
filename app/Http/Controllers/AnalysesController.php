<?php

namespace App\Http\Controllers;

use App\Acteur;
use App\Analyse;
use App\Chantier;
use App\Metier\CauseConsequences;
use App\Nature;
use App\Pays;
use App\Periodicite;
use App\Priorite;
use App\Responsable;
use App\Statut;
use App\Tableau_recap;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\View;
use Spipu\Html2Pdf\Html2Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class AnalysesController extends Controller
{
    //
    public function ajouter_analyse(){
        $natures= Nature::all();
        $payss = Pays::all();
        $chantiers = Chantier::where('id_pays','=',110)->get();
        $responsables = Responsable::where('id_chantier','=',$chantiers->first()->id)->get();

        return view('analyses.analyses',compact('natures','payss','chantiers','responsables'));

    }
    public function pageModifierAnalyse($id){
        $analyse=Analyse::find($id);
        $natures= Nature::all();
        $payss = Pays::all();
        $chantiers = Chantier::where('id_pays','=',110)->get();
        $responsables = Responsable::where('id_chantier','=',$chantiers->first()->id)->get();
        return view('analyses.modifierAnalyse',compact('analyse','natures','payss','chantiers','responsables'));

    }
    public function chantierListeFonction($id){
        $pays = Pays::find($id);


        return $pays->chantiers()->get();

    }
    public function proprietaireListeFonction($id){
        $chantier = Chantier::find($id);


        return $chantier->responsables()->get();

    }
    public function analyseFonctionId($id){
        $analyse = Analyse::find($id);


        return $analyse;

    }
public function ficheAnalyse($id){
    $analyse =Analyse::find($id);

    return view('analyses.fiche',compact('analyse'));
}
    public function liste(){
        $natures= Nature::all();
        $payss = Pays::all();
        $chantiers = Chantier::all();
        $responsables = Responsable::all();
        $priorites = Priorite::all();
        $analyses = Analyse::orderBy('id','DESC')->get();
        $statuts = Statut::all();
        $acteurs = Acteur::all();
        $periodicites = Periodicite::all();
       // dd($analyses[0]->chantier()->get());
        return view('analyses.liste',compact('natures','payss','chantiers','responsables','analyses','priorites','statuts','acteurs','periodicites'));

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
        $description = $parameters['description'];
        $detail = $parameters['detail'];

        $lepays= Pays::find($pays);
        $lechantier= Chantier::find($chantier);
        $lesanalyses= Analyse::all();

        $value=sizeof($lesanalyses)+1;
        $code = $lepays->alpha2.'-'.$lechantier->libelle.'-'.$value ;
        $probabiliteAvant = $parameters['probabiliteAvant'];
        $severiteAvant = $parameters['severiteAvant'];
        $planingAvant = $parameters['planingAvant'];
        $coutAvant = $parameters['coutAvant'];

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
        $var["consequences"] = json_encode($consequences->toArray());
        $analyse = new Analyse();

        $analyse->id_nature=$nature;
        $analyse->date=$date;
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

        $analyse->description=$description;
        $analyse->detail=$detail;


        $analyse->causes=$var["cause"];
        $analyse->consequences=$var["consequences"];
        $analyse->cout=filter_var($cout, FILTER_SANITIZE_NUMBER_INT);
        $analyse->id_auteur=\Illuminate\Support\Facades\Auth::user()->id;
        $analyse->save();


        return redirect()->route('liste')->with('success',"L'analyse a été enregistré avec succès");

    }

    public function modifier_analyse(Request $request){
        $parameters=$request->except(['_token']);
        $nature = $parameters['nature'];
        $date = $parameters['date'];
        $pays = $parameters['pays'];
        $id = $parameters['id'];
        $chantier = $parameters['chantier'];
        $proprietaire = $parameters['proprietaire'];
        $description = $parameters['description'];
        $detail = $parameters['detail'];

        $lepays= Pays::find($pays);
        $lechantier= Chantier::find($chantier);
        $lesanalyses= Analyse::all();

        $value=sizeof($lesanalyses)+1;
        $code = $lepays->alpha2.'-'.$lechantier->libelle.'-'.$value ;
        $probabiliteAvant = $parameters['probabiliteAvant'];
        $severiteAvant = $parameters['severiteAvant'];
        $planingAvant = $parameters['planingAvant'];
        $coutAvant = $parameters['coutAvant'];

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
        $var["consequences"] = json_encode($consequences->toArray());
        $analyse =  Analyse::find($id);
        if( (stristr( \Illuminate\Support\Facades\Auth::user()->nom,$analyse->proprietaire->nom) === true and stristr( \Illuminate\Support\Facades\Auth::user()->prenoms,$analyse->proprietaire->prenoms) === true )|| $analyse->auteur->id==\Illuminate\Support\Facades\Auth::user()->id ){


        $analyse->id_nature=$nature;
        $analyse->date=$date;
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

            $analyse->description=$description;
            $analyse->detail=$detail;

        $analyse->causes=$var["cause"];
        $analyse->consequences=$var["consequences"];
        $analyse->cout=filter_var($cout, FILTER_SANITIZE_NUMBER_INT);
        $analyse->id_auteur=\Illuminate\Support\Facades\Auth::user()->id;
        $analyse->save();

        return redirect()->route('liste')->with('success',"L'analyse a été mise à jour  avec succès");
            }else{
                return redirect()->route('liste')->with('error',"vous n'avez pas le droit de modifier cette analyse");
            }

    }

    public function EnregistrerEvalPosteEv(Request $request){
        $parameters=$request->except(['_token']);
        $probabiliteApres = $parameters['probabiliteApres'];
        $severiteApres = $parameters['severiteApres'];
        $planingApres = $parameters['planingApres'];
        $coutApres = $parameters['coutApres'];
        $id = $parameters['id_analyse'];
        $analyse =  Analyse::find($id);
        if( (stristr( \Illuminate\Support\Facades\Auth::user()->nom,$analyse->proprietaire->nom) === true and stristr( \Illuminate\Support\Facades\Auth::user()->prenoms,$analyse->proprietaire->prenoms) === true )|| $analyse->auteur->id==\Illuminate\Support\Facades\Auth::user()->id ) {

            $analyse->probabiliteApres = $probabiliteApres;
            $analyse->severiteApres = $severiteApres;
            $analyse->planingApres = $planingApres;
            $analyse->coutApres = $coutApres;
            $analyse->save();
            return redirect()->route('liste')->with('success', "Evaluation enregistré");
        }else{
            return redirect()->route('liste')->with('error',"vous n'avez pas le droit de faire l'évaluation");
        }
    }
    public function etat(){
    $risques = Analyse::where('id_nature','=',1)->orderBy('id','DESC')->get();
    $opportunites = Analyse::where('id_nature','=',2)->orderBy('id','DESC')->get();

    // dd($analyses->first()->mesures()->orderBy('dateplanifie','ASC')->first());
    // dd($analyses[0]->chantier()->get());
    //  $pdf = PDF::loadView('analyses.etat', compact('risques','opportunites'))->setPaper('a3', 'landscape');
    //return $pdf->download('etat.pdf');
      return view('analyses.etat',compact('risques','opportunites'));
    }

    public function etatpdf(){
        $risques = Analyse::where('id_nature','=',1)->orderBy('id','DESC')->get();
        $opportunites = Analyse::where('id_nature','=',2)->orderBy('id','DESC')->get();

        // dd($analyses->first()->mesures()->orderBy('dateplanifie','ASC')->first());
        // dd($analyses[0]->chantier()->get());
          $pdf = PDF::loadView('analyses.etat', compact('risques','opportunites'))->setPaper('a3', 'landscape');
        //return $pdf->download('etat.pdf');

        $html2pdf = new Html2Pdf('P', 'A4', 'fr');

        $content=  View::make('analyses.etat',compact('risques','opportunites'))->render()->output();


        $html2pdf->writeHTML($content);
        return $html2pdf->output();
        //  return view('analyses.etat',compact('risques','opportunites'));
    }
    public function saveEtat(Request $request){
        $parameters=$request->except(['_token']);
     //   dd($parameters);

       // dd($parameters['list_risk']);
      $list_risk = explode(',',$parameters['list_risk']);
       // dd($parameters);

            $aupire_aupire=$parameters['aupire_aupire'];
            $aupire_juste=$parameters['aupire_juste'];
            $aupire_aumieux=$parameters['aupire_aumieux'];
            $juste_aupire=$parameters['juste_aupire'];
            $juste_juste=$parameters['juste_juste'];
            $juste_aumieux=$parameters['juste_aumieux'];
            $aumieux_aupire=$parameters['aumieux_aupire'];
            $aumieux_juste=$parameters['aumieux_juste'];
            $aumieux_aumieux=$parameters['aumieux_aumieux'];

        $tableau_recap =  Tableau_recap::find(1);
        $tableau_recap->aupire_aupire=$aupire_aupire;
        $tableau_recap->aupire_juste=$aupire_juste;
        $tableau_recap->aupire_aumieux=$aupire_aumieux;
        $tableau_recap->juste_aupire=$juste_aupire;
        $tableau_recap->juste_juste=$juste_juste;
        $tableau_recap->juste_aumieux=$juste_aumieux;

        $tableau_recap->aumieux_aupire=$aumieux_aupire;
        $tableau_recap->aumieux_juste=$aumieux_juste;
        $tableau_recap->aumieux_aumieux=$aumieux_aumieux;
        $tableau_recap->save();

        foreach ($list_risk as $id):

            $risque = Analyse::find($id);

            if($id!=''){
                $risque->aupire=$parameters['prob_aupire_'.$id];
                $risque->juste=$parameters['prob_aujuste_'.$id];
                $risque->aumieux=$parameters['prob_aumieux_'.$id];
                $risque->save();
            }

        endforeach;

        $list_opportunite = explode(',',$parameters['list_opportunite']);
     //   dd($parameters);

        foreach ($list_opportunite as $id):

            $opportunite = Analyse::find($id);

            if($id!='') {
                $opportunite->aupire = $parameters['prob_aupire1_' . $id];
                $opportunite->juste = $parameters['prob_aujuste1_' . $id];
                $opportunite->aumieux = $parameters['prob_aumieux1_' . $id];
                $opportunite->save();

            }
        endforeach;
        return redirect()->route('etat')->with('success', "Etat enregistré");
    }
}
