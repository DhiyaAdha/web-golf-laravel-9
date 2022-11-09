/*Dashboard Init*/

"use strict";

/*****Ready function start*****/
$( document ).ready(function() {
// grafik line 
if($('#invoice_line')) {
        Morris.Line({
            element: 'invoice_line',
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
            gridTextFamily: "Roboto",
        });
    }
    // grafik line 
});
