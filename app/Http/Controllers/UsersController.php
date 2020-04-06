<?php

namespace App\Http\Controllers;

use App\Acteur;
use App\Chantier;
use App\Chantier_principale;
use App\Nature;
use App\Pays;
use App\Responsable;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    //
    public function utilisateurs(){

        $users= User::all();
        $chantiers = Chantier::all();
        $roles= Role::all();
        $acteurs =Acteur::all();

        return view('utilisateurs.utilisateur',compact('users','chantiers','roles','acteurs'));
    }
    public function voir_utilisateur($id){

        $user= User::find($id);
        $users= User::all();
        $chantiers = Chantier::all();
        $roles= Role::all();
        $acteurs =Acteur::all();

        return view('utilisateurs.utilisateur',compact('users','chantiers','roles','acteurs','user'));
    }
    public function supprimer_utilisateur($id){

        $user= User::find($id);

            $user->delete();
        return redirect()->back()->with('success', "L'utilisateur a été supprimé");
    }
    public function save_utilisateur( Request $request)
    {
        $parameters = $request->except(['_token']);

        // Fournisseur::create($parameters);
        $date = new \DateTime(null);
        $utilisateur = new User();
        $utilisateur->nom = $parameters['nom'];
        $utilisateur->prenoms = $parameters['prenoms'];
        $utilisateur->email = $parameters['email'];
        $utilisateur->password = Hash::make( $parameters['password']);
        $utilisateur->id_acteur = $parameters['id_acteur'];

        $utilisateur->id_acteur = $parameters['id_acteur'];
      //  $utilisateur->slug = Str::slug($parameters['email'] . $date->format('dmYhis'));
        $utilisateur->save();
        if(isset($parameters['roles'])){
            $roles=$parameters['roles'];

            foreach ($roles as $role):
                $utilisateur->roles()->attach(Role::where('name',$role)->first());
            endforeach;
        }

        if(isset($parameters['id_chantier_principal'])){
            $leschantiers=$parameters['id_chantier_principal'];
            foreach ($leschantiers as $lechantier):
                $utilisateur->ChantierPrincipale()->attach(Chantier::where('libelle',$lechantier)->first());
            endforeach;
        }
        if(isset($parameters['chantiers'])) {
            $chantiers = $parameters['chantiers'];
            foreach ($chantiers as $chantier):
                $utilisateur->chantiers()->attach(Chantier::where('libelle', $chantier)->first());
            endforeach;
        }

        return redirect()->back()->with('success', "L'utilisateur a été ajouté");
    }
    public function modifier_utilisateur( Request $request)
    {
        $parameters=$request->except(['_token']);



        $utilisateur=  User::find($parameters['id']);

        // Fournisseur::create($parameters);
        $date= new \DateTime(null);


        $utilisateur->nom = $parameters['nom'];
        $utilisateur->prenoms = $parameters['prenoms'];
        $utilisateur->email = $parameters['email'];
        $utilisateur->id_acteur = $parameters['id_acteur'];



        //Hash::needsRehash($parameters['password'])
        //dd("ancien ".$utilisateur->password." nouveau :".$parameters['password']." Qaund on hash sa donne ceci".Hash::check($parameters['password'],$parameters['password']));
        //  dd(Hash::needsRehash($parameters['password']));

        if(Hash::needsRehash($parameters['password'])){

            $utilisateur->password =Hash::make($parameters['password']);
        }

       // $utilisateur->slug = Str::slug($parameters['email'] . $date->format('dmYhis'));
        $utilisateur->save();

        $utilisateur->roles()->detach();

       // $utilisateur->id_chantier_principal = $parameters['id_chantier_principal'];
        $utilisateur->chantiers()->detach();
        if(isset($parameters['id_chantier_principal'])){
            $leschantiers=$parameters['id_chantier_principal'];
            foreach ($leschantiers as $lechantier):
                $utilisateur->ChantierPrincipale()->attach(Chantier::where('libelle',$lechantier)->first());
            endforeach;
        }

        if(isset($parameters['roles'])){
            $roles=$parameters['roles'];
            foreach ($roles as $role):
                $utilisateur->roles()->attach(Role::where('name',$role)->first());
            endforeach;
        }


        $utilisateur->chantiers()->detach();


        if(isset($parameters['chantiers'])) {
            $chantiers=$parameters['chantiers'];
            foreach ($chantiers as $chantier):
                $utilisateur->chantiers()->attach(Chantier::where('libelle', $chantier)->first());
            endforeach;
        }

        return redirect()->back()->with('success',"L'utilisateur a été mis à jour");
    }
}
