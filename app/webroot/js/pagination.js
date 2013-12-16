// JavaScript Document
$(document).ready(function() {
	$('#example').dataTable( {
		"bInfo": false,
		 
		"sPaginationType": "bootstrap",
		"bLengthChange": false,
		// Disable sorting on the first column
        
		"iDisplayLength": 10,
		"aLengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
		"oLanguage": {
			"oPaginate": {
           "sNext": "",
		   "sPrevious": ""
         },
			"sSearch": ""
			
		}
	} );
} );