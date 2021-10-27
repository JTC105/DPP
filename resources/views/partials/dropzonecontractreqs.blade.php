<div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Attach File for</h5>
      </div>
      <div class="modal-body ">

  
@permission('contract-upload-log')
  <div class="form-group row">
    <div class="col-sm-12">
      <input id="genReq" name="genReq" value="1" type="checkbox" {{$conreqData[0]['checked']}} class="form-control-custom">
      <label for="genReq" class="checkbox-custom-label"><small>{{$conreqData[0]['text']}} </small></label>
    </div>
  </div>

  <div class="form-group row ">
    <div class="col-sm-6 ">
      <div id="isIndiContainer">
      <small><b> INDIVIDUAL:</b></small>
      @for($i=1; $i<=8; $i++)
        <br><input id="indiReq_{{$i}}" name="indiReq[]" value="{{$i+1}}" type="checkbox" {{$conreqData[$i]['checked']}} class="form-control-custom">
        <label for="indiReq_{{$i}}" class="checkbox-custom-label"><small>{{$conreqData[$i]['text']}}</small></label>
      @endfor
      </div>
      <br>
      <div id="isCorpContainer">
      <small><b> CORPORATION:</b></small>
      @for($i=9; $i<=13; $i++)
        <br><input id="corpoReq_{{$i}}" name="corpoReq[]" value="{{$i+1}}" type="checkbox" {{$conreqData[$i]['checked']}} class="form-control-custom">
        <label for="corpoReq_{{$i}}" class="checkbox-custom-label"><small>{{$conreqData[$i]['text']}}</small></label>
      @endfor
      </div>

    </div>
    <div class="col-sm-6">
      <small><b> OTHER REQUIREMENTS:</b></small>
      @for($i=15; $i<=20; $i++)
        <br><input id="othersReq_{{$i}}" name="othersReq[]" value="{{$i+1}}" type="checkbox" {{$conreqData[$i]['checked']}} class="form-control-custom">
        <label for="othersReq_{{$i}}" class="checkbox-custom-label"><small>{{$conreqData[$i]['text']}}</small></label>
      @endfor

    </div>
  </div>

<br>
@endpermission

@permission('contract-upload-con-req')
  @role('lo')
    <div class="form-group row">
    <div class="col-sm-12">
      @if($conreqData[0]['checked'] == 'checked')
      <i class="fas fa-check-square check-color"></i>
      @else
      <i class="fas fa-minus-square" style="color:gray"></i>
      @endif
      <label><small>{{$conreqData[0]['text']}} </small></label>
    </div>
  </div>

  <div class="form-group row ">
    <div class="col-sm-6 ">
      <div id="isIndiContainer">
      <small><b> INDIVIDUAL:</b></small>
      @for($i=1; $i<=8; $i++)        
        @if($conreqData[$i]['checked'] == 'checked')
        <br><i class="fas fa-check-square check-color"></i>
        @else
        <br><i class="fas fa-minus-square" style="color:gray"></i>
        @endif
        <label><small>{{$conreqData[$i]['text']}}</small></label>
      @endfor
      </div>
      <br>
      <div id="isCorpContainer">
      <small><b> CORPORATION:</b></small>
      @for($i=9; $i<=13; $i++)
        @if($conreqData[$i]['checked'] == 'checked')
        <br><i class="fas fa-check-square check-color"></i>
        @else
        <br><i class="fas fa-minus-square" style="color:gray"></i>
        @endif
        <label><small>{{$conreqData[$i]['text']}}</small></label>
      @endfor
      </div>

    </div>
    <div class="col-sm-6">
      <small><b> OTHER REQUIREMENTS:</b></small>
      @for($i=15; $i<=20; $i++)
        @if($conreqData[$i]['checked'] == 'checked')
        <br><i class="fas fa-check-square check-color"></i>
        @else
        <br><i class="fas fa-minus-square" style="color:gray"></i>
        @endif
        <label><small>{{$conreqData[$i]['text']}}</small></label>
      @endfor

    </div>
  </div>

<br>
  @endrole

@if(!$data['contract']->is_conreqs_upload)
<p class="alert alert-info"><i class="fas fa-info-circle"></i>
<strong>Note: File Upload Guide</strong> <br>
&nbsp;&nbsp;&bull;&nbsp;File uploaded will be merge on the currently uploaded file. <br>
&nbsp;&nbsp;&bull;&nbsp;Files accepted are PDF. <br>
{{--&nbsp;&nbsp;&bull;&nbsp;File size should not be exceeded to 5MB per file. <br>
&nbsp;&nbsp;&bull;&nbsp;Single file upload only. <br> --}}
</span>
</p>


<div class="form-group row">
    <div class="col-sm-12">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="fileConReq" name="fileConReq" accept=".pdf">
          <label class="custom-file-label" for="fileConReq">Choose file</label>
        </div>
    </div>
  
</div>
@endif
@endpermission


      </div>
      <div class="modal-footer">
        <button type="button" id="btnResetForm2" class="btn btn-secondary" data-dismiss="modal">Close</button>
        @if(!$data['contract']->is_conreqs_upload)
        <button type="button" class="btn btn-primary pull-right" id="btnUpload2" data-dismiss="modal">Set</button>
        @else 
          @permission('contract-upload-log')
           <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Save</button>
          @endpermission
        @endif
      </div>


    </div>
  </div>
</div>
