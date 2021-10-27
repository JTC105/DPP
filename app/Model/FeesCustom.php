<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FeesCustom extends Model
{
    protected $table = 'fees_customs';

    public static function GetRowByPartyId($id) {
        $data = self::where('dealer_party_id', $id)->first();

        return $data;
    }

    public static function GetFeesLeaseByDealerPartyId($id) {
    	// return self::where('dealer_party_id', $id)->first()->fees_lease;
    	$d = self::where('dealer_party_id', $id)->first();

    	if($d==null)
    		$d = 0;
    	else
    		$d = $d->fees_lease;

    	return $d;
    }
}
