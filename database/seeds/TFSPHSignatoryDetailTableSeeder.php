<?php

use Illuminate\Database\Seeder;

use App\Model\TFSPHSignatoryDetail;

class TFSPHSignatoryDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = [

['name' => 'Ma. Fe S. Medrano, AVP', 'tin_id' => '129-530-458', 'govt_id' => '33-0690958-5', 'position' => 'Assistant Vice President'],
['name' => 'Rosemarie B. Balina, AVP', 'tin_id' => '154-087-616', 'govt_id' => '33-0914861-5', 'position' => 'Assistant Vice President'],
['name' => 'Analyn A. Arpiesa, Mgr. ', 'tin_id' => '177-087-379', 'govt_id' => '33-2084142-5', 'position' => 'Manager'],
['name' => 'Kathleen L. Amores, VP', 'tin_id' => '206-540-895', 'govt_id' => '33-6407139-0', 'position' => 'Vice President'],
['name' => 'Ma. Marissa L. Dionisio, SM', 'tin_id' => '171-412-005', 'govt_id' => '02-1049916-8', 'position' => 'Senior Manager'],
['name' => 'Angelina D. Lagman, SM', 'tin_id' => '120-095-393', 'govt_id' => '04-0741180-7', 'position' => 'Senior Manager'],
['name' => 'Jaime O. Dela Cruz, Jr., SM', 'tin_id' => '302-899-358', 'govt_id' => '33-7272714-4', 'position' => 'Senior Manager'],
['name' => 'Bernadette B. Bartolazo, SM', 'tin_id' => '188-658-802', 'govt_id' => '33-3834701-8', 'position' => 'Senior Manager'],
['name' => 'Rommel J. Ocampo, SVP', 'tin_id' => '155-319-596', 'govt_id' => '33-1458729-0', 'position' => 'Senior Vice President'],
['name' => 'Jamar D. Dalisay, AVP', 'tin_id' => '178-806-751', 'govt_id' => '33-2169961-8', 'position' => 'Assistant Vice President'],
['name' => 'Maria Cecilia E. Baltazar, VP', 'tin_id' => '186-888-484', 'govt_id' => '33-2792056-9', 'position' => 'Vice President'],
['name' => 'Josephine C. Gayumali, SM', 'tin_id' => '912-194-256', 'govt_id' => '33-3441790-0', 'position' => 'Senior Manager'],
['name' => 'Nedylane C. Camit, Mgr.', 'tin_id' => '199-414-334', 'govt_id' => '33-2908574-5', 'position' => 'Manager'],
['name' => 'Marlon M. Pernez, VP', 'tin_id' => '129-435-190', 'govt_id' => '03-9877612-5', 'position' => 'Vice President'],
['name' => 'Bernard M. Carague, SVP', 'tin_id' => '146-473-570', 'govt_id' => '03-9471251-2', 'position' => 'Senior Vice President'],
['name' => 'Yuen A. Zacarias, Mgr. ', 'tin_id' => '284-172-632', 'govt_id' => '34-1818896-4', 'position' => 'Manager'],
['name' => 'John Franco B. Lim, SM', 'tin_id' => '268-285-586', 'govt_id' => '34-0272194-2', 'position' => 'Senior Manager'],

    	];

    	foreach ($data as $d) {
		    $model = new TFSPHSignatoryDetail($d);
		    $model->save();
		}
    }
}
