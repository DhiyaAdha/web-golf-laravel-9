/*Dashboard3 Init*/

"use strict";

/*****Ready function start*****/
$(document).ready(function(){
	$('#support_table').DataTable({
		"bFilter": false,
		"bLengthChange": false,
		"bPaginate": false,
		"bInfo": false,
	});
	
	if($('#statistic_permainan_bar').length > 0) {
		// Morris bar chart
		Morris.Bar({
			element: 'statistic_permainan_bar',
			data: dataMingguan,
			xkey: 'y',
			ykeys: ['a'],
			labels: ['PERMAINAN' ],
			barColors:['#fec107'],
			hideHover: 'auto',
			gridLineColor: '#878787',
			resize: true,
			barGap: 4,
			gridTextColor:'#878787',
			gridTextFamily:"Roboto",
		});
    }
});
