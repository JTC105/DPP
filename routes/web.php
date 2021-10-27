<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('pages.login');
// });

Route::get('/',                'LoginController@index')->name('home-login');
Route::post('/signin',         'LoginController@login');
Route::get('/logout',          'LoginController@logout');


Route::group(['middleware' => ['auth']], function($param) {

	Route::get('/s/dashboard',     'SidebarController@dashboard')->name('dashboard');
	Route::get('/s/appcontracts',  'SidebarController@appcontracts');
	Route::get('/s/contracts',     'SidebarController@contracts');
	Route::get('/s/signatories',   'SidebarController@signatories');
	Route::get('/s/formtemplates', 'SidebarController@formtemplates');
	Route::get('/s/chequewriter',  'SidebarController@chequewriter');
	Route::get('/s/dealerprofile', 'SidebarController@dealerprofile');
	Route::get('/s/policy',		   'SidebarController@spolicy');
	Route::get('/s/dchangepass',   'SidebarController@dchangepass');
	Route::get('/s/conreqs',   	   'SidebarController@conreqs');
	Route::get('/s/userlist',      'SidebarController@userlist');
	Route::get('/s/dealerlist',    'SidebarController@dealerlist');
	Route::get('/s/vehiclelist',   'SidebarController@vehiclelist');
	Route::get('/s/citymunlist',   'SidebarController@citymunlist');
	Route::get('/s/rolelist',      'SidebarController@rolelist');
	Route::get('/s/dealerfee',     'SidebarController@dealerfee');
	Route::get('/s/reportlist',    'SidebarController@reportlist');

		// Approved Contracts
		// Route::get('/admin/appcontracts',     		'AppContractController@adminindex');
		// Route::post('/admin/appcontracts',     		'AppContractController@adminindex');
		// Route::get('/admin/viewappcontracts/{id}',  'AppContractController@adminviewindex');

		Route::get('/admin/appcontracts', 			['middleware' => ['permission:approve-con-view-all'], 'uses' => 'AppContractController@adminindex']);
		Route::post('/admin/appcontracts', 		['middleware' => ['permission:approve-con-view-all'], 'uses' => 'AppContractController@adminindex']);
		Route::get('/admin/viewappcontracts/{id}', ['middleware' => ['permission:approve-con-view-list'], 'uses' => 'AppContractController@adminviewindex']);

		// Contracts
		Route::get('/admin/contracts', 			['middleware' => ['permission:contract-view-all'], 'uses' => 'ContractController@adminindex']);
		Route::post('/admin/contracts', 		['middleware' => ['permission:contract-view-all'], 'uses' => 'ContractController@adminindex']);
		Route::get('/admin/viewcontracts/{id}', ['middleware' => ['permission:contract-view-list'], 'uses' => 'ContractController@adminviewindex']);
		Route::get('/admin/editconreqs',        ['middleware' => ['permission:contract-update-con-req'], 'uses' => 'ContractController@admineditconreqs']);
		Route::post('/admin/updateconreqs',     ['middleware' => ['permission:contract-update-con-req'], 'uses' => 'ContractController@adminupdateconreqs']);

		Route::get('/admin/viewconhistory/{id}', 	['middleware' => ['permission:contract-view-history'], 'uses' => 'ContractHistoryController@index']);
		Route::get('/admin/viewconhisdetails/{id}', ['middleware' => ['permission:contract-view-history'], 'uses' => 'ContractHistoryController@view']);
		Route::get('/refreshcontractdet/{id}',	 	['middleware' => ['permission:contract-refresh'], 'uses' => 'ContractHistoryController@sync']);

		// Signatories
		Route::get('/admin/dsignatories', 			['middleware' => ['permission:signa-loc-view-list|signa-tfsph-view-list'], 'uses' => 'SignatoriesController@adminindex']);
		Route::get('/admin/dsignatoriesedit/{id}', 	['middleware' => ['permission:signa-loc-add|signa-loc-edit|signa-tfsph-assign'], 'uses' => 'SignatoriesController@admineditdealersignatories']);
		Route::post('/admin/updatedsig/{id}', 		['middleware' => ['permission:signa-tfsph-add|signa-tfsph-edit|signa-loc-add|signa-loc-edit'], 'uses' => 'SignatoriesController@updatedealertfsphsignatories'])->name('updatedtfsphsig');
		Route::get('/admin/getsignadetails/{id}', 	['middleware' => ['permission:signa-loc-view-list|signa-tfsph-view-list'], 'uses' => 'SignatoriesController@gettfsphsignadetails']);

		// TFSPH Signatories
		Route::get('/admin/tfssignatories', ['middleware' => ['permission:signa-tfsph-view-list'], 'uses' => 'SignatoriesController@admintfssigindex']);
		Route::post('/admin/tfssigsave', 	['middleware' => ['permission:signa-tfsph-add|signa-tfsph-edit'], 'uses' => 'SignatoriesController@admintfssigstore']);
		Route::get('/admin/tfssigedit', 	['middleware' => ['permission:signa-tfsph-edit'], 'uses' => 'SignatoriesController@admintfssigedit']);

		// Roles
		Route::get('/admin/rolelist', 		['middleware' => ['permission:role-view-list'], 'uses' => 'RoleController@index']);
		Route::get('/admin/roleedit', 		['middleware' => ['permission:role-edit'], 'uses' => 'RoleController@edit']);
		Route::post('/admin/rolesave', 		['middleware' => ['permission:role-edit|role-add'], 'uses' => 'RoleController@update']);
		Route::get('/admin/roleedituser', 	['middleware' => ['permission:role-assign-users'], 'uses' => 'RoleController@editassignuser']);
		Route::post('/admin/rolesaveuser', 	['middleware' => ['permission:role-assign-users'], 'uses' => 'RoleController@updateassignuser']);
		Route::get('/admin/rolepermlist', 	['middleware' => ['permission:role-assign-perms'], 'uses' => 'RoleController@indexroleperm']);
		Route::get('/admin/rolepermedit', 	['middleware' => ['permission:role-assign-perms'], 'uses' => 'RoleController@editroleperm']);
		Route::post('/admin/rolepermsave', 	['middleware' => ['permission:role-assign-perms'], 'uses' => 'RoleController@updateroleperm']);

		Route::get('/admin/policy', 		['middleware' => ['permission:pol-userlockcount-edit|pol-pwdexpcount-edit|pol-pwdwarncount-edit'], 'uses' => 'PolicyController@edit']);
		Route::post('/admin/policysave',     'PolicyController@update');

		// User List
	    Route::get('/admin/users', 				['middleware' => ['permission:uadmin-view-list|ulevel2-view-list|ulevel3-view-list'], 'uses' => 'UserController@index']);
		Route::post('/admin/usersaveadmin', 	['middleware' => ['permission:uadmin-add'], 'uses' => 'UserController@userstoreadmin']);
		Route::post('/admin/usersavelevel', 	['middleware' => ['permission:ulevel2-add|ulevel3-add'], 'uses' => 'UserController@userstoreleveluser']);
		Route::get('/admin/useredit', 			['middleware' => ['permission:uadmin-edit|ulevel2-edit|ulevel3-edit'], 'uses' => 'UserController@edit']);
		Route::post('/admin/userupdate', 		['middleware' => ['permission:uadmin-edit|ulevel2-edit|ulevel3-edit'], 'uses' => 'UserController@update']);

		// Dealers
		Route::get('/admin/dealers', 			['middleware' => ['permission:udealer-view-list'], 'uses' => 'DealerController@index']);
		Route::post('/admin/dealersave', 		['middleware' => ['permission:udealer-add'], 'uses' => 'DealerController@store']);
		Route::get('/admin/dealeredit', 		['middleware' => ['permission:udealer-edit'], 'uses' => 'DealerController@edit']);

		// Vehicles
		Route::get('/vehicles', 			['middleware' => ['permission:vehicle-view-list'], 'uses' => 'VehicleController@index']);
		Route::post('/vehiclesave', 		['middleware' => ['permission:vehicle-add'], 'uses' => 'VehicleController@store']);
		Route::get('/vehicleedit', 			['middleware' => ['permission:vehicle-edit'], 'uses' => 'VehicleController@edit']);
		Route::post('/vehicleupdate', 		['middleware' => ['permission:vehicle-edit'], 'uses' => 'VehicleController@update']);

		// City / Municipality
		Route::get('/citymuns', 			['middleware' => ['permission:cm-view-list'], 'uses' => 'CitymunController@index']);
		Route::post('/citymunsave', 		['middleware' => ['permission:cm-add'], 'uses' => 'CitymunController@store']);
		Route::get('/citymunedit', 			['middleware' => ['permission:cm-edit'], 'uses' => 'CitymunController@edit']);
		Route::post('/citymunupdate', 		['middleware' => ['permission:cm-edit'], 'uses' => 'CitymunController@update']);

		// Dealer Fees
		Route::get('/admin/dealerfees', 			['middleware' => ['permission:dfees-view-list|dfees-tableref-view-list'], 'uses' => 'DealerFeeController@index']);
		Route::get('/admin/dealerfeeslist', 		['middleware' => ['permission:dfees-view-list'], 'uses' => 'DealerFeeController@dealerfeeslistindex']);
		Route::post('/admin/dealerfeessave', 		['middleware' => ['permission:dfees-add'], 'uses' => 'DealerFeeController@dealerfeesliststore']);
		Route::get('/admin/dealerfeesedit', 		['middleware' => ['permission:dfees-edit'], 'uses' => 'DealerFeeController@dealerfeeslistedit']);
		Route::post('/admin/dealerfeesupdate', 		['middleware' => ['permission:dfees-edit'], 'uses' => 'DealerFeeController@dealerfeeslistupdate']);

		Route::get('/admin/dealerfeestable/{id}', 		['middleware' => ['permission:dfees-tableref-view-list'], 'uses' => 'DealerFeeController@dealerfeestableindex']);
		Route::post('/admin/dealerfeestablesave', 		['middleware' => ['permission:dfees-tableref-add'], 'uses' => 'DealerFeeController@dealerfeestablestore']);
		Route::get('/admin/dealerfeestableedit', 		['middleware' => ['permission:dfees-tableref-edit'], 'uses' => 'DealerFeeController@dealerfeestableedit']);
		Route::post('/admin/dealerfeestableupdate', 	['middleware' => ['permission:dfees-tableref-edit'], 'uses' => 'DealerFeeController@dealerfeestableupdate']);

		// News
		Route::post('/newssave',     				['middleware' => ['permission:dash-news-add'], 'uses' => 'DashboardController@storenews']);
		Route::get('/newsedit',     				['middleware' => ['permission:dash-news-edit'], 'uses' => 'DashboardController@editnews']);
		Route::post('/newsupdate',     				['middleware' => ['permission:dash-news-edit'], 'uses' => 'DashboardController@updatenews']);
		Route::get('/nbview/{id}',     				['middleware' => ['permission:dash-news-view-specific'], 'uses' => 'DashboardController@viewnewsbulletin']);
		// Route::post('/newssave',     			'DashboardController@storenews');
		// Route::get('/newsedit',     				'DashboardController@editnews');
		// Route::post('/newsupdate',     			'DashboardController@updatenews');

		// Booking Guidelines
		Route::post('/bookingguidesave',     		['middleware' => ['permission:dash-bguide-edit'], 'uses' => 'DashboardController@storebookingguide']);
		Route::get('/bookingguideedit',     		['middleware' => ['permission:dash-bguide-edit'], 'uses' => 'DashboardController@editbookingguide']);
		Route::post('/bookingguideupdate',     		['middleware' => ['permission:dash-bguide-edit'], 'uses' => 'DashboardController@updatebookingguide']);
		Route::get('/bookingguideview/{id}',     		['middleware' => ['permission:dash-news-view-specific'], 'uses' => 'DashboardController@viewbookingguide']);
		// Route::get('/bookingguideedit',     		'DashboardController@editbookingguide');
		// Route::post('/bookingguideupdate',     		'DashboardController@updatebookingguide');
		// Route::get('/bookingguideview',     		'DashboardController@viewbookingguide');

		// Reports
		Route::get('/reportlist',       			'ReportGenerateController@index');
		Route::post('/generatereport',       		'ReportGenerateController@generatereport');
		// Route::get('/generatecon',       			'ReportGenerateController@generatecon');

	
	Route::get('/dashboard',     'DashboardController@index');

	// Approved Contracts
	Route::get('/appcontracts',     				'AppContractController@index');
	Route::post('/appcontracts',     				'AppContractController@index');
	Route::get('/appcontractview',   				'AppContractController@view');
	Route::get('/appcontractadd/{id}',   			'AppContractController@create');
	Route::get('/appcontractpreviewadvice/{id}',   	'AppContractController@previewadvice');

	// Contracts
	Route::get('/contracts',     				'ContractController@index');
	Route::post('/contracts',     				'ContractController@index');
	Route::get('/contractadd',   				'ContractController@create');
	Route::post('/contractsave',   				'ContractController@store');
	Route::get('/contractedit/{id}',   			'ContractController@edit');
	Route::post('/contractupdate/{detail}', 	'ContractController@update');
	Route::get('/computetfretail', 				'ContractController@computetfretail');

	// Route::post('/ticketimport', 	'ContractController@import'); // TEST

	Route::post('/contractreqssave', 			'ContractController@contractreqsave');
	Route::get('/contractreqview/{id}', 		'ContractController@contractreqview');

	Route::get('/printpreview/{id}',       		'ContractController@generateView');
	Route::get('/printcontract/{id}',       	'ContractController@generatePrint');

	// Signatories
	Route::get('/dsignatories',      		'SignatoriesController@editdealersignatories');
	Route::post('/updatedsig/{id}',    		'SignatoriesController@updatedealersignatories')->name('updatedsig');
	Route::get('/getsignadetails/{id}', 	'SignatoriesController@getsignadetails');
	
	// Form Templates
	Route::get('/ftemplates', 			['middleware' => ['permission:form-temp-view-list'], 'uses' => 'FormTemplateController@index']);
	Route::post('/ftemplatesave', 		['middleware' => ['permission:form-temp-add'], 'uses' => 'FormTemplateController@store'])->name('ftstore');
	Route::get('/ftemplateedit', 		['middleware' => ['permission:form-temp-edit'], 'uses' => 'FormTemplateController@edit']);
	Route::post('/ftemplateupdate', 	['middleware' => ['permission:form-temp-edit'], 'uses' => 'FormTemplateController@update']);

	// Cheque Writer
	Route::get('/chequewriter', 		['middleware' => ['permission:cwriter-encode'], 'uses' => 'ChequeWriterController@index']);
	Route::post('/chequewriterprint', 	['middleware' => ['permission:cwriter-encode'], 'uses' => 'ChequeWriterController@print']);

	// Profile
	Route::get('/dealerprofile',     			'DealerProfileController@view')->name('dprofile');
	// Route::post('/dealerprofileupdate/{id}', 	'DealerProfileController@update');

	// Change Password
	Route::get('/changepassword',       		'HomeController@showChangePasswordForm');
    Route::post('/changepassword',      		'HomeController@changePassword')->name('changePassword');


    

});


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
