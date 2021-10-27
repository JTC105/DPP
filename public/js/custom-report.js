$('#rfilterStartDate').datepicker({
		uiLibrary: 'bootstrap4'
	});

$('#rfilterEndDate').datepicker({
	uiLibrary: 'bootstrap4'
});

$(document).on('click', '.setReportType', function(event) {
	var id = $(this).data('info');

	$('#reportType').val(id);
});