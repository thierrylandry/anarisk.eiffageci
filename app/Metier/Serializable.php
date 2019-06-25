<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 25/06/2019
 * Time: 09:24
 */

namespace App\Metier\Json;


abstract class  Serializable
{
    public function __toString()
    {
        return json_encode(get_object_vars($this));
    }
}