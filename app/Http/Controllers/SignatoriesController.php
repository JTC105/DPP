<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Alert;
use App\Model\DealerInfo;
use App\Model\TFSPHSignatory;
use App\Model\TFSPHSignatoryDetail;

use Illuminate\Support\Facades\Log;

class SignatoriesController extends Controller
{
    //******************* ADMIN
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminindex() {
        $data = DealerInfo::GetLocalAndTFSPHSignatoriesPerDealer();
        return view('pages.admin.signatorylist', compact('data'));
    }

     // Edit TFS Signatories for a certain dealer
    public function admineditdealersignatories($id) {
        session(['dpid' => $id]); //dealer party id

        $dealer = DealerInfo::GetDealerInfo($id);
        $tfssignatories = $dealer->GetTFSPHSignatories();
        $tfssiglist = TFSPHSignatoryDetail::GetAllTFSPHSignatories();

        $data = [
            'id'          => $dealer->party_id,
            'name'        => $dealer->dealer_name,
            'sig1'        => $dealer->signatory1,
            'sig1_tin'    => $dealer->signatory1_tin,
            'sig1_govtid' => $dealer->signatory1_govtid,
            'sig2'        => $dealer->signatory2,
            'sig2_tin'    => $dealer->signatory2_tin,
            'sig2_govtid' => $dealer->signatory2_govtid,
            'tfssig'      => $tfssignatories,
            'tfssiglist'  => $tfssiglist,  
        ];

        return view('pages.admin.signatories', compact('data'));
    }

    // Update TFS Signatories for a certain dealer
    public function updatedealertfsphsignatories($id, Request $request) 
    {
        $this->validate($request,[
            'tfs_sig1'           => 'required|numeric',
            'tfs_sig2'           => 'required|numeric',

            ],
            [
                'tfs_sig1.required'     => 'TFSPH Signatory 1 is required.',
                'tfs_sig2.required'     => 'TFSPH Signatory 2 is required.',
                'tfs_sig1.numeric'      => 'Input invalid.',
                'tfs_sig2.numeric'      => 'Input invalid.',
            ]);

        $row = TFSPHSignatory::GetTFSPHSignatoriesRowByDealerId($id);
        $row->signatory1_id = request('tfs_sig1');
        $row->signatory2_id = request('tfs_sig2');
        $row->save();

        Alert::success('','Saved TFSPH Signatories','');

        $id = session()->get('dpid');

        if(!auth()->user()->hasRole('dealer')) {
            $d = [
                'sig' => $row,
                'did' => $id
            ];
          AdminLogController::WriteLog('signa-tfsph-assign',$d);
        }

        return redirect('/admin/dsignatoriesedit/'.$id);
    }

    // For the labeling the Position of TFSPH signatories
    public function gettfsphsignadetails($id) {
        $data = TFSPHSignatoryDetail::GetSignatoryDetail($id);
        return json_encode($data);
    }

    //***TFSPH Sig
    function admintfssigindex() {

        $data = TFSPHSignatoryDetail::GetAllTFSPHSignatories();
        return view('pages.admin.tfsphsignatories', compact('data'));
    }

    // Save TFSPH Signatory detail (both add and edit)
    function admintfssigstore(Request $request) {
        $id = request('tsid');

        $this->validate($request,[
            'tsid'           => 'numeric',
            'sig_name'       => 'bail|required|regex:/(^[-A-Za-z., ]+$)/',
            'sig_pos'        => 'bail|required|regex:/(^[-A-Za-z., ]+$)/',
            'sig_tin'        => 'bail|required|regex:/(^[-0-9A-Za-z# ]+$)/',
            'sig_govtid'     => 'bail|required|regex:/(^[-0-9A-Za-z# ]+$)/',

            ],
            [
                'tsid.numeric'      => 'Input invalid.',
                'sig_name.regex'    => 'The signatory name format is invalid.',
                'sig_pos.regex'     => 'The signatory position format is invalid.',
                'sig_tin.regex'     => 'The signatory tin format is invalid.',
                'sig_govtid.regex'  => 'The signatory government id format is invalid.',
            ]);


        if($id != 0) {
            $detail = TFSPHSignatoryDetail::GetSignatoryDetail($id);
            $log = "signa-tfsph-edit";
        }
        else  {
            $detail = new TFSPHSignatoryDetail();
            $log = "signa-tfsph-add";
        }

        if($detail!=null) {
            $detail->name = request('sig_name');
            $detail->position = request('sig_pos');
            $detail->tin_id = request('sig_tin');
            $detail->govt_id = request('sig_govtid');

            $detail->save();

            if(!auth()->user()->hasRole('dealer')) {
              AdminLogController::WriteLog($log,$detail);
            }
        }

        return back();
    }

