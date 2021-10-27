<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use Alert;
use App\Model\File;
use App\Model\FormTemplate;

class FormTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = FormTemplate::GetFormTemplates();

        return view('pages.formtemplates', compact('data'));
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

        Alert::success('','Uploaded Forms','');

         if ($request->hasFile('file')) {
            foreach ($request->file as $file) {

                $fileFull = $file->getClientOriginalName();
                $fileNameArray = explode(".", $fileFull);

                $filename = $fileNameArray[0];
                $filesize = $file->getClientSize()/1024;
                $filesize = round($filesize, 2);
                $path = File::GetFormTemplatePath();
                // Log:info($filename);
                // $file->storeAs('public/uploads/formtemplates/', $filename);

                $model = new FormTemplate();
                $model->name = $filename;
                $model->size = $filesize;
                $model->path = $path.$fileFull;
                $model->save();

                $file->move(public_path($path),$fileFull);

            }

            if(!auth()->user()->hasRole('dealer')) {
              AdminLogController::WriteLog('form-temp-add',$filename);
            }
        }        

        // return redirect('/ftemplates');

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
        $f = FormTemplate::where('id', $request->id)->first();

        return $f;
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
            'ftid'          => 'numeric',
            'formName'      => 'required|regex:/(^[-0-9A-Za-z._@ ]+$)/',
            ],
            [
                'ftid.numeric'             => 'The id should be numbers only.',
                'formName.regex'           => 'The form name format is invalid.',
            ]);

       
        $name = request('formName');

        $path = File::GetFormTemplatePath();
        $fileLocation = public_path().'/'.$path;

        $ft = FormTemplate::find(request('ftid'));
        $ftArray = explode(".", $ft->path);
        
        rename($fileLocation.$ft->name.'.'.$ftArray[1], $fileLocation.$name.'.'.$ftArray[1]);

        $ft->name = $name;
        // $ft->path = request('formPath');
        $ft->path = $path.$name.'.'.$ftArray[1];
        $ft->save();

        if(!auth()->user()->hasRole('dealer')) {
          AdminLogController::WriteLog('form-temp-edit',$name);
        }

        Alert::success('','Saved Form');

        return redirect('/ftemplates');
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
