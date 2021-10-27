<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\DealerInfo;

use Alert;

class DealerProfileController extends Controller
{

    function view() {
    	$data = DealerInfo::GetDealerInfo(auth()->user()->dealer_party_id); 
        return view('pages.dealerprofile', compact('data'));
    }

    function update(Request $request, $id) {

    	$d = DealerInfo::find($id);
    	$d->dealer_name = request('dealerName');
    	$d->dealer_tin = request('dealerTin');
    	$d->address = request('dealerAddress');
    	$d->save();

    	Alert::success('','Updated Profile','');

        return back();
    }
}
