/*Dashboard3 Init*/

"use strict";

/*****Ready function start*****/
$(document).ready(function(){
    var revenueBar = Morris.Bar({
        element: 'statistic_revenue_bar',
        data: revenueWeek,
        xkey: 'y',
        ykeys: ['a', 'b', 'c','d' ],
        labels: ['Permainan', 'Proshop & Fasilitas', 'Kantin', 'Profit' ],
        barColors:['#fec107', '#32FFC1', '#21E1E1'],
        hideHover: 'auto',
        gridLineColor: '#878787',
        resize: true,
        barGap: 4,
        gridTextColor:'#878787',
        gridTextFamily:"Roboto",
    });
});
