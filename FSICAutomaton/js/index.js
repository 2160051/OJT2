$(document).ready(function() {
	document.title='Records';
	$('#example').DataTable(
		{
			"dom": '<"dt-buttons"Bf><"clear">lirtp',
			"paging": true,
			"autoWidth": true,
			"buttons": [
				'colvis',
				'copyHtml5',
					{
	                extend: 'excelHtml5',
	                exportOptions: {
	                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
	                }
	            },
	            {
	                extend: 'pdfHtml5',
	                exportOptions: {
	                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
	                }
	            },
	            {
	                extend: 'csvHtml5',
	                exportOptions: {
	                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
	                }
	            },
				'print'
			]
		}
	);
});