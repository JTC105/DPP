<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Alert;
use Carbon\Carbon;

use App\Model\AppContract;
use App\Model\Contract;
use App\Model\ContractsHistory;
use App\Model\Vehicle;

class ContractHistoryController extends Controller
{
    public function index($id)
    {
    	$history = ContractsHistory::where('contract_id', $id)->get();

    	$data = [
    		'history' 		=> $history,
    		'contractId'	=> $id,
    	];

	   return view('pages.admin.contractshistories', compact('data'));
    }

    public function view($id) 
    {
    	$data = ContractsHistory::find($id);
	
        return view('pages.admin.contracthistoryview', compact('data'));
    }

    public function sync($id) 
    {
    	$contract = Contract::find($id);
    	$contractId = $contract->contract_id;

    	$otherContract = AppContract::GetAppConDetailByContract($contractId, $contract->dealer_id);
    	$otherInsuranceDetails = AppContract::GetInsuranceDetails($contractId);
    	$otherAssetClassVehicleDetails = AppContract::GetAssetClassVehicleDetails($contractId);

    	$isChange = $this->CheckIfDetailsChange($contract, $otherContract, $otherInsuranceDetails, $otherAssetClassVehicleDetails);

    	if($isChange) {
    		// change
    		
    		$this->SaveDetailsToHistory($contract);
    		$this->SyncDetails($contract, $otherContract, $otherInsuranceDetails, $otherAssetClassVehicleDetails);

    		Alert::success('','Updated Contract.','');

    	} else {
    		// notify user

    		 Alert::success('','Not updated. No changes were made.','');
    	}

    	return back();
    }

    function SaveDetailsToHistory($data)
    {
    	$contract = new ContractsHistory();

        $productType = $data->product_type;
        $retailType = $data->retail_type;

        $contract->contract_id      = $data->contract_id;
        $contract->product_type     = $productType;
        $contract->retail_type     = $retailType;
        $contract->is_fleet     =  $data->is_fleet;
        $contract->firstduedate     = $data->firstduedate ;
        $contract->dateaccepted     = $data->dateaccepted;
        $contract->party_type     = $data->party_type;

        // Client
        $contract->client_name     = strtoupper($data->client_name);
        $contract->client_marital     = $data->client_marital;
        $contract->client_govid     = $data->client_govid;
        $contract->client_dateissued     = $data->client_dateissued;
        $contract->client_tin     = strtoupper($data->client_tin);        
        $contract->client_nationality     = strtoupper($data->client_nationality);
        $contract->client_address     = strtoupper($data->client_address);
        $contract->client_city_mun     = $data->client_city_mun;

        // Comaker
        $contract->comaker_name     = strtoupper($data->comaker_name);
        $contract->comaker_marital     = $data->comaker_marital;
        $contract->comaker_govid     = strtoupper($data->comaker_govid );
        $contract->comaker_dateissued     = $data->comaker_dateissued;
        $contract->comaker_tin     = $data->comaker_tin ;
        
        // Witness
        $contract->witness1_name     = strtoupper($data->witness1_name);
        $contract->witness1_tin     = strtoupper($data->witness1_tin );
        $contract->witness2_name     = strtoupper($data->witness2_name);
        $contract->witness2_tin     = strtoupper($data->witness2_tin);

        // Dealer
        $contract->dealer_id     = $data->dealer_id;// party id

        if($productType == 2 && $retailType == 2) {
            $contract->dealer_signatory     = strtoupper($data->dealer_signatory);
            $contract->dealer_signatory_tin     = strtoupper($data->dealer_signatory_tin);
            $contract->dealer_signatory_govid     = strtoupper($data->dealer_signatory_govid);
        }

        // Vehicle
        $contract->vehicle_name     = strtoupper($data->vehicle_name);
        $contract->vehicle_color     = strtoupper($data->vehicle_color);
        $contract->vehicle_engine     = strtoupper($data->vehicle_engine);
        $contract->vehicle_chasis     = strtoupper($data->vehicle_chasis);
        $contract->vehicle_make     = strtoupper($data->vehicle_make);
        $contract->vehicle_yearmodel     = $data->vehicle_yearmodel;
        $contract->vehicle_consticker     = strtoupper($data->vehicle_consticker);
        $contract->vehicle_usage     = $data->vehicle_usage;

        // Insurance
        $contract->insurer     = strtoupper($data->insurer);
        $contract->insurance_period     = $data->insurance_period;
        $contract->insurance_liability     = $data->insurance_liability;
        $contract->insurance_effective_date     = $data->insurance_effective_date;
        $contract->insurance_expiry_date    = $data->insurance_expiry_date;
        $contract->insurance_comment     = $data->insurance_comments;


        // Finance
        $contract->term     = $data->term;
        $contract->add_on_rate     = $data->add_on_rate;
        $contract->unit_cost     = $data->unit_cost;
        $contract->downpayment     = $data->downpayment;
        $contract->amount_finance     = $data->amount_finance;
        $contract->monthly_installment     = $data->monthly_installment;
        $contract->is_outoftown     = $data->is_outoftown;
        $contract->province         = $data->province ;
        $contract->outoftown_charge     = $data->outoftown_charge;
        $contract->dst     = $data->dst;
        $contract->leaseretail_fee     =  $data->leaseretail_fee;
        $contract->total_fees     = $data->total_fees;
        $contract->other_charges     = $data->other_charges;
        $contract->balloon     = $data->balloon ;

        // $sss = trim(request('cusReqs'), '""');
        // dd(request('cusReqs'));
        $contract->custom_reqs = $data->custom_reqs;

        $contract->is_onemonthadvance     = $data->is_onemonthadvance;
        $contract->is_cicharge     = $data->is_cicharge;

        $contract->revision_number = $this->GetRevisionNumber($contract->contract_id);
        $contract->revisiondate = Carbon::now()->format('Y-m-d');
        $contract->revisor_username = auth()->user()->username;

        $contract->save();
    }

