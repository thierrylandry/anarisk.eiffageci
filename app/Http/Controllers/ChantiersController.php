<?php

namespace App\Http\Controllers;

use App\Chantier;
use App\Pays;
use App\Tableau_recap;
use App\User;
use Illuminate\Http\Request;

class ChantiersController extends Controller
{
    //
    public function chantiers(){

        $chantiers = Chantier::all();
        $payss= Pays::all();

        return view('chantiers.chantier',compact('chantiers','payss'));
    }
    public function voir_chantier($id){

        $chantier= Chantier::find($id);
        $chantiers = Chantier::all();
        $payss= Pays::all();

        return view('chantiers.chantier',compact('chantier','chantiers','payss'));
    }
    public function supprimer_chantier($id){

        $chantier= Chantier::find($id);

        //on supprime le tableau recapitulatif du chantier
        $tableau_recap= Tableau_recap::where('id_chantier','=',$chantier->id);
        $tableau_recap->delete();
        $chantier->delete();
        return redirect()->back()->with('success', "Le chantier a été supprimé");
    }
    public function liste_chantier($email){

      $user= User::where('email','=',$email)->first();

        return $user->chantiers()->get();

    }
    public function save_chantier( Request $request)
    {
        $parameters = $request->except(['_token']);

        // Fournisseur::create($parameters);
        $date = new \DateTime(null);
        $chantier = new Chantier();
        $chantier->libelle = $parameters['nom'];
        $chantier->id_pays = $parameters['id_pays'];
        $chantier->save();
        //on crée imédiatement un tableau récapitulatif pour ce chantier
        $tableau_recap= new Tableau_recap();

        $tableau_recap->aupire_aupire=0;
        $tableau_recap->aupire_juste=0;
        $tableau_recap->aupire_aumieux=0;
        $tableau_recap->juste_aupire=0;
        $tableau_recap->juste_juste=0;
        $tableau_recap->juste_aumieux=0;
        $tableau_recap->aumieux_aupire=0;
        $tableau_recap->aumieux_juste=0;
        $tableau_recap->aumieux_aumieux=0;
        $tableau_recap->id_chantier=$chantier->id;
        $tableau_recap->save();
        return redirect()->back()->with('success', "Le chantier a été ajouté");
    }
    public function modifier_chantier( Request $request)
    {
        $parameters=$request->except(['_token']);



        $chantier=  Chantier::find($parameters['id']);

        // Fournisseur::create($parameters);
        $date= new \DateTime(null);


        $chantier->libelle = $parameters['nom'];
        $chantier->id_pays = $parameters['id_pays'];
        $chantier->save();

        return redirect()->back()->with('success',"Le chantier a été mis à jour");
    }
}
