<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Priorite extends Model
{
    //
    protected  $table="priorite";
    protected $fillable = [
        'id','libelle'
    ];
}
