<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\User; 
use App\Model\Role; 
use Auth;

class SidebarController extends Controller
{

    public function dashboard()
    {
        session(['activeside' => 'sb-dashboard']);

        return redirect('/dashboard');
    }

    public function appcontracts()
    {
        session(['activeside' => 'sb-appcontracts']);

        // if(auth()->user()->hasRole('admin')) {
        //     return redirect('/admin/appcontracts');
        // }
        // else if(auth()->user()->hasRole('dealer')) {
        //     return redirect('/appcontracts');
        // }

        if(auth()->user()->hasRole('dealer') || auth()->user()->hasRole('lo')) {
            return redirect('/appcontracts');
        } else {
            return redirect('/admin/appcontracts');
        }
        
    }

    public function contracts()
    {
        session(['activeside' => 'sb-contracts']);

        // if(auth()->user()->hasRole('admin')) {
        //     return redirect('/admin/contracts');
        // }
        // else if(auth()->user()->hasRole('dealer')) {
        //     return redirect('/contracts');
        // }

        if(auth()->user()->hasRole('dealer') || auth()->user()->hasRole('lo')) {
            return redirect('/contracts');
        } else {
            return redirect('/admin/contracts');
        }
        
    }

    public function signatories()
    {
        session(['activeside' => 'sb-signatories']);

        // if(auth()->user()->hasRole('admin')) {
        //     return redirect('/admin/dsignatories');
        // }
        // else if(auth()->user()->hasRole('dealer')) {
        //     return redirect('/dsignatories');
        // }

        if(auth()->user()->hasRole('dealer')) {
            return redirect('/dsignatories');
        } else {
            return redirect('/admin/dsignatories');
        }
    }

    public function formtemplates()
    {
        session(['activeside' => 'sb-ftemplates']);
        return redirect('/ftemplates');
    }

    public function chequewriter()
    {
        session(['activeside' => 'sb-cheque']);
        return redirect('/chequewriter');
    }

    public function dealerprofile() {
        session(['activeside' => 'sb-dprofile']);
        return redirect('/dealerprofile');
    }

    public function spolicy() {
        session(['activeside' => 'sb-spolicy']);
        return redirect('/admin/policy');
    }

    public function dchangepass() {
        session(['activeside' => 'sb-dcpass']);
        return redirect('/changepassword');
    }

    public function conreqs() {
        session(['activeside' => 'sb-conreqs']);
        return redirect('/admin/editconreqs');
    }

    public function userlist() {
        session(['activeside' => 'sb-userlist']);
        return redirect('/admin/users');
    }

    public function dealerlist() {
        session(['activeside' => 'sb-dealerlist']);
        return redirect('/admin/dealers');
    }

    public function vehiclelist() {
        session(['activeside' => 'sb-vehicles']);
        return redirect('/vehicles');
    }

    public function citymunlist() {
        session(['activeside' => 'sb-citymun']);
        return redirect('/citymuns');
    }

    public function rolelist() {
        session(['activeside' => 'sb-rolelist']);
        return redirect('/admin/rolelist');
    }

    public function dealerfee() {
        session(['activeside' => 'sb-dealerfee']);
        return redirect('/admin/dealerfees');
    }
    
    public function reportlist() {
        session(['activeside' => 'sb-reports']);
        return redirect('/reportlist');
    }
}
