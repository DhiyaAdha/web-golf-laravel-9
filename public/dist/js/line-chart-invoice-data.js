/*Dashboard Init*/

"use strict";

/*****Ready function start*****/
$( document ).ready(function() {
// grafik line 
if($('#invoice_line_member')) {
    Morris.Line({
        element: 'invoice_line_member',
        data: invoiceMonth,
        xkey: "e",
        parseTime: false,
        ykeys: ["f"],
        labels: ["Total"],
        labelcolor : ["#fff"],
        hideHover: 'auto',
        pointSize: 2,
        fillOpacity: 0,
        lineWidth: 2,
        resize: true,
        redraw: true,
        pointStrokeColors: ["#01c853"],
        gridLineColor: "#878787",
        lineColors: ["#01c853"],
        gridTextColor: "#878787",
    });
}

if($('#invoice_line_vip')) {
    Morris.Line({
        element: 'invoice_line_vip',
        data: invoiceMonth,
        xkey: "e",
        parseTime: false,
        ykeys: ["g"],
        labels: ["Total"],
        labelcolor : ["#fff"],
        hideHover: 'auto',
        pointSize: 2,
        fillOpacity: 0,
        lineWidth: 2,
        resize: true,
        redraw: true,
        pointStrokeColors: ["#fec107"],
        gridLineColor: "#878787",
        lineColors: ["#fec107"],
        gridTextColor: "#878787",
    });
}
    // grafik line 
});
