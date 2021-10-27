<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AssetClassVehicle extends Model
{
    protected $table = 'ASSET_CLASS_VEHICLE';
    protected $connection  = 'oracle';
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = 'asset_class_id';

    public static function Get($id) {
    	$data = self::where('asset_class_id', $id)->first();

    	return $data;
    }
}
