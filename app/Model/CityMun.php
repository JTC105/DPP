<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CityMun extends Model
{
    protected $table = 'city_muns';

    public static function GetCityMunicipalities() {

    	$d = self::all();

    	return $d;
    }
}
