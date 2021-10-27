@extends('layouts.basepage')

@section('content')

      <section class="forms">
        <div class="container-fluid">

          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Signatories</h1>
          </header>
          @include('includes.errormod')
          
          <!-- Signatories Section-->
          <section class="no-padding-bottom">

             <div class="card mt-3 tab-card">
              <div class="card-header tab-card-header">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                      <a class="nav-link active show" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="One" aria-selected="true">Dealer Signatories</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="Two" aria-selected="false">TFSPH Signatories</a>
                  </li>
                </ul>
              </div>

              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active p-3" id="one" role="tabpanel" aria-labelledby="one-tab">
                  
                  <div class="card">
                    <div class="card-body">
                      
                      <form method="POST" class="form-horizontal" action="{{ route('updatedsig', $data['id']) }}">
                        {{ csrf_field() }}

                        <p>Signatory 1</p>
                        <hr/>
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Name</label>
                          <div class="col-sm-9">
                            <input id="inputHorizontalSuccess" name="sig1_name" type="name" placeholder="Name" class="form-control form-control-success" value="{{$data['sig1']}}">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">TIN</label>
                          <div class="col-sm-9">
                            <input id="inputHorizontalWarning" name="sig1_tin" type="text" placeholder="###-###-###" class="form-control form-control-warning" value="{{$data['sig1_tin']}}">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Government ID</label>
                          <div class="col-sm-9">
                            <input id="inputHorizontalWarning" name="sig1_govtid" type="text" placeholder="##-#######-#" class="form-control form-control-warning" value="{{$data['sig1_govtid']}}">
                          </div>
                        </div> 

                        <p>Signatory 2</p>
                        <hr/>
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Name</label>
                          <div class="col-sm-9">
                            <input id="inputHorizontalSuccess" name="sig2_name" type="name" placeholder="Name" class="form-control form-control-success" value="{{$data['sig2']}}">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">TIN</label>
                          <div class="col-sm-9">
                            <input id="inputHorizontalWarning" name="sig2_tin" type="text" placeholder="###-###-###" class="form-control form-control-warning" value="{{$data['sig2_tin']}}">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Government ID</label>
                          <div class="col-sm-9">
                            <input id="inputHorizontalWarning" name="sig2_govtid" type="text" placeholder="##-#######-#" class="form-control form-control-warning" value="{{$data['sig2_govtid']}}">
                          </div>
                        </div> 

                        <div class="form-group row">       
                          <div class="col-sm-9 offset-sm-3">
                            <input type="submit" value="Save" class="btn btn-primary">
                          </div>
                        </div>

                      </form>


                    </div>
                  </div>
                  


                </div>
                <div class="tab-pane fade p-3" id="two" role="tabpanel" aria-labelledby="two-tab">
                 
                 <div class="card">
                    <div class="card-body">
                      
                      <form class="form-horizontal">

                        <?php $i = 0; ?>
                        @foreach($data['tfssig'] as $d)
                        <p>Signatory {{ $i+1 }} &nbsp;&nbsp;<small>(Set {{ ($i==0) ? 'A' : 'B' }})</small></p> 
                        <hr/>
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Name</label>
                          <div class="col-sm-9">
                            @if($d!=null)
                            <p>{{ $d->name }} </p>
                            @else
                            <p>--</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Position</label>
                          <div class="col-sm-9">
                             @if($d!=null)
                            <p>{{ $d->position }} </p>
                            @else
                            <p>--</p>
                            @endif
                          </div>
                        </div>
                        <?php $i++; ?>
                        @endforeach

                      </form>


                    </div>
                  </div>

                </div>

              </div>
            </div>

          </section>

        </div>
      </section>
@endsection