<?php

use Illuminate\Database\Seeder;

use App\Model\Policy;

class PolicyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $details = [

['name' => 'lockoutUser', 'display_name' => 'Lockout User', 'desc' => 'Number of login failures until user account is locked.', 'value' => '3'],
['name' => 'passExpiry', 'display_name' => 'Password Expiry', 'desc' => 'Days until password expires.', 'value' => '90'],
['name' => 'passExpiryWarning', 'display_name' => 'Password Expiry Warning', 'desc' => 'Show warning(x) days before password expiry.', 'value' => '10'],
['name' => 'passMinLen', 'display_name' => 'Password Minimum Length', 'desc' => 'Minimum length (characters) of password.', 'value' => '8'],
['name' => 'passMaxLen', 'display_name' => 'Password Maximum Length', 'desc' => 'Maximum length (characters) of password.', 'value' => '15'],
['name' => 'passDefaultTfs', 'display_name' => 'Default Password (TFS)', 'desc' => 'Default Password of TFSPH employees', 'value' => 'Kaizen@86'],
['name' => 'passDefaultDealer', 'display_name' => 'Default Password (Dealer)', 'desc' => 'Default Password of Dealers.', 'value' => 'Tfsph.101'],

        ];

        foreach ($details as $detail) {
            $model = new Policy($detail);
            if($detail['name']=='passDefaultTfs' || $detail['name']=='passDefaultDealer')
                $model->value = bcrypt($detail['value']);
            
            $model->save();
        }
    }
}
