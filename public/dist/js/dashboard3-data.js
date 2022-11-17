/*Dashboard Init*/

"use strict";

/*****Ready function start*****/
$( document ).ready(function() {
    $('#b').click(function() {
        document.getElementById('revenue_bar_game').style = 'display:visible;';
    });
    $('#c').click(function() {
        document.getElementById('revenue_bar_facility').style = 'display:visible;';
    });
    $('#d').click(function() {
        document.getElementById('revenue_bar_other').style = 'display:visible;';
    });
    $('#f').click(function() {
        document.getElementById('revenue_line_game').style = 'display:visible;';
    });
    $('#g').click(function() {
        document.getElementById('revenue_line_facility').style = 'display:visible;';
    });
    $('#h').click(function() {
        document.getElementById('revenue_line_other').style = 'display:visible;';
    });

    $.ajax({  
        type: "GET",  
        url: "/analytic/week/revenue",  
        contentType: "application/json; charset=utf-8",  
        dataType: "json",  
        success: function(response) {  
            analytic_week_revenue(response);  
        },  
    });

    $.ajax({  
        type: "GET",  
        url: "/analytic/month/revenue",  
        contentType: "application/json; charset=utf-8",  
        dataType: "json",  
        success: function(response) {  
            analytic_month_revenue(response);  
        },  
    });

    function analytic_week_revenue(days) {
        Morris.Bar({
            element: 'revenue_bar',
            data: JSON.parse(days),
            xkey: 'y',
            ykeys: ['a', 'b', 'c','d' ],
            labels: ['Permainan', 'Proshop & Fasilitas', 'Kantin', 'Total' ],
            stacked: true,
            barColors:['#fec107', '#32FFC1', '#5F9DF7', '#00FFFFFF'],
            hideHover: 'auto',
            gridLineColor: '#878787',
            stacked: true,
            resize: true,
            barGap: 4,
            gridTextColor:'#878787',
            gridTextFamily:"Roboto",
            barSize: 30,
        });
        Morris.Bar({
            element: 'revenue_bar_game',
            data: JSON.parse(days),
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Permainan'],
            stacked: true,
            barColors:['#fec107'],
            hideHover: 'auto',
            gridLineColor: '#878787',
            stacked: true,
            resize: true,
            barGap: 4,
            gridTextColor:'#878787',
            gridTextFamily:"Roboto",
            barSize: 30,
        });
        Morris.Bar({
            element: 'revenue_bar_facility',
            data: JSON.parse(days),
            xkey: 'y',
            ykeys: ['b'],
            labels: ['Proshop & Fasilitas'],
            stacked: true,
            barColors:['#32FFC1'],
            hideHover: 'auto',
            gridLineColor: '#878787',
            stacked: true,
            resize: true,
            barGap: 4,
            gridTextColor:'#878787',
            gridTextFamily:"Roboto",
            barSize: 30,
        });
        Morris.Bar({
            element: 'revenue_bar_other',
            data: JSON.parse(days),
            xkey: 'y',
            ykeys: ['c'],
            labels: ['Kantin'],
            stacked: true,
            barColors:['#5F9DF7'],
            hideHover: 'auto',
            gridLineColor: '#878787',
            stacked: true,
            resize: true,
            barGap: 4,
            gridTextColor:'#878787',
            gridTextFamily:"Roboto",
            barSize: 30,
        });
    }

    function analytic_month_revenue(month) {
        Morris.Line({
            element: 'revenue_line',
            data: JSON.parse(month),
            xkey: "e",
            parseTime: false,
            ykeys: ["f", "g", "h", "i"],
            labels: ["Total", "Permainan", "Proshop & Fasilitas", "Kantin"],
            labelcolor : ["#fff", "#fff", "#fff", "#fff"],
            pointSize: 2,
            fillOpacity: 0,
            lineWidth: 2,
            resize: true,
            redraw: true,
            pointStrokeColors: ["#00FFFFFF", "#fec107", "#32FFC1", "#5F9DF7"],
            gridLineColor: "#878787",
            lineColors: ["#00FFFFFF", "#fec107", "#32FFC1", "#5F9DF7"],
            gridTextColor: "#878787",
            gridTextFamily: "Roboto",
            hideHover: 'auto',
        });
        Morris.Line({
            element: 'revenue_line_game',
            data: JSON.parse(month),
            xkey: "e",
            parseTime: false,
            ykeys: ["g"],
            labels: ["Permainan"],
            labelcolor : ["#fff"],
            pointSize: 2,
            fillOpacity: 0,
            lineWidth: 2,
            resize: true,
            redraw: true,
            pointStrokeColors: ["#fec107"],
            gridLineColor: "#878787",
            lineColors: ["#fec107"],
            gridTextColor: "#878787",
            gridTextFamily: "Roboto",
            hideHover: 'auto',
        });
        Morris.Line({
            element: 'revenue_line_facility',
            data: JSON.parse(month),
            xkey: "e",
            parseTime: false,
            ykeys: ["h"],
            labels: ["Proshop & Fasilitas"],
            labelcolor : ["#fff", "#fff", "#fff", "#fff"],
            pointSize: 2,
            fillOpacity: 0,
            lineWidth: 2,
            resize: true,
            redraw: true,
            pointStrokeColors: ["#32FFC1"],
            gridLineColor: "#878787",
            lineColors: ["#32FFC1"],
            gridTextColor: "#878787",
            gridTextFamily: "Roboto",
            hideHover: 'auto',
        });
        Morris.Line({
            element: 'revenue_line_other',
            data: JSON.parse(month),
            xkey: "e",
            parseTime: false,
            ykeys: ["i"],
            labels: ["Kantin"],
            labelcolor : ["#fff", "#fff", "#fff", "#fff"],
            pointSize: 2,
            fillOpacity: 0,
            lineWidth: 2,
            resize: true,
            redraw: true,
            pointStrokeColors: ["#5F9DF7"],
            gridLineColor: "#878787",
            lineColors: ["#5F9DF7"],
            gridTextColor: "#878787",
            gridTextFamily: "Roboto",
            hideHover: 'auto',
        });
    }
});
