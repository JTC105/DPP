<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Model\ContractRequirementLog;
use App\Model\DealerInfo;
use App\Model\Permission;
use App\Model\TFSPHSignatoryDetail;
use App\Model\User;

class AdminLogController extends Controller
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
            case 'signa-loc-edit':
                $content .= "updated local signatories of dealer ".$logdata->party_id." : ".$logdata->dealer_name;
                break;
            case 'signa-tfsph-add':
            case 'signa-tfsph-edit':
                
                switch ($param) {
                    case 'signa-tfsph-add':
                        $w1 = "added";
                        break;
                    case 'signa-tfsph-edit':
                        $w1 = "updated";
                        break;
                }

                $content .= $w1." ".$logdata->name." on TFSPH signatories record";

                break;
            case 'signa-tfsph-assign':
                $dinfo = DealerInfo::GetDealerInfo($logdata['did']);
                $sigdetail1 = TFSPHSignatoryDetail::GetSignatoryDetail($logdata['sig']->signatory1_id);
                $sigdetail2 = TFSPHSignatoryDetail::GetSignatoryDetail($logdata['sig']->signatory2_id);

                if($sigdetail1!=null)
                    $sigdetail1 = $sigdetail1->name;
                else
                    $sigdetail1 = "<none>";

                if($sigdetail2!=null)
                    $sigdetail2 = $sigdetail2->name;
                else
                    $sigdetail2 = "<none>";

                $content .= "asssigned ".$sigdetail1." and ".$sigdetail2." as TFSPH signatory of dealer ".$dinfo->party_id." : ".$dinfo->dealer_name;
                break;
            case 'form-temp-add':
            case 'form-temp-edit':
            // case 'form-temp-print':

                switch ($param) {
                    case 'form-temp-add':
                        $w1 = "added";
                        break;
                    case 'form-temp-edit':
                        $w1 = "updated";
                        break;
                    // case 'form-temp-print':
                    //  $w1 = "printed";
                    //  break;
                }

                $content .= $w1." ".$logdata." form template";
                break;
            case 'uadmin-add':
                $content .= "added ".$logdata." as admin";
                break;
            case 'user-add':
                $content .= "added ".$logdata." as user";
                break;
            case 'user-edit':
                $content .= "updated ".$logdata." as user";
                break;
            case 'udealer-add':
                $content .= "added dealer ".$logdata->party_id." : ".$logdata->dealer_name;
                break;
            case 'udealer-edit':
                $content .= "updated dealer ".$logdata->party_id." : ".$logdata->dealer_name;
                break;
            case 'vehicle-add':
                $content .= "added ".$logdata." in vehicle list";
                break;
            case 'vehicle-edit':
                $content .= "updated ".$logdata." in vehicle list";
                break;
            case 'cm-add':
                $content .= "added ".$logdata." in city/municipality list";
                break;
            case 'cm-edit':
                $content .= "updated ".$logdata." in city/municipality list";
                break;
            case 'role-add':
                $content .= "added ".$logdata." in role list";
                break;
            case 'role-edit':
                $content .= "updated ".$logdata." in role list";
                break;
            case 'role-assign-users':
                $content .= "assigned user/s ".User::GetUsernamesofList($logdata['users'])." to ".$logdata['role'];
                break;
            case 'role-assign-perms':
                $content .= "assigned permission/s ".Permission::GetPermissionDNameofList($logdata['perms'])." to ".$logdata['role'];
                break;
            case 'dfees-add':
            case 'dfees-edit':

                switch ($param) {
                    case 'dfees-add':
                        $w1 = "added";
                        $p1 = " in dealer fees record";
                        break;
                    case 'dfees-edit':
                        $w1 = "updated";
                        $p1 = " from table ".$logdata['prev']." in dealer fees record.";
                        $p2 = " Updated CM Fees Record: (CM Fee 2 Party: ".$logdata['fc']->fees_2party." from ".$logdata['prevCMFee2'].") (CM Fee 3 Party: ".$logdata['fc']->fees_2party." from ".$logdata['prevCMFee3'].") (CM Lease: ".$logdata['fc']->fees_lease." from ".$logdata['prevCMFeeLease'].")";

                        break;
                }
               
                $dname = DealerInfo::GetDealerInfo($logdata['df']->dealer_party_id)->dealer_name;
                $content .= $w1." dealer ".$logdata['df']->dealer_party_id." : ".$dname." to table ".$logdata['df']->table_no.$p1.$p2;
                break;
            case 'dfees-tableref-add':
            case 'dfees-tableref-edit':

                switch ($param) {
                    case 'dfees-tableref-add':
                        $w1 = "added";
                        $p1 = " on table ".$logdata['tname'];
                        break;
                    case 'dfees-tableref-edit':
                        $w1 = "updated";
                        $p1 = " from previous range (".$logdata['prevfrom']." to ".$logdata['prevto'].") and previous rate ".$logdata['prevrate']." on table ".$logdata['tname'];
                        break;
                }
                $content .= $w1." range (".$logdata['detail']->amt_threshold_from." to ".$logdata['detail']->amt_threshold_to.") and rate ".$logdata['detail']->rate.$p1;
                break;
            default:
                # code...
                break;
        }

        $date = Carbon::now()->format('Y-m-d');
        $myfile = file_put_contents('logs/adminlogs/'.$date.'-logs.txt', $content.PHP_EOL , FILE_APPEND | LOCK_EX);
    }
}
