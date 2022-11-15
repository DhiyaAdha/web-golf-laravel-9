/* daftar admin */
$('#dt-admin').DataTable({
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
        "url": "/daftar-admin",
        "type": "GET",
        "datatype": "json"
    },

    "render": $.fn.dataTable.render.text(),
    "columns": [{
            data: 'name',
            searchable: true,
            orderable: false
        },
        {
            data: 'email',
            searchable: true,
            orderable: false
        },
        {
            data: 'phone',
            searchable: true,
            orderable: false
        },
        {
            data: 'role',
            searchable: true,
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
        emptyTable: "Tidak ada data pada tabel ini",
        info: "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
        infoFiltered: "(difilter dari _MAX_ total data)",
        infoEmpty: "Tidak ada data pada tabel ini",
        lengthMenu: "Menampilkan _MENU_ data",
        zeroRecords: "Tidak ada data pada tabel ini"
    },
    columnDefs: [{
        className: 'text-left',
        targets: [0, 1, 2, 3]
    }, {
        width: '25%',
        targets: [0, 1]
    }, {
        width: '20%',
        targets: [2, 3]
    }], 
});
/* daftar admin */

/* delete admin */
$(document).on('click', '.delete-admin', function() {
    id = $(this).data('id');
    console.log(id)
    swal({
        title: "Anda yakin ingin menghapus admin ini?",
        imageUrl: "../img/Warning.svg",
        showCancelButton: true,
        confirmButtonColor: "#FF2A00",
        confirmButtonText: "Hapus admin",
        cancelButtonText: "Batal",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function(isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: 'POST',
                url: '/daftar-admin/destroy',
                data:{id:id},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('#ok_button').text('Hapus Data');
                },
                success: function(data) {
                    setTimeout(function() {
                        $('#confirmModal').modal('hide');
                        $('#dt-admin').DataTable().ajax.reload(null, false);
                        $('#dt-aktifitas').DataTable().ajax.reload(null, false);
                    });

                    window.setTimeout(function() {
                        $.toast({
                            text: 'Data admin berhasil dihapus',
                            position: 'top-right',
                            loaderBg: '#fec107',
                            icon: 'success',
                            hideAfter: 2000,
                            stack: 6
                        });
                    }, 1000);
                    swal("Terhapus!", "", "success");
                }
            })
        } else {
            swal("Dibatalkan", "", "error");
        }
    });
    return false;
});
/* delete admin */

/* data aktifitas */
$('#dt-aktifitas').DataTable({
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
        "url": "/aktifitas",
        "type": "GET",
        "datatype": "json"
    },
    "render": $.fn.dataTable.render.text(),
    "columns": [{
            data: 'role',
            searchable: true,
            orderable: false
        },
        {
            data: 'user_name',
            searchable: true,
            orderable: false
        },
        {
            data: 'information',
            searchable: true,
            orderable: false
        },
        {
            data: 'status_action',
            searchable: true,
            orderable: false
        },
        {
            data: 'date_activity',
            searchable: true,
            orderable: false
        }
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
    columnDefs: [{
        className: 'text-left',
        targets: [1, 2, 3, 4]
    }],
    dom: "<'row mb-3'<'col-sm-12 col-md-8 pull-right'f><'toolbar col-sm-12 col-md-4 float-left'B>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    initComplete: function() {
        $('div.toolbar').html('<b>Riwayat Aktifitas</b>').appendTo('.float-left');
    }
});
/* data aktifitas */