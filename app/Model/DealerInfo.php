<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DealerInfo extends Model
{
    protected $table = 'dealer_infos';

    public static function GetDealerPartyId() {
        // if(auth()->user()->hasRole('admin')) {
        //     $dealerPartyId = session()->get('dpid');
        // }
        // else if(auth()->user()->hasRole('dealer')) {
        //     $dealerPartyId = auth()->user()->dealer_party_id;
        // }

        if(auth()->user()->hasRole('dealer') || auth()->user()->hasRole('lo')) {
            $dealerPartyId = auth()->user()->dealer_party_id;
        } else {
            $dealerPartyId = session()->get('dpid');
        }
        
        return $dealerPartyId;
    }

    public static function GetDealers() {
        $dealers =  DealerInfo::orderBy('dealer_name', 'ASC')->get();
        $result = array();

        $i = 0;
        foreach ($dealers as $dealer) {
            $result[$i]['pid'] = $dealer->party_id;
            $result[$i]['name'] = $dealer->dealer_name;
            $i++;
        }

        return $result;
    }

    public function CheckIfContractIdExist($id) {
        $d = Contract::where('dealer_id', $this->party_id)->where('contract_id', $id)->first();

        if($d!=null)
            return true;

        return false;
    }

    public static function CheckIfDealerNameOrPartyIdExist($dealerName, $partyId) {
        $data = self::where('dealer_name', $dealerName)->orWhere('party_id', $partyId)->first();
        // dd($data);
        if($data!=null)
            return true;

        return false;

    }

    public static function GetDealersNotExistInPNCMDealersRef() {
        $data = self::whereNotIn('party_id', function($query) {
            $query->select('dealer_party_id')
             ->from(with(new PNCMFeesDealerRef)->getTable());
            })->get();

        // dd($data);

        return $data;
    }

    public static function GetDealerInfo($dealerPartyId) {

        $dealer = self::where('party_id', $dealerPartyId)->first();
        //dd($dealerPartyId);
        return $dealer;
    }

    public static function GetDealerInfoIfAdmin() {
        $dealer = self::where('party_id', session()->get('dpid'))->first();
        // dd($dealer);
        return $dealer;
    }

    public static function GetDealerInfoForContract() {
        // if(auth()->user()->hasRole('admin')) {
        //     $dealerPartyId = session()->get('dpid');
        // }
        // else if(auth()->user()->hasRole('dealer')) {
        //     $dealerPartyId = auth()->user()->dealer_party_id;
        // }

        if(auth()->user()->hasRole('dealer') || auth()->user()->hasRole('lo')) {
            $dealerPartyId = auth()->user()->dealer_party_id;
        } else {
            $dealerPartyId = session()->get('dpid');
        }

        $dealer = self::where('party_id', $dealerPartyId)->first();
        
        return $dealer;
    }

    public static function GetLocalAndTFSPHSignatoriesPerDealer() {
        $dealers =  DealerInfo::orderBy('dealer_name', 'ASC')->get();
        $result = array();
        
        $i = 0;
        foreach ($dealers as $dealer) {
            $result[$i]['pid'] = $dealer->party_id;
            $result[$i]['name'] = $dealer->dealer_name;
            $result[$i]['local'] = self::GetSignatories($dealer->party_id);
            $result[$i]['tfsph'] = TFSPHSignatory::GetTFSPHSignatoriesByDealerId($dealer->party_id);
            $i++;
        }
        // dd($result);
        return $result;
    }

    public static function GetSignatories($dealerPartyId) {

        $dealer = self::where('party_id', $dealerPartyId)->first();
        // dd($dealer);
        $signatories = array();

        $sig = [
            'id'    => 0,
            'name'  => $dealer->signatory1,
            'tin'   => $dealer->signatory1_tin,
            'govid' => $dealer->signatory1_govtid
        ];

        $signatories[] = $sig;

        $sig = [
            'id'    => 1,
            'name'  => $dealer->signatory2,
            'tin'   => $dealer->signatory2_tin,
            'govid' => $dealer->signatory2_govtid
        ];

        $signatories[] = $sig;

        // dd($signatoties);

        return $signatories;
    }

    // For the labeling the TIN and Gov ID of local signatories -- adding and editing contract
    public static function GetSignatory($id) {

        $signatories = self::GetSignatories(self::GetDealerInfoForContract()->party_id);//self::GetSignatories(auth()->user()->dealer_party_id);

        if($id < 0 || $id > 1)
            $signatories = null;
        else
            $signatories = $signatories[$id];

        return $signatories;

    }

    public static function IsMetro($dealerPartyId) {
        $result = self::where('party_id', $dealerPartyId)->first();

        $result = $result->is_metro;

        return $result;
    }

    public function GetTFSPHSignatories() {
        $signatories = TFSPHSignatory::GetTFSPHSignatoriesByDealerId($this->party_id);

        return $signatories;
    }

    public static function GetPartyIdByPartyNo($dealerPartyNo) {

        $data = DB::connection('oracle')->select(DB::raw("SELECT  PARTY_ID FROM PARTY WHERE PARTY_NO =".$dealerPartyNo));
        if($data!=null)
            $data = $data[0]->party_id;
        // Log::info($data);
        return $data;
    }
}
