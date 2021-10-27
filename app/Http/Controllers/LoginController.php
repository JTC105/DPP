<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\User;
use App\Model\Policy;

use Carbon\Carbon;

class LoginController extends Controller
{
	public function index() {
		return view('pages.login');
	}

    public function login(Request $request)
    {
        $username = request('username');
        $password = request('psswrd');



        if(!auth()->attempt(['username' => $username, 'password' => $password])) {

            $message = "Please check your credentials and try again.";
            $user = User::where('username', $username)->first();

            if($user!=null) {
                if($user->is_admin_level != 1) { // Check if not SUPER ADMIN
                    if($this->CheckIfLocked($username)) {
                         $message = "Your account is locked. Please contact TFSPH IT Dev.";
                     } else {
                        $this->IfFailedAttempt($username);

                        if($this->CheckIfLocked($username))
                            $message = "Your account is locked. Please contact TFSPH IT Dev.";
                    }
                }
            }

             return back()->withErrors([
                    'message' => $message               
                    ]);

            // return back();
        }

        if(auth()->user()->is_active == 0) {
            return back()->withErrors([
                'message' => 'Your account is no longer active. Please contact TFSPH IT Dev.'       
                ]);
        }

        if(auth()->user()->is_locked == 1) {
            return back()->withErrors([
                'message' => 'Your account is locked. Please contact TFSPH IT Dev.'       
                ]);
        }

        // Reset failed attempt because of successful login
        $user = auth()->user();
        $user->failed_attempt_count = 0;
        $user->save();

        if(auth()->user()->is_ftul || Policy::CheckIfPasswordExpired())
            return redirect('/s/dchangepass');
        else
            return redirect('/s/dashboard');
    }

    public function logout() {
        auth()->logout();
        session()->flush();

        return redirect('/');
    }

    function CheckIfLocked($username) {
        $user = User::where('username', $username)->first();
        // dd($user);
        if($user!=null) 
            return $user->is_locked;
        else 
            return false;
    }


    function IfFailedAttempt($username) {
        $user = User::where('username', $username)->first();
        $datenow = Carbon::now('Asia/Manila')->format('Y-m-d');

        if($user!=null) {
           $last_date_attempt = Carbon::parse($user->last_fattempt_date)->format('Y-m-d');

            if($last_date_attempt == $datenow) { // Check if same date

                $tempCount = $user->failed_attempt_count;                
                $user->failed_attempt_count = $tempCount+1;
                $user->last_fattempt_date = $datenow;
                $user->save();

                $lockoutCount = Policy::where('name', 'lockoutUser')->first()->value;

                if($user->failed_attempt_count == $lockoutCount) {
                    $user->is_locked = true;
                    $user->save();
                }

            } else if($last_date_attempt != $datenow) {
               
                $user->failed_attempt_count = 1;
                $user->last_fattempt_date = $datenow;
                $user->save();

            }
        }
    }
}
