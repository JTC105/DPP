@extends('layouts.basepagemod')

@section('content')
<section class="forms">
        <div class="container-fluid">

          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">
              Contract File Requirements             
            </h1>

             <small>Those items that are ticked are the REQUIRED files to be uploaded before dealer/user can print the final contract for signing.</small>

          </header>


          <!-- Contracts Section-->
          <section class="dashboard-counts no-padding-bottom">

              <div class="card">
     
              <div class="card-body">   
                
                <form class="form-horizontal" method="POST" action="/admin/updateconreqs">
                {{ csrf_field() }}

                <div class="form-group row">
    <div class="col-sm-12">
      <input id="genReq" name="genReq" value="1" type="checkbox" {{$data[0]['checked']}} class="form-control-custom">
      <label for="genReq" class="checkbox-custom-label"><small>{{$data[0]['text']}} </small></label>
    </div>
  </div>

  <div class="form-group row ">
    <div class="col-sm-6 ">
      <div id="isIndiContainer">
      <small><b> INDIVIDUAL:</b></small>
      @for($i=1; $i<=8; $i++)
        <br><input id="indiReq_{{$i}}" name="indiReq[]" value="{{$i+1}}" type="checkbox" {{$data[$i]['checked']}} class="form-control-custom">
        <label for="indiReq_{{$i}}" class="checkbox-custom-label"><small>{{$data[$i]['text']}}</small></label>
      @endfor
      </div>
      <br>
      <div id="isCorpContainer">
      <small><b> CORPORATION:</b></small>
      @for($i=9; $i<=13; $i++)
        <br><input id="corpoReq_{{$i}}" name="corpoReq[]" value="{{$i+1}}" type="checkbox" {{$data[$i]['checked']}} class="form-control-custom">
        <label for="corpoReq_{{$i}}" class="checkbox-custom-label"><small>{{$data[$i]['text']}}</small></label>
      @endfor
      </div>

    </div>
    <div class="col-sm-6">
      <small><b> OTHER REQUIREMENTS:</b></small>
      @for($i=15; $i<=20; $i++)
      <br><input id="othersReq_{{$i}}" name="othersReq[]" value="{{$i+1}}" type="checkbox" {{$data[$i]['checked']}} class="form-control-custom">
        <label for="othersReq_{{$i}}" class="checkbox-custom-label"><small>{{$data[$i]['text']}}</small></label>
      @endfor

    </div>
  </div>

                <div class="form-group row">
                  <div class="col-sm-3">
                  </div>
                  <div class="col-sm-6">
                    <button class="btn btn-primary btn-block btn-load">Save</button>
                  </div>
                  <div class="col-sm-3">
                  </div>

                </div>

                </form>

              </div>
            </div>

          </section>

        </div>
      </section>
@endsection

@section('scripts')
<script src="/js/custom-contract.js"></script>
@endsection