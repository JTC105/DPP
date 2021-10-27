<?php

use Illuminate\Database\Seeder;

use App\Model\CustomField;

class CustomFieldTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = [
    		
['desc_id' => 101,'field_id' => 1, 'field_name' => 'Lease'],
['desc_id' => 101,'field_id' => 2, 'field_name' => 'Retail'],
['desc_id' => 102,'field_id' => 1, 'field_name' => '2 Party'],
['desc_id' => 102,'field_id' => 2, 'field_name' => '3 Party'],
['desc_id' => 103,'field_id' => 1, 'field_name' => 'Individual'],
['desc_id' => 103,'field_id' => 2, 'field_name' => 'Corporation'],
['desc_id' => 104,'field_id' => 1, 'field_name' => 'Private'],
['desc_id' => 104,'field_id' => 2, 'field_name' => 'Public'],
['desc_id' => 104,'field_id' => 3, 'field_name' => 'Business'],

['desc_id' => 105,'field_id' => 1, 'field_name' => 'GeneralReq', 'field_value' => 'Downpayment Invoice'],

['desc_id' => 105,'field_id' => 2, 'field_name' => 'IndividualReq', 'field_value' => 'Completely Filled-Up and Signed Credit Application (CFUSCA)'],
['desc_id' => 105,'field_id' => 3, 'field_name' => 'IndividualReq', 'field_value' => 'At least two (2) valid government-issued IDs'],
['desc_id' => 105,'field_id' => 4, 'field_name' => 'IndividualReq', 'field_value' => 'Three (3) original specimen signature'],
['desc_id' => 105,'field_id' => 5, 'field_name' => 'IndividualReq', 'field_value' => 'Insurance Policy and OR of payment'],
['desc_id' => 105,'field_id' => 6, 'field_name' => 'IndividualReq', 'field_value' => 'Promissory Note and Chattel Mortgage (for Retail Account) - 8 sets'],
['desc_id' => 105,'field_id' => 7, 'field_name' => 'IndividualReq', 'field_value' => 'Lease Contract (Lease Financing) - 6 sets'],
['desc_id' => 105,'field_id' => 8, 'field_name' => 'IndividualReq', 'field_value' => 'Vehicle Sales Invoice and Delivery Receipt'],
['desc_id' => 105,'field_id' => 9, 'field_name' => 'IndividualReq', 'field_value' => 'LTO Stencil (Blue Form) - 3 original copies'],

['desc_id' => 105,'field_id' => 10, 'field_name' => 'CorporateReq', 'field_value' => 'SEC Registration'],
['desc_id' => 105,'field_id' => 11, 'field_name' => 'CorporateReq', 'field_value' => 'Articles of Inc. and By-Laws'],
['desc_id' => 105,'field_id' => 12, 'field_name' => 'CorporateReq', 'field_value' => 'Board Resolution / Secretary\'s Certificate'],
['desc_id' => 105,'field_id' => 13, 'field_name' => 'CorporateReq', 'field_value' => 'General Information Sheet (latest)'],
['desc_id' => 105,'field_id' => 14, 'field_name' => 'CorporateReq', 'field_value' => 'Audited Financial Statement (latest)'],

['desc_id' => 105,'field_id' => 15, 'field_name' => 'OthersReq', 'field_value' => 'Latest ITR / Latest 3 months payslip / Certificate of Tax Filing / Reg. (except for OFWs and other tax-exempt individuals)'],
['desc_id' => 105,'field_id' => 16, 'field_name' => 'OthersReq', 'field_value' => 'LTO Insurance Policy for Public Use'],
['desc_id' => 105,'field_id' => 17, 'field_name' => 'OthersReq', 'field_value' => 'a. Post Dated Checks (at lease 24 pieces)'],
['desc_id' => 105,'field_id' => 18, 'field_name' => 'OthersReq', 'field_value' => 'b. Autodebit (ADA) Form'],
['desc_id' => 105,'field_id' => 19, 'field_name' => 'OthersReq', 'field_value' => 'c. OTC Undertaking'],
['desc_id' => 105,'field_id' => 20, 'field_name' => 'OthersReq', 'field_value' => 'Proof of Foreign Identification - (For Foreign National)'],
['desc_id' => 105,'field_id' => 21, 'field_name' => 'OthersReq', 'field_value' => 'Affidavit / SPA (if applicable)'],

['desc_id' => 105,'field_id' => 22, 'field_name' => 'ConReqIds', 'field_value' => ''], // Values are field_ids of those 105 that are REQUIRED

    	];

    	foreach ($data as $d) {
		    $model = new CustomField($d);
		    $model->save();
		}
    }
}
