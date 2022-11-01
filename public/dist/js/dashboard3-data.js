/*Dashboard Init*/

"use strict";

/*****Ready function start*****/
$( document ).ready(function() {
    Morris.Bar({
        element: 'revenue_bar',
        data: revenueWeek,
        xkey: 'y',
        ykeys: ['a', 'b', 'c','d' ],
        labels: ['Permainan', 'Proshop & Fasilitas', 'Kantin', 'Profit' ],
        stacked: true,
        barColors:['#fec107', '#32FFC1', '#21E1E1', '#BF00FF'],
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
        data: revenueWeek,
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
    })
    Morris.Bar({
        element: 'revenue_bar_facility',
        data: revenueWeek,
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
    })
    Morris.Bar({
        element: 'revenue_bar_other',
        data: revenueWeek,
        xkey: 'y',
        ykeys: ['c'],
        labels: ['Kantin'],
        stacked: true,
        barColors:['#21E1E1'],
        hideHover: 'auto',
        gridLineColor: '#878787',
        stacked: true,
        resize: true,
        barGap: 4,
        gridTextColor:'#878787',
        gridTextFamily:"Roboto",
        barSize: 30,
    })

// grafik line 
if($('#revenue_line').length > 0) {
        Morris.Line({
            element: 'revenue_line',
            data: revenueMonth,
            xkey: "e",
            parseTime: false,
            ykeys: ["f", "g", "h", "i"],
            labels: ["Total", "Permainan", "Fasilitas", "Penjualan"],
            labelcolor : ["#fff", "#fff", "#fff", "#fff"],
            pointSize: 2,
            fillOpacity: 0,
            lineWidth: 2,
            resize: true,
            redraw: true,
            pointStrokeColors: ["#BF00FF", "#fec107", "#32FFC1", "#21E1E1"],
            gridLineColor: "#878787",
            lineColors: ["#BF00FF", "#fec107", "#32FFC1", "#21E1E1"],
            gridTextColor: "#878787",
            gridTextFamily: "Roboto",
            hideHover: 'auto',
        });
    }
if($('#revenue_line_game').length > 0) {
        Morris.Line({
            element: 'revenue_line_game',
            data: revenueMonth,
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
    }
if($('#revenue_line_facility').length > 0) {
        Morris.Line({
            element: 'revenue_line_facility',
            data: revenueMonth,
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
    }
if($('#revenue_line_other').length > 0) {
        Morris.Line({
            element: 'revenue_line_other',
            data: revenueMonth,
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
            pointStrokeColors: ["#21E1E1"],
            gridLineColor: "#878787",
            lineColors: ["#21E1E1"],
            gridTextColor: "#878787",
            gridTextFamily: "Roboto",
            hideHover: 'auto',
        });
    }
    // grafik line 
});
