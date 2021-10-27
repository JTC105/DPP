
	$('#reconDate').datepicker({
	uiLibrary: 'bootstrap4'
	});

	$('#creditAppDate').datepicker({
	uiLibrary: 'bootstrap4'
	});

	$('#creditAppValidity').datepicker({
	uiLibrary: 'bootstrap4'
	});

	$('#creditAppReconDate').datepicker({
	uiLibrary: 'bootstrap4'
	});

	$('#dateAccepted').datepicker({
		uiLibrary: 'bootstrap4'
	});

	 $('#firstDateDue').datepicker({
	uiLibrary: 'bootstrap4'
	});

	$('#insurance_effective_date').datepicker({
	uiLibrary: 'bootstrap4'
	});

	$('#insurance_expiry_date').datepicker({
	uiLibrary: 'bootstrap4'
	});

	$('#dateIssued').datepicker({
	    uiLibrary: 'bootstrap4'
	});

	$('#dateIssuedCoMaker').datepicker({
	    uiLibrary: 'bootstrap4'
	});

	$('#cfilterStartDate').datepicker({
		uiLibrary: 'bootstrap4'
	});

	$('#cfilterEndDate').datepicker({
		uiLibrary: 'bootstrap4'
	});

	$('#insurance_effective_date_SP').datepicker({
		uiLibrary: 'bootstrap4'
	});

	$('#insurance_expiry_date_SP').datepicker({
		uiLibrary: 'bootstrap4'
	});

	$('#insurance_effective_date_P').datepicker({
		uiLibrary: 'bootstrap4'
	});

	$('#timepicker').timepicker({
	            uiLibrary: 'bootstrap4'
	        });

	$('#productType').on('change', function() {
		CheckProductType();
	  	CheckIfRetail3Party();
		ComputeFinance();
	})

	$('#retailType').on('change', function() {
		CheckIfRetail3Party();
		SetRetailTypeInFinance($("#retailType option:selected").text());
		ComputeFinance();
	})

	$('#partyType').on('change', function() {
		CheckPartyType();
	})

	$('select[name="insurance_period"]').on('change', function() {
       CheckInsurancePeriod();
    });

	$('#isOOT[type=checkbox]').on('click', function(event) {
		// if ($(this).prop('checked')) {
		// 	// $('#ootProvince').removeAttr('disabled');
		// } else {
		// 	$('#ootProvince').val('1');
		// 	// $('#ootProvince').attr('disabled', 'disabled');
		// }
		CheckOutOfTownCharge();
	});

	$('#isCICharge[type=checkbox]').on('click', function(event) {
		ComputeFinance();
	});

	$('select[name="clientSigName"]').on('change', function() {
        var id = $(this).val();

        if(id) {
			SetSignatoriesContainer(id);
        }
    });

    $('select[name="ootProvince"]').on('change', function() {
        var val = $("#ootProvince option:selected").data('info'); 
        val = val + '.00';
        $('#ootTotalAmount').val(val);
        ComputeFinance();
    });

    function CheckInsurancePeriod() {
    	 var val = $("#insurance_period option:selected").data('info'); 

        if(val == 1)
        {
        	$('#specificPeriodContainer').hide();
        	$('#perpetualContainer').show();
        } else {

        	$('#specificPeriodContainer').show();
        	$('#perpetualContainer').hide();
        }

    }

	function CheckProductType() {

	  	if ($('#productType option:selected').text() == 'Lease') { //------------ LEASE

	  		$('#vehicleUsageContainer').hide();
	  		$('#vehicleUsage').removeAttr('required');
	  		$('#balloonAmountContainer').show(); // TODO: Still depends on Dealer
	  		$('#dateAccepted').removeAttr('disabled');
	  		$('#dateAccepted').attr('required', 'required');
	  		$('#isOOT').attr('disabled', 'disabled');

	  		$('#retailType').attr('readonly', 'readonly');
	  		$('#retailType').val('1');
	  		$('#retailType option:not(:selected)').prop('disabled', true);
	  		SetRetailTypeInFinance($("#retailType option:selected").text());

	  		$('#chattelMortgageContainer').hide();
	  		$('#processingFeeContainer').show();


	  	} else if ($('#productType option:selected').text() == 'Retail') { //------------ RETAIL

	  		$('#vehicleUsageContainer').show();	
	  		$('#vehicleUsage').attr('required', 'required');  		
	  		$('#balloonAmountContainer').hide(); // TODO: Still depends on Dealer
	  		$('#dateAccepted').attr('disabled', 'disabled');
	  		$('#dateAccepted').removeAttr('disabled');
	  		$('#isOOT').removeAttr('disabled');

	  		$('#retailType').removeAttr('readonly');
	  		$('#retailType option:not(:selected)').prop('disabled', false);

	  		$('#chattelMortgageContainer').show();
	  		$('#processingFeeContainer').hide();
	  	}	
	}

	function CheckPartyType() {
		if ($('#partyType option:selected').text() == 'Individual') { //------------ INDIVIDUAL

			$('#clientMaritalStatusContainer').show();
			$('#comakerMaritalStatusContainer').show();
			$('#clientNationalityContainer').show();
			$('#clientMaritalStatus').attr('required', 'required');
			$('#clientNationality').attr('required', 'required');
			$('#clientGovtId').attr('required', 'required');
			$('#clientGovtIdIconLabel').show();

			$('#isIndiContainer').show();
			$('#isCorpContainer').hide();			

		} else if ($('#partyType option:selected').text() == 'Corporation') { //------------ CORPORATION

			$('#clientMaritalStatusContainer').hide(); 
			$('#comakerMaritalStatusContainer').hide();
			$('#clientNationalityContainer').hide();
			$('#clientMaritalStatus').removeAttr('required');
			$('#clientNationality').removeAttr('required');
			$('#clientGovtId').removeAttr('required');
			$('#clientGovtIdIconLabel').hide();

			// $('#isIndiContainer').hide();
			$('#isCorpContainer').show();
		}
	}

	function CheckIfRetail3Party() {

		if($('#productType option:selected').text() == 'Retail' && $('#retailType option:selected').text() == '3 Party') {
			$('#dealerSigDetails').show();
			$('#clientSigName2').attr('required', 'required');
			$('#clientSigTin').attr('required', 'required');
			$('#clientSigGovId').attr('required', 'required');
		}
		else {
			$('#dealerSigDetails').hide();
			$('#clientSigName2').removeAttr('required');
			$('#clientSigTin').removeAttr('required');
			$('#clientSigGovId').removeAttr('required');
		}

	}

	function CheckOutOfTownCharge() {
		var ootChecked = $('#isOOT:checkbox:checked').length > 0;
		if(ootChecked) {
			$('#ootProvince').removeAttr('disabled');
		} else {
			$('#ootProvince').val('0').change();
			$('#ootProvince').attr('disabled', 'disabled');
		}
	}

	function SetRetailTypeInFinance(value) {
		var stringHTML = '<p>' + value + '</p>';
		$('#retailTypeLabel').html(stringHTML);
	}

	function OnLoad() {

		if($('#isMetro').val() == 0) {
			$('#isCICharge').attr('disabled', 'disabled');
		} else {
			$('#isCICharge').removeAttr('disabled');
		}

		CheckInsurancePeriod();
		CheckProductType();
		CheckPartyType();
	  	CheckIfRetail3Party();
	  	CheckOutOfTownCharge();
	  	CheckCityMunicipality();

	  	OnLoadROFinNumbers();
	}

	function OnLoadEdit() {
		OnLoad();

		// In edit
	  	OnLoadFinNumbers();
	}

	// TODO: For edit
	function OnLoadFinNumbers() {
		var elements = document.getElementsByClassName('fin-number');

		for(var i=0; i<elements.length; i++) {
		    var id = elements[i].id;
			var value = $('#'+id).val();
			value = value.split(',').join('');
			value = parseFloat(value).toFixed(2);

		     $('#'+id).val(replaceCommas(value));
		}

		ComputeFinance();
	}

	function OnLoadROFinNumbers() {
		var elements = document.getElementsByClassName('ro-fin-number');

		for(var i=0; i<elements.length; i++) {
		    var id = elements[i].id;
			var value = $('#'+id).val();
			value = value.split(',').join('');
			value = parseFloat(value).toFixed(2);

		     $('#'+id).val(replaceCommas(value));
		}
	}

	function ConvertToFloat(val) {
	  	var value = val;

	    if(value=="" || value==null)
	      value = 0;
	    else 
	      value = value.split(',').join('');

	  	value = parseFloat(value).toFixed(2);

	  	return value;
	}

	// $('input[type="number"]').keyup(function(e)
 //    {
 //    	if (/\D/g.test(this.value))
	//   {
	//   	alert("A");
	//     // Filter non-digits from input value.
	//     this.value = this.value.replace(/\D/g, '');
	//   }
	// });

	// FINANCIAL
	$('input.fin-number').keyup(function (event) {
	    // skip for arrow keys
	    if (event.which >= 37 && event.which <= 40) {
	        event.preventDefault();
	    }

	    var currentVal = $(this).val();
	    var testDecimal = testDecimals(currentVal);
	    if (testDecimal.length > 1) {
	        console.log("You cannot enter more than one decimal point");
	        currentVal = currentVal.slice(0, -1);
	    }
	    // alert(currentVal);
	    $(this).val(replaceCommas(currentVal));

	});

	function testDecimals(currentVal) {
	    var count;
	    currentVal.match(/\./g) === null ? count = 0 : count = currentVal.match(/\./g);
	    return count;
	}

	function replaceCommas(yourNumber) {
	    var components = yourNumber.toString().split(".");
	    if (components.length === 1) 
	        components[0] = yourNumber;
	    components[0] = components[0].replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	    if (components.length === 2)
	        components[1] = components[1].replace(/\D/g, "");
	    return components.join(".");
	}

	$('input.fin-number').focusout(function () {

	  	var id = $(this).attr('id');

		var value = $('#'+id).val();
		value = value.split(',').join('');
		value = parseFloat(value).toFixed(2);

	     $('#'+id).val(replaceCommas(value));
	     
	});

	$('input#addOnRate').focusout(function () {
		var val = $('#addOnRate').val();
		$('#addOnRate').val(parseFloat(val).toFixed(4));
	});

	$('input.fin-comp').focusout(function () {
		ComputeFinance(); // TODO: in edit
	});


	function ComputeFinance() {

		var af = ConvertToFloat($('#unitCost').val()) - ConvertToFloat($('#downPayment').val());
		af = parseFloat(af).toFixed(2);
		$('#amountFinance').val(replaceCommas(af));

		// ((Amount Finance – Balloon Amount) * ((Add On Rate% + 100)/100)) / Term
		var term = $('#term').val();
		if(term < 0 || term == "")
			term = 1;

		var aor = $('#addOnRate').val();
		if(aor == "")
			aor = 0;

		aor = parseFloat(aor);

		// MONTHLY INSTALLMENT
		// var mi = (af * ((aor+100)/100)) / term;
		var mi = (af*(1+(aor/100)))/term;
		mi = Math.ceil(mi);
		mi = parseFloat(mi).toFixed(2);		
		$('#monthlyInstallement').val(replaceCommas(mi));

		// DST
		var dst = (af / $('#dstDivisor').val()) * $('#dstMultiplier').val();
		var dstStr = dst+"";
		var dstArray = dstStr.split(".");

		if(dstArray[1]>0)
			dst = parseInt((dstArray[0])) + 1;
	
		dst = parseFloat(dst).toFixed(2);
		$('#dst').val(replaceCommas(dst));

		ComputeTotalFees();
	}

	function ComputeTotalFees() {
		var other = ConvertToFloat($('#otherCharges').val());
		var ciCharge = 0;

		var ciChecked = $('#isCICharge:checkbox:checked').length > 0;
		if(ciChecked) {
			ciCharge = ConvertToFloat($('#ciCharge').val());
		}

		if ($('#productType option:selected').text() == 'Lease') {
			ComputeTotalFeesLease(other, ciCharge);

		} else if ($('#productType option:selected').text() == 'Retail') {
			var oot = 0;
			var tempOot = $('#ootTotalAmount').val();

			if(tempOot > 0) {
				oot = tempOot;
				oot = ConvertToFloat(oot);
			}

			ComputeTotalFeesRetail(other, ciCharge, oot);
		}
	}

	function ComputeTotalFeesLease(other, ciCharge) {
		
		var pf = ConvertToFloat($('#processingFee').val());
		var dst = ConvertToFloat($('#dst').val());

		var tf = (parseFloat(pf) + parseFloat(dst)) + parseFloat(other) + parseFloat(ciCharge);
		tf = parseFloat(tf).toFixed(2);		
		$('#totalFees').val(replaceCommas(tf));
	}

	function ComputeTotalFeesRetail(other, ciCharge, oot) {
		var prodType = $('#productType option:selected').text();
		var retailType = $("#retailType option:selected").text();
		var af = ConvertToFloat($("#amountFinance").val());
		af = parseFloat(af).toFixed(2);
		var other = parseFloat(other).toFixed(2);
		var ciCharge = parseFloat(ciCharge).toFixed(2);
		var oot = parseFloat(oot).toFixed(2);

		$.ajax({
			url: '/computetfretail',
			type: 'GET',
			dataType: 'json',
			data: {
				'_token': $('input[name=_token]').val(),
				'prodType'    	: prodType,
				'retailType'	: retailType,
				'af'			: af,
				'other'			: other,
				'ciCharge'		: ciCharge,
				'oot'			: oot,
			},
			success: function(data) {
				
				// $('#totalFees').val(data);
				tf = parseFloat(data).toFixed(2);		
				$('#totalFees').val(replaceCommas(tf));

				// Chattel Mortgage
				var tf = ConvertToFloat($('#totalFees').val());
				var dst = ConvertToFloat($('#dst').val());
				var chattelMortgage = parseFloat(tf) - parseFloat(dst);
				chattelMortgage = parseFloat(chattelMortgage).toFixed(2);
				// alert(chattelMortgage);	
				$('#chattelMortgage').val(replaceCommas(chattelMortgage));
			}
		});	
	}

	$('#showFilterCCustom').on('click', function(event) {
		SetModalCCustomCount($("#cfilterType option:selected").val());
	});


	$('select[name="cfilterType"]').on('change', function() {
        var value = $(this).val();
        SetModalCCustomCount(value);
    });

    function SetModalCCustomCount(value) {
    	if(value == 0)
        	$('#byDateRangeContainer').show();
        else
        	$('#byDateRangeContainer').hide();
    }

    $('#showFilterACCustom').on('click', function(event) {
		SetModalACCustomCount($("#acfilterType option:selected").val());
	});


	$('select[name="acfilterType"]').on('change', function() {
        var value = $(this).val();
        SetModalACCustomCount(value);
    });

   function SetModalACCustomCount(value) {
    	if(value == 1) {
        	$('#byDateContainer').hide();
        	$('#byNameContainer').hide();
        	$('#byContractContainer').show();
    	}
        else if(value == 2) {
        	$('#byDateContainer').hide();
        	$('#byNameContainer').show();
        	$('#byContractContainer').hide();
        } else {
        	$('#byDateContainer').show();
        	$('#byNameContainer').hide();
        	$('#byContractContainer').hide();
        }
    }

    $('select[name="cityMunicipality"]').on('change', function() {
    	CheckCityMunicipality();
    });

    function CheckCityMunicipality() {
    	 var value = $("#cityMunicipality option:selected").data('info');
        if(value == "OTHERS")
        	$('#clientCityMunOthers').show();
        else
        	$('#clientCityMunOthers').hide();
    }


