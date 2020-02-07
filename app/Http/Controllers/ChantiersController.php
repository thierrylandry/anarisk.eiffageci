<?php

namespace App\Http\Controllers;

use App\Chantier;
use App\Pays;
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

        $chantier->delete();
        return redirect()->back()->with('success', "Le chantier a été supprimé");
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
