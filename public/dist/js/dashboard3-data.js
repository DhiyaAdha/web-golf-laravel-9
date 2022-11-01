/*Dashboard Init*/

"use strict";

/*****Ready function start*****/
function createChart(data, week) {
    Morris.Bar({
        element: 'statistic_revenue_bar',
        data: data,
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
}

// $( document ).ready(function() {
//     Morris.Bar({
//         element: 'statistic_revenue_bar',
//         data: revenueWeek,
//         xkey: 'y',
//         ykeys: ['a', 'b', 'c','d' ],
//         labels: ['Permainan', 'Proshop & Fasilitas', 'Kantin', 'Profit' ],
//         stacked: true,
//         barColors:['#fec107', '#32FFC1', '#21E1E1', '#BF00FF'],
//         hideHover: 'auto',
//         gridLineColor: '#878787',
//         stacked: true,
//         resize: true,
//         barGap: 4,
//         gridTextColor:'#878787',
//         gridTextFamily:"Roboto",
//         barSize: 30,
//     });
// });

