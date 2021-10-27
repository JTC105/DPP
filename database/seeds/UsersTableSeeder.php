<?php

use Illuminate\Database\Seeder;
use App\Model\User;
use App\Model\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->username = "tfsadmin";
        $user->password = bcrypt('Kaizen@86');
        $user->dealer_party_id = 0;
        $user->is_admin_level = 1;
        $user->save();
        $role = Role::where('name', 'admin')->first();
        $user->attachRole($role);

        $user = new User();
        $user->username = "tfscustomuser1";
        $user->password = bcrypt('Kaizen@86');
        $user->dealer_party_id = 0;
        $user->is_admin_level = 2;
        $user->creator_id = 1;
        $user->save();
        $role = Role::where('id', 4)->first();
        $user->attachRole($role);

        // $user = new User();
        // $user->username = "tfsadmin2";
        // $user->password = bcrypt(User::UserPassword('admin'));
        // $user->dealer_party_id = 0;
        // $user->save();
        // $role = Role::where('name', 'admin')->first();
        // $user->attachRole($role);

        // // $user = new User();
        // // $user->username = "tfsmandaue";
        // // $user->password = bcrypt('12345');
        // // $user->dealer_party_id = 81;
        // // $user->save();
        // // $role = Role::where('name', 'dealer')->first();
        // // $user->attachRole($role);

        // // $user = new User();
        // // $user->username = "tfsmakati";
        // // $user->password = bcrypt('12345');
        // // $user->dealer_party_id = 65;
        // // $user->save();
        // // $role = Role::where('name', 'dealer')->first();
        // // $user->attachRole($role);

        $dealerUsers = [
['username' => 'tfs_tai1', 'dealer_party_id' => 15],
['username' => 'tfs_tne1', 'dealer_party_id' => 61],
['username' => 'tfs_tbpi1', 'dealer_party_id' => 62],
['username' => 'tfs_tci1', 'dealer_party_id' => 63],
['username' => 'tfs_tci2', 'dealer_party_id' => 64],
['username' => 'tfs_tmi1', 'dealer_party_id' => 65],
['username' => 'tfs_tmbc1', 'dealer_party_id' => 66],
['username' => 'tfs_tm1', 'dealer_party_id' => 67],
['username' => 'tfs_tpti1', 'dealer_party_id' => 69],
['username' => 'tfs_tqai1', 'dealer_party_id' => 70],
['username' => 'tfs_tp1', 'dealer_party_id' => 73],
['username' => 'tfs_tbc1', 'dealer_party_id' => 74],
['username' => 'tfs_tb1', 'dealer_party_id' => 75],
['username' => 'tfs_tb2', 'dealer_party_id' => 76],
['username' => 'tfs_tc1', 'dealer_party_id' => 77],
['username' => 'tfs_tsfi1', 'dealer_party_id' => 78],
['username' => 'tfs_tcdo1', 'dealer_party_id' => 79],
['username' => 'tfs_tcc1', 'dealer_party_id' => 80],
['username' => 'tfs_tm2', 'dealer_party_id' => 81],
['username' => 'tfs_td1', 'dealer_party_id' => 82],
['username' => 'tfs_tdc1', 'dealer_party_id' => 84],
['username' => 'tfs_tdc2', 'dealer_party_id' => 85],
['username' => 'tfs_tin1', 'dealer_party_id' => 86],
['username' => 'tfs_tsi1', 'dealer_party_id' => 47060],
['username' => 'tfs_toi1', 'dealer_party_id' => 47247],
['username' => 'tfs_tbmi1', 'dealer_party_id' => 47257],
['username' => 'tfs_lmi1', 'dealer_party_id' => 47830],
['username' => 'tfs_tgs1', 'dealer_party_id' => 48422],
['username' => 'tfs_tasm1', 'dealer_party_id' => 48716],
['username' => 'tfs_tgc1', 'dealer_party_id' => 48790],
['username' => 'tfs_tlu1', 'dealer_party_id' => 185339],
['username' => 'tfs_tspli1', 'dealer_party_id' => 199572],
['username' => 'tfs_tcli1', 'dealer_party_id' => 285035],
['username' => 'tfs_tmbi1', 'dealer_party_id' => 290143],
['username' => 'tfs_ttli1', 'dealer_party_id' => 296399],
['username' => 'tfs_tmsc1', 'dealer_party_id' => 300230],
['username' => 'tfs_tsii1', 'dealer_party_id' => 339440],
['username' => 'tfs_tpb1', 'dealer_party_id' => 356028],
['username' => 'tfs_tbc2', 'dealer_party_id' => 393904],
['username' => 'tfs_tcsi1', 'dealer_party_id' => 399289],
['username' => 'tfs_ttc1', 'dealer_party_id' => 408799],
['username' => 'tfs_tdc3', 'dealer_party_id' => 434699],
['username' => 'tfs_ttri1', 'dealer_party_id' => 469062],
['username' => 'tfs_tppci1', 'dealer_party_id' => 501221],
['username' => 'tfs_ttc2', 'dealer_party_id' => 703697],
['username' => 'tfs_trc1', 'dealer_party_id' => 779812],
['username' => 'tfs_tzc1', 'dealer_party_id' => 779828],
['username' => 'tfs_tfi1', 'dealer_party_id' => 863925],
['username' => 'tfs_tlbi1', 'dealer_party_id' => 917785],
['username' => 'tfs_tbi1', 'dealer_party_id' => 984763],
['username' => 'tfs_tbci1', 'dealer_party_id' => 995413],
['username' => 'tfs_ttc3', 'dealer_party_id' => 995445],
['username' => 'tfs_tapi1', 'dealer_party_id' => 1456034],
['username' => 'tfs_tcsi2', 'dealer_party_id' => 1565355],
['username' => 'tfs_tsrli1', 'dealer_party_id' => 1581192],
['username' => 'tfs_tai2', 'dealer_party_id' => 1591773],
['username' => 'tfs_tin2', 'dealer_party_id' => 1592922],
['username' => 'tfs_ttc4', 'dealer_party_id' => 1609012],
['username' => 'tfs_tmci1', 'dealer_party_id' => 1654938],
['username' => 'tfs_tllc1', 'dealer_party_id' => 1772076],
['username' => 'tfs_tsci1', 'dealer_party_id' => 1776349],
['username' => 'tfs_tici1', 'dealer_party_id' => 1793929],
['username' => 'tfs_tcci1', 'dealer_party_id' => 1801466],
['username' => 'tfs_tkc1', 'dealer_party_id' => 1826572],
['username' => 'tfs_tmd1', 'dealer_party_id' => 1827004],
['username' => 'tfs_tvci1', 'dealer_party_id' => 1830254],
['username' => 'tfs_ttc5', 'dealer_party_id' => 1856374],
['username' => 'tfs_tno1', 'dealer_party_id' => 1916802],
['username' => 'tfs_tsjdmb1', 'dealer_party_id' => 1964519],
['username' => 'tfs_mni1', 'dealer_party_id' => 2059078],
['username' => 'tfs_tsi2', 'dealer_party_id' => 2066917],
['username' => 'tfs_tnei1', 'dealer_party_id' => 2067310],
        ];

        $role = Role::where('name', 'dealer')->first();
        foreach ($dealerUsers as $du) {
            $model = new User($du);
            $model->password = User::UserPassword($role->name);//bcrypt(User::UserPassword($role->name));
            $model->save();            
            $model->attachRole($role);
        }

        $dealerUsersLOs = [
['username' => 'tfs_lo_tai1', 'dealer_party_id' => 15],
['username' => 'tfs_lo_tne1', 'dealer_party_id' => 61],
['username' => 'tfs_lo_tbpi1', 'dealer_party_id' => 62],
['username' => 'tfs_lo_tci1', 'dealer_party_id' => 63],
['username' => 'tfs_lo_tci2', 'dealer_party_id' => 64],
['username' => 'tfs_lo_tmi1', 'dealer_party_id' => 65],
['username' => 'tfs_lo_tmbc1', 'dealer_party_id' => 66],
['username' => 'tfs_lo_tm1', 'dealer_party_id' => 67],
['username' => 'tfs_lo_tpti1', 'dealer_party_id' => 69],
['username' => 'tfs_lo_tqai1', 'dealer_party_id' => 70],
['username' => 'tfs_lo_tp1', 'dealer_party_id' => 73],
['username' => 'tfs_lo_tbc1', 'dealer_party_id' => 74],
['username' => 'tfs_lo_tb1', 'dealer_party_id' => 75],
['username' => 'tfs_lo_tb2', 'dealer_party_id' => 76],
['username' => 'tfs_lo_tc1', 'dealer_party_id' => 77],
['username' => 'tfs_lo_tsfi1', 'dealer_party_id' => 78],
['username' => 'tfs_lo_tcdo1', 'dealer_party_id' => 79],
['username' => 'tfs_lo_tcc1', 'dealer_party_id' => 80],
['username' => 'tfs_lo_tm2', 'dealer_party_id' => 81],
['username' => 'tfs_lo_td1', 'dealer_party_id' => 82],
['username' => 'tfs_lo_tdc1', 'dealer_party_id' => 84],
['username' => 'tfs_lo_tdc2', 'dealer_party_id' => 85],
['username' => 'tfs_lo_tin1', 'dealer_party_id' => 86],
['username' => 'tfs_lo_tsi1', 'dealer_party_id' => 47060],
['username' => 'tfs_lo_toi1', 'dealer_party_id' => 47247],
['username' => 'tfs_lo_tbmi1', 'dealer_party_id' => 47257],
['username' => 'tfs_lo_lmi1', 'dealer_party_id' => 47830],
['username' => 'tfs_lo_tgs1', 'dealer_party_id' => 48422],
['username' => 'tfs_lo_tasm1', 'dealer_party_id' => 48716],
['username' => 'tfs_lo_tgc1', 'dealer_party_id' => 48790],
['username' => 'tfs_lo_tlu1', 'dealer_party_id' => 185339],
['username' => 'tfs_lo_tspli1', 'dealer_party_id' => 199572],
['username' => 'tfs_lo_tcli1', 'dealer_party_id' => 285035],
['username' => 'tfs_lo_tmbi1', 'dealer_party_id' => 290143],
['username' => 'tfs_lo_ttli1', 'dealer_party_id' => 296399],
['username' => 'tfs_lo_tmsc1', 'dealer_party_id' => 300230],
['username' => 'tfs_lo_tsii1', 'dealer_party_id' => 339440],
['username' => 'tfs_lo_tpb1', 'dealer_party_id' => 356028],
['username' => 'tfs_lo_tbc2', 'dealer_party_id' => 393904],
['username' => 'tfs_lo_tcsi1', 'dealer_party_id' => 399289],
['username' => 'tfs_lo_ttc1', 'dealer_party_id' => 408799],
['username' => 'tfs_lo_tdc3', 'dealer_party_id' => 434699],
['username' => 'tfs_lo_ttri1', 'dealer_party_id' => 469062],
['username' => 'tfs_lo_tppci1', 'dealer_party_id' => 501221],
['username' => 'tfs_lo_ttc2', 'dealer_party_id' => 703697],
['username' => 'tfs_lo_trc1', 'dealer_party_id' => 779812],
['username' => 'tfs_lo_tzc1', 'dealer_party_id' => 779828],
['username' => 'tfs_lo_tfi1', 'dealer_party_id' => 863925],
['username' => 'tfs_lo_tlbi1', 'dealer_party_id' => 917785],
['username' => 'tfs_lo_tbi1', 'dealer_party_id' => 984763],
['username' => 'tfs_lo_tbci1', 'dealer_party_id' => 995413],
['username' => 'tfs_lo_ttc3', 'dealer_party_id' => 995445],
['username' => 'tfs_lo_tapi1', 'dealer_party_id' => 1456034],
['username' => 'tfs_lo_tcsi2', 'dealer_party_id' => 1565355],
['username' => 'tfs_lo_tsrli1', 'dealer_party_id' => 1581192],
['username' => 'tfs_lo_tai2', 'dealer_party_id' => 1591773],
['username' => 'tfs_lo_tin2', 'dealer_party_id' => 1592922],
['username' => 'tfs_lo_ttc4', 'dealer_party_id' => 1609012],
['username' => 'tfs_lo_tmci1', 'dealer_party_id' => 1654938],
['username' => 'tfs_lo_tllc1', 'dealer_party_id' => 1772076],
['username' => 'tfs_lo_tsci1', 'dealer_party_id' => 1776349],
['username' => 'tfs_lo_tici1', 'dealer_party_id' => 1793929],
['username' => 'tfs_lo_tcci1', 'dealer_party_id' => 1801466],
['username' => 'tfs_lo_tkc1', 'dealer_party_id' => 1826572],
['username' => 'tfs_lo_tmd1', 'dealer_party_id' => 1827004],
['username' => 'tfs_lo_tvci1', 'dealer_party_id' => 1830254],
['username' => 'tfs_lo_ttc5', 'dealer_party_id' => 1856374],
['username' => 'tfs_lo_tno1', 'dealer_party_id' => 1916802],
['username' => 'tfs_lo_tsjdmb1', 'dealer_party_id' => 1964519],
['username' => 'tfs_lo_mni1', 'dealer_party_id' => 2059078],
['username' => 'tfs_lo_tsi2', 'dealer_party_id' => 2066917],
['username' => 'tfs_lo_tnei1', 'dealer_party_id' => 2067310],
        ];

        $role = Role::where('name', 'lo')->first();
        foreach ($dealerUsersLOs as $dulo) {
            $model = new User($dulo);
            $model->password = User::UserPassword($role->name);//bcrypt(User::UserPassword($role->name));
            $model->save();            
            $model->attachRole($role);
        }


    }
}
