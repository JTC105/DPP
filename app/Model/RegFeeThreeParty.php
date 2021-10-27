<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RegFeeThreeParty extends Model
{
    protected $table = 'regfee_threeparty';

    public static function GetRegFee($amt) {
    	$data = self::where('range1', '<=', $amt)->where('range2', '>=', $amt)->first();

    	$data = $data->encumbrance+$data->rd;

    	return $data;
    }
}
