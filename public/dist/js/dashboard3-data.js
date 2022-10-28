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

	var barLine = Morris.Line({
        element: "revenue_trendline_permainan",
        data: dataNewPermainan,
        xkey: "period", 
        ykeys: ["jml_default"],
        labels: ["jml_default"],
        pointSize: 2,
        fillOpacity: 0,
        lineWidth: 2,
        pointStrokeColors: ["#fec107"],
        behaveLikeLine: true,
        gridLineColor: "#878787",
        hideHover: "auto",
        lineColors: ["#fec107"],
        resize: true,
        redraw: true,
        gridTextColor: "#878787",
        gridTextFamily: "Roboto",
        parseTime: false,
    });
});
