<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Contract extends Model
{
    protected $table = 'contracts';

    public static function GetContracts($dealerPartyId) {
        $data = self::where('dealer_id', $dealerPartyId)->orderBy('created_at', 'ASC')->get();

        return $data;
    }

    public static function GetContractByContractId($dealerPartyId, $contractId) {
        $data = self::where('dealer_id', $dealerPartyId)->where('contract_id', $contractId)->get();

        return $data;
    }

    public static function GetContractsByClientName($dealerPartyId, $name) {
        $data = self::where('dealer_id', $dealerPartyId)->where('client_name','LIKE',"%{$name}%")->get();

        return $data;
    }

    public static function GetContractOfDealerByDateRange($dealerPartyId, $start, $end) {
        // $start = "01/09/2019";
        // $end = "01/09/2019";

        $date_from = Carbon::parse($start)->startOfDay();
        $date_to = Carbon::parse($end)->endOfDay();

        $result = self::whereDate('created_at', '>=', $date_from)
            ->whereDate('created_at', '<=', $date_to)
            ->where('dealer_id', $dealerPartyId)
            ->get();

            // dd($result);
        return $result;
    }

     public static function GetContractsByDateRangeReport($dealerPartyId, $start, $end) {
        $date_from = Carbon::parse($start)->startOfDay();
        $date_to = Carbon::parse($end)->endOfDay();
      
        // $result = self::whereDate('credit_approval_date', '>=', $date_from)
        //     ->whereDate('credit_approval_date', '<=', $date_to)
        //     ->where('dealer_id', $dealerPartyId)
        //     ->get();

          $result = self::whereDate('created_at', '>=', $date_from)
            ->whereDate('created_at', '<=', $date_to)
            ->where('dealer_id', $dealerPartyId)
            ->get();
      
        return $result;
    }

    public static function GetContractsByDateRangeAllDealerReport($start, $end) {
        $date_from = Carbon::parse($start)->startOfDay();
        $date_to = Carbon::parse($end)->endOfDay();
      
          $result = self::whereDate('created_at', '>=', $date_from)
            ->whereDate('created_at', '<=', $date_to)
            ->get();
      
        return $result;
    }

    public static function GetContractCountPerDealer() {
        $dealers =  DealerInfo::orderBy('dealer_name', 'ASC')->get();
        $result = array();

        $i = 0;
        foreach ($dealers as $dealer) {
            $result[$i]['pid'] = $dealer->party_id;
            $result[$i]['name'] = $dealer->dealer_name;
            $result[$i]['count'] = count(self::GetContracts($dealer->party_id));
            $i++;
        }

        return $result;
    }

    public static function GetContractCountPerDealerByDateRange($start, $end) {
        $dealers =  DealerInfo::orderBy('dealer_name', 'ASC')->get();
        $result = array();

        $i = 0;
        foreach ($dealers as $dealer) {
            $result[$i]['pid'] = $dealer->party_id;
            $result[$i]['name'] = $dealer->dealer_name;
            $result[$i]['count'] = count(self::GetContractOfDealerByDateRange($dealer->party_id, $start, $end));
            $i++;
        }

        return $result;
    }   

    public function CheckIfAllowedPrint() {
        // Get required in Contract Requirements
        $crIds = CustomField::GetConReqFieldValueByDescAndFieldId(22); // ConReqIds
        $crIds = explode(',', $crIds);

        if($crIds[0] == null)
            return true;
        else {

            $ids = explode(",", $this->conreqs_ids);
            $isAllowed = false;

            foreach ($crIds as $crId) {
                if($this->CheckIfArrayContains($ids,$crId)) // If there is Downpayment
                    $isAllowed = true;
                else 
                    $isAllowed = false;
            }

            return $isAllowed;
        }
    }

    function CheckIfArrayContains($array, $param) {
      foreach ($array as $v) {
        if($v == $param)
          return true;
      }

      return false;
    }

    public static function GetPrefixContractFilename() {
         if(auth()->user()->hasRole('dealer')) {
           $name = auth()->user()->dealer_party_id;
         }
         else {
           $name = auth()->user()->username;
        }

        return $name;
    }

    public static function GetDefaultAmount($dealerPartyId) {

        $processingFee = FeesCustom::GetFeesLeaseByDealerPartyId($dealerPartyId);

        $data = [
            'cicharge'  => 2500,
            'div'       => 200,
            'multi'     => 1.5,
            'pf'        => $processingFee,
        ];

        return $data;
    }

    public static function GetPrintTemplateName($type, $prodType, $retailType) {
        $filename = "";

        switch ($prodType) {
            case '2': //Retail
                if($retailType == "1")
                    $filename = "contract_retail_2p_".$type;
                else 
                    $filename = "contract_retail_3p_".$type;
                break;
            case '1': //Lease
                $filename = "contract_lease_".$type;
                break;
        }

        return $filename;
    }

    public static function GetContractSourcePath() {
        return "uploads/contracts/templates/";
    }

    public static function GetContractReqSourcePath() {
        return "uploads/contractsreqs/";
    }

    public static function GetContractDestinationPath($prodType) {
        $path = "";

        switch ($prodType) {
            case '2': //Retail
                $path = "uploads/contracts/retail/";
                break;
            
            case '1': //Lease
                $path = "uploads/contracts/lease/";
                break;
        }

        return $path;
    }

    public function GetRetailType($id) {
        $type = CustomField::GetFieldNameByDescAndFieldId('retail_type',$id);

        return $type;
    }

    public function GetProductType($id) {
        $type = CustomField::GetFieldNameByDescAndFieldId('product_type',$id);

        return $type;
    }

    public function GetPartyType($id) {
        $type = CustomField::GetFieldNameByDescAndFieldId('party_type',$id);

        return $type;
    }

    public function GetVehicleUsage($id) {
        $type = CustomField::GetFieldNameByDescAndFieldId('vehicle_usage',$id);

        return $type;
    }

    public function GetVehicleName($id) {
        $name = Vehicle::where('id', $id)->first();

        if($name != null)
            $name = $name->name;

        return $name;
    }

    public function GetCityMunicipality($id) {
        $citymun = CityMun::where('id', $id)->first();

        return $citymun;
    }

    public static function GetCICharge($contract) {
        if($contract->is_cicharge) {
            if($contract->product_type == 1) // Lease
                return 2500;
            else if($prodType == 2) // Retail
                return 2500;
            } else {
                return 0;
            }
    }
}
