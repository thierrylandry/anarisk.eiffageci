<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acteur extends Model
{
    //
    protected  $table="acteur";
    protected $fillable = [
        'id','libelle'
    ];


}
