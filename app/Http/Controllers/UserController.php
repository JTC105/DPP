<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use Alert;

use App\Model\User;
use App\Model\Role;
use App\Model\Permission;
use App\Model\Policy;

class UserController extends Controller
{

    public function index()
    {
        
       if(auth()->user()->is_admin_level == 1)
            $users = User::get(); //admin | dealer | users
        else
             $users = User::where('is_admin_level',0)->orWhere('is_admin_level',2)->get(); // dealer | users

         $admins  = array();
         $dealers = array();
         $los = array();
         $ousers   = array();

        foreach ($users as $user) {
            $user = User::find($user->id);
            $role = $user->role_user()->first();

            $result = [
                'user'      =>  $user,
                'role'      =>  $role,
            
            ];

            switch ($user->is_admin_level) {
                case 1: // admin
                    $admins[] = $result;
                    break;
                case 0: // dealer
                    if($result['role']->name != "lo")
                        $dealers[] = $result;
                    else 
                        $los[] = $result;
                    break;
                default: // users
                    $ousers[] = $result;
                    break;
            }
          
        }

        // For displaying of tab view
        $display = [
            'admin'     => (auth()->user()->is_admin_level == 1) ? 'active show' : '',
            'n_admin'   => (auth()->user()->is_admin_level == 1) ? 'active show' : '',//(auth()->user()->is_admin_level == 1) ? '' : 'active show',
        ];

        $data = [
            'admins'     => $admins,
            'dealers'    => $dealers,
            'los'        => $los,
            'users'      => $ousers,
            'display'    => $display,
        ];


        $dataPass = [
            'admin'   =>  User::UserPassword("admin"),  
            'users'  =>  User::UserPassword("level2"),
        ];

        return view('pages.admin.userlist', compact('data', 'dataPass'));
    }

    public function userstoreadmin(Request $request)
    {
        $this->validate($request,[
            'username'       => 'required|regex:/(^[-0-9A-Za-z._@ ]+$)/',
            ]);


        $user = new User();
        $user->username = "tfs".request('username');
        $user->password = bcrypt(User::UserPassword("admin"));
        $user->dealer_party_id = 0;
        $user->is_admin_level = 1;
        $user->save();
        $role = Role::where('name', 'admin')->first();
        $user->attachRole($role);

        Alert::success('','Admin user added.');
        
        AdminLogController::WriteLog('uadmin-add',$user->username);

        return redirect('/admin/users');
    }

    public function userstoreleveluser(Request $request)
    {
        $this->validate($request,[
            'username'       => 'required|regex:/(^[-0-9A-Za-z._@ ]+$)/',
            ]);

        $level = request('ulevel');

        $user = new User();
        $user->username = "tfs".request('username');
        $user->password = bcrypt(User::UserPassword("level".$level));
        $user->dealer_party_id = 0;
        $user->is_admin_level = $level;
        $user->creator_id = auth()->user()->id;
        $user->save();

        // $message = 'Level ' .$level. ' user added.';
        $message = 'User added.';
        Alert::success('',$message);

        AdminLogController::WriteLog('user-add',$user->username);

        return back();
    }

    // Show User Info
    public function edit(Request $request) 
    {
        $user = User::find(request('id'));
        $role = $user->role_user()->first();

        
        // added for level 2
        $permissions = null;
        // $allowedperm = null;

        if($role!=null) {
            if($role->id > 2) {
                $permissions = $role->perms()->get();
                // $allowedperm = Permission::GetAllowedPermissions();
            }
        }

        // end

        $data = [
            'id'            => $user->id,
            'uname'         => substr($user->username, 3),
            'active'        => $user->is_active,
            'locked'        => $user->is_locked,
            'role'          => $role,
            'admin_level'   => $user->is_admin_level,

            // added for level 2
            'permissions'   => $permissions,
            // 'allowedperm'   => $allowedperm,
        ];

        // dd($data);

        return $data;

    }

    public function update(Request $request) {
        $this->validate($request,[
            'uname'         => 'required|regex:/(^[-0-9A-Za-z._@ ]+$)/',
            'isResetPsswrd' => 'alpha',
            'isActive'      => 'alpha',
            'isLocked'      => 'alpha'
            ],
            [
                'uname.regex'           => 'The username format is invalid.',
                'isResetPsswrd.alpha'   => 'The reset password format is invalid.',
                'isActive.alpha'        => 'The active format is invalid.',
                'isLocked.alpha'        => 'The locked password format is invalid.',
            ]);

        $isResetPass = 0;
        $isActive = 0;
        $isLocked = 0;
        $role = request('urole'); // can be admin level value

        if($role == 2 || $role == 3)
            $role = "level".$role;
   
        if(request('isResetPsswrd') == "on")
            $isResetPass = 1;

        if(request('isActive') == "on")
            $isActive = 1;

        if(request('isLocked') == "on")
            $isLocked = 1;

        $user = User::find(request('uid'));
        
        if($role != "dealer")
            $user->username = "tfs".request('uname');
        
        if($isResetPass) {
            $max = Policy::where('name', 'passMaxLen')->first()->value;
            $validator = Validator::make($request->all(), [ 
                'uPass'             => 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-.]).{1,'.$max.'}$/', 
            ],[              
                'uPass.regex'      => 'The password must have at least 1 uppercase, 1 lowercase, 1 numeric and 1 special character.',
            ]); 

            if ($validator->fails()) { 
                return back()->withInput($request->all())->withErrors($validator->errors());
            } 

            $psswrd = request('uPass');
            $user->password = bcrypt($psswrd);
        }
        
        $user->is_active = $isActive;
        $user->is_locked = $isLocked;

        if(!$isLocked) {
            $user->failed_attempt_count = 0;
        }

        $user->save();

        Alert::success('','User updated');

        AdminLogController::WriteLog('user-edit',$user->username);

        return back();
    }

    // public function updatel2(Request $request) {
    //     $isResetPass = 0;
    //     $isActive = 0;
    //     $role = request('uroleL2');
   
    //     if(request('isResetPsswrdL2') == "on")
    //         $isResetPass = 1;

    //     if(request('isActiveL2') == "on")
    //         $isActive = 1;

    //     $user = User::find(request('uidL2'));
        
    //     // if($role == "admin")
    //         $user->username = "tfs".request('unameL2');
        
    //     if($isResetPass) {
    //         $psswrd = User::UserPassword("custom");
    //         $user->password = bcrypt($psswrd);
    //     }
        
    //     $user->is_active = $isActive;
    //     $user->save();

    //     Alert::success('','User updated');

    //     return back();
    // }

    // public function updatel2perm(Request $request) {
    //     $role = request('uroleL2');
    //     $user = User::find(request('uidL2'));

    //     dd(request('roleL2'));

    //     Alert::success('','User updated');

    //     return back();
    // }

    
}
