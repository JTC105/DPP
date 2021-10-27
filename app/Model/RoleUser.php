<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';

	public function role_user()
	{
	    return $this->belongsTo('App\Model\User', 'user_id');
	}
}

