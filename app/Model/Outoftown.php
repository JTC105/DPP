<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Outoftown extends Model
{
    protected $table = 'outoftowns';

    public static function GetOutoftowns() {

    	$d = self::all();

    	return $d;
    }

}
