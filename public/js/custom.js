// $(document).ready(function() {
//     // Setup - add a text input to each footer cell
//     $('#contractTable thead tr').clone(true).appendTo( '#contractTable thead' );
//     $('#contractTable thead tr:eq(1) th').each( function (i) {
//         var title = $(this).text();

//         if (title != "Action") {
//             $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
//             $( 'input', this ).on( 'keyup change', function () {
//                 if ( table.column(i).search() !== this.value ) {
//                     table
//                         .column(i)
//                         .search( this.value )
//                         .draw();
//                 }
//             } );
//         } else {
//             $(this).html(' ');
//         } 
//     } );
 
//     var table = $('#contractTable').DataTable( {
//         orderCellsTop: true,
//         fixedHeader: true
//     } );

//     var table = $('#ftemplateTable').DataTable( {
//         orderCellsTop: true,
//         fixedHeader: true
//     } );
// } );

$(document).ready(function(){
    $('[rel="tooltip"]').tooltip({trigger: "hover"});
});


function sideBar() {

  var determiner = $('#activedet').val();
  // alert(determiner);
  // Will only work if string in href matches with location
  $('#sidebar ul.side-menu a[id="'+ determiner +'"]').parent().addClass('active');
  // Will also work for relative and absolute hrefs
  $('#sidebar ul.side-menu a').filter(function() {
      return this.id == determiner;
  }).parent().addClass('active');
}

$(document).on('click', '#print-custom', function(event) {
  event.preventDefault();
  var routeInfo = $(this).data('info');
  PrintData(routeInfo);
});

function PrintData($i) {
  swal({   
    title: "Are you sure?",
    text: "You will not be able to edit contract once printed.",        
    // type: "warning",   
    showCancelButton: true,   
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes", 
    closeOnConfirm: true 
  }, function(){   
   //  window.location.href = $i;
   window.open($i, '_blank');
  });

}

$(document).on('click', '#refresh-custom', function(event) {
  event.preventDefault();
  var routeInfo = $(this).data('info');
  RefreshData(routeInfo);
});

function RefreshData($i) {
  swal({   
    title: "Are you sure?",
    text: "Some data will be replaced.",        
    // type: "warning",   
    showCancelButton: true,   
    confirmButtonColor: "#28a745",
    confirmButtonText: "Yes", 
    closeOnConfirm: true 
  }, function(){   

    window.location.href = $i;
   // window.open($i, '_blank');
  });

}

function SetSignatoriesContainer(id) {
	$.ajax({
	    url: '/getsignadetails/'+id,
	    type: "GET",
	    dataType: "json",
	    success:function(data) {
	    	// var tinHTML = '<p>###-###-###</p>';
	    	// var govIdHTML = '<p>###-###-###</p>';
	    	var name = "";
	    	var tin = "";
	    	var govid = "";

	    	if(data != null) {
	    		if(data.name != null) {
		    		 // tinHTML = '<p>' + data.tin + '</p>';
		    		 name = data.name;
	    		}

		    	if(data.tin != null) {
		    		 // tinHTML = '<p>' + data.tin + '</p>';
		    		 tin = data.tin;
	    		}

		    	if(data.govid != null) {
		    		// govIdHTML = '<p>' + data.govid + '</p>';
		    		govid = data.govid;
		    	}
	    	}

	    	// $('#clientSigTin').html(tinHTML);
	    	// $('#clientSigGovId').html(govIdHTML);

	    	$('#clientSigName2').val(name);
	    	$('#clientSigTin').val(tin);
	    	$('#clientSigGovId').val(govid);

	    }, error: function(data){
			alert("ERROR");
		}
	});
}

function SetTFSPHSignatoriesContainer(id, elemId) {

	$.ajax({
	    url: '/admin/getsignadetails/'+id,
	    type: "GET",
	    dataType: "json",
	    success:function(data) {
	    	var positionHTML = '<p>Position</p>';

	    	if(data != null) {
	    		positionHTML = '<p>' + data.position + '</p>';
	    	} 

	    	$('#'+elemId+'_pos').html(positionHTML);

	    }
	});
}

    
$(document).on('click', '.showFormInfo', function(event) {
	event.preventDefault();
	var formId = $(this).data('info');

	$.ajax({
		url: '/ftemplateedit',
		type: 'GET',
		dataType: 'json',
		data: {
			'_token': $('input[name=_token]').val(),
			'id'    : formId
		},
		success: function(data) {

			$('#ftid').val(data.id);
			$('#formName').val(data.name);
			$('#formPath').val(data.path);
		}
	});	
});

