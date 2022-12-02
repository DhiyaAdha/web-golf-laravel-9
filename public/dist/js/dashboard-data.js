/*Dashboard Init*/

"use strict";

/*****Ready function start*****/
$(document).ready(function () {
    /* data analisis */
    $('#dt-analisis').DataTable({
        "processing": true,
        "serverSide": true,
        "lengthChange": false,
        "bDestroy": true,
        "searching": true,
        "paginate": {
            "first": "First",
            "last": "Last",
            "next": "Next",
            "previous": "Previous"
        },
        "ajax": {
            "url": "/analisis-tamu",
            "type": "GET",
            "datatype": "json"
        },

        "render": $.fn.dataTable.render.text(),
        "columns": [{
                data: 'name',
                searchable: true,
                orderable:false
            },
            {
                "data": function(data) {
                    return `<span class='text-capitalize'>${data.category}</span>`;
                },
                orderable:false
            },
            {
                "data": function(data) {
                    if (data.tipe_member == 'VIP') {
                        return `<span class='label label-success'>${data.tipe_member == 'VIP' ? 'Member' : 'VIP'}</span>`;
                    } else {
                        return `<span class='label label-warning'>${data.tipe_member == 'VVIP' ? 'VIP' : 'Member'}</span>`;
                    }
                },
                orderable:false
            },
            {
                data: 'times',
            }
        ],
        order: [
            [3, 'desc']
        ],
        responsive: true,
        language: {
            search: "",
            searchPlaceholder: "Cari nama",
            emptyTable: "Tidak ada data pada tabel ini",
            info: "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
            infoFiltered: "(difilter dari _MAX_ total data)",
            infoEmpty: "Tidak ada data pada tabel ini",
            lengthMenu: "Menampilkan _MENU_ data",
            zeroRecords: "Tidak ada data pada tabel ini"
        },
        columnDefs: [{
                className: 'text-left',
                targets: [0, 1, 2, 3, ]
            },
            {
                className: 'text-right',
                targets: [2]
            },
            {
                width: '40%',
                targets: [0]
            },
            {
                width: '20%',
                targets: [1, 2, 3]
            }
        ],
        dom: "<'row mb-3'<'col-sm-12 col-md-8 pull-right'f><'toolbar col-sm-12 col-md-4 float-left'B>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        initComplete: function() {
            $('div.toolbar').html('<h6>Daftar member terakhir bermain</h6>').appendTo('.float-left');
        }
    });
    /* data analisis */

    $.ajax({  
        type: "GET",  
        url: "/analytic/week",  
        contentType: "application/json; charset=utf-8",  
        dataType: "json",  
        success: function(response) {  
            analytic_week(response);  
        },  
    });

    $.ajax({  
        type: "GET",  
        url: "/analytic/month",  
        contentType: "application/json; charset=utf-8",  
        dataType: "json",  
        success: function(response) {  
            analytic_month(response);  
        },  
    });
    
    function analytic_week(days) {
        var barChart = Morris.Bar({
            element: 'statistic_visitor_bar',
            data: JSON.parse(days),
            xkey: 'y',
            ykeys: ['a', 'b', 'c' ],
            labels: ['VIP', 'Member', 'Reguler' ],
            barColors:['#fec107', '#32FFC1', '#21E1E1'],
            hideHover: 'auto',
            gridLineColor: '#878787',
            resize: true,
            barGap: 4,
            gridTextColor:'#878787',
            barSize: 30,
        });
    
        barChart.options.labels.forEach(function(label, i) {
            var legendItem = $('<span class="legend-item"></span>').text( label).prepend('<span class="legend-color">&nbsp;</span>');
            legendItem.find('span').css('backgroundColor', barChart.options.barColors[i]);
            $('#visitor_month').append(legendItem)
        });
    }

    function analytic_month(month) {
        var barLine = Morris.Line({
            element: "statistic_visitor_line",
            data: JSON.parse(month),
            xkey: "period", 
            ykeys: ["VIP", "Member","Reguler"],
            labels: ["VIP", "Member", "Reguler"],
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
            parseTime: false,
        });
    
        barLine.options.labels.forEach(function(label, i) {
            var legendItem = $('<span class="legend-item"></span>').text( label).prepend('<span class="legend-color">&nbsp;</span>');
            legendItem.find('span').css('backgroundColor', barLine.options.lineColors[i]);
            $('#visitor_week').append(legendItem)
        });

        var stackedBar = Morris.Bar({
            element: "bar-chart",
            data: JSON.parse(month),
            xkey: 'period',
            ykeys: ['pertamina', 'pensiunan' , 'forkopimda', 'perpesi', 'Umum'],
            labels: ['Pertamina', 'Pensiunan', 'Forkopimda', 'Perpesi', 'Umum'],
            fillOpacity: 0.6,
            hideHover: 'auto',
            stacked: true,
            resize: true,
            pointFillColors:['#ffffff'],
            pointStrokeColors: ['black'],
            barColors:['#e60049','#9b19f5','#ffa300','#dc0ab4','#00b7c7'],
            barSize: 30,
        });
    
        stackedBar.options.labels.forEach(function(label, i) {
            var legendItem = $('<span class="legend-item"></span>').text( label).prepend('<span class="legend-color">&nbsp;</span>');
            legendItem.find('span').css('backgroundColor', stackedBar.options.barColors[i]);
            $('#visitor_legend').append(legendItem)
        });
    }


});