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
}