$(document).on('click', '.showTFSPHSigInfo', function(event) {
	event.preventDefault();
	var id = $(this).data('info');

	$.ajax({
		url: '/admin/tfssigedit',
		type: 'GET',
		dataType: 'json',
		data: {
			'_token': $('input[name=_token]').val(),
			'id'    : id
		},
		success: function(data) {

			$('#tsid').val(data.id);
			$('#sig_name').val(data.name);
			$('#sig_pos').val(data.position);
			$('#sig_tin').val(data.tin_id);
			$('#sig_govtid').val(data.govt_id);

		}, error: function(data){

       		$('#tsid').val(0);
       		$('#sig_name').val("");
			$('#sig_pos').val("");
			$('#sig_tin').val("");
			$('#sig_govtid').val("");
       }
	});	
});

$(document).on('click', '.showUserInfo', function(event) {
	event.preventDefault();
	var id = $(this).data('info');

	$.ajax({
		url: '/admin/useredit',
		type: 'GET',
		dataType: 'json',
		data: {
			'_token': $('input[name=_token]').val(),
			'id'    : id
		},
		success: function(data) {
			$('#uid').val(data.id);

			if(data.role!=null)
				$('#urole').val(data.role.name);
			else
				$('#urole').val(data.admin_level);

			$('#uname').val(data.uname);
			$('#isResetPsswrd').prop('checked', false);

			if(data.role!=null) {
				if(data.role.name == "admin") {
					$('#uname').removeAttr('readonly');
				}
				else if(data.role.name == "dealer" || data.role.name == "lo") {
					$('#uname').attr('readonly', 'readonly');
				} else { //custom
					$('#uname').removeAttr('readonly');
				}
			} else {
				$('#uname').removeAttr('readonly');
			}

			if(data.active == 1)
				$('#isActive').prop('checked', true);
			else
				$('#isActive').prop('checked', false);

			if(data.locked == 1)
				$('#isLocked').prop('checked', true);
			else
				$('#isLocked').prop('checked', false);

		}, error: function(data){
			alert("ERROR");
		}
	});	
});

$(document).on('click', '.resetRoleInfo', function(event) {
	event.preventDefault();
	$('#rid').val(0);
	$('#roleName').val("");
	$('#roleDesc').val("");	
});

$(document).on('click', '.showRoleInfo', function(event) {
	event.preventDefault();
	var id = $(this).data('info');

	$.ajax({
		url: '/admin/roleedit',
		type: 'GET',
		dataType: 'json',
		data: {
			'_token': $('input[name=_token]').val(),
			'id'    : id
		},
		success: function(data) {
			$('#rid').val(data.id);
			$('#roleName').val(data.name);
			$('#roleDesc').val(data.desc);
			

		}, error: function(data){
			alert("ERROR");
		}
	});	
	
});

$(document).on('click', '.setUserLevel', function(event) {
	event.preventDefault();
	var id = $(this).data('info');
	// $('#modalAddLevelLabel').html('Add Level '+id+' User');	
	$('#ulevel').val(id);

	if(id == 2)
	{
		$('#ulevel2Container').show();
		$('#ulevel3Container').hide();
	} else {
		$('#ulevel2Container').hide();
		$('#ulevel3Container').show();
	}
	
});

$(document).on('click', '.showAssignedUserRole', function(event) {
	event.preventDefault();
	var id = $(this).data('info');
	
	$.ajax({
		url: '/admin/roleedituser',
		type: 'GET',
		dataType: 'json',
		data: {
			'_token': $('input[name=_token]').val(),
			'id'    : id
		},
		success: function(data) {
			$('#aurid').val(data.id);
			// var dHTML = '';

			var userSelect = $('#rUserList');
			var tHTML = "";

			$('#rUserList').empty();
			$('#rUserList').val(null).trigger('change');
			$.each(data.users, function (i, item) {
				
				var option = new Option(item['username'], item['id'], true, item['selected']);
		    	userSelect.append(option).trigger('change');

				// dHTML += '<option value="'+ item['id'] + '"'+ item['selected'] +'>' + item['username'] + '</option>';

				if(item['selected'])
					tHTML += '<tr><td>'+ item['username'] +'</td></tr>';
				
			});

			if(tHTML=="")
				tHTML = '<tr><td> No user assigned. </td></tr>';

			$('#assignedUserBodyCont').html(tHTML);

			// $('#rUserList').html(dHTML);

		}, error: function(data){
			alert("ERROR");
		}
	});	
	
});

// $(document).on('click', '.showLevel2UserInfo', function(event) {
// 	event.preventDefault();
// 	var id = $(this).data('info');

// 	$.ajax({
// 		url: '/admin/useredit',
// 		type: 'GET',
// 		dataType: 'json',
// 		data: {
// 			'_token': $('input[name=_token]').val(),
// 			'id'    : id
// 		},
// 		success: function(data) {
// 			$('#uidL2').val(data.id);
// 			$('#uroleL2').val(data.role.name);
// 			$('#unameL2').val(data.uname);
// 			$('#isResetPsswrdL2').prop('checked', false);

