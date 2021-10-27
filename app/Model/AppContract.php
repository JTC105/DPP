<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AppContract extends Model
{

    public static function GetAppConListByDate($dealerPartyId, $start, $end) {

        // $data = DB::connection('oracle')->select(DB::raw("SELECT C.CONTRACT_ID, P1.PARTY_ID, P1.EXT_NAME CLIENT, D .EXT_NAME DEALER, cstat.FIELD_VALUE AS CONTRACT_STATUS, CS. VALUE AS CONTRACT_STATE, CRS. VALUE AS CREDIT_STATE, PR. NAME PRODUCT, AD.APP_DT CREDIT_APP_DT FROM PARTY P1 INNER JOIN CONTRACT C ON P1.PARTY_ID = C.CPARTY_ID INNER JOIN PARTY D ON D .PARTY_ID = C.DEALER_ID AND D .PARTY_ID = ".$dealerPartyId." INNER JOIN PRODUCT PR ON C.PRODUCT_ID = PR.PRODUCT_ID INNER JOIN CONTRACT_CFV cstat ON cstat.contract_id = c.contract_id AND cstat.contract_cfd_id = 66 AND cstat.field_value = 'Pending' INNER JOIN LOOKUPSET CS ON CS.LOOKUPSET_ID = C.CONTRACT_STATE AND C.CONTRACT_STATE > = 1150 AND C.CONTRACT_STATE < 11130 INNER JOIN LOOKUPSET CRS ON CRS.LOOKUPSET_ID = C.CREDIT_STATE AND C.CREDIT_STATE IN (12050, 12060) INNER JOIN ( SELECT DISTINCT N.CONTRACT_ID, SUBJECT, MAX (N.ACTIVITY_DT) AS APP_DT FROM NOTE N WHERE N.SUBJECT LIKE '%Approved; Status set to Completed%' GROUP BY N.CONTRACT_ID, SUBJECT ) AD ON AD.CONTRACT_ID = C.CONTRACT_ID WHERE AD.APP_DT BETWEEN '".$start."' AND '".$end."' ORDER BY 7 DESC"));

        $data = DB::connection('oracle')->select(DB::raw("SELECT C.CONTRACT_ID, P1.PARTY_ID, P1.EXT_NAME CLIENT, D .EXT_NAME DEALER, cstat.FIELD_VALUE AS CONTRACT_STATUS, CS. VALUE AS CONTRACT_STATE, CRS. VALUE AS CREDIT_STATE, PR. NAME PRODUCT, DPPS_GET_APPDT (C.CONTRACT_ID) CREDIT_APP_DT FROM PARTY P1 INNER JOIN CONTRACT C ON P1.PARTY_ID = C.CPARTY_ID INNER JOIN PARTY D ON D .PARTY_ID = C.DEALER_ID AND D .PARTY_ID = ".$dealerPartyId." INNER JOIN PRODUCT PR ON C.PRODUCT_ID = PR.PRODUCT_ID INNER JOIN CONTRACT_CFV cstat ON cstat.contract_id = c.contract_id AND cstat.contract_cfd_id = 66 AND cstat.field_value = 'Pending' INNER JOIN LOOKUPSET CS ON CS.LOOKUPSET_ID = C.CONTRACT_STATE AND C.CONTRACT_STATE > = 1150 AND C.CONTRACT_STATE < 11130 INNER JOIN LOOKUPSET CRS ON CRS.LOOKUPSET_ID = C.CREDIT_STATE AND C.CREDIT_STATE IN (12050, 12060) WHERE TRUNC ( DPPS_GET_APPDT (C.CONTRACT_ID)) BETWEEN '".$start."' AND '".$end."' ORDER BY 9 DESC"));

        return $data;
    }   

    public static function GetAppConListByDateAndDealerReport($dealerPartyId, $start, $end) {

    // $data = DB::connection('oracle')->select(DB::raw("SELECT C.CONTRACT_ID, P1.PARTY_ID, P1.EXT_NAME CLIENT, D .EXT_NAME DEALER, cstat.FIELD_VALUE AS CONTRACT_STATUS, CS. VALUE AS CONTRACT_STATE, CRS. VALUE AS CREDIT_STATE, PR. NAME PRODUCT, DPPS_GET_APPDT (C.CONTRACT_ID) CREDIT_APP_DT, DPPS_GET_APPDT (C.CONTRACT_ID) + 30 CREDIT_APP_VALIDITY, DPPS_GET_RECONDT (C.CONTRACT_ID) CREDIT_APP_RECON_DT FROM PARTY P1 INNER JOIN CONTRACT C ON P1.PARTY_ID = C.CPARTY_ID INNER JOIN PARTY D ON D .PARTY_ID = C.DEALER_ID AND D .PARTY_ID = ".$dealerPartyId." INNER JOIN PRODUCT PR ON C.PRODUCT_ID = PR.PRODUCT_ID INNER JOIN CONTRACT_CFV cstat ON cstat.contract_id = c.contract_id AND cstat.contract_cfd_id = 66 AND cstat.field_value = 'Pending' INNER JOIN LOOKUPSET CS ON CS.LOOKUPSET_ID = C.CONTRACT_STATE AND C.CONTRACT_STATE > = 1150 AND C.CONTRACT_STATE < 11130 INNER JOIN LOOKUPSET CRS ON CRS.LOOKUPSET_ID = C.CREDIT_STATE AND C.CREDIT_STATE IN (12050, 12060) WHERE TRUNC ( DPPS_GET_APPDT (C.CONTRACT_ID)) BETWEEN '".$start."' AND '".$end."' ORDER BY 9 DESC"));    

     $data = DB::connection('oracle')->select(DB::raw("SELECT C.CONTRACT_ID, P1.PARTY_ID, P1.EXT_NAME CLIENT, D .EXT_NAME DEALER, cstat.FIELD_VALUE AS CONTRACT_STATUS, CS. VALUE AS CONTRACT_STATE, CRS. VALUE AS CREDIT_STATE, PR. NAME PRODUCT, DPPS_GET_APPDT (C.CONTRACT_ID) CREDIT_APP_DT, DPPS_GET_APPDT (C.CONTRACT_ID) + 30 CREDIT_APP_VALIDITY, DPPS_GET_APPDT_MAX (C.CONTRACT_ID) CREDIT_APP_RECON_DT, DPPS_GET_RECONDT (C.CONTRACT_ID) RECON_DT FROM PARTY P1 INNER JOIN CONTRACT C ON P1.PARTY_ID = C.CPARTY_ID INNER JOIN PARTY D ON D .PARTY_ID = C.DEALER_ID AND D .PARTY_ID = ".$dealerPartyId." INNER JOIN PRODUCT PR ON C.PRODUCT_ID = PR.PRODUCT_ID INNER JOIN CONTRACT_CFV cstat ON cstat.contract_id = c.contract_id AND cstat.contract_cfd_id = 66 AND cstat.field_value = 'Pending' INNER JOIN LOOKUPSET CS ON CS.LOOKUPSET_ID = C.CONTRACT_STATE AND C.CONTRACT_STATE > = 1150 AND C.CONTRACT_STATE < 11130 INNER JOIN LOOKUPSET CRS ON CRS.LOOKUPSET_ID = C.CREDIT_STATE AND C.CREDIT_STATE IN (12050, 12060) WHERE TRUNC ( DPPS_GET_APPDT (C.CONTRACT_ID)) BETWEEN '".$start."' AND '".$end."' ORDER BY 9 DESC"));      

        return $data;
    }

    public static function GetAppConListByDateAllReport($start, $end) {
        $data = DB::connection('oracle')->select(DB::raw("SELECT C.CONTRACT_ID, P1.PARTY_ID, P1.EXT_NAME CLIENT, D .EXT_NAME DEALER, cstat.FIELD_VALUE AS CONTRACT_STATUS, CS. VALUE AS CONTRACT_STATE, CRS. VALUE AS CREDIT_STATE, PR. NAME PRODUCT, DPPS_GET_APPDT (C.CONTRACT_ID) CREDIT_APP_DT, DPPS_GET_APPDT (C.CONTRACT_ID) + 30 CREDIT_APP_VALIDITY, DPPS_GET_APPDT_MAX (C.CONTRACT_ID) CREDIT_APP_RECON_DT, DPPS_GET_RECONDT (C.CONTRACT_ID) RECON_DT FROM PARTY P1 INNER JOIN CONTRACT C ON P1.PARTY_ID = C.CPARTY_ID INNER JOIN PARTY D ON D .PARTY_ID = C.DEALER_ID INNER JOIN PRODUCT PR ON C.PRODUCT_ID = PR.PRODUCT_ID INNER JOIN CONTRACT_CFV cstat ON cstat.contract_id = c.contract_id AND cstat.contract_cfd_id = 66 AND cstat.field_value = 'Pending' INNER JOIN LOOKUPSET CS ON CS.LOOKUPSET_ID = C.CONTRACT_STATE AND C.CONTRACT_STATE > = 1150 AND C.CONTRACT_STATE < 11130 INNER JOIN LOOKUPSET CRS ON CRS.LOOKUPSET_ID = C.CREDIT_STATE AND C.CREDIT_STATE IN (12050, 12060) WHERE TRUNC ( DPPS_GET_APPDT (C.CONTRACT_ID)) BETWEEN '".$start."' AND '".$end."' ORDER BY 9 DESC"));      

        return $data;
    }

    public static function GetAppConDetailByContract($contractid, $dealerPartyId) {

        // $data = DB::connection('oracle')->select(DB::raw("SELECT C.CONTRACT_ID, P1.EXT_NAME CLIENT, TFSPH_CREDITADVICE_CM_SF (C.CPARTY_ID) COMAKER, TFSPH_GET_PARTY_ADDRESS (C.CPARTY_ID, 'Permanent') CLIENT_ADDRESS, C.DEALER_ID, D .EXT_NAME DEALER, cstat.FIELD_VALUE AS CONTRACT_STATUS, CS. VALUE AS CONTRACT_STATE, CRS. VALUE AS CREDIT_STATE, PR. NAME PRODUCT, CASE WHEN UPPER (PR. NAME) LIKE '%LEASE%' THEN 1 ELSE 2 END PRODUCT_TYPE, A .TERM, A .AMT_FINANCED, ATT. NAME UNIT, AHDR.YEAR_OF_MANUFACTURE MODEL, A . COST unit_cost, ( SELECT SUM (F.AMOUNT) FROM FLOW F WHERE F.COLLECTION_STATE >= 14800 AND F.PURCHASE_INVOICE_ID = 0 AND F.EXPECTED_DT > TO_DATE ('01-JAN-2002') AND F.CUSTOM_FLOW_HDR_ID IN (52, 162) AND F.CURRENCY_ID = 111 AND F.FLOW_TYPE = 1010 AND F.CONTRACT_ID = C.CONTRACT_ID AND F.PARTY_ACCOUNT_ID > 0 AND F.REVERSAL_STATUS = 4200 AND F.IS_CASH = 1 AND F.IS_SHADOW_COPY = 0 AND F.FLOW_ID > 0 AND F.STATUS >= 2099 AND F.ACTUAL_DT > TO_DATE ('01-JAN-2002') AND F.AMT_GROSS > 0 AND F.INSTALLMENT_NO >= 0 AND F.AMT_MATCHED <= 999999999999 AND F.STAMP >= 0 ) DOWNPAYMENT, TFSPH_CREDITADVICE_REQ_NEW_SF (C.CONTRACT_ID) REQUIREMENTS, DPPS_GET_APPDT (C.CONTRACT_ID) CREDIT_APP_DT, DPPS_GET_APPDT (C.CONTRACT_ID) + 30 CREDIT_APP_VALIDITY, DPPS_GET_RECONDT (C.CONTRACT_ID) CREDIT_APP_RECON_DT, MP.EXT_NAME MARKETING_PROFESSIONAL, LO.EXT_NAME LOAN_OFFICER FROM PARTY P1 INNER JOIN CONTRACT C ON P1.PARTY_ID = C.CPARTY_ID INNER JOIN PARTY D ON D .PARTY_ID = C.DEALER_ID AND C.DEALER_ID = ".$dealerPartyId." INNER JOIN PRODUCT PR ON C.PRODUCT_ID = PR.PRODUCT_ID INNER JOIN CONTRACT_CFV cstat ON cstat.contract_id = c.contract_id AND cstat.contract_cfd_id = 66 AND cstat.field_value = 'Pending' INNER JOIN LOOKUPSET CS ON CS.LOOKUPSET_ID = C.CONTRACT_STATE AND C.CONTRACT_STATE > = 1150 AND C.CONTRACT_STATE < 11130 INNER JOIN LOOKUPSET CRS ON CRS.LOOKUPSET_ID = C.CREDIT_STATE AND C.CREDIT_STATE IN (12050, 12060) INNER JOIN asset A ON c.contract_id = A .contract_id INNER JOIN ASSET_HDR AHDR ON A .ASSET_HDR_ID = AHDR.ASSET_HDR_ID INNER JOIN ASSET_TYPE ATT ON AHDR.ASSET_TYPE_ID = ATT.ASSET_TYPE_ID LEFT JOIN ( SELECT L.EXT_NAME, CP.CONTRACT_ID FROM CONTRACT_PARTY CP, PARTY L WHERE CP.PARTY_ID = L.PARTY_ID AND CP.SYSTEM_DEFS_PARTY_ROLE_ID = 144 ) MP ON C.CONTRACT_ID = MP.CONTRACT_ID LEFT JOIN ( SELECT L.EXT_NAME, CP.CONTRACT_ID FROM CONTRACT_PARTY CP, PARTY L WHERE CP.PARTY_ID = L.PARTY_ID AND CP.SYSTEM_DEFS_PARTY_ROLE_ID = 123 ) LO ON C.CONTRACT_ID = LO.CONTRACT_ID WHERE c.contract_id = ".$contractid.""));

        $data = DB::connection('oracle')->select(DB::raw("SELECT C.CONTRACT_ID, P1.EXT_NAME CLIENT, TFSPH_CREDITADVICE_CM_SF (C.CPARTY_ID) COMAKER, TFSPH_GET_PARTY_ADDRESS (C.CPARTY_ID, 'Permanent') CLIENT_ADDRESS, C.DEALER_ID, D .EXT_NAME DEALER, cstat.FIELD_VALUE AS CONTRACT_STATUS, CS. VALUE AS CONTRACT_STATE, CRS. VALUE AS CREDIT_STATE, PR. NAME PRODUCT, CASE WHEN UPPER (PR. NAME) LIKE '%LEASE%' THEN 1 ELSE 2 END PRODUCT_TYPE, A .TERM, A .AMT_FINANCED, ATT. NAME UNIT, AHDR.YEAR_OF_MANUFACTURE MODEL, A . COST unit_cost, ( SELECT SUM (F.AMOUNT) FROM FLOW F WHERE F.COLLECTION_STATE >= 14800 AND F.PURCHASE_INVOICE_ID = 0 AND F.EXPECTED_DT > TO_DATE ('01-JAN-2002') AND F.CUSTOM_FLOW_HDR_ID IN (52, 162) AND F.CURRENCY_ID = 111 AND F.FLOW_TYPE = 1010 AND F.CONTRACT_ID = C.CONTRACT_ID AND F.PARTY_ACCOUNT_ID > 0 AND F.REVERSAL_STATUS = 4200 AND F.IS_CASH = 1 AND F.IS_SHADOW_COPY = 0 AND F.FLOW_ID > 0 AND F.STATUS >= 2099 AND F.ACTUAL_DT > TO_DATE ('01-JAN-2002') AND F.AMT_GROSS > 0 AND F.INSTALLMENT_NO >= 0 AND F.AMT_MATCHED <= 999999999999 AND F.STAMP >= 0 ) DOWNPAYMENT, TFSPH_CREDITADVICE_REQ_NEW_SF (C.CONTRACT_ID) REQUIREMENTS, DPPS_GET_APPDT (C.CONTRACT_ID) CREDIT_APP_DT, DPPS_GET_APPDT (C.CONTRACT_ID) + 30 CREDIT_APP_VALIDITY, DPPS_GET_APPDT_MAX (C.CONTRACT_ID) CREDIT_APP_RECON_DT, DPPS_GET_RECONDT (C.CONTRACT_ID) RECON_DT, MP.EXT_NAME MARKETING_PROFESSIONAL, LO.EXT_NAME LOAN_OFFICER FROM PARTY P1 INNER JOIN CONTRACT C ON P1.PARTY_ID = C.CPARTY_ID INNER JOIN PARTY D ON D .PARTY_ID = C.DEALER_ID AND C.DEALER_ID = ".$dealerPartyId." INNER JOIN PRODUCT PR ON C.PRODUCT_ID = PR.PRODUCT_ID INNER JOIN CONTRACT_CFV cstat ON cstat.contract_id = c.contract_id AND cstat.contract_cfd_id = 66 AND cstat.field_value = 'Pending' INNER JOIN LOOKUPSET CS ON CS.LOOKUPSET_ID = C.CONTRACT_STATE AND C.CONTRACT_STATE > = 1150 AND C.CONTRACT_STATE < 11130 INNER JOIN LOOKUPSET CRS ON CRS.LOOKUPSET_ID = C.CREDIT_STATE AND C.CREDIT_STATE IN (12050, 12060) INNER JOIN asset A ON c.contract_id = A .contract_id INNER JOIN ASSET_HDR AHDR ON A .ASSET_HDR_ID = AHDR.ASSET_HDR_ID INNER JOIN ASSET_TYPE ATT ON AHDR.ASSET_TYPE_ID = ATT.ASSET_TYPE_ID LEFT JOIN ( SELECT L.EXT_NAME, CP.CONTRACT_ID FROM CONTRACT_PARTY CP, PARTY L WHERE CP.PARTY_ID = L.PARTY_ID AND CP.SYSTEM_DEFS_PARTY_ROLE_ID = 144 ) MP ON C.CONTRACT_ID = MP.CONTRACT_ID LEFT JOIN ( SELECT L.EXT_NAME, CP.CONTRACT_ID FROM CONTRACT_PARTY CP, PARTY L WHERE CP.PARTY_ID = L.PARTY_ID AND CP.SYSTEM_DEFS_PARTY_ROLE_ID = 123 ) LO ON C.CONTRACT_ID = LO.CONTRACT_ID WHERE c.contract_id = ".$contractid.""));
        
        return $data;
    }

    public static function GetAppConDetailByName($name, $dealerPartyId) {

        $name = strtoupper($name);

      
        // $data = DB::connection('oracle')->select(DB::raw("SELECT C.CONTRACT_ID, P1.EXT_NAME CLIENT, TFSPH_CREDITADVICE_CM_SF (C.CPARTY_ID) COMAKER, TFSPH_GET_PARTY_ADDRESS (C.CPARTY_ID, 'Permanent') CLIENT_ADDRESS, C.DEALER_ID, D .EXT_NAME DEALER, cstat.FIELD_VALUE AS CONTRACT_STATUS, CS. VALUE AS CONTRACT_STATE, CRS. VALUE AS CREDIT_STATE, PR. NAME PRODUCT, CASE WHEN UPPER (PR. NAME) LIKE '%LEASE%' THEN 1 ELSE 2 END PRODUCT_TYPE, A .TERM, A .AMT_FINANCED, ATT. NAME UNIT, AHDR.YEAR_OF_MANUFACTURE MODEL, A . COST unit_cost, ( SELECT SUM (F.AMOUNT) FROM FLOW F WHERE F.COLLECTION_STATE >= 14800 AND F.PURCHASE_INVOICE_ID = 0 AND F.EXPECTED_DT > TO_DATE ('01-JAN-2002') AND F.CUSTOM_FLOW_HDR_ID IN (52, 162) AND F.CURRENCY_ID = 111 AND F.FLOW_TYPE = 1010 AND F.CONTRACT_ID = C.CONTRACT_ID AND F.PARTY_ACCOUNT_ID > 0 AND F.REVERSAL_STATUS = 4200 AND F.IS_CASH = 1 AND F.IS_SHADOW_COPY = 0 AND F.FLOW_ID > 0 AND F.STATUS >= 2099 AND F.ACTUAL_DT > TO_DATE ('01-JAN-2002') AND F.AMT_GROSS > 0 AND F.INSTALLMENT_NO >= 0 AND F.AMT_MATCHED <= 999999999999 AND F.STAMP >= 0 ) DOWNPAYMENT, TFSPH_CREDITADVICE_REQ_NEW_SF (C.CONTRACT_ID) REQUIREMENTS, DPPS_GET_APPDT (C.CONTRACT_ID) CREDIT_APP_DT, DPPS_GET_APPDT (C.CONTRACT_ID) + 30 CREDIT_APP_VALIDITY, DPPS_GET_RECONDT (C.CONTRACT_ID) CREDIT_APP_RECON_DT, MP.EXT_NAME MARKETING_PROFESSIONAL, LO.EXT_NAME LOAN_OFFICER FROM PARTY P1 INNER JOIN CONTRACT C ON P1.PARTY_ID = C.CPARTY_ID INNER JOIN PARTY D ON D .PARTY_ID = C.DEALER_ID AND C.DEALER_ID = ".$dealerPartyId." INNER JOIN PRODUCT PR ON C.PRODUCT_ID = PR.PRODUCT_ID INNER JOIN CONTRACT_CFV cstat ON cstat.contract_id = c.contract_id AND cstat.contract_cfd_id = 66 AND cstat.field_value = 'Pending' INNER JOIN LOOKUPSET CS ON CS.LOOKUPSET_ID = C.CONTRACT_STATE AND C.CONTRACT_STATE > = 1150 AND C.CONTRACT_STATE < 11130 INNER JOIN LOOKUPSET CRS ON CRS.LOOKUPSET_ID = C.CREDIT_STATE AND C.CREDIT_STATE IN (12050, 12060) INNER JOIN asset A ON c.contract_id = A .contract_id INNER JOIN ASSET_HDR AHDR ON A .ASSET_HDR_ID = AHDR.ASSET_HDR_ID INNER JOIN ASSET_TYPE ATT ON AHDR.ASSET_TYPE_ID = ATT.ASSET_TYPE_ID LEFT JOIN ( SELECT L.EXT_NAME, CP.CONTRACT_ID FROM CONTRACT_PARTY CP, PARTY L WHERE CP.PARTY_ID = L.PARTY_ID AND CP.SYSTEM_DEFS_PARTY_ROLE_ID = 144 ) MP ON C.CONTRACT_ID = MP.CONTRACT_ID LEFT JOIN ( SELECT L.EXT_NAME, CP.CONTRACT_ID FROM CONTRACT_PARTY CP, PARTY L WHERE CP.PARTY_ID = L.PARTY_ID AND CP.SYSTEM_DEFS_PARTY_ROLE_ID = 123 ) LO ON C.CONTRACT_ID = LO.CONTRACT_ID WHERE P1.EXT_NAME LIKE '%".$name."%'"));


          $data = DB::connection('oracle')->select(DB::raw("SELECT C.CONTRACT_ID, P1.EXT_NAME CLIENT, TFSPH_CREDITADVICE_CM_SF (C.CPARTY_ID) COMAKER, TFSPH_GET_PARTY_ADDRESS (C.CPARTY_ID, 'Permanent') CLIENT_ADDRESS, C.DEALER_ID, D .EXT_NAME DEALER, cstat.FIELD_VALUE AS CONTRACT_STATUS, CS. VALUE AS CONTRACT_STATE, CRS. VALUE AS CREDIT_STATE, PR. NAME PRODUCT, CASE WHEN UPPER (PR. NAME) LIKE '%LEASE%' THEN 1 ELSE 2 END PRODUCT_TYPE, A .TERM, A .AMT_FINANCED, ATT. NAME UNIT, AHDR.YEAR_OF_MANUFACTURE MODEL, A . COST unit_cost, ( SELECT SUM (F.AMOUNT) FROM FLOW F WHERE F.COLLECTION_STATE >= 14800 AND F.PURCHASE_INVOICE_ID = 0 AND F.EXPECTED_DT > TO_DATE ('01-JAN-2002') AND F.CUSTOM_FLOW_HDR_ID IN (52, 162) AND F.CURRENCY_ID = 111 AND F.FLOW_TYPE = 1010 AND F.CONTRACT_ID = C.CONTRACT_ID AND F.PARTY_ACCOUNT_ID > 0 AND F.REVERSAL_STATUS = 4200 AND F.IS_CASH = 1 AND F.IS_SHADOW_COPY = 0 AND F.FLOW_ID > 0 AND F.STATUS >= 2099 AND F.ACTUAL_DT > TO_DATE ('01-JAN-2002') AND F.AMT_GROSS > 0 AND F.INSTALLMENT_NO >= 0 AND F.AMT_MATCHED <= 999999999999 AND F.STAMP >= 0 ) DOWNPAYMENT, TFSPH_CREDITADVICE_REQ_NEW_SF (C.CONTRACT_ID) REQUIREMENTS, DPPS_GET_APPDT (C.CONTRACT_ID) CREDIT_APP_DT, DPPS_GET_APPDT (C.CONTRACT_ID) + 30 CREDIT_APP_VALIDITY, DPPS_GET_APPDT_MAX (C.CONTRACT_ID) CREDIT_APP_RECON_DT, DPPS_GET_RECONDT (C.CONTRACT_ID) RECON_DT, MP.EXT_NAME MARKETING_PROFESSIONAL, LO.EXT_NAME LOAN_OFFICER FROM PARTY P1 INNER JOIN CONTRACT C ON P1.PARTY_ID = C.CPARTY_ID INNER JOIN PARTY D ON D .PARTY_ID = C.DEALER_ID AND C.DEALER_ID = ".$dealerPartyId." INNER JOIN PRODUCT PR ON C.PRODUCT_ID = PR.PRODUCT_ID INNER JOIN CONTRACT_CFV cstat ON cstat.contract_id = c.contract_id AND cstat.contract_cfd_id = 66 AND cstat.field_value = 'Pending' INNER JOIN LOOKUPSET CS ON CS.LOOKUPSET_ID = C.CONTRACT_STATE AND C.CONTRACT_STATE > = 1150 AND C.CONTRACT_STATE < 11130 INNER JOIN LOOKUPSET CRS ON CRS.LOOKUPSET_ID = C.CREDIT_STATE AND C.CREDIT_STATE IN (12050, 12060) INNER JOIN asset A ON c.contract_id = A .contract_id INNER JOIN ASSET_HDR AHDR ON A .ASSET_HDR_ID = AHDR.ASSET_HDR_ID INNER JOIN ASSET_TYPE ATT ON AHDR.ASSET_TYPE_ID = ATT.ASSET_TYPE_ID LEFT JOIN ( SELECT L.EXT_NAME, CP.CONTRACT_ID FROM CONTRACT_PARTY CP, PARTY L WHERE CP.PARTY_ID = L.PARTY_ID AND CP.SYSTEM_DEFS_PARTY_ROLE_ID = 144 ) MP ON C.CONTRACT_ID = MP.CONTRACT_ID LEFT JOIN ( SELECT L.EXT_NAME, CP.CONTRACT_ID FROM CONTRACT_PARTY CP, PARTY L WHERE CP.PARTY_ID = L.PARTY_ID AND CP.SYSTEM_DEFS_PARTY_ROLE_ID = 123 ) LO ON C.CONTRACT_ID = LO.CONTRACT_ID WHERE P1.EXT_NAME LIKE '%".$name."%'"));

        return $data;
    }

    public static function GetAssetHDRId($contractId) {

        $data = DB::connection('oracle')->select(DB::raw("SELECT ASSET_HDR_ID FROM ASSET WHERE CONTRACT_ID = ".$contractId.""));

        if($data!=null) 
            $data = $data[0]->asset_hdr_id;
        

        return $data;

    }

    public static function GetAssetClassIdByContractId($contractId) {

        $assetHRId = self::GetAssetHDRId($contractId);
        $data = null;

        if($assetHRId!=null) {
            $data = DB::connection('oracle')->select(DB::raw("SELECT ASSET_CLASS_ID FROM ASSET_CLASS_VEHICLE WHERE ASSET_HDR_ID = ".$assetHRId.""));

            if($data!=null)
                $data = $data[0]->asset_class_id;
        }

        return $data;
    }

    public static function GetInsuranceDetails($contractId) {
        $assetHRId = self::GetAssetHDRId($contractId);

        $data = DB::connection('oracle')->select(DB::raw("SELECT INPUT_DT, EXPIRY_DT, AMOUNT, COMMENTS FROM ASSET_HDR_INSURANCE WHERE ASSET_HDR_INSURANCE_ID = (SELECT MIN(ASSET_HDR_INSURANCE_ID) FROM ASSET_HDR_INSURANCE WHERE ASSET_HDR_ID = ".$assetHRId.")"));
        
        return $data;
    }

    public static function GetAssetClassVehicleDetails($contractId) {
        $assetHRId = self::GetAssetHDRId($contractId);

        $data = DB::connection('oracle')->select(DB::raw("SELECT VIN_NO, CHASSIS_NO, ENGINE_NO, COLOUR FROM ASSET_CLASS_VEHICLE WHERE ASSET_HDR_ID = ".$assetHRId));
        
        return $data;
    }

    public static function GetOrigPurchaseDate($contractId) {

        $assetHRId = self::GetAssetHDRId($contractId);
        $data = null;

        if($assetHRId!=null) {
            $data = DB::connection('oracle')->select(DB::raw("SELECT ORIGINAL_PURCHASE_DT FROM ASSET_HDR WHERE ASSET_HDR_ID = ".$assetHRId.""));

            if($data!=null)
                $data = $data[0]->original_purchase_dt;
        }

        return $data;
    }


    public static function GetInsuranceCount($contractId) {

        $assetHRId = self::GetAssetHDRId($contractId);
        $data = null;

        if($assetHRId!=null) {
            $data = DB::connection('oracle')->select(DB::raw("SELECT COUNT(ASSET_HDR_ID) as ins_count from ASSET_HDR_INSURANCE where ASSET_HDR_ID = ".$assetHRId.""));
            // dd($data);
            if($data!=null)
                $data = $data[0]->ins_count;
        }

        return $data;
    }

    public static function InsertInsurance($contractId, $effectiveDate, $expiryDate, $liability, $comments) {

        $assetHRId = self::GetAssetHDRId($contractId);
        
        $data = DB::connection('oracle')->insert(DB::raw("INSERT INTO ASSET_HDR_INSURANCE ( ASSET_HDR_ID, INSURANCE_PARTY_ID, INPUT_DT, EXPIRY_DT, AMOUNT, EXCESS_AMOUNT, POLICY_TYPE, COMMENTS, STAMP ) VALUES (". $assetHRId .", 0, TO_DATE ('".$effectiveDate."', 'yyyy/mm/dd'), TO_DATE ('".$expiryDate."', 'yyyy/mm/dd'), ". $liability.", 0, ' ', '". $comments."', 0 )"));
    }

    public static function GetInsuranceStamp($assetHRId) {

        $data = null;

        if($assetHRId!=null) {
            $data = DB::connection('oracle')->select(DB::raw("SELECT STAMP, ASSET_HDR_INSURANCE_ID FROM ASSET_HDR_INSURANCE WHERE ASSET_HDR_INSURANCE_ID = (SELECT MIN(ASSET_HDR_INSURANCE_ID) FROM ASSET_HDR_INSURANCE WHERE ASSET_HDR_ID = ".$assetHRId.")"));

        }

        return $data;
    }

    public static function UpdateInsurance($contractId, $effectiveDate, $expiryDate, $liability, $comments) {

        $assetHRId = self::GetAssetHDRId($contractId);
        $result = self::GetInsuranceStamp($assetHRId);
        
        $stamp = $result[0]->stamp+1;
        $assetHDRInsuranceId = $result[0]->asset_hdr_insurance_id;

        $data = DB::connection('oracle')->update(DB::raw("UPDATE ASSET_HDR_INSURANCE SET INPUT_DT = TO_DATE ('".$effectiveDate."', 'yyyy/mm/dd'), EXPIRY_DT = TO_DATE ('".$expiryDate."', 'yyyy/mm/dd'), AMOUNT = ". $liability.", COMMENTS = '". $comments."', STAMP = ".$stamp."  WHERE ASSET_HDR_INSURANCE_ID = ".$assetHDRInsuranceId.""));

    }


    public static function GetAssetId($contractId) {
         $data = DB::connection('oracle')->select(DB::raw("select asset_id from asset where contract_id = ".$contractId.""));
         
         return $data[0]->asset_id;
    }

    public static function CheckIfAssetIdExist($assetId) {
        // dd($assetId);
        $data = DB::connection('oracle')->select(DB::raw("select asset_id from asset_cfv where asset_id = ".$assetId." and asset_cfd_id = 19 "));
        // dd($data);
        if ($data == null) {
            // dd("aaaadsdsdddd");
            return false;
        }

        return true;
    }

    public static function InsertInvoiceNo($assetId, $invoiceNo) {
        // dd("dasdad");
        $data = DB::connection('oracle')->insert(DB::raw("insert into asset_cfv (asset_id, asset_cfd_id, field_value, image_no, stamp) values (".$assetId.", 19, '".$invoiceNo."', 0, 0)"));
    }

    public static function UpdateInvoiceNo($assetId, $invoiceNo) {
        // dd("aaaaa");
        $data = DB::connection('oracle')->update(DB::raw("update asset_cfv set field_value = '".$invoiceNo."' where asset_id = ".$assetId." and asset_cfd_id = 19"));
    }

    public static function GetInvoice($contractId) {
        $assetId = self::GetAssetId($contractId);
        // dd($assetId);
        // select field_value from asset_cfv where asset_id = asset_id and asset_cfd_id = 19
        $data = DB::connection('oracle')->select(DB::raw("select field_value from asset_cfv where asset_id = ".$assetId." and asset_cfd_id = 19"));
         // dd($data);

        if($data != null)
         return $data[0]->field_value;

         return "";
    }
}
