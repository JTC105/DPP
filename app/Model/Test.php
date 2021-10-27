<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Test extends Model
{
    // protected $table = 'PARTY';//'DPPS_TEST';
    // protected $connection  = 'oracle';
    // public $incrementing = false;
    // public $timestamps = false;
    // protected $primaryKey = 'party_id';

    public static function Get(/*$dealerPartyId, $start, $end*/) {
    	$dealerPartyId = 70;
    	$start = '01-apr-2018';
    	$end = '30-apr-2018';
    	// return self::where("party_id", $id)->first();

    	// $data = DB::connection('oracle')->select(DB::raw("SELECT C.CONTRACT_ID, P1.PARTY_ID, P1.EXT_NAME CLIENT FROM PARTY P1 INNER JOIN CONTRACT C ON P1.PARTY_ID = C.CPARTY_ID WHERE ROWNUM < 4")); // gumana!!!

    	$data = DB::connection('oracle')->select(DB::raw("SELECT C.CONTRACT_ID, P1.PARTY_ID, P1.EXT_NAME CLIENT, D .EXT_NAME DEALER, cstat.FIELD_VALUE AS CONTRACT_STATUS, CS. VALUE AS CONTRACT_STATE, PR. NAME PRODUCT, AD.APP_DT APPROVE_DT FROM PARTY P1 INNER JOIN CONTRACT C ON P1.PARTY_ID = C.CPARTY_ID INNER JOIN PARTY D ON D .PARTY_ID = C.DEALER_ID AND D .PARTY_ID =".$dealerPartyId."INNER JOIN PRODUCT PR ON C.PRODUCT_ID = PR.PRODUCT_ID INNER JOIN CONTRACT_CFV cstat ON cstat.contract_id = c.contract_id AND cstat.contract_cfd_id = 66 AND cstat.field_value = 'Pending' INNER JOIN LOOKUPSET CS ON CS.LOOKUPSET_ID = C.CONTRACT_STATE AND C.CONTRACT_STATE > = 1150 AND C.CONTRACT_STATE < 11130 INNER JOIN ( SELECT DISTINCT N.CONTRACT_ID, SUBJECT, MAX (N.ACTIVITY_DT) AS APP_DT FROM NOTE N WHERE N.SUBJECT LIKE '%Approved; Status set to Completed%' GROUP BY N.CONTRACT_ID, SUBJECT ) AD ON AD.CONTRACT_ID = C.CONTRACT_ID WHERE AD.APP_DT BETWEEN '".$start."' AND '".$end."' ORDER BY 7 DESC"));

    	// $data = $data[0]->contract_id;

        return $data;
    }	
}
