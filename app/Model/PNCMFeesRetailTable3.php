<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PNCMFeesRetailTable3 extends Model
{
    protected $table = 'pncmfees_retailtable3';

    public static function GetRate($partytype, $amountfinance) {

    	$result = DB::select(DB::raw("SELECT rate FROM pncmfees_retailtable3 WHERE party_type = '$partytype' AND CAST(amt_threshold_from AS numeric(17,2) ) <= '$amountfinance' AND CAST(amt_threshold_to AS numeric(17,2) ) >= '$amountfinance'"));

		$result = $result[0]->rate;

        return $result;
    }
}
