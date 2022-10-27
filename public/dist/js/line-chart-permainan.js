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
    

    if ($("#statistic_permainan_line").length > 0) {
        var lineChart = Morris.Line({
            element: "statistic_permainan_line",
            xkey: "period", 
            ykeys: ["PERMAINAN"],
            labels: ["PERMAINAN"],
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
            lineChart.setData(dataNewPermainan);
            lineChart.redraw();
        }
    };
    swichMorris();
    $(document).on("change", "#morris_switch", function () {
        swichMorris();
    });
});