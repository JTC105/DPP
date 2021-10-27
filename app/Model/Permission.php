<?php

namespace App\Model;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
  protected $table = 'permissions';

  public function permissions() {
      return $this->belongsToMany('App\Model\Role', 'permission_role', 'permission_id', 'role_id')->withTimestamps();
  }

  public static function GetPermission($id) {
    return self::find($id);
  }

  public static function GetAllowedPermissions() {
    // $data = self::whereNotIn('id', [1, 26, 27, 28, 29, 30, 31])->get(); // Permission ID that are for Super Admin only
    $data = self::whereNotIn('id', [1, 26, 27, 28, 29, 30, 31, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62])->get(); 

    return $data;
  }

  public static function GetPermissionDNameofList($ids) {
        $notes = "(";

        for($i=0;$i<count($ids);$i++) {
          $id = $ids[$i];
          $notes .= self::where('id', $id)->first()->display_name;

          if($i<count($ids)-1)
            $notes .= ", ";
        }
        $notes .= ")";

        return $notes;
    }

  public static function IfDateRestricted() {
    $role = auth()->user()::whatRole();
    $rolePermissions = $role->perms()->get();
    $result = $rolePermissions->contains(71);

    if ($result != null) {
      return false;
    } else {
      return true;
    }
  }
}