<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TFSPHSignatoryDetail extends Model
{
    protected $table = 'tfsph_signatory_details';


    public static function GetSignatoryDetail($id) {
    	return self::where('id',$id)->first();
    }

    public static function GetAllTFSPHSignatories() {
    	return self::where('is_active', true)->get();
    }

}
