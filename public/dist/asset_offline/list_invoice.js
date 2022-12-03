/* daftar invoice */
$('#dt-riwayat').dataTable({
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
        "url": "/riwayat-invoice",
        "type": "GET",
        "datatype": "json"
    },
    "render": $.fn.dataTable.render.text(),
    "columns": [{
            data: 'name'
        },
        {
            "data": function(data) {
                if (data.tipe_member == 'VIP') {
                    return `<span class='label label-success'>${data.tipe_member == 'VIP' ? 'MEMBER' : 'VVIP'}</span>`;
                } else if (data.tipe_member == 'VVIP') {
                    return `<span class='label label-warning'>${data.tipe_member == 'VVIP' ? 'VIP' : 'MEMBER'}</span>`;
                } else {
                    return `<span class='label label-primary'>${data.tipe_member}</span>`;
                }
            }
        },
        {
            data: 'payment_type'
        },
        {
            data: 'total'
        },
        {
            data: 'created_at'
        },
        {
            data: 'action'
        },
    ],
    order: [
        [5, 'desc']
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
    columnDefs: [
        { className: 'text-center', targets: [1, 2, 3, 4]}, 
        { orderable: false, targets: [0, 1, 2, 3, 4]},
        { width: '15%', targets: [0]}
    ],
});
/* daftar invoice */