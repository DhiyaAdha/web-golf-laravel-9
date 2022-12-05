$(document).on("change", "#filter-all", function(e) {
    let filter_data = [];
    let option = $(this).find(':selected');
    let url = window.location.href;

    $.each(option, function(index, value) {
        filter_data.push(option.val());
    });

    let param = filter_data.join(","); 
    if(param != "") {
        if (url.indexOf('?') > -1) {
            url += '&filter='+param
        } else {
            url += '?filter='+param
        }
    }

    let EndUrl = url.split("?")[1];
    if(EndUrl != "") {
        $('#dt-report-all').DataTable().ajax.url("/laporan/semua?"+EndUrl).load();
    } else {
        $('#dt-report-all').DataTable().ajax.url("/laporan/semua").load();
    }
});

$(document).on("change", "#filter-games", function(e) {
    let filter_data = [];
    let option = $(this).find(':selected');
    let url = window.location.href;

    $.each(option, function(index, value) {
        filter_data.push(option.val());
    });

    let param = filter_data.join(","); 
    if(param != "") {
        if (url.indexOf('?') > -1) {
            url += '&filter='+param
        } else {
            url += '?filter='+param
        }
    }

    let EndUrl = url.split("?")[1];
    if(EndUrl != "") {
        $('#dt-report-games').DataTable().ajax.url("/laporan/permainan?"+EndUrl).load();
    } else {
        $('#dt-report-games').DataTable().ajax.url("/laporan/permainan").load();
    }
});

$(document).on("change", "#filter-proshop", function(e) {
    let filter_data = [];
    let option = $(this).find(':selected');
    let url = window.location.href;

    $.each(option, function(index, value) {
        filter_data.push(option.val());
    });

    let param = filter_data.join(","); 
    if(param != "") {
        if (url.indexOf('?') > -1) {
            url += '&filter='+param
        } else {
            url += '?filter='+param
        }
    }

    let EndUrl = url.split("?")[1];
    if(EndUrl != "") {
        $('#dt-report-proshop').DataTable().ajax.url("/laporan/fasilitas?"+EndUrl).load();
    } else {
        $('#dt-report-proshop').DataTable().ajax.url("/laporan/fasilitas").load();
    }
});

$(document).on("change", "#filter-canteen", function(e) {
    let filter_data = [];
    let option = $(this).find(':selected');
    let url = window.location.href;

    $.each(option, function(index, value) {
        filter_data.push(option.val());
    });

    let param = filter_data.join(","); 
    if(param != "") {
        if (url.indexOf('?') > -1) {
            url += '&filter='+param
        } else {
            url += '?filter='+param
        }
    }

    let EndUrl = url.split("?")[1];
    if(EndUrl != "") {
        $('#dt-report-canteen').DataTable().ajax.url("/laporan/kantin?"+EndUrl).load();
    } else {
        $('#dt-report-canteen').DataTable().ajax.url("/laporan/kantin").load();
    }
});

/* data report all */
$('#dt-report-all').DataTable({
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
        "url": "/laporan/semua",
        "type": "GET",
        "datatype": "json"
    },
    "render": $.fn.dataTable.render.text(),
    "columns": [
        {
            data: 'name',
            searchable: true,
            orderable:false
        },
        {
            data: 'qty',
            searchable: true,
            orderable:false
        },
        {
            data: 'pricesingle',
            searchable: true,
            orderable:false
        },
        {
            data: 'price',
            searchable: true,
            orderable:false
        },
        {
            data: 'created_at',
            searchable: true,
            orderable:false
        },
    ],
    order: [],
    responsive: true,
    language: {
        search: "",
        searchPlaceholder: "Cari Nama",
        emptyTable: "Tidak ada data pada tabel ini",
        info: "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
        infoFiltered: "(difilter dari _MAX_ total data)",
        infoEmpty: "Tidak ada data pada tabel ini",
        lengthMenu: "Menampilkan _MENU_ data",
        zeroRecords: "Tidak ada data pada tabel ini"
    },
    columnDefs: [
        {
            orderable: false,
            targets: [0, 1, 2, 3]
        },
        {
            width: '25%',
            targets: [0]
        }, 
        {
            width: '20%',
            targets: [2,3]
        }, 
        {
            width: '15%',
            targets: [4]
        }, 
        {
            width: '10%',
            targets: [1]
        }, 
    ],
});
/* data report all */