    function SyncDetails($contract, $oC, $oI, $oA) {


        // Client
        $contract->client_name     = strtoupper($oC[0]->client);
        $contract->client_address     = strtoupper($oC[0]->client_address);

        // Comaker
        $contract->comaker_name     = strtoupper($oC[0]->comaker);

        // Vehicle
        Vehicle::CheckIfVehicleExist($oC[0]->unit);
        $contract->vehicle_name     = Vehicle::GetVehicleIdByName($oC[0]->unit);
        $contract->vehicle_color     = strtoupper($oA[0]->colour);
        $contract->vehicle_engine     = strtoupper($oA[0]->engine_no);
        $contract->vehicle_chasis     = strtoupper($oA[0]->chassis_no);
        $contract->vehicle_yearmodel     = $oC[0]->model;
        $contract->vehicle_consticker     = strtoupper($oA[0]->vin_no);

        // Insurance
        if($oI != null) {
            $effective = Carbon::parse($oI[0]->input_dt)->format('Y-m-d');
            $expiry = Carbon::parse($oI[0]->expiry_dt)->format('Y-m-d');


            $contract->insurance_period     = ($expiry == '9998-12-31') ? 'Perpetual' : 'Specific Period';
            $contract->insurance_liability     = $oI[0]->amount;
            $contract->insurance_effective_date     = $effective;
            $contract->insurance_expiry_date    = $expiry;
            $contract->insurance_comment     = $oI[0]->comments;
        }


        // Finance
        $contract->term     = $oC[0]->term;
        $contract->unit_cost     = $oC[0]->unit_cost;
        $contract->downpayment     = $oC[0]->downpayment;
        $contract->amount_finance     = $oC[0]->amt_financed;

        $contract->save();
    }

    function GetRevisionNumber($contractId) {
    	$r = ContractsHistory::where('contract_id', $contractId)->orderBy('created_at', 'desc')->first();

    	if($r!=null) {
    		return $r->revision_number+1;
    	} else {
    		return 1;
    	}
    }

    public function CheckIfDetailsChange($main, $oC, $oI, $oA) {

    	if($this->CompareContract($main, $oC))
    		return true;

        if($oI!=null)
    	if($this->CompareInsurace($main, $oI))
    		return true;

    	if($this->CompareAsset($main, $oA))
    		return true;

    	return false;
    }

    public function CompareContract($m, $o) {
        $isChange = false;

        if(strtoupper($m->client_name) != strtoupper($o[0]->client))
            $isChange = true;

        if(strtoupper($m->client_address) != strtoupper($o[0]->client_address))
            $isChange = true;

        if(strtoupper($m->comaker_name) != strtoupper($o[0]->comaker))
            $isChange = true;

        if(strtoupper($m->GetVehicleName($m->vehicle_name)) != strtoupper($o[0]->unit))
            $isChange = true;

        if($m->vehicle_yearmodel != $o[0]->model)
            $isChange = true;

        if($this->ConvertStringToNum($m->unit_cost) != $this->ConvertStringToNum($o[0]->unit_cost))
            $isChange = true;

        if($this->ConvertStringToNum($m->downpayment) != $this->ConvertStringToNum($o[0]->downpayment))
            $isChange = true;

        if($this->ConvertStringToNum($m->amount_finance) != $this->ConvertStringToNum($o[0]->amt_financed))
            $isChange = true;

        if($m->term != $o[0]->term)
            $isChange = true;

        //approval reqs

        return $isChange;
    }

    public function CompareInsurace($m, $o)
    {
    	$isChange = false;

    	if(Carbon::parse($m->insurance_effective_date)->format('Y-m-d') != Carbon::parse($o[0]->input_dt)->format('Y-m-d'))
    		$isChange = true;

    	if(Carbon::parse($m->insurance_expiry_date)->format('Y-m-d') != Carbon::parse($o[0]->expiry_dt)->format('Y-m-d'))
    		$isChange = true;

    	 $mL = intval(preg_replace("/[^-0-9\.]/","",$m->insurance_liability)); 
    	 $mO = intval(preg_replace("/[^-0-9\.]/","",$o[0]->amount)); 

    	 if($mL != $mO)
    	 	$isChange = true;

    	 if($m->insurance_comment != $o[0]->comments)
    	 	$isChange = true;

    	 return $isChange;
    }

    public function CompareAsset($m, $o) 
    {
    	$isChange = false;

    	if($m->vehicle_consticker != $o[0]->vin_no && $o[0]->vin_no != " ")
    		$isChange = true;

    	if($m->vehicle_chasis != $o[0]->chassis_no)
    		$isChange = true;

    	if($m->vehicle_engine != $o[0]->engine_no)
    		$isChange = true;

    	if($m->vehicle_color != $o[0]->colour)
    		$isChange = true;

    	return $isChange;
    }

    public function ConvertStringToNum($value) {
    	return intval(preg_replace("/[^-0-9\.]/","",$value)); 
    }
}
