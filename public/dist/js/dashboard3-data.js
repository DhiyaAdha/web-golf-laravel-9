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

	if($('#revenue_trendline').length > 0) {
		// Morris bar chart
		Morris.Bar({
			element: 'revenue_trendline',
			data: dataMingguan,
			xkey: 'y',
			ykeys: ['a'	, 'b', 'c' ],
			labels: ['VIP', 'Member', 'Reguler' ],
			barColors:['#fec107', '#32FFC1', '#21E1E1'],
			hideHover: 'auto',
			gridLineColor: '#878787',
			resize: true,
			barGap: 4,
			gridTextColor:'#878787',
			gridTextFamily:"Roboto",
			// yLabelFormat: function(y){ return y != Math.round(y)?'':y; }
		});
    }
});
