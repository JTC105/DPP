<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

use PhpOffice\PhpSpreadsheet\Writer\IWriter;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

use App\Model\AppContract;
use App\Model\AssetClassVehicle;
use App\Model\AssetHdrInsurance;
use App\Model\BookedContract;
use App\Model\CityMun;
use App\Model\Contract;
use App\Model\ContractRequirementLog;
use App\Model\CustomField;
use App\Model\DealerInfo;
use App\Model\FeesCustom;
use App\Model\Outoftown;
use App\Model\Permission;
use App\Model\PNCMFeesDealerRef;
use App\Model\PNCMFeesRetailTable1;
use App\Model\PNCMFeesRetailTable2;
use App\Model\PNCMFeesRetailTable3;
use App\Model\Vehicle;

use Alert;
use Carbon\Carbon;

use App\Model\Test;
use DB;

class ContractController extends Controller
{
    //******************* ADMIN
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminindex(Request $request) {       


      if(request('cfilterType')==null || request('cfilterType') == 0){

        $filterType = "By Date Range";
        $filter = '0';
        $start = request('cfilterStartDate');
        $end = request('cfilterEndDate');

        $startC = Carbon::parse($start);
        $endC = Carbon::parse($end);

        if (Permission::IfDateRestricted()) {
          $length = $endC->diffInDays($startC);

          if($start == null || $length > 31)
            $start = Carbon::now('Asia/Manila')->format('m/d/Y');
          if($end == null || $length > 31)
            $end = Carbon::now('Asia/Manila')->format('m/d/Y');

          if ($length > 31) {
              Alert::success('','Cannot generate more than 31 days.','');
           }
        } else {
           if($start == null)
            $start = Carbon::now('Asia/Manila')->format('m/d/Y');
          if($end == null)
            $end = Carbon::now('Asia/Manila')->format('m/d/Y');
        }

        $data = Contract::GetContractCountPerDealerByDateRange($start,$end);

      } else {
        

        $filterType = "All Contracts";
        $filter = '1';
        $start = Carbon::now('Asia/Manila')->format('m/d/Y');
        $end = Carbon::now('Asia/Manila')->format('m/d/Y');
        $data = Contract::GetContractCountPerDealer();
      }

      $dataFilter = [
        'type'    => $filterType,
        'filter'  => $filter,
        'start'   => $start,
        'end'     => $end,
      ];

      return view('pages.admin.dealercontracts', compact('data', 'dataFilter'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminviewindex(Request $request, $id) {
        session(['dpid' => $id]); //dealer party id

        return $this->index($request);
    }

    public function admineditconreqs() {
      // Get checked in Checklist
        $crIds = CustomField::GetConReqFieldValueByDescAndFieldId(22);
        $crIds = explode(',', $crIds);

        for($i=0; $i<21; $i++) {
          $data[$i]['text'] = CustomField::GetConReqFieldValueByDescAndFieldId($i+1);

          if($this->CheckIfArrayContains($crIds, $i))
            $data[$i]['checked'] = 'checked';
          else
            $data[$i]['checked'] = '';
        }

      return view('pages.admin.conreqform', compact('data'));
    }

    public function adminupdateconreqs(Request $request) {
      $temp = ContractRequirementLog::GetDataForConReqIds($request);
      if($temp['ids']!=null)  
          $temp = implode(",", $temp['ids']);
      else
          $temp = null;

      $model = CustomField::where('field_id', '=', 22)->first();
      $model->field_value = $temp;
      $model->save();

      Alert::success('','Updated Contract Requirements Settings.','');

      return back();
    }

    //******************* DEALER
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = DealerInfo::GetDealerPartyId();

        $start = Carbon::now('Asia/Manila')->format('m/d/Y');
        $end = Carbon::now('Asia/Manila')->format('m/d/Y');
        $cID = 0;
        $cName = " ";

        if(request('acfilterType')==null || request('acfilterType') == 0){// by Date Range
          
          $filterType = "By Date Range";
          $filter = '0';
          $start = request('cfilterStartDate');
          $end = request('cfilterEndDate');

          $startC = Carbon::parse($start);
          $endC = Carbon::parse($end);

        if (Permission::IfDateRestricted()) {
          $length = $endC->diffInDays($startC);

          if($start == null || $length > 31)
            $start = Carbon::now('Asia/Manila')->format('m/d/Y');
          if($end == null || $length > 31)
            $end = Carbon::now('Asia/Manila')->format('m/d/Y');

          if ($length > 31) {
            Alert::success('','Cannot generate more than 31 days.','');
          } 
        } else {
          if($start == null)
            $start = Carbon::now('Asia/Manila')->format('m/d/Y');
          if($end == null)
            $end = Carbon::now('Asia/Manila')->format('m/d/Y');

        }

          $data = Contract::GetContractOfDealerByDateRange($id,$start,$end);

        } else if (request('acfilterType') == 1){ // by Contract
         

          $filterType = "By Contract";
          $filter = '1';

          $cID = request('cID');

          $data = Contract::GetContractByContractId($id, $cID);

        } else if(request('acfilterType') == 2) { // by Name
          
          $filterType = "By Client Name";
          $filter = '2';
      
          $cName = request('cName');

          $data = Contract::GetContractsByClientName($id, $cName);
        }

        $contracts = $data;
        $dealer = DealerInfo::GetDealerInfo($id);

        $data = [
            'contracts' => $contracts,
            'name'      => $dealer->dealer_name,
        ];

        $dataFilter = [
          'type'    => $filterType,
          'filter'  => $filter,
          'start'   => $start,
          'end'     => $end,
          'cID'     => $cID,
          'cName'   => $cName,
        ];

        $conreqnotes = CustomField::GetConReqFieldValuesByConReqIdsBeforePrinting();

        return view('pages.contracts', compact('data', 'dataFilter', 'conreqnotes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->RetrieveDetails();

        return view('pages.contractdetailsadd', compact('data'));
    }

    public function CheckIfContractExist($contractId) {

      $contract = Contract::where('contract_id', $contractId)->first();

      if($contract!=null)
        return true;
      else
        return false;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if(!$this->CheckIfContractExist(request('contractId'))) {
        $contract = new Contract();

        $this->SaveDetails($contract);

        session(['activeside' => 'sb-contracts']); // NOTE

        Alert::success('','Saved Contract','');

        if(auth()->user()->hasRole('dealer')) {

          if(request('isApprovedContract')==1) {
            DealerLogController::WriteLog('approve-con-add',$contract);

          } else {
            DealerLogController::WriteLog('contract-add',$contract);

          }

            return redirect('/contracts');
        } else {

          if(request('isApprovedContract')==1) {
            AdminLogController::WriteLog('approve-con-add',$contract);
          } else {
            AdminLogController::WriteLog('contract-add',$contract);
          }

          

          return redirect('/admin/viewcontracts/'.auth()->user()->GetDealerInfoIfAdmin()->party_id);
        }
      } else {
        Alert::success('','Contract Already Exist','');
        return back()->withInput(Input::all());
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        session(['c_id' => $id]);
        $dealerPartyId = DealerInfo::GetDealerPartyId();
        $data = $this->RetrieveDetails($id);

        // File upload table
        $temp = ContractRequirementLog::where('contract_id', $data['contract']->contract_id)->get();
        $data2 = null;
        $x = 0;
        foreach ($temp as $t) {
          $du = new Carbon($t->dateupload);
          $data2[$x]['dateupload'] = $du->toDayDateTimeString(); //$du->toFormattedDateString();//
          $data2[$x]['note'] = ContractRequirementLog::GetDataForLogNotes($t->notes);
          $data2[$x]['username'] = $t->username;
          $x++;
        }
        
        // Get checked in Checklist
        $crIds = $data['contract']->conreqs_ids;
        $crIds = explode(',', $crIds);

        for($i=0; $i<21; $i++) {
          $conreqData[$i]['text'] = CustomField::GetConReqFieldValueByDescAndFieldId($i+1);

          if($this->CheckIfArrayContains($crIds, $i))
            $conreqData[$i]['checked'] = 'checked';
          else
            $conreqData[$i]['checked'] = '';
        }

        // $editable = ($data['contract']->dateprinted == null) ? true : false;

        $editable = (BookedContract::CheckIfContractIsBooked($dealerPartyId,$data['contract']->contract_id)==null) ? true : false; // check if contract is not yet booked
        $booked = $editable;
        if(auth()->user()->whatRole()->name == "lo")
          $editable = false;

        return view('pages.contractdetailsedit', compact('data', 'data2', 'conreqData', 'editable', 'booked'));
    }

    function CheckIfArrayContains($array, $param) {
      foreach ($array as $v) {
        if($v == $param+1)
          return true;
      }

      return false;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $dealerPartyId = DealerInfo::GetDealerPartyId();
        $contract = Contract::find($id);

        // check if contract is already booked
        if(BookedContract::CheckIfContractIsBooked($dealerPartyId,$contract->contract_id)==null) {

          if(!auth()->user()->hasRole('lo')) {

            $this->SaveDetails($contract);
            $this->contractreqssave($contract, $request);
            $this->contractfileupload($contract, $request);

            Alert::success('','Updated Contract','');

            // Log update
            if(!auth()->user()->hasRole('dealer')) {
              AdminLogController::WriteLog('contract-edit',$contract);
            } else {
              DealerLogController::WriteLog('contract-edit',$contract);
            }

          } else if(auth()->user()->hasRole('lo')){
            $this->contractfileupload($contract, $request);

            Alert::success('','Uploaded File.','');
          }

        } else {
          Alert::warning('Contract is already booked.','Cannot Update','');
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function RetrieveDetails($id = 0) {
        $dealerPartyId = DealerInfo::GetDealerPartyId();

        $cm = CityMun::GetCityMunicipalities();
        $vehicle = Vehicle::GetVehicles();
        $oot = Outoftown::GetOutoftowns();
        $sigs = DealerInfo::GetSignatories($dealerPartyId);
        $producttype = CustomField::GetFieldsByDesc('product_type');
        $retailtype = CustomField::GetFieldsByDesc('retail_type');
        $partytype = CustomField::GetFieldsByDesc('party_type');
        $vehicleusage = CustomField::GetFieldsByDesc('vehicle_usage');

        $defaultAmount = Contract::GetDefaultAmount($dealerPartyId);

        $contract = null;
        $assetOrigPurchaseDate = null;
        
        
        if($id != 0) {
            $contract = Contract::find($id);
            $assetOrigPurchaseDate = Appcontract::GetOrigPurchaseDate($contract->contract_id);
        }

        $data = [
            'cm'                => $cm,
            'vehicle'           => $vehicle,
            'oot'               => $oot,
            'sigs'              => $sigs,
            'producttype'       => $producttype,
            'retailtype'        => $retailtype,
            'partytype'         => $partytype,
            'vehicleusage'      => $vehicleusage,
            'defamount'         => $defaultAmount,
            'contract'          => $contract,
            'assetOrgPurchDate' => $assetOrigPurchaseDate,
        ];

        return $data;
    }

    function SaveDetails($contract) {
        $dealerPartyId = DealerInfo::GetDealerPartyId();

        $productType = request('productType');
        $retailType = request('retailType');

        $is_fleet = 0;
        $is_outoftown = 0;
        $is_onemonthadvance = 0;
        $is_cicharge = 0;
        
        if($productType == 1)   
            $leaseretail_fee = request('processingFee');
        else if($productType == 2)
            $leaseretail_fee = request('chattelMortgage');

        if(request('isFleetAccount') == "on")
            $is_fleet = 1;

        if(request('isOOT') == "on")
            $is_outoftown = 1;

        if(request('isOMA') == "on")
            $is_onemonthadvance = 1;

        if(request('isCICharge') == "on")
            $is_cicharge = 1;

        if($contract->contract_id == null)
          $contract->contract_id      = request('contractId');

        $contract->product_type     = $productType;
        $contract->retail_type     = $retailType;
        $contract->is_fleet     =  $is_fleet;
        $contract->firstduedate     = request('firstDateDue');
        $contract->dateaccepted     = request('dateAccepted');
        $contract->party_type     = request('partyType');

        // Additional for Reports
        $contract->status = request('contractStat');
        $contract->credit_approval_date = request('creditAppDate');
        $contract->credit_approval_validity = request('creditAppValidity');

        // dd(request('reconDateValue'));
         $recondate = Carbon::createFromFormat('d/m/Y', '01/01/1900');

        if(request('reconDateValue') != "" && request('reconDateValue') != "01/01/1900")
          $contract->recon_date = request('reconDate');
        else {
          
           $contract->recon_date = $recondate;
         }

        $contract->credit_approval_recon_date = request('creditAppReconDate');
      
        // Client
        $contract->client_name     = strtoupper(request('clientName'));
        $contract->client_marital     = request('clientMaritalStatus');
        $contract->client_govid     = strtoupper(request('clientGovtId'));
        $contract->client_dateissued     = request('dateIssued');
        $contract->client_tin     = strtoupper(request('clientTin'));        
        $contract->client_nationality     = strtoupper(request('clientNationality'));
        $contract->client_address     = strtoupper(request('clientAddress'));

        $cityMunInput = request('cityMunicipality');
 
        if($cityMunInput!=null) {
          $cityMunArray = explode(':', $cityMunInput);

          $contract->client_city_mun     = $cityMunArray[0];

          if($cityMunArray[1] == "OTHERS")
            $contract->client_city_mun_others = request('cityMunicipalityOthers');
          else
            $contract->client_city_mun_others = "";
        }

        // Comaker
        $contract->comaker_name     = strtoupper(request('comakerName'));
        $contract->comaker_marital     = request('comakerMaritalStatus');
        $contract->comaker_govid     = strtoupper(request('comakerGovtId'));
        $contract->comaker_dateissued     = request('dateIssuedCoMaker');
        $contract->comaker_tin     = strtoupper(request('comakerTin'));
        
        // Witness
        $contract->witness1_name     = strtoupper(request('witness1Name'));
        $contract->witness1_tin     = strtoupper(request('witness1Tin'));
        $contract->witness2_name     = strtoupper(request('witness2Name'));
        $contract->witness2_tin     = strtoupper(request('witness2Tin'));

        // Dealer
        $contract->dealer_id     = $dealerPartyId;// party id

        if($productType == 2 && $retailType == 2) {
            $contract->dealer_signatory     = strtoupper(request('clientSigName2'));
            $contract->dealer_signatory_tin     = strtoupper(request('clientSigTin'));
            $contract->dealer_signatory_govid     = strtoupper(request('clientSigGovId'));
        }

        // Vehicle
        $contract->vehicle_name     = strtoupper(request('vehicleName'));
        $contract->vehicle_color     = strtoupper(request('vehicleColor'));
        $contract->vehicle_engine     = strtoupper(request('vehicleEngineNo'));
        $contract->vehicle_chasis     = strtoupper(request('vehicleChasisNo'));
        $contract->vehicle_make     = strtoupper(request('vehicleMake'));
        $contract->vehicle_yearmodel     = request('vehicleYearModel');
        $contract->vehicle_consticker     = strtoupper(request('vehicleConSticker'));
        $contract->vehicle_usage     = request('vehicleUsage');
        $contract->invoice_no       = request('invoiceNo');

        // Insurance
        $contract->insurer     = strtoupper(request('insurer'));
        $contract->insurance_period     = request('insurance_period');
        $contract->insurance_liability     = request('insurance_liability');
        $contract->insurance_effective_date     = (request('insurance_period') == "Perpetual") ? request('insurance_effective_date_P') :request('insurance_effective_date_SP');
        $contract->insurance_expiry_date    = (request('insurance_period') == "Perpetual") ?  Carbon::parse('9998-12-31 00:00:00')->format('Y-m-d') : request('insurance_expiry_date_SP');
        $contract->insurance_comment     = request('insurance_comments');

        // Link to S42
        $this->SaveDetailsToS42($contract);

        // Finance
        $contract->term     = request('term');
        $contract->add_on_rate     = request('addOnRate');
        $contract->unit_cost     = request('unitCost');
        $contract->downpayment     = request('downPayment');
        $contract->amount_finance     = request('amountFinance');
        $contract->monthly_installment     = request('monthlyInstallement');
        $contract->is_outoftown     = $is_outoftown;
        $contract->province         = request('ootProvince');
        $contract->outoftown_charge     = request('ootTotalAmount');
        $contract->dst     = request('dst');
        $contract->leaseretail_fee     =  $leaseretail_fee;
        $contract->total_fees     = request('totalFees');
        $contract->other_charges     = request('otherCharges');
        $contract->balloon     = request('balloonAmount');

        $contract->custom_reqs = request('cusReqs');

        $contract->is_onemonthadvance     = $is_onemonthadvance;
        $contract->is_cicharge     = $is_cicharge;

        $contract->save();
    }

    public function SaveDetailsToS42($contract) {
      $contractId = $contract->contract_id;
      $assetClassId = AppContract::GetAssetClassIdByContractId($contractId);

      if($assetClassId!=null) {
        $assetclassvehicle = AssetClassVehicle::Get($assetClassId);

        $consticker = strtoupper(request('vehicleConSticker'));
        if($consticker==null)
          $consticker = " ";

        $assetclassvehicle->vin_no = $consticker;
        $assetclassvehicle->colour = strtoupper(request('vehicleColor'));
        $assetclassvehicle->engine_no = strtoupper(request('vehicleEngineNo'));
        $assetclassvehicle->chassis_no = strtoupper(request('vehicleChasisNo'));
        $assetclassvehicle->save();
      }

       $assetHdrId = AppContract::GetAssetHDRId($contractId);

        if ($assetHdrId !=null) {
          if(request('insurer')!=null) {
           
            $rowCount = AppContract::GetInsuranceCount($contractId);
            $liabilityNum = 0;
            $comment = " ";

            if(request('insurance_liability')!=null)
              $liabilityNum = intval(preg_replace("/[^-0-9\.]/","",request('insurance_liability')));

            if(request('insurance_comments')!=null)
              $comment = request('insurance_comments');

            $effectiveDate = (request('insurance_period') == "Perpetual") ? request('insurance_effective_date_P') :request('insurance_effective_date_SP');
            $expiryDate = (request('insurance_period') == "Perpetual") ? Carbon::parse('9998-12-31 00:00:00')->format('Y-m-d') : request('insurance_expiry_date_SP');

            $effectiveDate = Carbon::parse($effectiveDate)->format('Y-m-d');
            $expiryDate = Carbon::parse($expiryDate)->format('Y-m-d');

            if($rowCount == 0) {
              
              AppContract::InsertInsurance($contractId, $effectiveDate, $expiryDate, $liabilityNum, $comment);

            } else if($rowCount > 0) {

              AppContract::UpdateInsurance($contractId, $effectiveDate, $expiryDate, $liabilityNum, $comment);

            }

          }
        } 


        $assetId = AppContract::GetAssetId($contractId);
        $invoiceNo = request('invoiceNo');
        
        if(AppContract::CheckIfAssetIdExist($assetId)) {
          AppContract::UpdateInvoiceNo($assetId, $invoiceNo);
        } else {
          AppContract::InsertInvoiceNo($assetId, $invoiceNo);
        }

    }

    public function computetfretail(Request $request) {

        $dealerPartyId = DealerInfo::GetDealerPartyId();
        $amountFinance = $request->af;
        $fc = FeesCustom::where('dealer_party_id', $dealerPartyId)->first();
        $initial = 0;

        // Get Initial
        if($request->retailType == "2 Party") {

            if($fc!=null) {
              if($fc->fees_2party == 0) {
                  $initial = $this->GetRateFromTable($dealerPartyId, 2, $amountFinance);
              } else {
                  $initial = $fc->fees_2party;
              }
            }

        } else if($request->retailType == "3 Party") {

            if($fc!=null) {
              if($fc->fees_3party == 0) {
                  $initial = $this->GetRateFromTable($dealerPartyId, 3, $amountFinance);
              } else {
                  $initial = $fc->fees_3party;
              }
            }

        }

        $total = $initial + $request->oot + $request->other + $request->ciCharge;

        return $total;

    }

    function GetRateFromTable($partryid, $partytype, $amountfinance) {
        $table = PNCMFeesDealerRef::where('dealer_party_id', $partryid)->first()->table_no;

        switch ($table) {
            case "TABLE 1":
                    $rate = PNCMFeesRetailTable1::GetRate($partytype, $amountfinance);
                break;
             case "TABLE 2":
                    $rate = PNCMFeesRetailTable2::GetRate($partytype, $amountfinance);
                break;
            case "TABLE 3":
                    $rate = PNCMFeesRetailTable3::GetRate($partytype, $amountfinance);
                break;
        }

        return $rate;
    }


    ///////////////////**** PRINT CONTRACT
    public function generateView($id) {    
      $contract = Contract::find($id);

      $pdfFilePath = new ContractGenerateController();
      $pdfFilePath = $pdfFilePath->Generate($contract, "preview");
      
      return redirect($pdfFilePath);
    }

    public function generatePrint($id) {
      $contract = Contract::find($id);

      if($contract->dateprinted == null) {
        $contract->dateprinted = Carbon::now();
        $contract->save();
      }

      $pdfFilePath = new ContractGenerateController();
      $pdfFilePath = $pdfFilePath->Generate($contract, "preprinted");

      if(!auth()->user()->hasRole('dealer')) {
        AdminLogController::WriteLog('contract-print',$contract);
      } else
      {
        DealerLogController::WriteLog('contract-print',$contract);
      }

      return redirect($pdfFilePath);
     
    }

    public function contractreqssave($contract, $request) {
      $contractId = $contract->contract_id;

      if(!$this->CheckIfNoChangesInConReqLog($contractId, $request)) {
        $this->updateconreqlog($contract, $request);

         if(!auth()->user()->hasRole('dealer') && !auth()->user()->hasRole('lo')) {
            AdminLogController::WriteLog('contract-upload-log',$contract);
          } else {
            DealerLogController::WriteLog('contract-upload-log',$contract);
          }
      }
  
         
    }

    public function contractfileupload($contract, $request) {
      $contractId = $contract->contract_id;

      if(!$contract->is_conreqs_upload) {
        if ($request->hasFile('fileConReq')) {
          
          $file = request('fileConReq');

          $fileFull = $file->getClientOriginalName();
          $fileNameArray = explode(".", $fileFull);

          $filename = $fileNameArray[0];
          $filesize = $file->getClientSize()/1024;
          $filesize = round($filesize, 2);
          $path = Contract::GetContractReqSourcePath();

          $crFilename = $contractId."_conreq";

          $file->move(public_path($path),$crFilename.".pdf");
          $contract->is_conreqs_upload = true;
          $contract->save();

          $this->updateconreqlog($contract, $request);
          
          if(!auth()->user()->hasRole('dealer') && !auth()->user()->hasRole('lo')) {
            AdminLogController::WriteLog('contract-upload-con-req',$contract);
          } else {
            DealerLogController::WriteLog('contract-upload-con-req',$contract);
          }

        }  
      } 
    }

    public function CheckIfNoChangesInConReqLog($contractId, $request) {
      $temp = ContractRequirementLog::GetDataForNotesLogNotes($request);
      if($temp['ids']!=null)
        $temp = implode(",", $temp['ids']);
      else {
        $temp = null;
        return true;
      }

      $d = ContractRequirementLog::where('contract_id', $contractId)->orderBy('created_at', 'desc')->first();

      $value = false;

      if($d!=null)
        if($temp == $d->notes)
          return true;

      return $value;
    }

    public function updateconreqlog($contract, $request) {
      // save details for log
        $model = new ContractRequirementLog();
        $model->dateupload = Carbon::now('Asia/Manila');
        $model->contract_id = $contract->contract_id;
        $temp = ContractRequirementLog::GetDataForNotesLogNotes($request);
        if($temp['ids']!=null)  
          $temp = implode(",", $temp['ids']);
        else
          $temp = null;

        $model->notes = $temp;
        $model->username = auth()->user()->username;
        $model->save();

        // save contract req ids
        if($temp != null) {
          $contract->conreqs_ids = $temp;
          $contract->save();
        }

        // AdminLogController::WriteLog('contract-upload-log',$contract);
    }

    public function contractreqview($id) {
      $contract = Contract::find($id);

      $crFilename = $contract->contract_id."_conreq";
      $path = Contract::GetContractReqSourcePath();

      $pdfFilePath = './'.$path.$crFilename.'.pdf';
    
      return redirect($pdfFilePath);
    }

}