// 			if(data.active == 1)
// 				$('#isActiveL2').prop('checked', true);
// 			else
// 				$('#isActiveL2').prop('checked', false);

// 		}, error: function(data){
// 			alert("ERROR");
// 		}
// 	});	
// });

$(document).on('click', '.showRolePerm', function(event) {
	event.preventDefault();
	var id = $(this).data('info');

	$.ajax({
		url: '/admin/rolepermedit',
		type: 'GET',
		dataType: 'json',
		data: {
			'_token': $('input[name=_token]').val(),
			'id'    : id
		},
		success: function(data) {
			$('#uidLP2').val(data.id);
			$('#uroleLP2').val(data.role.name);
			var uHTML = data.uname;
			$('#unameLP2').html(uHTML);

			for(var i = 1; i < 53; i++) {
				$('#roleL2_'+i).prop('checked', (searchArray($('#roleL2_'+i).val(), data.permissions) != null) ? true : false);

				if(searchArray($('#roleL2_'+i).val(), data.allowedperms))
					$('#roleL2_'+i).removeAttr('disabled');
				else
					$('#roleL2_'+i).attr('disabled', 'disabled');
			}

			if(data.role.name == "lo")
				$('#btnSave').attr('disabled', 'disabled');
			else
				$('#btnSave').removeAttr('disabled');

		}, error: function(data){
			alert("ERROR");
		}
	});	
});


function searchArray(nameKey, myArray){
    for (var i=0; i < myArray.length; i++) {
        if (myArray[i].name === nameKey) {
            return myArray[i];
        }
    }
}

// $(document).on('click', '.addDealerInfos', function(event) {
// 	// event.preventDefault();
	// $('#diid').val(0);
	// $('textarea,input').val([]);
	// $('#activeContainer').hide();
// });

$(document).on('click', '.addDealerInfo', function(event) {
	$('#diid').val(0);
	$('#activeContainer').hide();
	$('.addDealerInfoContainer').show();
	$('#editDealerInfoContainer').hide();
	$('input[type=text]').val([]);
	$('input[type=number]').val([]);
	$('input[type=checkbox]').val([]);
	$('textarea').val("");
});

$(document).on('click', '.showAppconview', function(event) {
	event.preventDefault();
	var id = $(this).data('info');

	$.ajax({
		url: '/appcontractview',
		type: 'GET',
		dataType: 'json',
		data: {
			'_token': $('input[name=_token]').val(),
			'id'    : id
		},
		success: function(data) {
			// alert(data);
			$('#contract_id').val(data[0].contract_id);
			$('#client').val(data[0].client);
			$('#comaker').val(data[0].comaker);
			$('#client_address').val(data[0].client_address);
			$('#dealer').val(data[0].dealer);
			$('#contract_status').val(data[0].contract_status);
			$('#contract_state').val(data[0].contract_state);
			$('#credit_state').val(data[0].credit_state);
			$('#product').val(data[0].product);			
			$('#term').val(data[0].term);
			$('#amt_financed').val(data[0].amt_financed);
			$('#unit').val(data[0].unit);
			$('#model').val(data[0].model);
			$('#unit_cost').val(data[0].unit_cost);
			$('#downpayment').val(data[0].downpayment);
			$('#requirements').val(data[0].requirements);
			$('#credit_app_dt').val(data[0].credit_app_dt);
			$('#marketing_professional').val(data[0].marketing_professional);
			$('#loan_officer').val(data[0].loan_officer);
		}
	});	
});

$(document).on('click', '.showDealerInfo', function(event) {
	event.preventDefault();
	var id = $(this).data('info');

	$.ajax({
		url: '/admin/dealeredit',
		type: 'GET',
		dataType: 'json',
		data: {
			'_token': $('input[name=_token]').val(),
			'id'    : id
		},
		success: function(data) {
			$('.addDealerInfoContainer').hide();
			$('#editDealerInfoContainer').show();

			$('#diid').val(data.id);
			$('#partyId').html(data.party_id);
			$('#partyNo').val(data.party_no);
			$('#dealerName').val(data.dealer_name);
			$('#dReference').val(data.reference);
			$('#dAddress').val(data.address);
			$('#dTin').val(data.dealer_tin);

			if(data.is_metro == 1)
				$('#isMetro').prop('checked', true);
			else
				$('#isMetro').prop('checked', false);

			if(data.is_2party == 1)
				$('#isTwoParty').prop('checked', true);
			else
				$('#isTwoParty').prop('checked', false);

			if(data.is_3party == 1)
				$('#isThreeParty').prop('checked', true);
			else
				$('#isThreeParty').prop('checked', false);

			$('#activeContainer').show();

			if(data.is_active == 1)
				$('#isActive').prop('checked', true);
			else
				$('#isActive').prop('checked', false);

		}, error: function(data){
			alert("error");

			$('#diid').val(0);
			$('textarea,input').val([]);
       }
	});	
});

