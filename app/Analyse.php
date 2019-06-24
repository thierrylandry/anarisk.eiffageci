<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analyse extends Model
{
    //
    protected  $table="chantier";
    protected $fillable = [
        'id','description',detail,date,code,causes,conséquences,probabiliteAvant,severiteAvant,planingAvavant,coutAvant,probabiliteApres,severiteAprs
    ];
}
