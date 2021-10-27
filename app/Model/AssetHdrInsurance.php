<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AssetHdrInsurance extends Model
{
    protected $table = 'ASSET_HDR_INSURANCE';
    protected $connection  = 'oracle';
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = 'asset_hdr_insurance_id';

    public static function Get($id) {
    	$data = self::where('asset_hdr_id', $id)->first();

    	return $data;
    }
}
