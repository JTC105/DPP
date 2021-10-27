<?php

use Illuminate\Database\Seeder;

use App\Model\PNCMFeesDealerRef;

class PNCMFeesDealerRefTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

['dealer_party_id' => 82,'table_no' => 'NONE'],
['dealer_party_id' => 69,'table_no' => 'TABLE 1'],
['dealer_party_id' => 47060,'table_no' => 'TABLE 1'],
['dealer_party_id' => 47247,'table_no' => 'TABLE 2'],
['dealer_party_id' => 48716,'table_no' => 'TABLE 1'],
['dealer_party_id' => 67,'table_no' => 'TABLE 1'],
['dealer_party_id' => 62,'table_no' => 'TABLE 1'],
['dealer_party_id' => 66,'table_no' => 'TABLE 1'],
['dealer_party_id' => 73,'table_no' => 'TABLE 1'],
['dealer_party_id' => 70,'table_no' => 'TABLE 1'],
['dealer_party_id' => 63,'table_no' => 'TABLE 1'],
['dealer_party_id' => 61,'table_no' => 'TABLE 2'],
['dealer_party_id' => 863925,'table_no' => 'TABLE 1'],
['dealer_party_id' => 64,'table_no' => 'TABLE 1'],
['dealer_party_id' => 47830,'table_no' => 'TABLE 1'],
['dealer_party_id' => 48790,'table_no' => 'TABLE 1'],
['dealer_party_id' => 15,'table_no' => 'TABLE 1'],
['dealer_party_id' => 47257,'table_no' => 'TABLE 2'],
['dealer_party_id' => 65,'table_no' => 'TABLE 1'],
['dealer_party_id' => 469062,'table_no' => 'TABLE 1'],
['dealer_party_id' => 1776349,'table_no' => 'TABLE 1'],
['dealer_party_id' => 84,'table_no' => 'TABLE 1'],
['dealer_party_id' => 995413,'table_no' => 'TABLE 1'],
['dealer_party_id' => 199572,'table_no' => 'TABLE 1'],
['dealer_party_id' => 285035,'table_no' => 'TABLE 1'],
['dealer_party_id' => 1581192,'table_no' => 'TABLE 1'],
['dealer_party_id' => 76,'table_no' => 'TABLE 1'],
['dealer_party_id' => 917785,'table_no' => 'TABLE 1'],
['dealer_party_id' => 1801466,'table_no' => 'TABLE 1'],
['dealer_party_id' => 399289,'table_no' => 'NONE'],
['dealer_party_id' => 290143,'table_no' => 'TABLE 2'],
['dealer_party_id' => 356028,'table_no' => 'NONE'],
['dealer_party_id' => 1964519,'table_no' => 'TABLE 2'],
['dealer_party_id' => 78,'table_no' => 'NONE'],
['dealer_party_id' => 1456034,'table_no' => 'TABLE 1'],
['dealer_party_id' => 984763,'table_no' => 'NONE'],
['dealer_party_id' => 2066917,'table_no' => 'NONE'],
['dealer_party_id' => 995445,'table_no' => 'NONE'],
['dealer_party_id' => 2067310,'table_no' => 'NONE'],
['dealer_party_id' => 77,'table_no' => 'NONE'],
['dealer_party_id' => 185339,'table_no' => 'NONE'],
['dealer_party_id' => 1592922,'table_no' => 'NONE'],
['dealer_party_id' => 1856374,'table_no' => 'NONE'],
['dealer_party_id' => 339440,'table_no' => 'NONE'],
['dealer_party_id' => 75,'table_no' => 'NONE'],
['dealer_party_id' => 703697,'table_no' => 'NONE'],
['dealer_party_id' => 1654938,'table_no' => 'NONE'],
['dealer_party_id' => 1609012,'table_no' => 'NONE'],
['dealer_party_id' => 81,'table_no' => 'NONE'],
['dealer_party_id' => 300230,'table_no' => 'NONE'],
['dealer_party_id' => 80,'table_no' => 'NONE'],
['dealer_party_id' => 1772076,'table_no' => 'NONE'],
['dealer_party_id' => 296399,'table_no' => 'NONE'],
['dealer_party_id' => 79,'table_no' => 'NONE'],
['dealer_party_id' => 1565355,'table_no' => 'NONE'],
['dealer_party_id' => 1591773,'table_no' => 'NONE'],
['dealer_party_id' => 779812,'table_no' => 'NONE'],
['dealer_party_id' => 86,'table_no' => 'NONE'],
['dealer_party_id' => 1916802,'table_no' => 'NONE'],
['dealer_party_id' => 74,'table_no' => 'NONE'],
['dealer_party_id' => 434699,'table_no' => 'NONE'],
['dealer_party_id' => 501221,'table_no' => 'NONE'],
['dealer_party_id' => 1793929,'table_no' => 'NONE'],
['dealer_party_id' => 779828,'table_no' => 'NONE'],
['dealer_party_id' => 393904,'table_no' => 'NONE'],
['dealer_party_id' => 1830254,'table_no' => 'NONE'],
['dealer_party_id' => 1826572,'table_no' => 'NONE'],
['dealer_party_id' => 48422,'table_no' => 'TABLE 3'],
['dealer_party_id' => 408799,'table_no' => 'TABLE 3'],
['dealer_party_id' => 1827004,'table_no' => 'TABLE 3'],
['dealer_party_id' => 85,'table_no' => 'TABLE 3'],
['dealer_party_id' => 2059078,'table_no' => 'TABLE 1'],



        ];

        foreach ($data as $d) {
            $model = new PNCMFeesDealerRef($d);
            $model->save();
        }
    }
}
