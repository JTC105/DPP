@extends('layouts.basepagewhole')

@section('content')

  <div class="page login-page">
    <div class="container">
      <div class="form-outer text-center d-flex align-items-center">

        <div class="form-inner" style="width:100%; margin-top: 80px;">
          {{-- <img src="/img/toyota_logo.png" alt="..." class="img-fluid">
          <br> --}}
          <img src="/img/toyota_logo_2.png" alt="..."  class="img-fluid" style="width: 48%; height: 48%">
          <br />
          <div class="logo text-uppercase"><span>DPPS</span><strong class="text-primary">Online</strong></div>
          <p>Dealer Prompt Payment System (DPPS) is being used as a tool for printing collateral documents Lease Contract and Promissory Note with Chattel Mortgage (PNCM).</p>
          <form method="POST" class="text-left form-validate" action="/signin" autocomplete="off">
            {{ csrf_field() }}

            <div class="form-group-material">
              <input id="username" type="text" name="username" required data-msg="Please enter your username" class="input-material" required>
              <label for="login-username" class="label-material">Username</label>
            </div>
            <div class="form-group-material">
              <input id="psswrd" type="password" name="psswrd" required data-msg="Please enter your password" class="input-material" required>
              <label for="login-password" class="label-material">Password</label>
            </div>
            
            <div class="line line-dashed"></div>
            <div class="required-field" style="text-align: center;"></div>
            @include('includes.error')
            <div class="form-group text-center">
                <input id="/signin" type="submit" value="Login" class="btn btn-primary">
            </div>
          </form>
        </div>

        @include('includes.footerwhole')

      </div>
    </div>
  </div>

@endsection