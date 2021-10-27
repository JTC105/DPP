@extends('layouts.basepagemod')

@section('content')

          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="#" class="btn-load">Settings</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ul>
          </div>

          <section class="forms custom-bg"> 
            <div class="container-fluid">

	          <!-- Page Header-->
	          <header> 
	            <h1 class="h3 display">Dealer Profile</h1>
	          </header>

              <div class="row">
              	
				<div class="col-lg-12">
				 {{-- <form class="form-horizontal" method="POST" action="/dealerprofileupdate/{{$data->id}}"> --}}

                <!-- Client Details -->
              	<div class="card">
  
                    <div class="card-body">
	                    
	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Reference</label>
	                      <div class="col-sm-9">
	                        <p>{{$data->reference}}</p>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Name</label>
	                      <div class="col-sm-9">
	                        {{-- <input type="text" id="dealerName" name="dealerName" placeholder="Name" value="{{$data->dealer_name}}" class="form-control form-control-sm" required> --}}
	                        <p>{{$data->dealer_name}}</p>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">TIN</label>
	                      <div class="col-sm-9">
	                        {{-- <input type="text" id="dealerTin" name="dealerTin" placeholder="###-###-###" value="{{$data->dealer_tin}}" class="form-control form-control-sm" required> --}}
	                        <p>{{$data->dealer_tin}}</p>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Address</label>
	                      <div class="col-sm-9">
	                        {{-- <textarea id="dealerAddress" name="dealerAddress" class="form-control form-control-sm"></textarea required> --}}
	                        <p>{{$data->address}}</p>
	                      </div>
	                    </div>

	                    {{-- <div class="form-group row">
	                    	<div class="col-sm-12">
							<button type="submit" class="btn btn-primary btn-block btn-load">Save</button>
							</div>
		          	  	</div> --}}

	                </div>
	              </div>

	              

	              <br/><br/><br/>
	             </form>
	        	</div>



              </div>
            </div>
           </section>

@endsection

@section('scripts')
<script type="text/javascript">

</script>
@endsection
