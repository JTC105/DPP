<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ContractsHistory extends Model
{
    protected $table = 'contracts_histories';

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
    	if($id!=null && $id != " ") {
	        $type = CustomField::GetFieldNameByDescAndFieldId('vehicle_usage',$id);

	        return $type;
    	} 

    	return null;
    }

    public function GetVehicleName($id) {
    	$name = Vehicle::where('id', $id)->first()->name;

    	return $name;
    }

    public function GetCityMunicipality($id) {
    	$citymun = CityMun::where('id', $id)->first();

    	return $citymun;
    }

}
