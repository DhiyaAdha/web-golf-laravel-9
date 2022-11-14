/* data package */
$('#dt-package').DataTable({
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
        "url": "/package",
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
                if (data.category == 'default') {
                    return `<span class="label label-permainan">${data.category == 'default' ? 'Permainan' : 'Proshop & Fasilitas'}</span>`;
                } else if (data.category == 'additional') {
                    return `<span class="label label-fasilitas">${data.category == 'additional' ? 'Proshop & Fasilitas' : 'Permainan'}</span>`;
                } else {
                    return `<span class="label label-kantin">${data.category == 'others' ? 'Kantin' : 'Permainan'}</span>`;
                }
            }
        },
        {
            "data": function(data) {
                return `<p>${data.price_weekdays}</p>`;
            }
        },
        {
            "data": function(data) {
                return `<p>${data.price_weekend}</p>`;
            }
        },
        {
            "data": function(data) {
                if (data.status == 0) {
                    return `<div class="checkbox checkbox-success checkbox-circle">
                            <input id="checkbox-10" type="checkbox" checked="" disabled>
                            <label for="checkbox-10" data-toggle="tooltip" data-placement="top" title="ON"></label>
                        </div>`;
                } else {
                    return `<div class="checkbox checkbox-danger checkbox-circle">
                            <input id="checkbox-12" type="checkbox" checked="" disabled>
                            <label for="checkbox-12" data-toggle="tooltip" data-placement="top" title="OFF"></label>
                        </div>`;
                }
            }
        },
        {
            "data": "action"
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
    columnDefs: [{
        orderable: false,
        targets: [0, 1, 2, 3, 4, 5, ]
    }],
});
/* data package */

/* delete package */
$(document).on('click', '.delete', function() {
    id = $(this).data('id');
    swal({
        title: "Anda yakin ingin menghapus paket ini?",
        imageUrl: "../img/Warning.svg",
        showCancelButton: true,
        confirmButtonColor: "#FF2A00",
        confirmButtonText: "Hapus paket",
        cancelButtonText: "Batal",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function(isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: 'POST',
                url: '/package/destroy',
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
                        $('#dt-package').DataTable().ajax.reload(null, false);
                    });

                    window.setTimeout(function() {
                        $.toast({
                            text: 'Product berhasil dihapus permanen',
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
            swal("Dibatalkan", "Paket Tidak Dihapus", "error");
        }
    });
    return false;
});
/* delete package */