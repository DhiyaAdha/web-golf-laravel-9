/*Dashboard Init*/

"use strict";

/*****Ready function start*****/
$(document).ready(function () {

Morris.Line({
    element: 'areaChart',
    data: dataNewPermainan,
    xkey:  "period", 
    parseTime: false,
    ykeys: ["total", "permainan","fasilitas","penjualan"],
    labels: ["total", "permainan","fasilitas","penjualan"],
    pointSize: 2,
    fillOpacity: 0,
    lineWidth: 2,
    resize: true,
    redraw: true,
    pointStrokeColors:["#fec107", "#32FFC1", "#21E1E1","#B2BEB5"],
    gridLineColor: "#878787",
    lineColors:["#fec107", "#32FFC1", "#21E1E1","#B2BEB5"],
    gridTextColor: "#878787",
    gridTextFamily: "Roboto",
    hideHover: 'auto',

})
});