    // View TFSPH signatory details
    function admintfssigedit(Request $request) {
        $data = TFSPHSignatoryDetail::GetSignatoryDetail(request('id'));

        return $data;
    }

    function admintfssigupdate(Request $request) {
        
        
    }


    //******************* DEALER
    public function editdealersignatories() 
    {
        $dealer = DealerInfo::GetDealerInfo(auth()->user()->dealer_party_id);
        $tfssignatories = $dealer->GetTFSPHSignatories();

        // dd($tfssignatories);

        $data = [
            'id'          => $dealer->party_id,
            'sig1'        => $dealer->signatory1,
            'sig1_tin'    => $dealer->signatory1_tin,
            'sig1_govtid' => $dealer->signatory1_govtid,
            'sig2'        => $dealer->signatory2,
            'sig2_tin'    => $dealer->signatory2_tin,
            'sig2_govtid' => $dealer->signatory2_govtid,
            'tfssig'      => $tfssignatories,
        ];
        
        return view('pages.signatories', compact('data'));
    }

    public function updatedealersignatories($id, Request $request) 
    {
        $this->validate($request,[
            'sig1_name'       => 'nullable|regex:/(^[-A-Za-z., ]+$)/',
            'sig1_tin'        => 'nullable|regex:/(^[-0-9A-Za-z# ]+$)/',
            'sig1_govtid'     => 'nullable|regex:/(^[-0-9A-Za-z# ]+$)/',

            'sig2_name'       => 'nullable|regex:/(^[-A-Za-z., ]+$)/',
            'sig2_tin'        => 'nullable|regex:/(^[-0-9A-Za-z# ]+$)/',
            'sig2_govtid'     => 'nullable|regex:/(^[-0-9A-Za-z# ]+$)/',


            ],
            [
                'sig1_name.regex'    => 'The signatory 1 name format is invalid.',
                'sig1_tin.regex'     => 'The signatory 1 tin format is invalid.',
                'sig1_govtid.regex'  => 'The signatory 1 government id format is invalid.',

                'sig2_name.regex'    => 'The signatory 2 name format is invalid.',
                'sig2_tin.regex'     => 'The signatory 2 tin format is invalid.',
                'sig2_govtid.regex'  => 'The signatory 2 government id format is invalid.',
            ]);

        $d = DealerInfo::GetDealerInfo($id);
        //dd($id);
        $d->signatory1          = request('sig1_name');
        $d->signatory1_tin      = request('sig1_tin');
        $d->signatory1_govtid   = request('sig1_govtid');
        $d->signatory2          = request('sig2_name');
        $d->signatory2_tin      = request('sig2_tin');
        $d->signatory2_govtid   = request('sig2_govtid');
        $d->save();

        Alert::success('','Updated Signatories','');

        if(!auth()->user()->hasRole('dealer')) {
          AdminLogController::WriteLog('signa-loc-edit',$d);
        }

        return back();
        // return redirect('/editdsig');
    }
    
    // For the labeling the TIN and Gov ID of local signatories -- adding and editing contract
    public function getsignadetails($id) {
        $data = DealerInfo::GetSignatory($id);
        return json_encode($data);
    }
}
