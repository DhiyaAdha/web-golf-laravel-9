var tg = window.location.href;
tg = tg.split("?");
tg = tg[0];
tg = tg.split("/");
member = tg[tg.length - 1];

let invoice = (id) => {
    return new Promise((resolve, reject) => {
        $.ajax({
            async: true,
            type: "GET",
            url: "/detail-invoice-member/" + id,
            data: {
                id: id,
            },
            dataType: "json",
            success: (data) => {
                resolve(data);
            },
            error: (error) => {
                reject(error);
            }
        });
    });
}

$(".modal-detail-invoice").on("show.bs.modal", function (e) {
    let id = $(e.relatedTarget).data("id");
    let detail_invoice = invoice(id);

    detail_invoice.finally(() => {
        console.log('Tunggu proses selesai');
    }).then((data) => {
        $(".products").html("");
        $("#myLargeModalLabel").text("ORDER ID : " + data.order_number);
        $("#name_visitor").text(data.name);
        $("#method_payment").text(data.pay);
        $("#date").text(data.date);
        $("#type_tamu").addClass(
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
            $(".products").append(
                    `<tr>
                    <td>${val.name}</td>    
                    <td class="text-right">${val.pricesingle}</td>    
                    <td class="text-right">${val.qty}</td>    
                    <td class="text-right">${val.price}</td>    
                </tr>`
                ).one();
        });
    }).catch((error) => {
        console.log(error);
    });
});

function screenshot(first){
    html2canvas(document.getElementById("front-content")).then(function(canvas){
        downloadImage(canvas.toDataURL(), first + '-front.jpg');
    });
    html2canvas(document.getElementById("back-content")).then(function(canvas){
        downloadImage(canvas.toDataURL(), first + '-back.jpg');
    });
}

function downloadImage(uri, filename){
    var link = document.createElement('a');
    if(typeof link.download !== 'string'){
        window.open(uri);
    }else{
        link.href = uri;
        link.download = filename;
        accountForFirefox(clickLink, link);
    }
}

function clickLink(link){
    link.click();
}

function accountForFirefox(click){
    var link = arguments[1];
    document.body.appendChild(link);
    click(link);
    document.body.removeChild(link);
}

$(".download-kartu-tamu").on("click", function () {
    $('#kartu-tamu').modal('hide');
    const fullName = $(this).data('name');
    const [first, last] = fullName.split(' ');
    screenshot(first);
    
    // $(".resolution").modal('hide').printThis({
    //     importCSS: true,
    //     importStylse: true,
    //     loadCSS: "dist/css/custom.css",
    //     header: "<h6>Kartu Member</h6>",
    // });


    // html2canvas($('.front-content')[0], {
    //     logging: true,
    //     profile: true,
    //     useCORS: true,
    //     width: 1200,
    //     height: 1200
    // }).then(function(canvas) {
    //     let a = document.createElement('a');
    //     a.href = canvas.toDataURL("image/jpeg", 1);
    //     a.download =  first + '-front.jpg';
    //     a.target = '_blank';
    //     a.click();
    // });

    // html2canvas($('.back-content')[0], {
    //     logging: true,
    //     profile: true,
    //     useCORS: true,
    //     width: 1200,
    //     height: 1200
    // }).then(function(canvas) {
    //     let a = document.createElement('a');
    //     a.href = canvas.toDataURL("image/png", 1);
    //     a.download = first + '-back.png';
    //     a.target = '_blank';
    //     a.click();
    // });
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
                return `<a href="javascript:void(0)" data-id="${data.id}" title="Klik untuk Cetak" data-toggle="modal" data-target=".modal-detail-invoice">${data.order_number}</a>`;
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
