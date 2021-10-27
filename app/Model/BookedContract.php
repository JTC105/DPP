<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class BookedContract extends Model
{
    public static function CheckIfContractIsBooked($dealerPartyId, $contractId) {

    	$data = DB::connection('oracle')->select(DB::raw("SELECT C.CONTRACT_ID, D .EXT_NAME DEALER, cstat.FIELD_VALUE AS CONTRACT_STATUS, CS. VALUE AS CONTRACT_STATE, CRS. VALUE AS CREDIT_STATE, AD.APP_DT APPROVE_DT FROM PARTY P1 INNER JOIN CONTRACT C ON P1.PARTY_ID = C.CPARTY_ID INNER JOIN PARTY D ON D .PARTY_ID = C.DEALER_ID AND C.DEALER_ID = ".$dealerPartyId." INNER JOIN CONTRACT_CFV cstat ON cstat.contract_id = c.contract_id AND cstat.contract_cfd_id = 66 AND cstat.field_value <> 'Pending' INNER JOIN LOOKUPSET CS ON CS.LOOKUPSET_ID = C.CONTRACT_STATE AND C.CONTRACT_STATE >= 11130 INNER JOIN LOOKUPSET CRS ON CRS.LOOKUPSET_ID = C.CREDIT_STATE AND C.CREDIT_STATE IN (12050, 12060) INNER JOIN ( SELECT DISTINCT N.CONTRACT_ID, SUBJECT, MAX (N.ACTIVITY_DT) AS APP_DT FROM NOTE N WHERE N.SUBJECT LIKE '%Approved; Status set to Completed%' GROUP BY N.CONTRACT_ID, SUBJECT ) AD ON AD.CONTRACT_ID = C.CONTRACT_ID WHERE c.contract_id = ".$contractId.""));

        return $data;
    }
}
