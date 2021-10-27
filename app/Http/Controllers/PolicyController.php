<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Model\Policy;

use Alert;

class PolicyController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $policy = Policy::get();

        // $r = Policy::where('name', 'lockoutUser')->first();
        // $r->value = 4;
        // $r->save();
        // dd($r);

        $data = [
            'pol' => $policy,
        ];

        return view('pages.admin.policyform', compact('data'));
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
        $max = Policy::where('name', 'passMaxLen')->first()->value;
        $validator = Validator::make($request->all(), [ 
            'lockoutUser'       => 'numeric',
            'passExpiry'        => 'numeric',
            'passExpiryWarning' => 'numeric',
            'passMinLen'        => 'numeric',
            'passMaxLen'        => 'numeric',
            'passDefaultTfs'    => 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-.]).{1,'.$max.'}$/', 
            'passDefaultDealer' => 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-.]).{1,'.$max.'}$/' 
        ],[
            'passExpiry.numeric'        => 'The password expiry must be a number.',
            'passExpiryWarning.numeric' => 'The password expiry warning must be a number.',
            'passMinLen.numeric'        => 'The password minimum length must be a number.',
            'passMaxLen.numeric'        => 'The password maximum length must be a number.',
            'passDefaultTfs.regex'      => 'The default password of TFSPH employees must have at least 1 uppercase, 1 lowercase, 1 numeric and 1 special character.',
            'passDefaultDealer.regex'   => 'the default password of Dealers must have at least 1 uppercase, 1 lowercase, 1 numeric and 1 special character.',
        ]); 

        if ($validator->fails()) { 

            // dd("fsdfd");
            // return redirect()->back()->with("error",$validator->messages()->first());
            // return redirect()->back()->with("error","Password must have at least 1 uppercase, 1 lowercase, 1 numeric and 1 special character.");
            return back()->withInput($request->all())->withErrors($validator->errors());
        } 

        $policy = Policy::get();

        foreach ($policy as $p) {
            $r = Policy::where('name', $p->name)->first();
            if($r->name == "passDefaultTfs" || $r->name == "passDefaultDealer"){
                $r->value = bcrypt(request($p->name));
            }
            else {
                $r->value = request($p->name);
            }

            $r->save();
        }

        Alert::success('','Updated Policy','');

        return back();
    }
}
