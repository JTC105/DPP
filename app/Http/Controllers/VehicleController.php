<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Alert;
use App\Model\Vehicle;

class VehicleController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Vehicle::GetVehicles();

        return view('pages.admin.vehiclelist', compact('data'));
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
            'vehicleNameA'   => 'required|regex:/(^[-0-9A-Za-z.,\/()& ]+$)/',
            ],[
                'vehicleNameA.regex'    => 'The vehicle name format is invalid.',
            ]);

        $v= new Vehicle();
        $v->name = request('vehicleNameA');
        $v->save();

        Alert::success('','Vehicle Saved');

        AdminLogController::WriteLog('vehicle-add',request('vehicleNameA'));

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
        $v = Vehicle::where('id', request('id'))->first();

        return $v;
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
            'vid'            => 'numeric',
            'vehicleName'    => 'required|regex:/(^[-0-9A-Za-z.,\/()& ]+$)/',
            ],[
                'vid.numeric'          => 'Input invalid.',
                'vehicleName.regex'    => 'The vehicle name format is invalid.',
            ]);

        $v = Vehicle::find(request('vid'));
        if($v!=null) {
            $v->name = request('vehicleName');
            $v->save();

            Alert::success('','Vehicle Saved');

            AdminLogController::WriteLog('vehicle-edit',request('vehicleName'));
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
