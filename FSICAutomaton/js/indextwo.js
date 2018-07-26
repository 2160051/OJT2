$(document).ready(function() {
	document.title='FSIC Payments';
	$('#example').DataTable(
		{
			"dom": '<"dt-buttons"Bf><"clear">lirtp',
			"paging": true,
			"autoWidth": true,
			"buttons": [
				'colvis',
				{
	                extend: 'copyHtml5',
	                exportOptions: {
	                    columns: [0, 1, 2, 3, 4, 5, 6]
	                }
	            },
					{
	                extend: 'excelHtml5',
	                exportOptions: {
	                    columns: [0, 1, 2, 3, 4, 5, 6]
	                }
	            },
	            {
	                extend: 'pdfHtml5',
	                exportOptions: {
	                    columns: [0, 1, 2, 3, 4, 5, 6]
	                }
	            },
	            {
	                extend: 'csvHtml5',
	                exportOptions: {
	                    columns: [0, 1, 2, 3, 4, 5, 6]
	                }
	            },
				{
	                extend: 'print',
	                exportOptions: {
	                    columns: [0, 1, 2, 3, 4, 5, 6]
	                }
	            }
			]
		}
	);
});