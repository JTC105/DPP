<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PNCMFeesDealerRef extends Model
{
    protected $table = 'pncmfees_dealer_ref';

    public static function GetRowByPartyId($id) {
        $data = self::where('dealer_party_id', $id)->first();

        return $data;
    }

    public static function GetSpecificTableRef($id) {
        $tname = "";
        $tabledata = "";

        switch ($id) {
            case 1: // Table 1
                $tname = "TABLE 1";
                $tabledata = new PNCMFeesRetailTable1();
                break;
            
            case 2: // Table 2
                $tname = "TABLE 2"; 
                $tabledata = new PNCMFeesRetailTable2();
                break;

            case 3: // Table 3
                $tname = "TABLE 3";
                $tabledata = new PNCMFeesRetailTable3();
                break;
        }

        $data = [
            'tname'             => $tname,
            'tableinstance'     => $tabledata,
        ];

        // dd($data);

        return $data;


    }

    public static function GetTableRefs() {
    	$data = [
            [
                'name'  => "TABLE 1",
                'ctr'   => 1,
            ],
            [
                'name'  => "TABLE 2",
                'ctr'   => 2,
            ],
            [
                'name'  => "TABLE 3",
                'ctr'   => 3,
            ]
        ];

        return $data;
    }

    public static function GetPartyTypeRetailTypeCustomFieldId($value) {
        $fieldId = 0;

        if($value == 2) // 2 party
            $fieldId = 1;
        if($value == 3) // 3 party
           $fieldId = 2;

       return $fieldId;
    }

}
