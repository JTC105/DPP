<?php

use Illuminate\Database\Seeder;

use App\Model\BookingGuideline;

class BookingGuidelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

['title' => 'Title', 'content' => 'Content'],

    	];

    	foreach ($data as $d) {
		    $model = new BookingGuideline($d);
		    $model->save();
		}
    }
}
