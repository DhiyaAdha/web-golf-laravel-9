$(document).on("change", "#filter-data", function(e) {
    // member.column($(this).data('column')).search($(this).val()).draw();
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
        $('#dt-tamu').DataTable().ajax.url("/daftar-tamu?"+EndUrl).load();
    } else {
        $('#dt-tamu').DataTable().ajax.url("/daftar-tamu").load();
    }
});

$(document).on("change", "#filter-deposit", function(e) {
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
        $('#dt-riwayat-deposit').DataTable().ajax.url("/historydeposit?"+EndUrl).load();
    } else {
        $('#dt-riwayat-deposit').DataTable().ajax.url("/historydeposit").load();
    }
});

/* data tamu */
let member = $('#dt-tamu').DataTable({
    "processing": true,
    "serverSide": true,
    "lengthChange": false,
    "bDestroy": true,
    "orderable": false,
    "searching": true,
    "paginate": {
        "first": "First",
        "last": "Last",
        "next": "Next",
        "previous": "Previous"
    },
    "ajax": {
        "url": "/daftar-tamu",
        "type": "GET",
        "datatype": "json"
    },
    "render": $.fn.dataTable.render.text(),
    "columns": [{
            data: 'name',
            orderable: false
        },
        {
            data: 'email',
            orderable: false
        },
        {
            "data": function(data) {
                if (data.tipe_member == 'VIP') {
                    return `<span class='label label-success'>${data.tipe_member == 'VIP' ? 'Member' : 'VIP'}</span>`;
                } else {
                    return `<span class='label label-warning'>${data.tipe_member == 'VVIP' ? 'VIP' : 'Member'}</span>`;
                }
            },
            orderable: false
        },
        {
            "data": function(data) {
                return data.status == 'active' ? 'Aktif' : 'Non Aktif'
            },
            orderable: false
        },
        {
            "data": function(data) {
                return data.expired_date;
            },
            orderable: false
        },
        {
            data: 'action',
            searchable: false,
            orderable: false
        },
    ],
    order: [],
    responsive: true,
    language: {
        search: "",
        searchPlaceholder: "Cari nama",
        emptyTable: "Tidak ada data",
        info: "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
        infoFiltered: "(difilter dari _MAX_ total data)",
        infoEmpty: "Tidak ada data",
        lengthMenu: "Menampilkan _MENU_ data",
        zeroRecords: "Tidak ada data pada tabel ini"
    },

    columnDefs: [{
            className: 'text-left',
            targets: [0, 1, 2, 3, 4,5]
        },
        {
            className: 'text-center',
            targets: [4]
        }, 
        {
            width: '25%',
            targets: [0,1, 5]
        }, 
        {
            width: '12%',
            targets: [2, 3, 4]
        }
    ]
});
/* data tamu */

/* delete tamu */
$(document).on('click', '.delete-confirm', function() {
    id = $(this).data('id');
    swal({
        title: "Anda yakin ingin menghapus tamu ini?",
        imageUrl: "../img/Warning.svg",
        showCancelButton: true,
        confirmButtonColor: "#FF2A00",
        confirmButtonText: "Hapus Tamu",
        cancelButtonText: "Batal",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function(isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: 'POST',
                url: '/daftar-tamu/destroy',
                data:{id:id},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: () => {
                    setTimeout(() => {
                        $('#confirmModal').modal('hide');
                        $('#dt-tamu').DataTable().ajax.reload(null, false);
                    });

                    window.setTimeout(() => {
                        $.toast({
                            text: 'Data berhasil dihapus',
                            position: 'top-right',
                            loaderBg: '#fec107',
                            icon: 'success',
                            hideAfter: 2000,
                            stack: 6
                        });
                    }, 1000);
                    swal("Terhapus!", "", "success");
                },
                error: () => {
                    sword();
                    swal({
                        title: "Internal Server Error",
                        type: "error",
                        text: "Terdapat kesalahan program pada action ini",
                        confirmButtonColor: "#01c853",
                    });
                    return false;
                }
            })
        } else {
            swal("Dibatalkan", "", "info");
        }
    });
    return false;
});
/* delete tamu */

let history_deposit = $("#dt-riwayat-deposit").DataTable({
    processing: true,
    serverSide: true,
    lengthChange: false,
    bDestroy: true,
    searching: false,
    paginate: {
        first: "First",
        last: "Last",
        next: "Next",
        previous: "Previous",
    },
    ajax: {
        url: "/historydeposit",
        type: "GET",
        datatype: "json",
    },
    render: $.fn.dataTable.render.text(),
    columns: [
        {
            data: "name",
            searchable: true,
            orderable: false,
        },
        {
            data: "report_balance",
            searchable: true,
            orderable: false,
        },
        {
            data: "fund",
            searchable: true,
            orderable: false,
        },
        {
            data: "payment_type",
            searchable: true,
            orderable: false,
        },
        {
            data: "created_at",
            searchable: true,
            orderable: false,
        },
    ],
    order: [],
    responsive: true,
    language: {
        emptyTable: "Tidak ada data pada tabel ini",
        info: "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
        infoFiltered: "(difilter dari _MAX_ total data)",
        infoEmpty: "Tidak ada data pada tabel ini",
        lengthMenu: "Menampilkan _MENU_ data",
        zeroRecords: "Tidak ada data pada tabel ini",
    },
    columnDefs: [
        {
            className: "text-left",
            targets: [0, 1],
        },
        {
            className: "text-center",
            targets: [2, 3, 4],
        },
        {
            width: '25%',
            targets: [0,4]
        },
    ],
});