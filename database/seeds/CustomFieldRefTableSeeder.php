<?php

use Illuminate\Database\Seeder;

use App\Model\CustomFieldRef;

class CustomFieldRefTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = [

['desc_id' => 101, 'desc' => 'product_type'],
['desc_id' => 102, 'desc' => 'retail_type'],
['desc_id' => 103, 'desc' => 'party_type'],
['desc_id' => 104, 'desc' => 'vehicle_usage'],
['desc_id' => 105, 'desc' => 'contract_requirement'],

    	];

    	foreach ($data as $d) {
		    $model = new CustomFieldRef($d);
		    $model->save();
		}
    }
}
