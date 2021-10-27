@extends('layouts.basepagewhole')

@section('content')

  <div class="page login-page">
    <div class="container-fluid">
      <div class="form-outer text-center d-flex align-items-center">

        <div class="form-inner" style="width:150%; margin-top: 80px;">
          <div class="logo text-uppercase"><span>CHANGE PASSWORD</span>{{-- <strong class="text-primary">PASSWORD</strong>--}}</div>
          <br>
          <ul class="alert alert-info password-note">
          @if(auth()->user()->is_ftul)
          <li><b>It is required to change your password if it is your first time to login.</b></li>
          @endif

          @if($data['is_expire'])
          <li>Your password has expired. Please change your password.</li>
          @endif

          <li>Password length (characters) should be minimum of {{$data['min']}} and maximum of {{$data['max']}} </li>
          <li>Password must have at least 1 uppercase, 1 lowercase, 1 numeric and 1 special character.</li>
          </ul>
          @include('partials.flash-message')
          <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}" autocomplete="off">
            {{ csrf_field() }}


          <div class="form-group-material {{ $errors->has('current-password') ? ' has-error' : '' }}">
            <input id="current-password" type="password" name="current-password" required data-msg="This is a required field." class="input-material" required>
            <label for="current-password" class="label-material">Current Password</label>
            @if ($errors->has('current-password'))
                <span class="help-block">
                    <strong>{{ $errors->first('current-password') }}</strong>
                </span>
            @endif
          </div>

          <div class="form-group-material {{ $errors->has('new-password') ? ' has-error' : '' }}">
            <input id="new-password" type="password" name="new-password" required data-msg="This is a required field." class="input-material" required>
            <label for="new-password" class="label-material">New Password</label>
            @if ($errors->has('new-password'))
                <span class="help-block">
                    <strong>{{ $errors->first('new-password') }}</strong>
                </span>
            @endif
          </div>

          <div class="form-group-material {{ $errors->has('new-password-confirm') ? ' has-error' : '' }}">
            <input id="new-password-confirm" type="password" name="new-password-confirm" required data-msg="This is a required field." class="input-material" required>
            <label for="new-password-confirm" class="label-material">Confirm Password</label>
            @if ($errors->has('new-password-confirm'))
                <span class="help-block">
                    <strong>{{ $errors->first('new-password-confirm') }}</strong>
                </span>
            @endif
          </div>

          <br>

          <div class="form-group row">
            <div class="col-sm-4">
              @if(!auth()->user()->is_ftul && !$data['is_expire'])
            
              <a id="close" href="{{ route('dashboard') }}" class="btn btn-block btn-secondary">Go Back</a>
             
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