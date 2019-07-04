<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mesure extends Model
{
    //
    protected $table = "mesure";
    protected $fillable = ['*'];  // * => toutes les propriétés
    public function  analyse(){

        return $this->belongsTo('App\Analyse', 'id_analyse');
    }
    public function  auteur(){

        return $this->belongsTo('App\User', 'id_auteur');
    }
    public function  priorite(){

        return $this->belongsTo('App\Priorite', 'id_priorite');
    }
    public function  statut(){

        return $this->belongsTo('App\Statut', 'id_statut');
    }

    public function  responsable(){

        return $this->belongsTo('App\Responsable', 'id_responsable');
    }
    public function  acteur(){

        return $this->belongsTo('App\Acteur', 'id_acteur');
    }
    public function  periodicite(){

        return $this->belongsTo('App\Periodicite', 'id_periodicite');
    }
}
