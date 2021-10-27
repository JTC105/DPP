@extends('layouts.basepagemod')

@section('content')
<section class="forms">
        <div class="container-fluid">

          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Policy Settings</h1>
          </header>
          @include('includes.errormod')

          <!-- Contracts Section-->
          <section class="dashboard-counts no-padding-bottom">

              <div class="card">
     
              <div class="card-body">   
                
                <form class="form-horizontal" method="POST" action="/admin/policysave">
                {{ csrf_field() }}

                @foreach($data['pol'] as $d)
                <div class="form-group row">
                  <label class="col-sm-3 form-control-label">{{$d->display_name}}</label>
                  <div class="col-sm-3">
                      @if($d->name == "passDefaultTfs" || $d->name == "passDefaultDealer")
                      <input id="{{$d->name}}" name="{{$d->name}}" type="password" class="form-control" data-toggle="password" value="{{$d->value}}"  />
                      @else
                      <input id="{{$d->name}}" name="{{$d->name}}" type="text" class="form-control" value="{{$d->value}}"  min="0" step="1"/>
                      @endif
                      <small class="form-text">{{$d->desc}}</small>
                  </div>
                </div>
                @endforeach

                <div class="form-group row">
                  <div class="col-sm-3">
                  </div>
                  <div class="col-sm-3">
                    <button class="btn btn-primary btn-block btn-load">Save</button>
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