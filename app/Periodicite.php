<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodicite extends Model
{
    //
    protected  $table="periodicite";
    protected $fillable = [
        'id','libelle'
    ];
}
