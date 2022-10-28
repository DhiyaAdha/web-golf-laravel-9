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
    

    if ($("#statistic_visitor_line").length > 0) {
        var lineChart = Morris.Line({
            element: "statistic_visitor_line",
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