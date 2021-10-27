<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Alert;

use App\Model\Permission;
use App\Model\PermissionRole;
use App\Model\Role;
use App\Model\RoleUser;
use App\Model\User;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = auth()->user()::whatRole();

        if($role!=null)
            $roles = Role::where('role_parent_id', $role->id)->where('name','!=', 'dealer')->get();
        else
            $roles = null;

        // $roles = Role::all();

        $data = [
            'roles' => $roles,
        ];

        // dd($data);

        return view('pages.admin.rolelist', compact('data'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'id'            => 'numeric',
            'roleName'      => 'required|regex:/(^[-0-9A-Za-z._@ ]+$)/',
            'roleDesc'      => 'required|regex:/(^[-0-9A-Za-z._@ ]+$)/',
            ],
            [
                'roleName.regex'           => 'The role name format is invalid.',
                'roleDesc.regex'           => 'The role description format is invalid.',
            ]);
        
        $id = request('rid');

        if($id != 0)
            $detail = Role::find($id);
        else {
            $detail = new Role();

            if(auth()->user()->hasRole('admin'))
                $detail->role_parent_id = 1;
            else {
                $role = auth()->user()::whatRole();
                $detail->role_parent_id = $role->id;
            }
        }

        $name = str_replace(" ", "-", request('roleName'));
        $name = strtolower($name);

        $detail->name         = $name;
        $detail->display_name = request('roleName'); // optional
        $detail->description  = request('roleDesc'); // optional
        $detail->save();

        Alert::success('','Saved Role');

        if($id!=0) {
            AdminLogController::WriteLog('role-edit',$name);
        } else {
            AdminLogController::WriteLog('role-add',$name);
        }

        return back();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

        $role = Role::where('id',request('id'))->first();

        $data = [
            'id'    => $role->id,
            'name'  => $role->display_name,
            'desc'  => $role->description,
        ];

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editassignuser(Request $request)
    {
        $roleId = request('id');
        $selectedUsers = User::whereIn('id', function($query) use ($roleId) {
            $query->select('user_id')
             ->from(with(new RoleUser)->getTable())
             ->where('role_id', $roleId);
            })->get();
        
        $notSelectedUsers = User::whereNotIn('id', function($query) {
            $query->select('user_id')
             ->from(with(new RoleUser)->getTable());
            })->get();

        $users = array();

        $i = 0;
        foreach ($selectedUsers as $u) {
            $users[$i]['selected'] = true;
            $users[$i]['username'] = $u->username;
            $users[$i]['id'] = $u->id;
            $i++;
        }
        foreach ($notSelectedUsers as $u) {
            $users[$i]['selected'] = false;
            $users[$i]['username'] = $u->username;
            $users[$i]['id'] = $u->id;
            $i++;
        }

        // dd($users);

        $data = [
            'id'        => $roleId,
            // 'full_name' => "test",
            'users' => $users,
        ];

        // Log:info($data);

        return $data;

    }

    public function updateassignuser(Request $request)
    {
        $id = request('aurid');

        $role = Role::find($id);

        // dd(request('rUserList'));
        $users = array();
        if(request('rUserList')!=null) {
            foreach (request('rUserList') as $u) {
                $users[] = $u;
            }
        }

        // dd($users);

        $role->users()->sync($users);

        Alert::success('','Assigned User');

        $data = [
            'users' => $users,
            'role'  => $role->display_name,
        ];

        AdminLogController::WriteLog('role-assign-users',$data);

        return back();
    }


    public function indexroleperm()
    {
        // $perms = Permission::GetAllowedPermissions();
       
        // foreach ($perms as $perm) {
        //     $permissions = array();
        //     $permId = $perm->id;
        //     $permissions['id'] = $permId;
        //     $permissions['name'] = $perm->display_name;
        //     $roles = Role::whereIn('id', function($query) use ($permId) {
        //     $query->select('role_id')
        //      ->from(with(new PermissionRole)->getTable())
        //      ->where('permission_id', $permId);
        //     })->get();

        //     $x = 0;
        //     foreach ($roles as $r) {
        //         $permissions['roles'][$x]['id'] = $r->id;
        //         $permissions['roles'][$x]['name'] = $r->display_name;

        //         $x++;
        //     }

        //     $data[$perm->name] =  $permissions;
        // }

        // dd($permissions);

        // $data = [
        //     'perm'  => $permissions,
        // ];

        $role = auth()->user()::whatRole();

        if($role!=null)
            $roles = Role::where('role_parent_id', $role->id)->where('name','!=', 'dealer')->get();
        else
            $roles = null;

        // $roles = Role::all();

        // dd($roles[0]->perms()->get());

        $allowedPerms = Permission::GetAllowedPermissions();
        // Restrict other users from giving Role Level 3 (Levels created by a none admin user) permission to View, Add, Edit Users
        if($role->role_parent_id >= 1) { 
            $allowedToRoleParentPerms = $role->perms()->whereNotIn('id', [32,33,34])->get();
        } else {
            $allowedToRoleParentPerms = $role->perms()->get();
        }        

        $roleArray = array();
        // dd($allowedPerms);
        $ctr = 0;
        foreach ($roles as $role) {
            // $role = $roles[1];
            $roleArray[$ctr]['role'] = $role;

            $i2 = 0;
            for($i=0;$i<52;$i++) {                 

                if($i != 7) {
                    $perm = Permission::GetPermission($allowedPerms[$i2]->id);
                    $i2++;

                } else if($i == 7) { // Insert Permission #59 to index #7
                   $perm = Permission::GetPermission(59);
                }
                 
                $roleArray[$ctr]['permissions'][$i]['id'] = $perm->id;
                $roleArray[$ctr]['permissions'][$i]['name'] = $perm->name;
                $isEnabled = false;
                if($role->perms->contains($perm->id))
                    $isEnabled = true;

                $roleArray[$ctr]['permissions'][$i]['enabled'] = $isEnabled;

                $isPermitted = false;

                if($allowedToRoleParentPerms->contains($perm->id))
                    $isPermitted = true;

                $roleArray[$ctr]['permissions'][$i]['permitted'] = $isPermitted;
            }
            $ctr++;
        }

        
        // dd($roleArray);

        $data = $roleArray;

        return view('pages.admin.rolepermissionlist', compact('data'));
    }

    public function editroleperm() {
        $roleId = request('id');
        $role = Role::find($roleId);
        $roleParent = Role::find($role->role_parent_id);

        if($roleParent->id > 1) {
            $allowedPerms = $roleParent->perms()->whereNotIn('id', [32,33,34])->get();
        } else {
            $allowedPerms = $roleParent->perms()->get();
        }
        
        $data = [
            'id'            => $roleId,
            'role'          => $role,
            'uname'         => $role->display_name,
            'permissions'   => $role->perms()->get(),
            'allowedperms'  => $allowedPerms,
        ];

        // Log:info($data);

        return $data;
    }

    public function updateroleperm() {
        $id = request('uidLP2');

        $role = Role::find($id);

        $permissionIds = array();
        if(request('roleL2')!=null) {
            foreach (request('roleL2') as $p) {
                $perm = Permission::where('name', $p)->first();
                $permissionIds[] = $perm->id;
            } 
        }

        if(auth()->user()->hasRole('admin')) { //NOTE: Automatically added if Role is created by admin
            for($i = 50; $i < 56; $i++) { 
                $permissionIds[] = $i;
            }
        }

        if(in_array(2, $permissionIds)) {
            // automatically add view all contracts
            $permissionIds[] = 1;
        }
        else if(in_array(1, $permissionIds))
        {
            // delete view all contracts
             $permissionIds = array_diff($array, [1]);
        }
        // dd($permissionIds);

        $role->perms()->sync($permissionIds);

        Alert::success('','Role Permission Saved');

        $data = [
            'perms' => $permissionIds,
            'role'  => $role->display_name,
        ];

        AdminLogController::WriteLog('role-assign-perms',$data);

        return back();
    }
}
