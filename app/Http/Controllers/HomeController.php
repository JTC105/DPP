<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Alert;
use Carbon\Carbon;
use \Hash;

use App\Model\Policy;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function showChangePasswordForm(){
        $min = Policy::where('name', 'passMinLen')->first()->value;
        $max = Policy::where('name', 'passMaxLen')->first()->value;
        $isPassExpired = Policy::CheckIfPasswordExpired();

        $data = [
            'min'           => $min,
            'max'           => $max,
            'is_expire'     => $isPassExpired,
        ];

        return view('auth.changepassword', compact('data'));
    }

    public function changePassword(Request $request){
        $min = Policy::where('name', 'passMinLen')->first()->value;
        $max = Policy::where('name', 'passMaxLen')->first()->value;


        $validator = Validator::make($request->all(), [ 
            'new-password' => 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-.]).{1,'.$max.'}$/' 
        ]); 

        if ($validator->fails()) { 
            // return redirect()->back()->with("error",$validator->messages()->first());
            return redirect()->back()->with("error","Password must have at least 1 uppercase, 1 lowercase, 1 numeric and 1 special character.");
        } 

        if (!(Hash::check($request->get('current-password'), auth()->user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not match with the password you provided. Please try again.");
        }
 
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        if(strcmp($request->get('new-password'), $request->get('new-password-confirm')) != 0){
            return redirect()->back()->with("error","New Password and Cofirm New Password does not match.");
        }

        if(strlen($request->get('new-password')) < $min) {
            return redirect()->back()->with("error","Password is less than the minimum required length (characters)");
        }

        if(strlen($request->get('new-password')) > $max) {
            return redirect()->back()->with("error","Password is greater than the maximum required length (characters)");
        }
 
        // $validatedData = $request->validate([
        //     'current-password' => 'required',
        //     'new-password' => 'required|string|min:6|confirmed',
        // ]);
 
        //Change Password
        $user = auth()->user();
        $user->password = bcrypt($request->get('new-password'));
        $tempFTUL = $user->is_ftul;
        $tempExpire = Policy::CheckIfPasswordExpired();
        $user->is_ftul = false;
        $datenow = Carbon::now('Asia/Manila')->format('Y-m-d');
        $user->last_changepass_date = $datenow;
        $user->save();
        
        if(!$tempFTUL && !$tempExpire)
            return redirect()->back()->with("success","Password changed successfully."); 
        else {
           Alert::success('', 'Password changed successfully.','');
            // if(auth()->user()->is_admin_level) {
                return redirect()->route('dashboard');
            // } else {
            //     return redirect()->route('dprofile');
            // }
        }
        
    }
}
