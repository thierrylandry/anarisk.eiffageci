<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    //
    protected  $table="responsable";
    protected $fillable = [
        'id','nom','prenoms','id_acteur'
    ];
}