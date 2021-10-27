<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TFSPHSignatory extends Model
{
    protected $table = 'tfsph_signatories';

    public $primaryKey = 'dealer_info_party_id'; 
    public $incrementing = false;

    protected $fillable = [
        'dealer_info_party_id',
    ];

    public static function GetTFSPHSignatoriesByDealerId($id) {
    	// $row = self::where('dealer_info_party_id', $id)->first();

    	$row = self::GetTFSPHSignatoriesRowByDealerId($id);
    	
    	$signatories = array();

    	if($row != null) {
			$signatories[] = TFSPHSignatoryDetail::GetSignatoryDetail($row->signatory1_id);
			$signatories[] = TFSPHSignatoryDetail::GetSignatoryDetail($row->signatory2_id);
		} 
		// else {
		// 	$signatories[] = null;
		// 	$signatories[] = null;
		// }

    	return $signatories;
    }

    public static function GetTFSPHSignatoriesRowByDealerId($id) {
    	$row = self::where('dealer_info_party_id', $id)->first();

    	if($row == null) {
    		$row = self::create([
    			'dealer_info_party_id'	=> $id,
    		]);
    	}

    	return $row;
    }
}
