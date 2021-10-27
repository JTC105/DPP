<?php

use Illuminate\Database\Seeder;
use App\Model\Role;
use App\Model\Permission;
// use Illuminate\Cache\TaggableStore;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// Permissions
  //   	$addUser = new Permission();
		// $addUser->name         = 'add-user';
		// $addUser->display_name = 'Add Users'; // optional
		// $addUser->description  = 'xxx'; // optional
		// $addUser->save();

		// $editUser = new Permission();
		// $editUser->name         = 'edit-user';
		// $editUser->display_name = 'Edit Users'; // optional
		// $editUser->description  = 'xxx'; // optional
		// $editUser->save();

  //       $addContract = new Permission();
		// $addContract->name         = 'add-contract';
		// $addContract->display_name = 'Add Contract'; // optional
		// $addContract->description  = 'XXX'; // optional
		// $addContract->save();

  //   	$cViewAll = new Permission();
  //   	$cViewAll->id 			= 1;
		// $cViewAll->name         = 'contract-view-all';
		// $cViewAll->display_name = 'Contract View All List'; // optional
		// $cViewAll->description  = 'View/Search list of contracts of all dealers.'; // optional
		// $cViewAll->save();

		// $cViewList = new Permission();
		// $cViewList->id 			 = 2;
		// $cViewList->name         = 'contract-view-list';
		// $cViewList->display_name = 'Contract View List'; // optional
		// $cViewList->description  = 'View/Search list of contracts.'; // optional
		// $cViewList->save();

		// $cViewDet = new Permission();
		// $cViewDet 				= 3;
		// $cViewDet->name         = 'contract-view-det';
		// $cViewDet->display_name = 'Contract View Details'; // optional
		// $cViewDet->description  = 'View contract details.'; // optional
		// $cViewDet->save();

		// $cAdd = new Permission();
		// $cAdd 				= 4;
		// $cAdd->name         = 'contract-add';
		// $cAdd->display_name = 'Contract Add'; // optional
		// $cAdd->description  = 'Add contracts'; // optional
		// $cAdd->save();

		// $cEdit = new Permission();
		// $cEdit 				 = 5;
		// $cEdit->name         = 'contract-edit';
		// $cEdit->display_name = 'Contract Edit'; // optional
		// $cEdit->description  = 'Edit contracts'; // optional
		// $cEdit->save();

		// $cPrintPrev = new Permission();
		// $cPrintPrev->id 		  = 6;
		// $cPrintPrev->name         = 'contract-printprev';
		// $cPrintPrev->display_name = 'Contract Print Preview'; // optional
		// $cPrintPrev->description  = 'Print preview contracts'; // optional
		// $cPrintPrev->save();

		// $cPrint = new Permission();
		// $cPrint->id 		  = 7;
		// $cPrint->name         = 'contract-print';
		// $cPrint->display_name = 'Contract Print'; // optional
		// $cPrint->description  = 'Print contract using preprinted template'; // optional
		// $cPrint->save();

		// $cUpload = new Permission();
		// $cUpload->id 		   = 8;
		// $cUpload->name         = 'contract-upload';
		// $cUpload->display_name = 'Contract Upload'; // optional
		// $cUpload->description  = 'Upload necessary requirements of contract'; // optional
		// $cUpload->save();


		$permissions = [

['name' => 'contract-view-all', 'display_name' => 'View All Contracts'],
['name' => 'contract-view-list', 'display_name' => 'View Contracts'],
['name' => 'contract-view-det', 'display_name' => 'View Contract Details'],
['name' => 'contract-add', 'display_name' => 'Add Contract'],
['name' => 'contract-edit', 'display_name' => 'Edit Contract'],
['name' => 'contract-printprev', 'display_name' => 'Printpreview Contract'],
['name' => 'contract-print', 'display_name' => 'Print Contract'],
['name' => 'contract-upload-log', 'display_name' => 'Update Contract Upload Log'],

['name' => 'approve-con-view-list', 'display_name' => 'View Approved Contracts'],
['name' => 'approve-con-view-det', 'display_name' => 'View Approved Contract Details'],
['name' => 'approve-con-add', 'display_name' => 'Add Approved Contract'],

['name' => 'signa-loc-view-list', 'display_name' => 'View Local Signatories'],
['name' => 'signa-loc-add', 'display_name' => 'Add Local Signatory'],
['name' => 'signa-loc-edit', 'display_name' => 'Edit Local Signatory'],
['name' => 'signa-tfsph-view-list', 'display_name' => 'View TFSPH Signatories'],
['name' => 'signa-tfsph-add', 'display_name' => 'Add TFSPH Signatory'],
['name' => 'signa-tfsph-edit', 'display_name' => 'Edit TFSPH Signatory'],
['name' => 'signa-tfsph-assign', 'display_name' => 'Assign TFSPH Signatory'],

['name' => 'form-temp-add', 'display_name' => 'Add Form Template'],
['name' => 'form-temp-edit', 'display_name' => 'Edit Form Template'],
['name' => 'form-temp-view-list', 'display_name' => 'View Form Templates'],
['name' => 'form-temp-print', 'display_name' => 'Print Form Template'],

['name' => 'cwriter-encode', 'display_name' => 'Encode Cheque Writer Details'],
['name' => 'cwriter-preview', 'display_name' => 'Preview Cheque Writer'],
['name' => 'cwriter-print', 'display_name' => 'Print Cheque'],

['name' => 'uadmin-view-list', 'display_name' => 'View Admin Users'],
['name' => 'uadmin-add', 'display_name' => 'Add Admin User'],
['name' => 'uadmin-edit', 'display_name' => 'Edit Admin User'],
['name' => 'ulevel2-view-list', 'display_name' => 'View Level 2 Users'],
['name' => 'ulevel2-add', 'display_name' => 'Add Level 2 User'],
['name' => 'ulevel2-edit', 'display_name' => 'Edit Level 2 User'],
['name' => 'ulevel3-view-list', 'display_name' => 'View Level 3 Users'],
['name' => 'ulevel3-add', 'display_name' => 'Add Level 3 User'],
['name' => 'ulevel3-edit', 'display_name' => 'Edit Level 3 User'],
['name' => 'udealer-view-list', 'display_name' => 'View Dealer Users'],
['name' => 'udealer-add', 'display_name' => 'Add Dealer User'],
['name' => 'udealer-edit', 'display_name' => 'Edit Dealer User'],

['name' => 'vehicle-view-list', 'display_name' => 'View Vehicles'],
['name' => 'vehicle-add', 'display_name' => 'Add Vehicle'],
['name' => 'vehicle-edit', 'display_name' => 'Edit Vehicle'],

['name' => 'cm-view-list', 'display_name' => 'View City Municipalities'],
['name' => 'cm-add', 'display_name' => 'Add City Municipality'],
['name' => 'cm-edit', 'display_name' => 'Edit City Municipality'],

['name' => 'dfees-view-list', 'display_name' => 'View Dealer Fees'],
['name' => 'dfees-add', 'display_name' => 'Add Dealer Fee'],
['name' => 'dfees-edit', 'display_name' => 'Edit Dealer Fee'],
['name' => 'dfees-tableref-view-list', 'display_name' => 'View Fee Table Reference'],
['name' => 'dfees-tableref-add', 'display_name' => 'Add Range in Table Reference'],
['name' => 'dfees-tableref-edit', 'display_name' => 'Edit Range in Table Reference'],

['name' => 'role-view-list', 'display_name' => 'View Roles'],
['name' => 'role-assign-perms', 'display_name' => 'Assign Permissions to Role'],

['name' => 'role-assign-users', 'display_name' => 'Assign Users to Role'],
['name' => 'role-add', 'display_name' => 'Add Role'],
['name' => 'role-edit', 'display_name' => 'Edit Role'],

['name' => 'approve-con-view-all', 'display_name' => 'View All Approved Contracts'],

['name' => 'pol-userlockcount-edit', 'display_name' => 'Edit Lockoout User Count'],
['name' => 'pol-pwdexpcount-edit', 'display_name' => 'Edit Password Expiry Count'],
['name' => 'pol-pwdwarncount-edit', 'display_name' => 'Edit Password Warning Count'],

['name' => 'contract-update-con-req', 'display_name' => 'Update Contract File Requirements'],
['name' => 'contract-upload-con-req', 'display_name' => 'Uppload Contract Requirement File'],

['name' => 'contract-view-history', 'display_name' => 'View Contract History'], // 61
['name' => 'contract-refresh', 'display_name' => 'Refresh Contract'], // 62

['name' => 'dash-bguide-view', 'display_name' => 'View Booking Guidelines'],
['name' => 'dash-bguide-edit', 'display_name' => 'Edit Booking Guidelines'],
['name' => 'dash-news-view-all', 'display_name' => 'View All News'],
['name' => 'dash-news-view-specific', 'display_name' => 'View Specific News'],
['name' => 'dash-news-add', 'display_name' => 'Add News'],
['name' => 'dash-news-edit', 'display_name' => 'Edit News'],

['name' => 'report-gen-appcon', 'display_name' => 'Generate Approve Contract Report'],
['name' => 'report-gen-con', 'display_name' => 'Generate Contract Report'],

['name' => 'date-restriction', 'display_name' => 'Date Restriction'],


		];

		foreach ($permissions as $perm) {
		    $permModel = new Permission($perm);
		    $permModel->save();
		}
		
		// Roles
		$admin = new Role();
		$admin->name         = 'admin';
		$admin->display_name = 'Administrator'; // optional
		$admin->description  = 'xxx'; // optional
		$admin->save();

        $dealer = new Role();
		$dealer->name         	= 'dealer';
		$dealer->display_name 	= 'Dealer'; // optional
		$dealer->role_parent_id = 1;
		$dealer->description  	= 'xxx'; // optional
		$dealer->save();

		$lo = new Role();
		$lo->name         	= 'lo';
		$lo->display_name 	= 'Loan Officer'; // optional
		$lo->role_parent_id = 1;
		$lo->description  	= 'xxx'; // optional
		$lo->save();

		$custom1 = new Role();
		$custom1->name         	= 'role-custom-1';
		$custom1->display_name 	= 'Role Custom 1'; // optional
		$custom1->role_parent_id  = 1;
		$custom1->description  	= 'xxx'; // optional
		$custom1->save();

		// $dealer->attachPermission($addContract);
		// equivalent to $admin->perms()->sync(array($createPost->id));
		$admin->perms()->sync(array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58, 59,60,61,62, 63, 64, 65, 66, 67, 68, 69, 70, 71));
		$dealer->perms()->sync(array(2,3,4,5,6,7,8,9,10,11,12,13,14,15,21,22,23,24,25,/*38,41,*/55, 62, 63, 66, 69, 70));
		$lo->perms()->sync(array(2,3,5,6,7,9,10,60));
		$custom1->perms()->sync(array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55, 63, 66));

		// $admin->attachPermissions(array($addUser, $editUser, $addContract));
		// equivalent to $owner->perms()->sync(array($createPost->id, $editUser->id));
    }
}
