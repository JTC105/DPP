<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Alert;
use Carbon\Carbon;

use App\Model\AppContract;
use App\Model\CityMun;
use App\Model\Contract;
use App\Model\CustomField;
use App\Model\DealerInfo;
use App\Model\Outoftown;
use App\Model\Permission;
use App\Model\Vehicle;

class AppContractController extends Controller
{
    //******************* ADMIN
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminindex(Request $request) {       

      $data = DealerInfo::GetDealers();
      return view('pages.admin.dealerappcontracts', compact('data'));
    }

    public function adminviewindex(Request $request, $id) {
        session(['dpid' => $id]); //dealer party id

        return $this->index($request);
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

      if(request('acfilterType')==null || request('acfilterType') == 0){ // by Date Range
      
          $filterType = "By Date Range";
          $filter = '0';

          $start = request('cfilterStartDate');
          $end = request('cfilterEndDate');
          
          $startC = Carbon::parse($start);
          $endC = Carbon::parse($end);

          $length = $endC->diffInDays($startC);


          if (Permission::IfDateRestricted()) {
            if($start == null || $length > 31)
              $start = Carbon::now('Asia/Manila')->format('d-M-Y');
            if($end == null || $length > 31)
              $end = Carbon::now('Asia/Manila')->format('d-M-Y');

            if ($length > 31) {
              Alert::success('','Cannot generate more than 31 days.','');
            }
          } else {
             if($start == null)
              $start = Carbon::now('Asia/Manila')->format('d-M-Y');
            if($end == null)
              $end = Carbon::now('Asia/Manila')->format('d-M-Y');
          }

          $start = Carbon::parse($start)->format('d-M-Y');
          // $end = Carbon::parse($end)->addDay()->format('d-M-Y');  
          $end = Carbon::parse($end)->format('d-M-Y');                         

          $data = AppContract::GetAppConListByDate($id,$start,$end);

        } else if (request('acfilterType') == 1){ // by Contract

          $filterType = "By Contract";
          $filter = '1';

          $cID = request('cID');
          
          $data = AppContract::GetAppConDetailByContract($cID, $id);

        } else if(request('acfilterType') == 2) { // by Name
          $filterType = "By Client Name";
          $filter = '2';
     
          $cName = request('cName');

          $data = AppContract::GetAppConDetailByName($cName, $id);
        }

        $acontracts = $data;
        $dealer = DealerInfo::GetDealerInfo($id);

        $data = [
            'acontracts' => $acontracts,
            'dealer'     => $dealer,
        ];

        $dataFilter = [
          'type'    => $filterType,
          'filter'  => $filter,
          'start'   => $start,
          'end'     => $end,
          'cID'     => $cID,
          'cName'   => $cName,
        ];

        return view('pages.appcontracts', compact('data', 'dataFilter'));
    }


    public function view(Request $request)
    {
      $id = DealerInfo::GetDealerPartyId();

        $data1 = Appcontract::GetAppConDetailByContract(request('id'), $id);

        return $data1;
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

        $assetOrigPurchaseDate = null;
        if($id!=0)
          $assetOrigPurchaseDate = Appcontract::GetOrigPurchaseDate($id);

        $defaultAmount = Contract::GetDefaultAmount($dealerPartyId);


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
            'assetOrgPurchDate' => $assetOrigPurchaseDate,
        ];

        return $data;
    }


    public function create(Request $request,$id)
    {
        $dealer_id = DealerInfo::GetDealerPartyId();
        $data1 = Appcontract::GetAppConDetailByContract($id, $dealer_id);
        $producttype = $data1[0]->product_type;
        Vehicle::CheckIfVehicleExist($data1[0]->unit);
        $data = $this->RetrieveDetails($id);
        $invoiceNo = AppContract::GetInvoice($id);

        return view('pages.appcontractdetailsadd', compact('data', 'data1', 'producttype', 'invoiceNo'));
    }

    public function previewadvice(Request $request,$id) {
  
        //$dir = '//192.168.0.15/42DevExternalFiles/DocumentGeneration/'; // TODO: Modify
      $dir = '//192.168.0.78/AFDevExternalFiles/DocumentGeneration/*/*/'; // TODO: Modify

        $filenames = array();
        $i = 0;
        foreach(glob($dir. "*_".$id.".pdf") as $file) {
            $filenames[$i] = $file;
            $i++;
        }

        $count = count($filenames);
        if($count > 0) {
          $filename = $filenames[$count-1];
          $username = auth()->user()->username;
          $result = \File::copy($filename,base_path('public/uploads/creditadvice/'.$username.'.pdf'));

          return redirect('./uploads/creditadvice/'.$username.'.pdf');

        } else {
          Alert::success('','Credit Advice is not yet generated or could not be located.','');

          //alert
          return back();
          // return $this->index($request);
        }
    }

}
