<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chantier extends Model
{
    //
    protected  $table="chantier";
    protected $fillable = [
        'id','libelle'
    ];
    public function responsables(){

        return $this->hasMany('App\Responsable','id_chantier');
    }

    public function pays(){

        return $this->belongsTo('App\Pays','id_pays');
    }
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_chantier', 'chantier_id', 'user_id');
    }
}
