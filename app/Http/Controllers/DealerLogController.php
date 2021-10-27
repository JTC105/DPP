<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Model\ContractRequirementLog;
use App\Model\DealerInfo;
use App\Model\Permission;
use App\Model\TFSPHSignatoryDetail;
use App\Model\User;

class DealerLogController extends Controller
{
    public static function WriteLog($param, $logdata) {
	    
    	
    	$datetimeval = Carbon::now('Asia/Manila')->format('Y-m-d H:i:s');
    	$content = "[".$datetimeval."] ".auth()->user()->username." ";
    	switch ($param) {
            case 'approve-con-add':
                $dealer = DealerInfo::where('party_id',$logdata->dealer_id)->first();
                $content .= "added approved contract number ".$logdata->contract_id." to dealer ".$dealer->party_id." : ".$dealer->dealer_name;
                break;
    		case 'contract-add':
    		case 'contract-edit':
    		case 'contract-print':

    			switch ($param) {
    				case 'contract-add':
    					$w1 = "added";
    					$w2 = "to";
    					break;
		    		case 'contract-edit':
		    			$w1 = "updated";
    					$w2 = "of";
		    			break;
		    		case 'contract-print':
		    			$w1 = "printed";
    					$w2 = "of";
		    			break;
    			}

    			$dealer = DealerInfo::where('party_id',$logdata->dealer_id)->first();
    			$content .= $w1." contract number ".$logdata->contract_id." ".$w2." dealer ".$dealer->party_id." : ".$dealer->dealer_name;
    			break;
    		case 'contract-upload-log':
    			$content .= "Processed file/s ".ContractRequirementLog::GetDataFileLogForAdminLog($logdata->conreqs_ids)." in contract number ".$logdata->contract_id;
    			break;
            case 'contract-upload-con-req':
                $content .= "Uploaded file in contract number ".$logdata->contract_id;
                break;
    	}
	    $date = Carbon::now()->format('Y-m-d');
		$myfile = file_put_contents('logs/dealerlogs/'.auth()->user()->dealer_party_id.'_'.$date.'-logs.txt', $content.PHP_EOL , FILE_APPEND | LOCK_EX);
    }
}