/* data report games */
$('#dt-report-games').DataTable({
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
        "url": "/laporan/permainan",
        "type": "GET",
        "datatype": "json"
    },
    "render": $.fn.dataTable.render.text(),
    "columns": [
        {
            data: 'name',
            searchable: true,
            orderable:false
        },
        {
            data: 'qty',
            searchable: true,
            orderable:false
        },
        {
            data: 'pricesingle',
            searchable: true,
            orderable:false
        },
        {
            data: 'price',
            searchable: true,
            orderable:false
        },
        {
            data: 'created_at',
            searchable: true,
            orderable:false
        },
    ],
    order: [],
    responsive: true,
    language: {
        search: "",
        searchPlaceholder: "Cari Nama",
        emptyTable: "Tidak ada data pada tabel ini",
        info: "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
        infoFiltered: "(difilter dari _MAX_ total data)",
        infoEmpty: "Tidak ada data pada tabel ini",
        lengthMenu: "Menampilkan _MENU_ data",
        zeroRecords: "Tidak ada data pada tabel ini"
    },
    columnDefs: [
        {
            orderable: false,
            targets: [0, 1, 2, 3]
        },
        {
            width: '25%',
            targets: [0]
        }, 
        {
            width: '20%',
            targets: [2,3]
        }, 
        {
            width: '15%',
            targets: [4]
        }, 
        {
            width: '10%',
            targets: [1]
        }, 
    ],
});
/* data report games */

/* data report proshop */
$('#dt-report-proshop').DataTable({
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
        "url": "/laporan/fasilitas",
        "type": "GET",
        "datatype": "json"
    },
    "render": $.fn.dataTable.render.text(),
    "columns": [
        {
            data: 'name',
            searchable: true,
            orderable:false
        },
        {
            data: 'qty',
            searchable: true,
            orderable:false
        },
        {
            data: 'pricesingle',
            searchable: true,
            orderable:false
        },
        {
            data: 'price',
            searchable: true,
            orderable:false
        },
        {
            data: 'created_at',
            searchable: true,
            orderable:false
        },
    ],
    order: [],
    responsive: true,
    language: {
        search: "",
        searchPlaceholder: "Cari Nama",
        emptyTable: "Tidak ada data pada tabel ini",
        info: "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
        infoFiltered: "(difilter dari _MAX_ total data)",
        infoEmpty: "Tidak ada data pada tabel ini",
        lengthMenu: "Menampilkan _MENU_ data",
        zeroRecords: "Tidak ada data pada tabel ini"
    },
    columnDefs: [
        {
            orderable: false,
            targets: [0, 1, 2, 3]
        },
        {
            width: '25%',
            targets: [0]
        }, 
        {
            width: '20%',
            targets: [2,3]
        }, 
        {
            width: '15%',
            targets: [4]
        }, 
        {
            width: '10%',
            targets: [1]
        }, 
    ],
});
/* data report proshop */

/* data report kantin */
$('#dt-report-canteen').DataTable({
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
        "url": "/laporan/kantin",
        "type": "GET",
        "datatype": "json"
    },
    "render": $.fn.dataTable.render.text(),
    "columns": [
        {
            data: 'name',
            searchable: true,
            orderable:false
        },
        {
            data: 'qty',
            searchable: true,
            orderable:false
        },
        {
            data: 'pricesingle',
            searchable: true,
            orderable:false
        },
        {
            data: 'price',
            searchable: true,
            orderable:false
        },
        {
            data: 'created_at',
            searchable: true,
            orderable:false
        },
    ],
    order: [],
    responsive: true,
    language: {
        search: "",
        searchPlaceholder: "Cari Nama",
        emptyTable: "Tidak ada data pada tabel ini",
        info: "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
        infoFiltered: "(difilter dari _MAX_ total data)",
        infoEmpty: "Tidak ada data pada tabel ini",
        lengthMenu: "Menampilkan _MENU_ data",
        zeroRecords: "Tidak ada data pada tabel ini"
    },
    columnDefs: [
        {
            orderable: false,
            targets: [0, 1, 2, 3]
        },
        {
            width: '25%',
            targets: [0]
        }, 
        {
            width: '20%',
            targets: [2,3]
        }, 
        {
            width: '15%',
            targets: [4]
        }, 
        {
            width: '10%',
            targets: [1]
        }, 
    ],
});
/* data report kantin */