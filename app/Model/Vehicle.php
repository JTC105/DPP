<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicles';

    public static function GetVehicles() {

    	$d = self::all();

    	return $d;
    }

    public static function GetVehicleIdByName($name) {
    	$r = self::where('name', $name)->first();

    	if($r!=null)
    		return $r->id;

    	return null;
    }

    public static function CheckIfVehicleExist($name) {
      $name = strtoupper($name);
      $r = self::where('name', $name)->first();

      if($r==null) {
        self::CreateVehicle($name);
      } 
    }

    public static function CreateVehicle($name) {
       
        $v = new Vehicle();
        $v->name = $name;
        $v->save();
    }
}
