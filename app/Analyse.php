<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analyse extends Model
{
    //
    protected $table = "analyse";
    protected $fillable = ['*'];  // * => toutes les propriétés

    public function  nature(){

        return $this->belongsTo('App\Nature', 'id_nature');
}
    public function  chantier(){

        return $this->belongsTo('App\Chantier', 'id_chantier');
    }
    public function  proprietaire(){

        return $this->belongsTo('App\Responsable', 'id_proprietaire');
    }
    public function  auteur(){

        return $this->belongsTo('App\User', 'id_auteur');
    }
    public function  mesures(){

        return $this->hasMany('App\Mesure', 'id_analyse');
    }

}