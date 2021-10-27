@extends('layouts.basepagemod')

@section('content')

          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              @if(auth()->user()->whatRole()->name == 'dealer')
              <li class="breadcrumb-item"><a href="/s/contracts" class="btn-load">Contracts</a></li>
              <li class="breadcrumb-item active">Contract Details</li>
              @else

              @permission('contract-view-all')
              <li class="breadcrumb-item"><a href="/s/contracts" class="btn-load">Dealer Contracts</a></li>
              <li class="breadcrumb-item"><a href="/admin/viewcontracts/{{auth()->user()->GetDealerInfoIfAdmin()->party_id}}" class="btn-load">Contracts</a></li>
              <li class="breadcrumb-item active">Contract Details</li>              
              @endpermission
              @endif

            </ul>
          </div>

          <section class="forms custom-bg"> 
            <div class="container-fluid">

	          <!-- Page Header-->
	          <header> 
	            <h1 class="h3 display">
	            Contract Details
	            @role('admin')
	            <small><span class="badge badge-pill badge-dark">{{auth()->user()->GetDealerInfoIfAdmin()->dealer_name}}</span></small>
	            @endrole
	        	</h1> 

	            <small>Field with <span class="required-icon">*</span> is required</small>
	          </header>

              <div class="row">
              	

				<div class="col-lg-12">
				 <form class="form-horizontal" method="POST" action="/contractsave">
				 	{{ csrf_field() }}

			 	<input type="hidden" id="isMetro" value="{{ auth()->user()::IsMetro() }}">

				 <!-- Contract Details -->
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4"></h3>
                    </div>
                    <div class="card-body">
                    	<div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Contract ID <span class="badge"><i class="fas fa-asterisk required-icon"></i></span></label>
	                      <div class="col-sm-9">
	                        <input type="number" id="contractId" name="contractId" placeholder="##########" class="form-control" maxlength="9"  required>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Product Type</label>
	                      <div class="col-sm-9">
	                        <select id="productType" name="productType" class="form-control">
	                          @foreach($data['producttype'] as $d)
	                          	<option value="{{$d->field_id}}">{{$d->field_name}}</option>
	                          @endforeach
	                        </select>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Retail Type</label>
	                      <div class="col-sm-9">
	                        <select id="retailType" name="retailType" class="form-control">
	                          @foreach($data['retailtype'] as $d)
	                          	<option value="{{$d->field_id}}">{{$d->field_name}}</option>
	                          @endforeach
	                        </select>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Fleet Acount</label>
	                      <div class="col-sm-9">
	                        <input id="isFleetAccount" name="isFleetAccount" type="checkbox" class="form-control-custom">
                              <label for="isFleetAccount" class="checkbox-custom-label"> &nbsp;&nbsp;</label>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">First Due Date <span class="badge"><i class="fas fa-asterisk required-icon"></i></span></label>
	                      <div class="col-sm-9">
                            <input id="firstDateDue" name="firstDateDue" class="form-control" width="276" required value="{{ Carbon\Carbon::now()->format('m/d/Y') }}" class="form-control" />
                             {{-- <input id="timepicker" value="{{ Carbon\Carbon::now('Asia/Manila')->format('h:i:s') }}" width="276" /> --}}
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Date Accepted <span class="badge"><i class="fas fa-asterisk required-icon"></i></span></label>
	                      <div class="col-sm-9">
                            <input id="dateAccepted" name="dateAccepted" class="form-control" width="276" required value="{{ Carbon\Carbon::now()->format('m/d/Y') }}" />
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
	                        <select id="partyType" name="partyType" class="form-control">
	                          @foreach($data['partytype'] as $d)
	                          	<option value="{{$d->field_id}}">{{$d->field_name}}</option>
	                          @endforeach
	                        </select>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Name <span class="badge"><i class="fas fa-asterisk required-icon"></i></span></label>
	                      <div class="col-sm-9">
	                        <input type="text" id="clientName" name="clientName" placeholder="Name" class="form-control contractTI" value="{{ old('clientName') }}" required>
	                      </div>
	                    </div>

	                    <div class="form-group row" id="clientMaritalStatusContainer">
	                      <label class="col-sm-3 form-control-label">Marital Status <span class="badge"><i class="fas fa-asterisk required-icon"></i></span></label>
	                      <div class="col-sm-9">
	                        <select id="clientMaritalStatus" name="clientMaritalStatus" class="form-control" required>
                        	  <option value="">...</option>
	                          <option value="Single">Single</option>
	                          <option value="Married">Married</option>
	                          <option value="Separated">Separated</option>
	                          <option value="Widowed">Widowed</option>
	                          <option value="None">None</option>
	                        </select>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Government ID <span id="clientGovtIdIconLabel" class="badge"><i class="fas fa-asterisk required-icon"></i></span></label>
	                      <div class="col-sm-9">
	                        <input id="clientGovtId" name="clientGovtId" type="text" placeholder="##-#######-#" class="form-control contractTI" required>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Date Issued</label>
	                      <div class="col-sm-9">
                            <input id="dateIssued" name="dateIssued" class="form-control" width="276" value="{{ Carbon\Carbon::now()->format('m/d/Y') }}" />
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">TIN <span class="badge"><i class="fas fa-asterisk required-icon"></i></span></label>
	                      <div class="col-sm-9">
	                        <input type="text" id="clientTin" name="clientTin" placeholder="###-###-###" class="form-control contractTI" required>
	                      </div>
	                    </div>

	                    <div class="form-group row" id="clientNationalityContainer">
	                      <label class="col-sm-3 form-control-label">Nationality <span class="badge"><i class="fas fa-asterisk required-icon"></i></span></label>
	                      <div class="col-sm-9">
	                        <input type="text" id="clientNationality" name="clientNationality" placeholder="Nationality" value="FILIPINO" class="form-control contractTI" required>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Address <span class="badge"><i class="fas fa-asterisk required-icon"></i></span></label>
	                      <div class="col-sm-9">
	                        <textarea id="clientAddress" name="clientAddress" class="form-control contractTI"></textarea required>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">City Municipality</label>
	                      <div class="col-sm-9">
	                        <select id="cityMunicipality" name="cityMunicipality" class="form-control" id="cityMunList">
	                          <option value="">...</option>
	                          @foreach($data['cm'] as $cm)
	                          <option value="{{$cm->id}}:{{$cm->name}}" data-info="{{$cm->name}}">{{ $cm->name }}</option>
	                          @endforeach
	                        </select>
	                      </div>
	                    </div>

	                    <div class="form-group row" id="clientCityMunOthers">
	                      <label class="col-sm-3 form-control-label">&nbsp;</label>
	                      <div class="col-sm-9">
	                        <input type="text" id="cityMunicipalityOthers" name="cityMunicipalityOthers" placeholder="Other City Municipality" class="form-control contractTI">
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
	                        <input id="comakerName" name="comakerName" type="text" placeholder="Name" class="form-control contractTI">
	                      </div>
	                    </div>

	                    <div class="form-group row" id="comakerMaritalStatusContainer">
	                      <label class="col-sm-3 form-control-label">Marital Status</label>
	                      <div class="col-sm-9">
	                        <select id="comakerMaritalStatus" name="comakerMaritalStatus" class="form-control">
	                          <option value="">...</option>
	                          <option value="Single">Single</option>
	                          <option value="Married">Married</option>
	                          <option value="Separated">Separated</option>
	                          <option value="Widowed">Widowed</option>
	                          <option value="None">None</option>
	                        </select>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Government ID</label>
	                      <div class="col-sm-9">
	                        <input id="comakerGovtId" name="comakerGovtId" type="text" placeholder="##-#######-#" class="form-control contractTI">
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Date Issued</label>
	                      <div class="col-sm-9">
                            <input id="dateIssuedCoMaker" class="form-control" width="276" value="{{ Carbon\Carbon::now()->format('m/d/Y') }}" />
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">TIN</label>
	                      <div class="col-sm-9">
	                        <input id="comakerTin" name="comakerTin" type="text" placeholder="###-###-###" class="form-control contractTI">
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
	                      <label class="col-sm-3 form-control-label">Witness #1 Name <span class="badge"><i class="fas fa-asterisk required-icon"></i></span></label>
	                      <div class="col-sm-9">
	                        <input id="witness1Name" name="witness1Name" type="text" placeholder="Name" class="form-control contractTI" required>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Witness #1 TIN <span class="badge"><i class="fas fa-asterisk required-icon"></i></span></label>
	                      <div class="col-sm-9">
	                        <input id="witness1Tin" name="witness1Tin" type="text" placeholder="###-###-###" class="form-control contractTI" required>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Witness #2 Name <span class="badge"><i class="fas fa-asterisk required-icon"></i></span></label>
	                      <div class="col-sm-9">
	                        <input id="witness2Name" name="witness2Name" type="text" placeholder="Name" class="form-control contractTI" required>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Witness #2 TIN <span class="badge"><i class="fas fa-asterisk required-icon"></i></span></label>
	                      <div class="col-sm-9">
	                        <input id="witness2Tin" name="witness2Tin" type="text" placeholder="###-###-###" class="form-control contractTI" required>
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
	                      <label class="col-sm-3 form-control-label">Local Signatories</label>
	                      <div class="col-sm-9">
	                        <select id="clientSigName" name="clientSigName" class="form-control">
	                          <option value="-1">...</option>
	                          @if($data['sigs']!=null)
	                          @foreach($data['sigs'] as $sig)

	                          @if($sig['name'] != null)
	                          <option value="{{ $sig['id'] }}">{{ $sig['name'] }}</option>
	                          @endif

	                          @endforeach
	                          @endif
	                        </select>
	                      </div>
	                    </div>

                     	<div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Name <span class="badge"><i class="fas fa-asterisk required-icon"></i></span></label>
	                      <div class="col-sm-9">
	                        <input id="clientSigName2" name="clientSigName2" type="text" placeholder="Name" class="form-control contractTI" required>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">TIN <span class="badge"><i class="fas fa-asterisk required-icon"></i></span></label>
	                      <div class="col-sm-9">
	                        <input id="clientSigTin" name="clientSigTin" type="text" placeholder="###-###-###" class="form-control contractTI" required>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Government ID <span class="badge"><i class="fas fa-asterisk required-icon"></i></span></label>
	                      <div class="col-sm-9">
	                        <input id="clientSigGovId" name="clientSigGovId" type="text" placeholder="###-###-###" class="form-control contractTI" required>
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
	                      <label class="col-sm-3 form-control-label">Vehicle Series <span class="badge"><i class="fas fa-asterisk required-icon"></i></span></label>
	                      <div class="col-sm-9">
	                        <select id="vehicleName" name="vehicleName" class="form-control contractTI" required>
	                          <option value="">...</option>
	                          @foreach($data['vehicle'] as $vehicle)
	                          <option value="{{$vehicle->id}}">{{$vehicle->name}}</option>
	                          @endforeach
	                        </select>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Color <span class="badge"><i class="fas fa-asterisk required-icon"></i></span></label>
	                      <div class="col-sm-9">
	                        <input id="vehicleColor" name="vehicleColor" type="text" placeholder="Color" class="form-control contractTI" required>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Engine No. <span class="badge"><i class="fas fa-asterisk required-icon"></i></span></label>
	                      <div class="col-sm-9">
	                        <input id="vehicleEngineNo" name="vehicleEngineNo" type="text" placeholder="Engine No." class="form-control contractTI" required>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Chasis No. <span class="badge"><i class="fas fa-asterisk required-icon"></i></span></label>
	                      <div class="col-sm-9">
	                        <input id="vehicleChasisNo" name="vehicleChasisNo" type="text" placeholder="Chasis No." class="form-control contractTI" required>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Vehicle Make <span class="badge"><i class="fas fa-asterisk required-icon"></i></span></label>
	                      <div class="col-sm-9">
	                        <input id="vehicleMake" name="vehicleMake" type="text" placeholder="Vehicle Make" class="form-control contractTI" required>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Year Model <span class="badge"><i class="fas fa-asterisk required-icon"></i></span></label>
	                      <div class="col-sm-9">
	                        <input id="vehicleYearModel" name="vehicleYearModel" type="number" placeholder="Year Model" class="form-control" required>
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Coduction Sticker</label>
	                      <div class="col-sm-9">
	                        <input id="vehicleConSticker" name="vehicleConSticker" type="text" placeholder="Conduction Sticker" class="form-control contractTI">
	                      </div>
	                    </div>

	                    <div id="vehicleUsageContainer" class="form-group row">
	                      <label class="col-sm-3 form-control-label">Vehicle Usage <span class="badge"><i class="fas fa-asterisk required-icon"></i></span></label>
	                      <div class="col-sm-9">
	                        <select id="vehicleUsage" name="vehicleUsage" class="form-control" required>
	                          <option value="">...</option>
	                          @foreach($data['vehicleusage'] as $d)
	                          	<option value="{{$d->field_id}}">{{$d->field_name}}</option>
	                          @endforeach
	                        </select>
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
	                      <label class="col-sm-3 form-control-label">Insurer </label>
	                      <div class="col-sm-9">
	                        <input id="insurer" name="insurer" type="text" placeholder="Insurer" class="form-control contractTI" >
	                      </div>
	                    </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Insurance Period </label>
	                      <div class="col-sm-9">
	                        <select id="insurance_period" name="insurance_period" class="form-control" >
	                          <option value="Specified Period" data-info="0">Specified Period</option>
	                          <option value="Perpetual" data-info="1">Perpetual</option>
	                        </select>
	                      </div>
	                    </div>

	                    <div id="specificPeriodContainer">
	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Effective Date </label>
	                      <div class="col-sm-9">
                            <input id="insurance_effective_date_SP" name="insurance_effective_date_SP" value="{{ Carbon\Carbon::now()->format('m/d/Y') }}" class="form-control" class="form-control" width="276"  />

                           </div>
                        </div>

                        <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Expiry Date </label>
	                      <div class="col-sm-9">
                            <input id="insurance_expiry_date_SP" name="insurance_expiry_date_SP" value="{{ Carbon\Carbon::now()->format('m/d/Y') }}" class="form-control" class="form-control" width="276" />

                          </div>
                        </div>
                     	</div>

                     	<div id="perpetualContainer">
	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Effective Date </label>
	                      <div class="col-sm-9">
                            <input id="insurance_effective_date_P" name="insurance_effective_date_P" value="{{ Carbon\Carbon::parse($data['assetOrgPurchDate'])->format('m/d/Y') }}" class="form-control" width="276" readonly />

                           </div>
                        </div>

                        <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Expiry Date </label>
	                      <div class="col-sm-9">
                            <p> None </p>

                          </div>
                        </div>
                     	</div>

		                 <div class="form-group row">
		                      <label class="col-sm-3 form-control-label">Liability </label>
		                      <div class="col-sm-9">
		                        <input id="insurance_liability" name="insurance_liability" type="number" placeholder="0.00" class="form-control fin-number fin-comp" >
		                      </div>
		                  </div>

	                    <div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Insurance Premium </label>
	                      <div class="col-sm-9">
	                        <input id="insurance_comments" name="insurance_comments" type="text" placeholder="Comments" class="form-control contractTI" >
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

                    	   <div id="balloonAmountContainer">
		                   <div class="form-group row">
		                      <label class="col-sm-5 form-control-label">Balloon Amount</label>
		                      <div class="col-sm-7">
		                        <input id="balloonAmount" name="balloonAmount" type="number" value="0.00" disabled class="form-control">
		                      </div>
		                    </div>

		                    <hr>
		                    </div>

		                    <div class="form-group row">
		                      <label class="col-sm-5 form-control-label">Unit Cost <span class="badge"><i class="fas fa-asterisk required-icon"></i></span></label>
		                      <div class="col-sm-7">
		                        <input id="unitCost" name="unitCost" type="number" placeholder="0.00" class="form-control fin-number fin-comp" required>
		                      </div>
		                    </div>
		                    <div class="form-group row">
		                      <label class="col-sm-5 form-control-label">Downpayment <span class="badge"><i class="fas fa-asterisk required-icon"></i></span></label>
		                      <div class="col-sm-7">
		                        <input id="downPayment" name="downPayment" type="number" placeholder="0.00" class="form-control fin-number fin-comp" required>
		                      </div>
		                    </div>

		                    <div class="line-custom"> </div>
		                    <div class="form-group row">
		                      <label class="col-sm-5 form-control-label">Amount Finance</label>
		                      <div class="col-sm-7">
		                        <input id="amountFinance" name="amountFinance" type="text" value="0.00" readonly class="form-control">
		                      </div>
		                    </div>

		                    <div class="form-group row">
		                      <label class="col-sm-5 form-control-label">Monthly Installments</label>
		                      <div class="col-sm-7">
		                        <input id="monthlyInstallement" name="monthlyInstallement" type="number" value="0.00" readonly class="form-control">
		                      </div>
		                    </div>


                    	</div>

                    	<div class="col-sm-4">

                    		<div class="form-group row">
		                      <label class="col-sm-5 form-control-label">Term <span class="badge"><i class="fas fa-asterisk required-icon"></i></span></label>
		                      <div class="col-sm-7">
		                        <input id="term" name="term" type="number" placeholder="0" class="form-control fin-comp" required>
		                      </div>
		                    </div>

		                    <div class="form-group row">
		                      <label class="col-sm-5 form-control-label">Add On Rate % <span class="badge"><i class="fas fa-asterisk required-icon"></i></span></label>
		                      <div class="col-sm-7">
		                        <input id="addOnRate" name="addOnRate" type="text" placeholder="0.0000" class="form-control fin-comp" required>
		                      </div>
		                    </div>

		                    <div class="form-group row">
		                     <div class="col-sm-9">
                              <input id="isOMA" name="isOMA" type="checkbox" class="form-control-custom">
                              <label for="isOMA" class="checkbox-custom-label"> &nbsp;&nbsp;One Month Advance</label>
                             </div>
		                    </div>

		                    <div class="form-group row">
		                     <div class="col-sm-9">
                              <input id="isCICharge" type="checkbox" value="" class="form-control-custom">
                              <label for="isCICharge" class="checkbox-custom-label"> &nbsp;&nbsp;CI Charge</label>
                             </div>
                              <input id="ciCharge" type="hidden" value="{{$data['defamount']['cicharge']}}">
		                    </div>

		                    <hr>

		                    <div class="form-group row">
		                     <div class="col-sm-9">
                              <input id="isOOT" name="isOOT" type="checkbox" class="form-control-custom">
                              <label for="isOOT" class="checkbox-custom-label">  &nbsp;&nbsp;Out of Town Charge</label>
                             </div>
		                    </div>

		                    <div class="form-group row">
		                      <label class="col-sm-5 form-control-label">Province</label>
		                      <div class="col-sm-7">
		                        <select id="ootProvince" name="ootProvince" class="form-control">
		                          <option value="0" data-info="0">...</option>
		                          @foreach($data['oot'] as $oot)
		                          <option value="{{$oot->id}}" data-info="{{$oot->total}}">{{$oot->province}}</option>
		                          @endforeach
		                        </select>
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
		                      <label class="col-sm-5 form-control-label">Retail Type</label>
		                      <div class="col-sm-7" id="retailTypeLabel">
		                        <p>...</p>
		                      </div>
		                    </div>

                    		<div class="form-group row">
		                      <label class="col-sm-5 form-control-label">DST</label>
		                      <div class="col-sm-7">
		                        <input id="dst" name="dst" type="number" value="0.00" readonly class="form-control">
		                      </div>
		                      <input id="dstDivisor" type="hidden" value="{{$data['defamount']['div']}}">
		                      <input id="dstMultiplier" type="hidden" value="{{$data['defamount']['multi']}}">
		                    </div>

		                    <div class="form-group row" id="processingFeeContainer">
		                      <label class="col-sm-5 form-control-label">Processing Fee</label>
		                      <div class="col-sm-7">
		                        <input id="processingFee" name="processingFee" type="text" value="{{ $data['defamount']['pf'] }}" readonly class="form-control ro-fin-number">
		                      </div>
		                    </div>

		                    <div class="form-group row" id="chattelMortgageContainer">
		                      <label class="col-sm-5 form-control-label">Chattel Mortgage</label>
		                      <div class="col-sm-7">
		                        <input id="chattelMortgage" name="chattelMortgage" type="number" value="0.00" readonly class="form-control">
		                      </div>
		                    </div>

		                    <div class="form-group row">
		                      <label class="col-sm-5 form-control-label">Other Charges</label>
		                      <div class="col-sm-7">
		                        <input id="otherCharges" name="otherCharges" type="number" placeholder="0.00" class="form-control fin-number fin-comp">
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

	              <!-- Requirements Details-->
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Requirements </h3>
                    </div>
                    <div class="card-body">
                		<div class="form-group row">
	                      <label class="col-sm-3 form-control-label">Approval Conditions</label>
	                      <div class="col-sm-9">
	                        <textarea id="cusReqs" name="cusReqs" class="form-control"></textarea>
	                      </div>
	                    </div>

	                </div>
	              </div>

	          	  <div class="form-group row">
					<div class="col-sm-3">
					</div>

		              {{--<div class="col-sm-3">
		              	<a id="print" class="btn btn-danger btn-block btn-load" href="#"><i class="far fa-file-pdf"></i> Print Preview</a>
		              </div>--}}

		              @permission('contract-add')
		              <div class="col-sm-6">
		              	<button type="submit" class="btn btn-primary btn-block btn-load">Save</button>
		              </div>
		              @endpermission

	          	  </div>

	              <br/><br/><br/>
	             </form>
	        	</div>



              </div>
            </div>
           </section>

@endsection

@section('scripts')
<script src="/js/custom-contract.js"></script>
<script type="text/javascript">
	// $('.btn-load').on('click', function(event) {
	//   $(".se-pre-con-click").fadeIn("fast");
	// });

    $(document).ready(function() {
    	// $(".se-pre-con-click").fadeOut(0);

    	$('#vehicleName').select2(); 
    	$('#ootProvince').select2(); 
        $('#cityMunicipality').select2(); 
        OnLoad();   

    });    



</script>

@endsection
