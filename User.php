<?php
namespace App;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

// use Illuminate\Contracts\Auth\Authenticatable;
// use Illuminate\Auth\Authenticatable as AuthenticableTrait;

use Zizaco\Entrust\Traits\EntrustUserTrait;

use App\Model\DealerInfo;
use App\Model\Role;
use App\Model\RoleUser;

class User extends Authenticatable
{
    // use AuthenticableTrait;
    use Notifiable;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function GetDealerInfo() {
        
        return DealerInfo::GetDealerInfo(auth()->user()->dealer_party_id);
    }

    public static function GetDealerInfoIfAdmin() {
        return DealerInfo::GetDealerInfoIfAdmin();
    }

    public static function IsMetro() {
        $dealerPartyId = 0;

        // if(auth()->user()->hasRole('admin')) {
        //     $dealerPartyId = session()->get('dpid');
        // }else if(auth()->user()->hasRole('dealer')) {
        //     $dealerPartyId = auth()->user()->dealer_party_id;
        // }

        if(auth()->user()->hasRole('dealer') || auth()->user()->hasRole('lo')) {
            $dealerPartyId = auth()->user()->dealer_party_id;
        } else {
             $dealerPartyId = session()->get('dpid');
        }

        return DealerInfo::IsMetro($dealerPartyId);
    }

    public static function whatRole() {
        $r = RoleUser::where('user_id', auth()->user()->id)->first();

        if($r!=null)
            $role = Role::find($r->role_id);
        else
            $role = null;

        return $role;
    }

}
