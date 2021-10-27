<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model
{
    use EntrustUserTrait;
    protected $table = 'users';

    public function role_user() {
        return $this->belongsToMany('App\Model\Role', 'role_user', 'user_id', 'role_id')->withTimestamps();
    }

    public function hasRole($roleString) {
        $role = Role::where('name', $roleString)->first();

        $result = $this->role_user->contains($role);

        return $result;
    }

    public static function hasRole2($user, $roleString) {
        $role = Role::where('name', $roleString)->first();

        if($role!=null)
            $result = RoleUser::where('user_id', $user->id)->where('role_id', $role->id)->first();

        if($result!=null)
            return true;

        return false;
    }

   public static function UserPassword($role) {
        // $pass = "Kaizen@87";

        // if($role == "admin")
        // {
        //     $pass = "Kaizen@86";
        // } else if ($role == "dealer" || $role == "lo") {
        //     $pass = "TFSph.101";
        // } 

        $pass = Policy::where('name', 'passDefaultTfs')->first()->value;

        if ($role == "dealer") {
             $pass = Policy::where('name', 'passDefaultDealer')->first()->value;
        } 

        return $pass;
   }

   public static function CreateDealerUser($dealerName, $partyId) {
        $tempArray = explode(" ", $dealerName);
        $temp = "";

        foreach ($tempArray as $ta) {
           $temp .= $ta[0];
        }
        $temp = strtolower($temp);
        $username = 'tfs_'.$temp;
        $increment = 1;
        $username = self::CheckIfUserExist($username, $increment);

        $role = Role::where('name', 'dealer')->first();

        $user = new User();
        $user->username = $username;
        $user->password = bcrypt(self::UserPassword($role->name));
        $user->dealer_party_id = $partyId;
        $user->save();
        $user->attachRole($role);
        // dd($user);
    }

     public static function CreateDealerLOUser($dealerName, $partyId) {
        $tempArray = explode(" ", $dealerName);
        $temp = "";

        foreach ($tempArray as $ta) {
           $temp .= $ta[0];
        }
        $temp = strtolower($temp);
        $username = 'tfs_lo_'.$temp;
        $increment = 1;
        $username = self::CheckIfUserExist($username, $increment);

        $role = Role::where('name', 'lo')->first();

        $user = new User();
        $user->username = $username;
        $user->password = bcrypt(self::UserPassword($role->name));
        $user->dealer_party_id = $partyId;
        $user->save();
        $user->attachRole($role);
        // dd($user);
    }

    public static function CheckIfUserExist($username, $increment) {
        $temp = "{$username}{$increment}";
        $query = self::where('username',$temp)->first();

        if($query == null) {
             return $temp;  
        } else {
            return self::CheckIfUserExist($username, $increment+1);
        }
    }

    public function GetDealerName() {
        $data = DealerInfo::GetDealerInfo($this->dealer_party_id);

        if($data!=null)
            $data = $data->dealer_name;

        return $data;
    }

    public function GetCreatorUserName() {
        if($this->creator_id > 0)   
            $data = self::where('id',$this->creator_id)->first()->username;
        else 
            $data = '';

        return $data;
    }

    public static function GetUsernamesofList($ids) {
        $notes = "(";

        for($i=0;$i<count($ids);$i++) {
          $id = $ids[$i];
          $notes .= self::where('id', $id)->first()->username;

          if($i<count($ids)-1)
            $notes .= ", ";
        }
        $notes .= ")";

        return $notes;
    }

}
