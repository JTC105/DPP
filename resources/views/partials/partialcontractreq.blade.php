<!-- Files Details -->
<div class="card">
<div class="card-header d-flex align-items-center">
  <h3 class="h4">Contract Requirements </h3> 
</div>
<div class="card-body">

  <div class="form-group row">
    <label class="col-sm-2 form-control-label">Approval Conditions</label>
    <div class="col-sm-10">
      <p>{!! nl2br(e($data['contract']->custom_reqs)) !!}</p>
    </div>
  </div>
  <br>
	<div class="form-group row">
		&nbsp;&nbsp;&nbsp;
    @if($data['contract']->is_conreqs_upload)
		<a class="btn btn-warning btn-load" target="_blank" target="_blank" href="/contractreqview/{{ $data['contract']->id }}"><i class="fas fa-eye"></i> <b>View Uploaded File</b></a>  
    @else
    <button type="button" class="btn btn-default" disabled><i class="fas fa-eye"></i> <b>View Uploaded File</b></button>  
    @endif
    @if(auth()->user()->whatRole()->name == 'lo')
		&nbsp;&nbsp;&nbsp;
		<button type="button" data-toggle="modal" data-target="#fileModal" class="btn btn-primary"><i class="fas fa-upload"></i> Upload File</button>  
		&nbsp;&nbsp;&nbsp;
		<label class="form-control-label" id="fileName">...</label>
		@else
    &nbsp;&nbsp;&nbsp;
    <button type="button" data-toggle="modal" data-target="#fileModal" class="btn btn-primary"><i class="fas fa-upload"></i> Set Processed File/s</button>  
    @endif
	</div>
	@include('partials.dropzonecontractreqs')

	<div class="table-responsive">                       
      <table class="table table-striped table-hover" id="conReqTable">
        <thead>
          <tr>
            <th>Date</th>
            <th>Note</th>
            <th>Username</th>
          </tr>
        </thead>
        <tbody>
          @if($data2!=null)
          @foreach($data2 as $d2)
          <tr>
            <td scope="row">{{ $d2['dateupload'] }}</td>
            <td>{!! nl2br(e($d2['note'])) !!}</td>
            <td>{{ $d2['username'] }}</td>
          </tr>
          @endforeach
          @else
          <tr>
          	<td colspan="3">
          		No data.
          	</td>
          </tr>
          @endif
        </tbody>
      </table>
    </div>

</div>
</div>
