<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Model\CustomField;
use App\Model\DealerInfo;
use App\Model\FeesCustom;
use App\Model\PNCMFeesDealerRef;
use App\Model\PNCMFeesRetailTable1;
use App\Model\PNCMFeesRetailTable2;
use App\Model\PNCMFeesRetailTable3;

use Alert;

class DealerFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dealers = DealerInfo::GetDealersNotExistInPNCMDealersRef();
        $tablerefs = PNCMFeesDealerRef::GetTableRefs();

        $dealerList = DealerInfo::get();
   
        $i = 0;
        foreach ($dealerList as $d) {
            $dealer = DealerInfo::GetDealerInfo($d->party_id);
            $result[$i]['pid'] = ($dealer!=null) ? $dealer->party_id : 0;
            $result[$i]['name'] = ($dealer!=null) ? $dealer->dealer_name : "";

            $dealerRef = PNCMFeesDealerRef::GetRowByPartyId($d->party_id);            
            $result[$i]['tableref'] = ($dealerRef!=null) ? $dealerRef->table_no : "NONE";
            $result[$i]['drid'] = ($dealerRef!=null) ? $dealerRef->id : 0;

            $feesCustom = FeesCustom::GetRowByPartyId($d->party_id); 
            $result[$i]['cmfee2'] = ($feesCustom!=null) ? $feesCustom->fees_2party : 0;
            $result[$i]['cmfee3'] = ($feesCustom!=null) ? $feesCustom->fees_3party : 0;
            $result[$i]['leasefee'] = ($feesCustom!=null) ? $feesCustom->fees_lease : 0;
            $result[$i]['fcid'] = ($feesCustom!=null) ? $feesCustom->id : 0;

            $i++;
        }

        $data = [
            'list'          => $result,
            'dealers'       => $dealers,
            'tablerefs'     => $tablerefs,
        ];

        return view('pages.admin.dealerfeesindex', compact('data'));
    }

    public function dealerfeeslistindex() {
         $data = PNCMFeesDealerRef::GetTableRefs();

        return view('pages.admin.dealerfeeslist', compact('data'));
    }

    public function dealerfeesliststore(Request $request) {

         $this->validate($request,[
            'dealerIdA'     => 'required|numeric',
            'dTableRefA'    => 'required|regex:/(^[0-9A-Za-z ]+$)/',
            ],
            [
                'dealerIdA.numeric'    => 'The dealer id should be numbers only.',
                'dealerIdA.required'   => 'The dealer id is required.',
                'dTableRefA.regex'     => 'The table reference format is invalid.',
                'dTableRefA.required'  => 'The table reference is required.',
            ]);

        $df = new PNCMFeesDealerRef();
        $df->dealer_party_id = request('dealerIdA');
        $df->table_no = request('dTableRefA');
        $df->save();

        Alert::success('','Saved Record','');

         $data = [
            'df'    => $df,
        ];

        AdminLogController::WriteLog('dfees-add',$data);

        return back();
    }

    public function dealerfeeslistedit(Request $request) {

        $dealerPartyId = request('id');
        $dealer =  DealerInfo::GetDealerInfo($dealerPartyId);
        $tablerefs = PNCMFeesDealerRef::GetTableRefs($dealerPartyId);
        $dealerRef = PNCMFeesDealerRef::GetRowByPartyId($dealerPartyId);
        $feesCustom = FeesCustom::GetRowByPartyId($dealerPartyId);

        $data = [
            "name"          => ($dealer!=null) ? $dealer->dealer_name : "",
            "tablerefname"  => ($dealerRef!=null) ? $dealerRef->table_no : 0,
            "id"            => $dealerPartyId,
            "cmfee2"        => ($feesCustom!=null) ? $feesCustom->fees_2party : 0,
            "cmfee3"       => ($feesCustom!=null) ? $feesCustom->fees_3party : 0,
            "leasefee"      => ($feesCustom!=null) ? $feesCustom->fees_lease : 0,
            "tablerefs"     => $tablerefs,
        ];


        return json_encode($data);

    }

    public function dealerfeeslistupdate(Request $request) {

         $this->validate($request,[
            'dfid'      => 'required|numeric',
            'dTableRef' => 'regex:/(^[0-9A-Za-z ]+$)/',
            'cmfee2'    => 'required|regex:/(^[0-9A.,]+$)/',
            'cmfee3'    => 'required|regex:/(^[0-9A.,]+$)/',
            'leasefee'  => 'required|regex:/(^[0-9A.,]+$)/',
            ],
            [
                'dfid.numeric'        => 'The dealer id should be numbers only.',
                'dfid.required'       => 'The dealer id is required.',
                'dTableRef.regex'     => 'The table reference format is invalid.',
                'cmfee2.regex'        => 'The cm fee 2 party format is invalid.',
                'cmfee3.regex'        => 'The table reference format is invalid.',
                'leasefee.regex'      => 'The table reference format is invalid.',
            ]);

        $dealerPartyId = request('dfid');

        $df = PNCMFeesDealerRef::GetRowByPartyId($dealerPartyId);
        $prev = ($df!=null) ? $df->table_no : "NONE";
        if($df==null) {
            $df = new PNCMFeesDealerRef();
            $df->dealer_party_id = $dealerPartyId;
        }

        $dTableRef = request('dTableRef');
        $df->table_no = ($dTableRef!="0") ? $dTableRef : "NONE";
        $df->save();

        $fc = FeesCustom::GetRowByPartyId($dealerPartyId);
        $prevCMFee2 = 0;
        $prevCMFee3 = 0;
        $prevCMFeeLease = 0;

        if($fc==null) {
            $fc = new FeesCustom();
            $fc->dealer_party_id = $dealerPartyId;
        } else {
            $prevCMFee2 = $fc->fees_2party;
            $prevCMFee3 = $fc->fees_3party;
            $prevCMFeeLease = $fc->fees_lease;
        }

        $fc->fees_2party = request('cmfee2');
        $fc->fees_3party = request('cmfee3');
        $fc->fees_lease = request('leasefee');
        $fc->save();

        Alert::success('','Updated Record','');

        $data = [
            'df'            => $df,
            'prev'          => $prev,
            'fc'            => $fc,
            'prevCMFee2'    => $prevCMFee2,
            'prevCMFee3'    => $prevCMFee3,
            'prevCMFeeLease'=> $prevCMFeeLease,
        ];

        AdminLogController::WriteLog('dfees-edit',$data);

        return back();
    }

    public function dealerfeestableindex($id) {

        session(['dftid' => $id]);

        $table = PNCMFeesDealerRef::GetSpecificTableRef($id);
        $tabledata = $table['tableinstance']->get();
        $retailtypes = CustomField::GetFieldsByDesc('retail_type');

        $i = 0;
        foreach ($tabledata as $d) {
            $result[$i]['id'] = $d->id;
            $result[$i]['from'] = $d->amt_threshold_from;
            $result[$i]['to'] = $d->amt_threshold_to;
            $result[$i]['rate'] = $d->rate;
            $result[$i]['retailtype'] = CustomField::GetFieldNameByDescAndFieldId('retail_type', PNCMFeesDealerRef::GetPartyTypeRetailTypeCustomFieldId($d->party_type));

            $i++;
        }

        $data = [
            'tableId'       => $id,
            'tableName'     => $table['tname'],
            'tableData'     => $result,
            'retailtypes'   => $retailtypes,
        ];

        return view('pages.admin.dealerfeestable', compact('data'));
    }

    public function dealerfeestablestore(Request $request) {

        $this->validate($request,[
            'fromRangeA'     => 'required|regex:/(^[0-9.,]+$)/',
            'toRangeA'       => 'required|regex:/(^[0-9.,]+$)/',
            'rateA'          => 'required|regex:/(^[0-9.,]+$)/',
            ],
            [
                'fromRangeA.numeric'        => 'The from range format is invalid.',
                'toRangeA.numeric'          => 'The to range format is invalid.',
                'rateA.numeric'             => 'The rate format is invalid.',
            ]);

        $temptableinstance = PNCMFeesDealerRef::GetSpecificTableRef(session()->get('dftid'));
        $tableinstance = $temptableinstance['tableinstance'];

        $d = $tableinstance;
        $d->amt_threshold_from = request('fromRangeA');
        $d->amt_threshold_to = request('toRangeA');
        $d->rate = request('rateA');
        $d->party_type = request('retailTypeA')+1;
        $d->save();

        Alert::success('','Saved Details','');

        $data = [
            'tname'     => $temptableinstance['tname'],
            'detail'    => $d,
        ];

        AdminLogController::WriteLog('dfees-tableref-add',$data);

        return back();
    }

    public function dealerfeestableedit(Request $request) {

        $tableinstance = PNCMFeesDealerRef::GetSpecificTableRef(session()->get('dftid'));
        $tableinstance = $tableinstance['tableinstance'];
        $retailtypes = CustomField::GetFieldsByDesc('retail_type');

        $d = $tableinstance::find(request('id'));

        $data['id'] = $d->id;
        $data['from'] = $d->amt_threshold_from;
        $data['to'] = $d->amt_threshold_to;
        $data['rate'] = $d->rate;
        $data['retailtypeid'] = $d->party_type-1;//CustomField::GetFieldNameByDescAndFieldId('retail_type', PNCMFeesDealerRef::GetPartyTypeRetailTypeCustomFieldId($d->party_type));
        $data['retailtypes'] = $retailtypes;

        return json_encode($data);
    }

    public function dealerfeestableupdate(Request $request) {

         $this->validate($request,[
            'fromRange'     => 'required|regex:/(^[0-9.,]+$)/',
            'toRange'       => 'required|regex:/(^[0-9.,]+$)/',
            'rate'          => 'required|regex:/(^[0-9.,]+$)/',
            ],
            [
                'fromRange.numeric'        => 'The from range format is invalid.',
                'toRange.numeric'          => 'The to range format is invalid.',
                'rate.numeric'             => 'The rate format is invalid.',
            ]);

        $temptableinstance = PNCMFeesDealerRef::GetSpecificTableRef(session()->get('dftid'));
        $tableinstance = $temptableinstance['tableinstance'];

        $d = $tableinstance::find(request('dfrid'));
        $prevfrom = $d->amt_threshold_from;
        $prevto = $d->amt_threshold_to;
        $prevrate = $d->rate;
        $d->amt_threshold_from = request('fromRange');
        $d->amt_threshold_to = request('toRange');
        $d->rate = request('rate');
        $d->party_type = request('retailType')+1;
        $d->save();

        Alert::success('','Updated Details','');

        $data = [
            'prevfrom'  => $prevfrom,
            'prevto'    => $prevto,
            'prevrate'  => $prevrate,
            'tname'     => $temptableinstance['tname'],
            'detail'    => $d,
        ];

        AdminLogController::WriteLog('dfees-tableref-edit',$data);

        return back();
    }
}
