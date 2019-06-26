<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pays extends Model
{
    //
    protected  $table="pays";
    protected $fillable = [
        'id','code','alpha2','alpha3','nom_en_gb','nom_fr_fr','created_at','updated_at'
    ];

    public function chantiers(){

        return $this->hasMany('App\Chantier','id_pays');
        //return $this->belongsTo(Chantier::class, "id_pays");
    }
}
