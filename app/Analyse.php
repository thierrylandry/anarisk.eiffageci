<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analyse extends Model
{
    //
    protected $table = "analyse";
    protected $fillable = ['*'];  // * => toutes les propriétés
}