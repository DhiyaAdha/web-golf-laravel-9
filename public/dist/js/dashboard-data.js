/*Dashboard Init*/

"use strict";

/*****Ready function start*****/
$(document).ready(function () {
    $("#statement").DataTable({
        bFilter: false,
        bLengthChange: false,
        bPaginate: false,
        bInfo: false,
    });
    if ($("#chart_2").length > 0) {
        var ctx2 = document.getElementById("chart_2").getContext("2d");
        var data2 = {
            labels: [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
            ],
            datasets: [
                {
                    label: "My First dataset",
                    backgroundColor: "rgba(254,193,7,1)",
                    borderColor: "rgba(254,193,7,1)",
                    data: [10, 30, 80, 61, 26, 75, 40],
                },
                {
                    label: "My Second dataset",
                    backgroundColor: "rgba(255,42,0,1)",
                    borderColor: "rgba(255,42,0,1)",
                    data: [28, 48, 40, 19, 86, 27, 90],
                },
                {
                    label: "My Third dataset",
                    backgroundColor: "rgba(1,200,83,1)",
                    borderColor: "rgba(1,200,83,1)",
                    data: [8, 28, 50, 29, 76, 77, 40],
                },
            ],
        };

        var hBar = new Chart(ctx2, {
            type: "horizontalBar",
            data: data2,

            options: {
                tooltips: {
                    mode: "label",
                },
                scales: {
                    yAxes: [
                        {
                            stacked: true,
                            gridLines: {
                                color: "#878787",
                            },
                            ticks: {
                                fontFamily: "Roboto",
                                fontColor: "#878787",
                            },
                        },
                    ],
                    xAxes: [
                        {
                            stacked: true,
                            gridLines: {
                                color: "#878787",
                            },
                            ticks: {
                                fontFamily: "Roboto",
                                fontColor: "#878787",
                            },
                        },
                    ],
                },
                elements: {
                    point: {
                        hitRadius: 40,
                    },
                },
                animation: {
                    duration: 3000,
                },
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false,
                },

                tooltip: {
                    backgroundColor: "rgba(33,33,33,1)",
                    cornerRadius: 0,
                    footerFontFamily: "'Roboto'",
                },
            },
        });
    }
    if ($("#chart_6").length > 0) {
        var ctx6 = document.getElementById("chart_6").getContext("2d");
        var data6 = {
            labels: ["organic", "Referral", "Other"],
            datasets: [
                {
                    data: [200, 50, 250],
                    backgroundColor: ["#2879ff", "#01c853", "#fec107"],
                    hoverBackgroundColor: ["#2879ff", "#01c853", "#fec107"],
                },
            ],
        };

        var pieChart = new Chart(ctx6, {
            type: "pie",
            data: data6,
            options: {
                animation: {
                    duration: 3000,
                },
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false,
                },
                tooltip: {
                    backgroundColor: "rgba(33,33,33,1)",
                    cornerRadius: 0,
                    footerFontFamily: "'Roboto'",
                },
                elements: {
                    arc: {
                        borderWidth: 0,
                    },
                },
            },
        });
    }

    if ($("#statistic_visitor_line").length > 0) {
        var lineChart = Morris.Line({
            element: "statistic_visitor_line",
            xkey: "period", 
            ykeys: ["vvip", "vip"],
            labels: ["vvip", "vip"],
            pointSize: 2,
            fillOpacity: 0,
            lineWidth: 2,
            pointStrokeColors: ["#fec107", "#32FFC1"],
            behaveLikeLine: true,
            gridLineColor: "#878787",
            hideHover: "auto",
            lineColors: ["#fec107", "#32FFC1"],
            resize: true,
            redraw: true,
            gridTextColor: "#878787",
            gridTextFamily: "Roboto",
            parseTime: false,
        });
    }
    /* Switchery Init*/
    var elems = Array.prototype.slice.call(
        document.querySelectorAll(".js-switch")
    );
    $("#morris_switch").each(function () {
        new Switchery($(this)[0], $(this).data());
    });
    var swichMorris = function () {
        if ($("#morris_switch").is(":checked")) {
            lineChart.setData(data);
            lineChart.redraw();
        } else {
            lineChart.setData(dataNewVisitor);
            lineChart.redraw();
        }
    };
    swichMorris();
    $(document).on("change", "#morris_switch", function () {
        swichMorris();
    });
});
/*****Ready function end*****/

/*****Load function start*****/
$(window).load(function(){
	window.setTimeout(function(){
		$.toast({
			// heading: '',
			text: 'Selamat Datang Kembali <strong>Admin</strong>',
			position: 'top-right',
			loaderBg:'#fec107',
			icon: 'success',
			hideAfter: 2000, 
			stack: 6
		});
	}, 1000);
});
/*****Load function* end*****/

var sparklineLogin = function () {
    if ($("#sparkline_1").length > 0) {
        $("#sparkline_1").sparkline([2, 4, 4, 6, 8, 5, 6, 4, 8, 6, 6, 2], {
            type: "line",
            width: "100%",
            height: "35",
            lineColor: "#2879ff",
            fillColor: "rgba(40,121,255,.2)",
            maxSpotColor: "#2879ff",
            highlightLineColor: "rgba(0, 0, 0, 0.2)",
            highlightSpotColor: "#2879ff",
        });
    }
    if ($("#sparkline_2").length > 0) {
        $("#sparkline_2").sparkline([0, 2, 8, 6, 8], {
            type: "line",
            width: "100%",
            height: "35",
            lineColor: "#2879ff",
            fillColor: "rgba(40,121,255,.2)",
            maxSpotColor: "#2879ff",
            highlightLineColor: "rgba(0, 0, 0, 0.2)",
            highlightSpotColor: "#2879ff",
        });
    }
    if ($("#sparkline_3").length > 0) {
        $("#sparkline_3").sparkline(
            [0, 23, 43, 35, 44, 45, 56, 37, 40, 45, 56, 7, 10],
            {
                type: "line",
                width: "100%",
                height: "35",
                lineColor: "#2879ff",
                fillColor: "rgba(40,121,255,.2)",
                maxSpotColor: "#2879ff",
                highlightLineColor: "rgba(0, 0, 0, 0.2)",
                highlightSpotColor: "#2879ff",
            }
        );
    }
    if ($("#sparkline_4").length > 0) {
        $("#sparkline_4").sparkline([0, 2, 8, 6, 8, 5, 6, 4, 8, 6, 6, 2], {
            type: "bar",
            width: "100%",
            height: "50",
            barWidth: "5",
            resize: true,
            barSpacing: "5",
            barColor: "#fec107",
            highlightSpotColor: "#fec107",
        });
    }
};
var sparkResize;
$(window).resize(function (e) {
    clearTimeout(sparkResize);
    sparkResize = setTimeout(sparklineLogin, 200);
});
sparklineLogin();

// Grafik rekap harian
var data = {
    labels: ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"],
    series: [
        [100, 105, 80, 60, 70, 100, 30],
        [160, 55, 110, 110, 110, 60, 40],
    ],
};

var options = {
    seriesBarDistance: 15,
};

var responsiveOptions = [
    [
        "screen and (min-width: 641px) and (max-width: 1024px)",
        {
            seriesBarDistance: 10,
            axisX: {
                labelInterpolationFnc: function (value) {
                    return value;
                },
            },
        },
    ],
    [
        "screen and (max-width: 640px)",
        {
            seriesBarDistance: 5,
            axisX: {
                labelInterpolationFnc: function (value) {
                    return value[0];
                },
            },
        },
    ],
];

new Chartist.Bar(".ct-chart", data, options, responsiveOptions);
