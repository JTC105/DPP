<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ContractRequirementLog extends Model
{
    protected $table = 'contract_requirement_logs';

    public static function GetDataForNotesLogNotes($request) {
      $crIds = null;
      if($request->genReq!=null) {
    	 $crIds[] = (int)$request->genReq;
      }

        if($request->partyType == 1) {
          if($request->indiReq!=null) {
            foreach ($request->indiReq as $ir) {
              $crIds[] += $ir;
            }
          }
        } else if($request->partyType == 2) {
          if($request->corpoReq!=null) {
            foreach ($request->corpoReq as $cr) {
              $crIds[] += $cr;
            }
          }
        }
        if($request->othersReq!=null) {
          foreach ($request->othersReq as $or) {
            $crIds[] += $or;
          }
        }

        $notes = null;
        if($crIds != null) {
          foreach ($crIds as $id) {
            $notes .= CustomField::where('desc_id', 105)->where('field_id', $id)->first()->field_value . "\n";
          }
        }
        // dd($crIds);
        $data = [
        	'ids'	=> $crIds,
        	'notes'	=> $notes,
        ];

        return $data;
    }

    public static function GetDataForConReqIds($request) {
      $crIds = null;
      if($request->genReq!=null) {
       $crIds[] = (int)$request->genReq;
      }

      if($request->indiReq!=null) {
        foreach ($request->indiReq as $ir) {
          $crIds[] += $ir;
        }
      }

      if($request->corpoReq!=null) {
        foreach ($request->corpoReq as $cr) {
          $crIds[] += $cr;
        }
      }

      if($request->othersReq!=null) {
        foreach ($request->othersReq as $or) {
          $crIds[] += $or;
        }
      }


      $data = [
        'ids' => $crIds,
      ];

      return $data;
    }

    public static function GetDataForLogNotes($ids) {
       $notes = "Processed files: "."\n";

        if($ids != null && count($ids) != 0)
          $crIds = explode(",", $ids);
        else {
          $crIds = null;
          $notes = "Uploaded file.";
        }

        if($crIds != null) {
          foreach ($crIds as $id) {
            $notes .= "-".CustomField::where('desc_id', 105)->where('field_id', $id)->first()->field_value . "\n";
          }
        }

        return $notes;

    }

    public static function GetDataFileLogForAdminLog($ids) {
        if($ids != null && count($ids) != 0)
          $crIds = explode(",", $ids);
        else
          $crIds = null;

        $notes = "(";

        for($i=0;$i<count($crIds);$i++) {
          $id = $crIds[$i];
          $notes .= CustomField::where('desc_id', 105)->where('field_id', $id)->first()->field_value;

          if($i<count($crIds)-1)
            $notes .= ", ";
        }
        $notes .= ")";

        return $notes;
    }
}
