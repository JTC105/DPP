<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Alert;
use App\Model\CityMun;

class CitymunController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = CityMun::GetCityMunicipalities();

        return view('pages.admin.citymunlist', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'citymunNameA'   => 'required|regex:/(^[-A-Za-z., ]+$)/',
            ],[
                'citymunNameA.regex'    => 'The city municipality name format is invalid.',
            ]);

        $cm= new CityMun();
        $cm->name = request('citymunNameA');
        $cm->save();

        Alert::success('','City/Municipality Saved');

        AdminLogController::WriteLog('cm-add',request('citymunNameA'));

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $cm = CityMun::where('id', request('id'))->first();

        return $cm;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {        

        $this->validate($request,[
            'cmid'           => 'numeric',
            'citymunName'    => 'required|regex:/(^[-A-Za-z., ]+$)/',
            ],[
                'cmid.numeric'         => 'Input invalid.',
                'citymunName.regex'    => 'The city municipality name format is invalid.',
            ]);

        $cm = CityMun::find(request('cmid'));
        if($cm!=null) {
            $cm->name = request('citymunName');
            $cm->save();

            Alert::success('','City/Municipality Saved');

            AdminLogController::WriteLog('cm-edit',request('citymunName'));
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
