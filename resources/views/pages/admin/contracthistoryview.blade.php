@extends('layouts.basepagemod')

@section('content')
          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              @permission(['contract-view-all','contract-view-history'],true)
              <li class="breadcrumb-item"><a href="/s/contracts" class="btn-load">Dealer Contracts</a></li>
              <li class="breadcrumb-item"><a href="/admin/viewcontracts/{{auth()->user()->GetDealerInfoIfAdmin()->party_id}}" class="btn-load">Contracts</a></li>
              <li class="breadcrumb-item"><a href="/contractedit/{{session()->get('c_id')}}" class="btn-load">Contract Details</a></li>
              <li class="breadcrumb-item"><a href="/admin/viewconhistory/{{$data->contract_id}}" class="btn-load">Contract History</a></li>
              <li class="breadcrumb-item active">Contract History View</li>              
              @endpermission
              
              @role('dealer')
              <li class="breadcrumb-item"><a href="/admin/viewcontracts/{{auth()->user()->GetDealerInfoIfAdmin()->party_id}}" class="btn-load">Contracts</a></li>
              <li class="breadcrumb-item"><a href="/contractedit/{{session()->get('c_id')}}" class="btn-load">Contract Details</a></li>
              <li class="breadcrumb-item"><a href="/admin/viewconhistory/{{$data->contract_id}}" class="btn-load">Contract History</a></li>
              <li class="breadcrumb-item active">Contract History View</li>   
              @endrole

            </ul>
          </div>

          <section class="forms custom-bg"> 
            <div class="container-fluid">

	          <!-- Page Header-->
	          <header> 
	            <h1 class="h3 display">
	            Contract History View
	            @permission('contract-view-all')
	            <small><span class="badge badge-pill badge-dark">{{auth()->user()->GetDealerInfoIfAdmin()->dealer_name}}</span></small>
	            @endpermission

	        	</h1> 
	        	
	          </header>

              <div class="row">
              	

				<div class="col-lg-12">


				 <!-- Contract Details -->
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4"></h3>
                    </div>
                    <div class="card-body">
                    	<div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Contract ID </label>
	                      <div class="col-sm-9">
	                       <p>{{$data->contract_id}}</p>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Product Type</label>
	                      <div class="col-sm-9">
	                        <p>{{$data->GetProductType($data->product_type)}}</p>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Retail Type</label>
	                      <div class="col-sm-9">
	                        <p>{{$data->GetRetailType($data->retail_type)}}</p>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Fleet Acount</label>
	                      <div class="col-sm-9">
	                        <input id="isFleetAccount" name="isFleetAccount" type="checkbox" class="form-control-custom" disabled {{ $data->is_fleet == 1 ? 'checked' : '' }} >
	                        <label for="isFleetAccount" class="checkbox-custom-label"> &nbsp;&nbsp;</label>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">First Due Date </label>
	                      <div class="col-sm-9">
                            <p>{{ Carbon\Carbon::parse($data->firstduedate)->format('m/d/Y') }}</p>

	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Date Accepted </label>
	                      <div class="col-sm-9">
                             <p>{{ Carbon\Carbon::parse($data->dateaccepted)->format('m/d/Y') }}</p>
	                      </div>
	                    </div>	                    

	                </div>
	              </div>

                <!-- Client Details -->
              	<div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Client </h3>
                    </div>
                    <div class="card-body">
	                    
	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Party Type</label>
	                      <div class="col-sm-9">
	                        <p>{{$data->GetPartyType($data->party_type)}}</p>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Name </label>
	                      <div class="col-sm-9">
	                        <p>{{$data->client_name}}</p>
	                      </div>
	                    </div>

	                    <div class="form-group row" id="clientMaritalStatusContainer">
	                      <label class="col-sm-3 form-control-label">Marital Status </label>
	                      <div class="col-sm-9">
	                        <p>{{ $data->client_marital }}</p>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Government ID </label>
	                      <div class="col-sm-9">
	                        <p>{{$data->client_govid}}</p>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Date Issued</label>
	                      <div class="col-sm-9">
                            <p>{{ Carbon\Carbon::parse($data->client_dateissued)->format('m/d/Y') }}</p>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">TIN </label>
	                      <div class="col-sm-9">
	                        <p>{{$data->client_tin}}</p>
	                      </div>
	                    </div>

	                    <div class="form-group row" id="clientNationalityContainer">
	                      <label class="col-sm-3 form-control-label">Nationality <span class="badge"><i></i></span></label>
	                      <div class="col-sm-9">
	                        <p>{{$data->client_nationality}}</p>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Address <span class="badge"><i></i></span></label>
	                      <div class="col-sm-9">
	                        <p>{{$data->client_address}}</p>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">City Municipality</label>
	                      <div class="col-sm-9">
	                        <p>{{$data->GetCityMunicipality($data->client_city_mun)->name}}</p>
	                      </div>
	                    </div>

	                </div>
	              </div>


  				 <!-- Co-maker Details -->
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Co-Maker </h3>
                    </div>
                    <div class="card-body">

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Name</label>
	                      <div class="col-sm-9">
	                      	@if($data->comaker_name!=null)
	                        <p>{{$data->comaker_name}}</p>
	                        @else
	                        <p>...</p>
	                        @endif
	                      </div>
	                    </div>

  				  <div class="form-group row" id="comakerMaritalStatusContainer">
	                      <label class="col-sm-3 form-control-label">Marital Status</label>
	                      <div class="col-sm-9">
	                      	@if($data->comaker_marital!=null)
	                        <p>{{ $data->comaker_marital }}</p>
	                        @else
	                        <p>...</p>
	                        @endif
	                      </div>
	                    </div>
	                    

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Government ID</label>
	                      <div class="col-sm-9">
	                      	@if($data->comaker_govid!=null)
	                        <p>{{$data->comaker_govid}}</p>
	                        @else
	                        <p>...</p>
	                        @endif
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Date Issued</label>
	                      <div class="col-sm-9">
                            <p>{{ Carbon\Carbon::parse($data->comaker_dateissued)->format('m/d/Y') }}</p>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">TIN</label>
	                      <div class="col-sm-9">
	                      	@if($data->comaker_tin!=null)
	                        <p>{{$data->comaker_tin}}</p>
	                        @else
	                        <p>...</p>
	                        @endif
	                      </div>
	                    </div>

	                </div>
	              </div>

	              <!-- Witness Details-->
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Witness </h3>
                    </div>
                    <div class="card-body">
                		<div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Witness #1 Name <span class="badge"><i></i></span></label>
	                      <div class="col-sm-9">
	                        <p>{{$data->witness1_name}}</p>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Witness #1 TIN <span class="badge"><i></i></span></label>
	                      <div class="col-sm-9">
	                        <p>{{$data->witness1_tin}}</p>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Witness #2 Name <span class="badge"><i></i></span></label>
	                      <div class="col-sm-9">
	                        <p>{{$data->witness2_name}}</p>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Witness #2 TIN <span class="badge"><i></i></span></label>
	                      <div class="col-sm-9">
	                        <p>{{$data->witness2_tin}}</p>
	                      </div>
	                    </div>

	                </div>
	              </div>

	              <!-- Dealer Details -->
	              <div id="dealerSigDetails" class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Dealer </h3> &nbsp;&nbsp;&nbsp; <small> Visible only if 3 Party. </small>
                    </div>
                    <div class="card-body">

                     	<div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Name <span class="badge"><i></i></span></label>
	                      <div class="col-sm-9">
	                        <p>{{$data->dealer_signatory}}</p>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">TIN <span class="badge"><i></i></span></label>
	                      <div class="col-sm-9">
	                        <p>{{$data->dealer_signatory_tin}}</p>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Government ID <span class="badge"><i></i></span></label>
	                      <div class="col-sm-9">
	                        <p>{{$data->dealer_signatory_govid}}</p>
	                      </div>
	                    </div>

	                </div>
	              </div>

	              <!-- Vehicle Details -->
	              <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Vehicle </h3> 
                    </div>
                    <div class="card-body">

                		<div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Vehicle Series <span class="badge"><i></i></span></label>
	                      <div class="col-sm-9">
	                        <p>{{$data->GetVehicleName($data->vehicle_name)}}</p>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Color <span class="badge"><i></i></span></label>
	                      <div class="col-sm-9">
	                        <p>{{$data->vehicle_color}}</p>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Engine No. <span class="badge"><i></i></span></label>
	                      <div class="col-sm-9">
	                        <p>{{$data->vehicle_engine}}</p>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Chasis No. <span class="badge"><i></i></span></label>
	                      <div class="col-sm-9">
	                        <p>{{$data->vehicle_chasis}}</p>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Vehicle Make <span class="badge"><i></i></span></label>
	                      <div class="col-sm-9">
	                        <p>{{$data->vehicle_make}}</p>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Year Model <span class="badge"><i></i></span></label>
	                      <div class="col-sm-9">
	                        <p>{{$data->vehicle_yearmodel}}</p>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Conduction Sticker</label>
	                      <div class="col-sm-9">
	                      	@if($data->vehicle_consticker!=null && $data->vehicle_consticker!=" ")
	                        <p>{{$data->vehicle_consticker}}</p>
	                        @else
	                        <p>...</p>
	                         @endif
	                      </div>
	                    </div>

	                    <div id="vehicleUsageContainer" class="form-group row">
	                      <label class="col-sm-3 form-control-label">Vehicle Usage <span class="badge"><i></i></span></label>
	                      <div class="col-sm-9">
	                      	@if($data->GetVehicleUsage($data->vehicle_usage) != null)
	                        <p> {{ $data->GetVehicleUsage($data->vehicle_usage) }}</p>
	                        @else 
	                        <p>...</p>
	                        @endif
	                      </div>
	                    </div>

	                </div>
	              </div>

	              <!-- Insurance Details-->
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Insurance </h3>
                    </div>
                    <div class="card-body">
                		<div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Insurer <span class="badge"><i></i></span></label>
	                      <div class="col-sm-9">
	                        <p>{{$data->insurer}}</p>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Insurance Period <span class="badge"><i></i></span></label>
	                      <div class="col-sm-9">
	                        <p> {{ $data->insurance_period }}</p>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Effective Date <span class="badge"><i></i></span></label>
	                      <div class="col-sm-9">
                            <p>{{ Carbon\Carbon::parse($data->insurance_effective_date)->format('m/d/Y') }}</p>

                           </div>
                        </div>

                        <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Expiry Date <span class="badge"><i></i></span></label>
	                      <div class="col-sm-9">
                            <p>{{ Carbon\Carbon::parse($data->insurance_expiry_date)->format('m/d/Y') }}</p>

                          </div>
                        </div>

		                 <div class="form-group row">
		                      <label class="col-sm-3 form-control-label">Liability <span class="badge"><i></i></span></label>
		                      <div class="col-sm-9">
		                        <p>{{$data->insurance_liability}}</p>
		                      </div>
		                  </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Comments <span class="badge"><i></i></span></label>
	                      <div class="col-sm-9">
	                        <p>{{$data->insurance_comments}}</p>
	                      </div>
	                    </div>

	                </div>
	              </div>

	              <!-- Finance Details -->
	              <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Finance </h3> 
                    </div>
                    <div class="card-body">

                    	<div class="row">

                    	<div class="col-sm-4">


		                    <div class="form-group row">
		                      <label class="col-sm-5 form-control-label">Unit Cost <span class="badge"><i></i></span></label>
		                      <div class="col-sm-7">
		                        <p>{{$data->unit_cost}}</p>
		                      </div>
		                    </div>

		                    <div class="form-group row">
		                      <label class="col-sm-5 form-control-label">Downpayment <span class="badge"><i></i></span></label>
		                      <div class="col-sm-7">
		                        <p>{{$data->downpayment}}</p>
		                      </div>
		                    </div>

		                    <div class="line-custom"> </div>
		                    <div class="form-group row">
		                      <label class="col-sm-5 form-control-label">Amount Finance</label>
		                      <div class="col-sm-7">
		                        <p>{{$data->amount_finance}}</p>
		                      </div>
		                    </div>

		                    <div class="form-group row">
		                      <label class="col-sm-5 form-control-label">Monthly Installments</label>
		                      <div class="col-sm-7">
		                        <p>{{$data->monthly_installment}}</p>
		                      </div>
		                    </div>


                    	</div>

                    	<div class="col-sm-4">

                    		<div class="form-group row">
		                      <label class="col-sm-5 form-control-label">Term <span class="badge"><i></i></span></label>
		                      <div class="col-sm-7">
		                       <p>{{$data->term}}</p>
		                      </div>
		                    </div>

		                    <div class="form-group row">
		                      <label class="col-sm-5 form-control-label">Add On Rate % <span class="badge"><i></i></span></label>
		                      <div class="col-sm-7">
		                        <p>{{$data->add_on_rate}}</p>
		                      </div>
		                    </div>

		                    <div class="form-group row">
		                     <div class="col-sm-9">
                              <input id="isOMA" name="isOMA" type="checkbox" class="form-control-custom" disabled {{ $data->is_onemonthadvance == 1 ? 'checked' : '' }} >
                              <label for="isOMA" class="checkbox-custom-label"> &nbsp;&nbsp;One Month Advance</label>
                             </div>
		                    </div>

		                    <div class="form-group row">
		                     <div class="col-sm-9">
                              <input id="isCICharge" type="checkbox" value="" class="form-control-custom" disabled {{ $data->is_cicharge == 1 ? 'checked' : '' }} >
                              <label for="isCICharge" class="checkbox-custom-label"> &nbsp;&nbsp;CI Charge</label>
                             </div>
		                    </div>

		                    <hr>

		                    <div class="form-group row">
		                     <div class="col-sm-9">
                              <input id="isOOT" name="isOOT" type="checkbox" class="form-control-custom" disabled {{ $data->is_outoftown == 1 ? 'checked' : '' }}>
                              <label for="isOOT" class="checkbox-custom-label">  &nbsp;&nbsp;Out of Town Charge</label>
                             </div>
		                    </div>

		                    <div class="form-group row">
		                      <label class="col-sm-5 form-control-label">Province</label>
		                      <div class="col-sm-7">
		                      	@if($data->province!=null)
		                        <p> {{$data->province}}</p>
		                        @else
	                        	<p>...</p>
	                        	@endif
		                      </div>
		                    </div>
		                    		                   
		                    <div class="form-group row">
		                      <label class="col-sm-5 form-control-label">Amount</label>
		                      <div class="col-sm-7">
		                        <input id="ootTotalAmount" name="ootTotalAmount" type="number" value="00.00" readonly class="form-control">
		                      </div>
		                    </div>
		                    
                    	</div>
                    	
                    	<div class="col-sm-4">

                    		<div class="form-group row">
		                      <label class="col-sm-5 form-control-label">DST</label>
		                      <div class="col-sm-7">
		                        <p>{{$data->dst}}</p>
		                      </div>
		                    </div>
	
		                      {{--<label class="col-sm-5 form-control-label">Processing Fee / Chatterl Mortgage</label>
		                      <div class="col-sm-7">
		                        <input id="processingFee" name="processingFee" type="text" value="" readonly class="form-control ro-fin-number">
		                      </div>
		                      --}}

		                    <div class="form-group row">
		                      <label class="col-sm-5 form-control-label">Other Charges</label>
		                      <div class="col-sm-7">
		                      	@if($data->other_charges!=0.00)
		                        <p>{{$data->other_charges}}</p>
		                        @else
	                        	<p>0.00</p>
	                        	@endif	
		                      </div>
		                    </div>

		                    
		                    <div class="form-group row">
		                      <label class="col-sm-5 form-control-label">Total Fees</label>
		                      <div class="col-sm-7">
		                        <input id="totalFees" name="totalFees" type="number" value="00.00" readonly class="form-control">
		                      </div>
		                    </div>


                    	</div>

		                </div>


	                </div>
	              </div>


	        	</div>



              </div>
            </div>
           </section>

@endsection

@section('scripts')

<script src="/js/custom-contract.js"></script>
<script type="text/javascript">

    $(document).ready(function() {

    	// $('#vehicleName').select2(); 
    	// $('#ootProvince').select2(); 
     //    $('#cityMunicipality').select2(); 
     //    OnLoadEdit();   
    });    

</script>

@endsection
