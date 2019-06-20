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
}
