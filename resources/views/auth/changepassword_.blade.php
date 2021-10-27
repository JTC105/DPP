@extends('layouts.basepagewhole')

@section('content')

  <div class="page login-page">
    <div class="container-fluid">
      <div class="form-outer text-center d-flex align-items-center">

        <div class="form-inner" style="width:150%; margin-top: 80px;">
          <div class="logo text-uppercase"><span>CHANGE</span><strong class="text-primary">PASSWORD</strong></div>
          <ul class="alert alert-info password-note">
          @if(auth()->user()->is_ftul)
          <li>It is required to change your password if it is your first time to login.</li>
          @endif

          @if($data['is_expire'])
          <li>Your password has expired. Please change your password.</li>
          @endif

          <li>Password length (characters) should be minimum of {{$data['min']}} and maximum of {{$data['max']}} </li>
          <li>Password must have at least 1 uppercase, 1 lowercase, 1 numeric and 1 special character.</li>
          </ul>
          @include('partials.flash-message')
          <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}">
            {{ csrf_field() }}

          <div class="form-group row {{ $errors->has('current-password') ? ' has-error' : '' }}">
              <label for="current-password" class="col-sm-3 form-control-label">Current</label>

              <div class="col-sm-9">
                  <input id="current-password" type="password" class="form-control" name="current-password" required>

                  @if ($errors->has('current-password'))
                      <span class="help-block">
                          <strong>{{ $errors->first('current-password') }}</strong>
                      </span>
                  @endif
              </div>
          </div>

          <div class="form-group row {{ $errors->has('new-password') ? ' has-error' : '' }}">
              <label for="new-password" class="col-sm-3 form-control-label">New</label>

              <div class="col-sm-9">
                  <input id="new-password" type="password" class="form-control" name="new-password" minlength="{{$data['min']}}" maxlength="{{$data['max']}}" required>

                  @if ($errors->has('new-password'))
                      <span class="help-block">
                          <strong>{{ $errors->first('new-password') }}</strong>
                      </span>
                  @endif
              </div>
          </div>

          <div class="form-group row">
              <label for="new-password-confirm" class="col-sm-3 form-control-label">Confirm</label>

              <div class="col-sm-9">
                  <input id="new-password-confirm" type="password" class="form-control" name="new-password-confirm" required>
              </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-4">
              @if(!auth()->user()->is_ftul && !$data['is_expire'])
              @if(auth()->user()->is_admin_level > 0)
              <a id="close" href="{{ route('dashboard') }}" class="btn btn-block btn-secondary">Go Back</a>
              @endif

              @role('dealer')
              <a id="close" href="{{ route('dprofile') }}" class="btn btn-block btn-secondary">Go Back</a>
              @endrole
              @endif
            </div>
              <div class="col-sm-8">
                <button id="add" type="submit" class="btn btn-block btn-primary">Change Password</button>
              </div>
          </div>
          </form>
        </div>

       {{-- @include('includes.footerwhole') --}}

      </div>
    </div>
  </div>

@endsection