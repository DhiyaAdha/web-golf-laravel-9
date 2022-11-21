var tg = window.location.href;
tg = tg.split("?");
tg = tg[0];
tg = tg.split("/");
member = tg[tg.length - 1];

$(".modal-detail-invoice").on("show.bs.modal", function (e) {
    var id = $(e.relatedTarget).data("id");

    $.ajax({
        async: true,
        type: "GET",
        url: "/detail-invoice-member/" + id,
        data: {
            id: id,
        },
        dataType: "json",
        success: function (data) {
            $(".products").html("");
            $("#myLargeModalLabel").text("ORDER ID : " + data.order_number);
            $("#name_visitor").text(data.name);
            $("#method_payment").text(data.pay);
            $("#date").text(data.date);
            $("#type_tamu")
                .addClass(
                    data.type_member == "VIP"
                        ? "label label-success"
                        : "label label-warning"
                )
                .text(data.type_member == "VIP" ? "member" : "VIP");
            $("#visitor_email").text(data.visitor_email);
            $("#visitor_phone").text(data.visitor_phone);
            $("#amount_item").text(data.amount_item);
            $("#amount_order").text(data.amount_order);
            $("#discount").text(data.discount);
            $("#total_payment").text(data.total_payment);
            $("#total_bill").text(data.total_bill);
            $.each(data.products, function (b, val) {
                $(".products")
                    .append(
                        `<tr>
                        <td>${val.name}</td>    
                        <td class="text-right">${val.pricesingle}</td>    
                        <td class="text-right">${val.qty}</td>    
                        <td class="text-right">${val.price}</td>    
                    </tr>`
                    )
                    .one();
            });
        },
    });
});

$(".download-kartu-tamu").on("click", function () {
    $(".resolution").printThis({
        importCSS: true,
        importStylse: true,
        loadCSS: "dist/css/custom.css",
        base: "https://jasonday.github.io/printThis/",
        header: "<h6>Kartu Member</h6>",
    });
});

$("#dt-tamu-transaksi").DataTable({
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
        url: "/reporttransaksi/" + member,
        type: "GET",
        datatype: "json",
    },
    render: $.fn.dataTable.render.text(),
    columns: [
        {
            data: function (data) {
                return `<div data-toggle="tooltip" title="Lihat invoice"><a href="javascript:void(0)" data-id="${data.id}" data-toggle="modal" data-target=".modal-detail-invoice">${data.order_number}</a></div>`;
            },
        },
        {
            data: "information",
            searchable: true,
            orderable: false,
        },
        {
            data: "total_gross",
            searchable: true,
            orderable: false,
        },
        {
            data: "status",
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
            targets: [0],
        },
        {
            className: "text-center",
            targets: [2, 3, 4],
        },
        {
            width: "20%",
            targets: [0],
        },
        {
            width: "30%",
            targets: [1],
        },
        {
            width: "10%",
            targets: [2, 4],
        },
        {
            width: "7%",
            targets: [3],
        },
        {
            orderable: false,
            targets: [0],
        },
    ],
});

$("#dt-tamu-deposit").DataTable({
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
        url: "/reportdeposit/" + member,
        type: "GET",
        datatype: "json",
    },
    render: $.fn.dataTable.render.text(),
    columns: [
        {
            data: "report_balance",
            searchable: true,
            orderable: false,
        },
        {
            data: "transaction",
            searchable: true,
            orderable: false,
        },
        {
            data: "payment_type",
            searchable: true,
            orderable: false,
        },
        {
            data: "status",
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
    ],
});

$("#dt-tamu-limit").DataTable({
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
        url: "/reportlimit/" + member,
        type: "GET",
        datatype: "json",
    },
    render: $.fn.dataTable.render.text(),
    columns: [
        {
            data: "limit",
            searchable: true,
            orderable: false,
        },
        {
            data: "Informasi",
            searchable: true,
            orderable: false,
        },
        {
            data: "status",
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
            targets: [0],
        },
        {
            className: "text-center",
            targets: [2, 3],
        },
    ],
});

$("#dt-tamu-kupon").DataTable({
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
        url: "/reportkupon/" + member,
        type: "GET",
        datatype: "json",
    },
    render: $.fn.dataTable.render.text(),
    columns: [
        {
            data: "kupon",
            searchable: true,
            orderable: false,
        },
        {
            data: "Informasi",
            searchable: true,
            orderable: false,
        },
        {
            data: "status",
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
            targets: [0],
        },
        {
            className: "text-center",
            targets: [2, 3],
        },
    ],
});
