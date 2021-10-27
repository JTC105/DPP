<?php

namespace App\Model;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
	protected $table = 'roles';
    
	public function users()
    {
        return $this->belongsToMany('App\Model\User');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Model\Permission', 'permission_role', 'permission_id', 'role_id')->withTimestamps();
    }

    public function assign(Permission $permission) //Gives permission to a role.
    {
        return $this->permissions()->save($permission);
    }

    public function role_user() {
        return $this->belongsToMany('App\Model\User', 'role_user', 'user_id', 'role_id')->withTimestamps();
    }
}