<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PNCMFeesRetailTable1 extends Model
{
    protected $table = 'pncmfees_retailtable1';

    public static function GetRate($partytype, $amountfinance) {

    	// $result = DB::select(DB::raw("SELECT rate FROM pncmfees_retailtable1 WHERE party_type = '$partytype' AND CAST(amt_threshold_from AS numeric(17,2) ) <= '$amountfinance' AND CAST(amt_threshold_to AS numeric(17,2) ) >= 500000"));

    	$result = DB::select(DB::raw("SELECT rate FROM pncmfees_retailtable1 WHERE party_type = '$partytype' AND CAST(amt_threshold_from AS numeric(17,2) ) <= '$amountfinance' AND CAST(amt_threshold_to AS numeric(17,2) ) >= '$amountfinance'"));

    	// Log:info($result);

		$result = $result[0]->rate;

        return $result;
    }

}