$(document).on('click', '.showVehicle', function(event) {
	event.preventDefault();
	var id = $(this).data('info');

	$.ajax({
		url: '/vehicleedit',
		type: 'GET',
		dataType: 'json',
		data: {
			'_token': $('input[name=_token]').val(),
			'id'    : id
		},
		success: function(data) {

			$('#vid').val(data.id);
			$('#vehicleName').val(data.name);
		}
	});	
});

$(document).on('click', '.showCityMun', function(event) {
	event.preventDefault();
	var id = $(this).data('info');

	$.ajax({
		url: '/citymunedit',
		type: 'GET',
		dataType: 'json',
		data: {
			'_token': $('input[name=_token]').val(),
			'id'    : id
		},
		success: function(data) {

			$('#cmid').val(data.id);
			$('#citymunName').val(data.name);
		}
	});	
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$(document).on('click', '.showDealerFeesInfo', function(event) {
	event.preventDefault();
	var id = $(this).data('info');

	$.ajax({
		url: '/admin/dealerfeesedit',
		type: 'GET',
		dataType: 'json',
		data: {
			'_token': $('input[name=_token]').val(),
			'id'    : id
		},
		success: function(data) {

			$('#dfid').val(data.id);
			var dnHTML = "<p>"+data.name+"</p>";
			var trHTML = "<option value='0'>...</option>";

			$.each(data.tablerefs, function (i, item) {

				if(data.tablerefname == item['name'])
				trHTML += '<option value="'+ item['name'] + '" selected>' + item['name'] + '</option>';
				else 
				trHTML += '<option value="'+ item['name'] + '">' + item['name'] + '</option>';
				
			});

			$('#dealerName').html(dnHTML);
			$('#dTableRef').html(trHTML);

			$('#cmfee2').val(data.cmfee2);
			$('#cmfee3').val(data.cmfee3);
			$('#leasefee').val(data.leasefee);
		}
	});	
});

$(document).on('click', '.showDealerFeesTableInfo', function(event) {
	event.preventDefault();
	var id = $(this).data('info');
	var tid = $('#tableId').val();

	$.ajax({
		url: '/admin/dealerfeestableedit',
		type: 'GET',
		dataType: 'json',
		data: {
			'_token': $('input[name=_token]').val(),
			'id'    : id,
			'tid'	: tid,
		},
		success: function(data) {

			$('#dftid').val(data.id);
			$('#dfrid').val(data.id);
			$('#fromRange').val(data.from);
			$('#toRange').val(data.to);
			$('#rate').val(data.rate);

			var trHTML = "";

			$.each(data.retailtypes, function (i, item) {
				
				if(data.retailtypeid == item['field_id'])
				trHTML += '<option value="'+ item['field_id'] + '" selected>' + item['field_name'] + '</option>';
				else 
				trHTML += '<option value="'+ item['field_id'] + '">' + item['field_name'] + '</option>';
				
			});

			$('#retailType').html(trHTML);
		}
	});	
});


$(document).on('click', '.editNewsBulletin', function(event) {
	event.preventDefault();
	var id = $(this).data('info');

	$.ajax({
		url: '/newsedit',
		type: 'GET',
		dataType: 'json',
		data: {
			'_token': $('input[name=_token]').val(),
			'id'    : id
		},
		success: function(data) {

			$('#nid').val(data.id);
			$('#newsTitle').val(data.title);
			$('#newsContent').val(data.content);
			// $('#isNewsVisible').val(data.is_visible);
			if(data.is_visible == 1) {
				$('#isNewsVisible').prop('checked', true);
			} else {
				$('#isNewsVisible').prop('checked', false);
			}
		}
	});	
});

$(document).on('click', '.viewNewsBulletin', function(event) {
	event.preventDefault();
	var id = $(this).data('info');

	$.ajax({
		url: '/newsedit',
		type: 'GET',
		dataType: 'json',
		data: {
			'_token': $('input[name=_token]').val(),
			'id'    : id
		},
		success: function(data) {

			// $('#nid').val(data.id);
			$('#newsTitleV').html(data.title);
			$('#newsContentV').html(data.content);
		}
	});	
});

$(document).on('click', '.editBookingGuideline', function(event) {
	event.preventDefault();
	var id = $(this).data('info');

	$.ajax({
		url: '/bookingguideedit',
		type: 'GET',
		dataType: 'json',
		data: {
			'_token': $('input[name=_token]').val(),
			'id'    : id
		},
		success: function(data) {

			$('#bgid').val(data.id);
			$('#bookingGuideContent').val(data.content);
		}
	});	
});