/*Dashboard Init*/

"use strict";

/*****Ready function start*****/
$(document).ready(function () {
    
    
    var barChart = Morris.Bar({
        element: 'statistic_visitor_bar',
        data: dataMingguan,
        xkey: 'y',
        ykeys: ['a', 'b', 'c' ],
        labels: ['VIP', 'Member', 'Umum' ],
        barColors:['#fec107', '#32FFC1', '#21E1E1'],
        hideHover: 'auto',
        gridLineColor: '#878787',
        resize: true,
        barGap: 4,
        gridTextColor:'#878787',
        gridTextFamily:"Roboto",
    });

    barChart.options.labels.forEach(function(label, i) {
        var legendItem = $('<span class="legend-item"></span>').text( label).prepend('<span class="legend-color">&nbsp;</span>');
        legendItem.find('span').css('backgroundColor', barChart.options.barColors[i]);
        $('#visitor_month').append(legendItem)
    });

    var barLine = Morris.Line({
        element: "statistic_visitor_line",
        data: dataNewVisitor,
        xkey: "period", 
        ykeys: ["VIP", "Member","Umum"],
        labels: ["VIP", "Member", "Umum"],
        pointSize: 2,
        fillOpacity: 0,
        lineWidth: 2,
        pointStrokeColors: ["#fec107", "#32FFC1", "#21E1E1"],
        behaveLikeLine: true,
        gridLineColor: "#878787",
        hideHover: "auto",
        lineColors: ["#fec107", "#32FFC1", "#21E1E1"],
        resize: true,
        redraw: true,
        gridTextColor: "#878787",
        gridTextFamily: "Roboto",
        parseTime: false,
    });

    barLine.options.labels.forEach(function(label, i) {
        var legendItem = $('<span class="legend-item"></span>').text( label).prepend('<span class="legend-color">&nbsp;</span>');
        legendItem.find('span').css('backgroundColor', barLine.options.lineColors[i]);
        $('#visitor_week').append(legendItem)
    });

    var stackedBar = Morris.Bar({
        element: "bar-chart",
        data: dataNewVisitor,
        xkey: 'period',
        ykeys: ['pertamina', 'pensiunan' , 'forkopimda', 'perpesi', 'umum'],
        labels: ['Pertamina', 'Pensiunan', 'Forkopimda', 'Perpesi', 'Umum'],
        fillOpacity: 0.6,
        hideHover: 'auto',
        stacked: true,
        resize: true,
        pointFillColors:['#ffffff'],
        pointStrokeColors: ['black'],
        barColors:['#e60049','#9b19f5','#ffa300','#dc0ab4','#00b7c7'],
    });

    stackedBar.options.labels.forEach(function(label, i) {
        var legendItem = $('<span class="legend-item"></span>').text( label).prepend('<span class="legend-color">&nbsp;</span>');
        legendItem.find('span').css('backgroundColor', stackedBar.options.barColors[i]);
        $('#visitor_legend').append(legendItem)
    });
});