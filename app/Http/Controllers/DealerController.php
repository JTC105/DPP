<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Alert;

use App\Model\DealerInfo;
use App\Model\User;

class DealerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DealerInfo::get();
        $dataPass = [
            'dealer'   =>  User::UserPassword("dealer"),  
        ];

        return view('pages.admin.dealerlist', compact('data', 'dataPass'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(request('isMetro'));
        $this->validate($request,[
            'diid'           => 'numeric',
            'dealerName'     => 'bail|required|regex:/(^[-A-Za-z., ]+$)/',
            // 'partyId'        => 'bail|required|numeric',
            'partyNo'        => 'bail|required|numeric',
            'dAddress'       => 'bail|required|regex:/(^[-0-9A-Za-z.,#\/() ]+$)/',
            'dTin'           => 'bail|required|regex:/(^[-0-9A-Za-z# ]+$)/',
            'dReference'     => 'bail|required|regex:/(^[-0-9A-Za-z# ]+$)/',
            'isMetro'        => 'alpha',
            'isTwoParty'     => 'alpha',
            'isThreeParty'   => 'alpha'

            ],
            [
                'diid.numeric'      => 'Input invalid.',
                'isMetro.alpha'     => 'The metro format is invalid.',
                'isTwoParty.alpha'  => 'The metro format is invalid.',
                'isThreeParty.alpha'=> 'The metro format is invalid.',
                'dAddress.regex'    => 'The address format is invalid.',
                'dTin.regex'        => 'The tin format is invalid.',
                'dReference.regex'  => 'The reference format is invalid.',
            ]);


        $id = request('diid');
        $dealerName = request('dealerName');
        $partyNo = request('partyNo');
        $partyId = DealerInfo::GetPartyIdByPartyNo($partyNo);//request('partyId');
        $isNew = true;

        if($partyId!=null) {
            if(DealerInfo::CheckIfDealerNameOrPartyIdExist($dealerName, $partyId) && $id == 0) {
                Alert::warning('','Dealer already exist.',''); 
                return back();

            } else {

                $isMetro = 0;
                $isTwoParty = 0;
                $isThreeParty = 0;
                $isActive = 0;

                if(request('isMetro') == "on")
                    $isMetro = 1;

                if(request('isTwoParty') == "on")
                    $isTwoParty = 1;

                if(request('isThreeParty') == "on")
                    $isThreeParty = 1;

                if(request('isActive') == "on")
                    $isActive = 1;

                if($id != 0) {
                    $detail = DealerInfo::find($id);
                    $detail->is_active = $isActive;
                    $isNew = false;
                }
                else  {
                    $detail = new DealerInfo();
                }

                if($detail != null) {
                    $detail->party_id = $partyId;
                    $detail->party_no = $partyNo;
                    $detail->dealer_name = $dealerName;
                    $detail->reference = request('dReference');
                    $detail->address = request('dAddress');
                    $detail->dealer_tin = request('dTin');
                    $detail->is_metro = $isMetro;
                    $detail->is_2party = $isTwoParty;
                    $detail->is_3party = $isThreeParty;
                    $detail->save();

                    User::CreateDealerUser($dealerName, $partyId);
                    User::CreateDealerLOUser($dealerName, $partyId);

                    Alert::success('','Saved Dealer Information',''); 

                    if($id != 0) {
                        AdminLogController::WriteLog('udealer-edit',$detail);
                    } else {
                        AdminLogController::WriteLog('udealer-add',$detail);
                    }
                } else {
                   // return back()->withErrors([
                   //      'message' => 'Invalid Input.'               
                   //      ]);
                    Alert::warning('','Invalid Input.',''); 
                    return back();
                }
            }
        } else {
            Alert::warning('','Dealer Party No does not exist.',''); 
            return back();
        }

        if($isNew)
            return redirect('/s/dealerfee');
        else
            return redirect('/admin/dealers');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $data = DealerInfo::find(request('id'));

        return $data;
    }

}
