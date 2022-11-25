$('[data-toggle="tooltip"]').tooltip();

const checkout = (url, title) => {
    popupCenter(url, title, 1000, 700);
}

const popupCenter = (url, title, w, h) => {
    const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : window.screenX;
    const dualScreenTop = window.screenTop !== undefined ? window.screenTop : window.screenY;

    const width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    const systemZoom = width / window.screen.availWidth;
    const left = (width - w) / 2 / systemZoom + dualScreenLeft
    const top = (height - h) / 2 / systemZoom + dualScreenTop
    const newWindow = window.open(url, title, `scrollbars=yes,width  = ${w / systemZoom}, height = ${h / systemZoom}, top    = ${top}, left   = ${left}`);
    if (window.focus) newWindow.focus();
}

const loading = () => {
    $.blockUI({
        css: {
            backgroundColor: 'transparent',
            border: 'none'
        },
        message: '<img src="../img/rolling.svg">',
        baseZ: 1500,
        overlayCSS: {
            backgroundColor: '#7C7C7C',
            opacity: 0.4,
            cursor: 'wait'
        }
    });
}

let format = (num) => {
    let str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
    if(str.indexOf(".") > 0) {
        parts = str.split(".");
        str = parts[0];
    }
    str = str.split("").reverse();
    for(let j = 0, len = str.length; j < len; j++) {
        if(str[j] != ",") {
        output.push(str[j]);
        if(i%3 == 0 && j < (len - 1)) {
            output.push(".");
        }
        i++;
        }
    }
    formatted = output.reverse().join("");
    return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
};

let addCart = (id) => {
    $.ajax({
        async: true,
        type: 'POST',
        url: '/cart_add/reguler',
        data: {id: id},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        success: function(response) {
            $.unblockUI();
            if (response.status == "INVALID") {
                sword();
                swal({
                    title: "",
                    type: "error",
                    text: response.message,
                    confirmButtonColor: "#01c853",
                });
                return false;
            } else {
                beep();
            }
            location.reload();
        },
        error: function (error){
            sword();
            swal({
                title: "Internal Server Error",
                type: "error",
                text: error,
                confirmButtonColor: "#01c853",
            });
            return false;
        }
    });
}

let updateQTY = (id, type) => {
    let $n = $(".qty-" + id);
    if (type === 'plus') {
        $n.val(Number($n.val()) + 1);
        $.toast({
            text: 'Item bertambah ' + $n.val(),
            position: 'top-right',
            loaderBg: '#fec107',
            icon: 'success',
            hideAfter: 700,
            stack: 6
        });
    } else {
        if ($n.val() == 0) {
            $('.disabled-cart-' + id).css('background', 'tomato');
            $('.disabled-cart-' + id).fadeOut(800, function() {
                $(this).remove();
            });
        } else {
            $n.val(Number($n.val()) - 1);
            $.toast({
                text: 'Item berkurang ' + $n.val(),
                position: 'top-right',
                loaderBg: '#fec107',
                icon: 'success',
                hideAfter: 700,
                stack: 6
            });
        }
    }
    click();
    $.ajax({
        async: true,
        type: 'POST',
        url: 'reguler_update/qty',
        data: {
            id: id,
            type: type
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        success: function(response) {
            $('.price-' + response.id).text('Rp. ' + format(response.qty * response.price));
            $("#total-pay").text('Rp. ' + format(response.total));
            $('.counted').text(response.counted);
            if ($n.val() == 0) {
                $('.disabled-cart-' + response.id).remove();
            }
            if (response.cart.length != 0) {
                $('#qty').text(response.cart.length);
            } else {
                $('#isi-').append(`<span class="not-found text-muted">Keranjang masih kosong</span>`)
                    .addClass('d-flex justify-content-center align-items-center');
                $('.active-checkout').remove();
                $('#disabled-checkout').html(`<button type="submit" class="mt-15 mb-15 btn-xs btn-block btn btn-success btn-anim"
                                                    id="disabled-pay">
                                                    <i class="icon-rocket"></i>
                                                    <span class="btn-text">Checkout</span>
                                                </button>`);
                $('#qty').text('0');
            }
        },
        error: function (error){
            sword();
            swal({
                title: "Internal Server Error",
                type: "error",
                text: error,
                confirmButtonColor: "#01c853",
            });
            return false;
        }
    });
}

let removeItem = (id) => {
    $('.disabled-cart-' + id).css('background', 'tomato');
    $('.disabled-cart-' + id).fadeOut(800, function() {
        $(this).remove();
    });
    dlt();
    $.ajax({
        async: true,
        type: 'POST',
        url: '/cart_remove/reguler',
        data: {id: id},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        success: function(response) {
            $.unblockUI();
            $("#total-pay").text('Rp. ' + format(response.total));
            $('.counted').text(response.counted);
            var qty = $('#qty').text();
            $('#qty').text(qty - 1);
            if (response.cart == 1) {
                $('#isi-').html(`<span class="not-found text-muted">Keranjang masih kosong</span>`)
                    .addClass('d-flex justify-content-center align-items-center');
                $('.active-checkout').remove();
                $('#disabled-checkout').html(`<button type="submit" class="mt-15 mb-15 btn-xs btn-block btn btn-success btn-anim"
                                    id="disabled-pay">
                                    <i class="icon-rocket"></i>
                                    <span class="btn-text">Checkout</span>
                                </button>`);
            }
        },
        error: function (error){
            sword();
            swal({
                title: "Internal Server Error",
                type: "error",
                text: error,
                confirmButtonColor: "#01c853",
            });
            return false;
        }
    });
}

let interval = setInterval(function() {
    let momentNow = moment().locale('fr');
    $('#time-part').html(momentNow.format('hh:mm:ss A'));
}, 100);

$(document).on('click', '#reset-order-reguler', function() {
    let tg = window.location.href;
    tg = tg.split("?")
    tg = tg[0];
    tg = tg.split("/");
    id = tg[tg.length - 1];
    swal({
        title: "Anda yakin ingin reset keranjang?",
        imageUrl: "../img/Warning.svg",
        showCancelButton: true,
        confirmButtonColor: "#FF2A00",
        confirmButtonText: "Hapus order",
        cancelButtonText: "Batal",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function(isConfirm) {
        if (isConfirm) {
            $.ajax({
                async: true,
                type: 'POST',
                url: '/cart_reguler/clear',
                data: {
                    id: id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function(request) {
                    loading();
                },
                success: function(data) {
                    rst();
                    swal({
                        title: "",
                        type: "success",
                        text: "Keranjang berhasil direset",
                        confirmButtonColor: "#01c853",
                    }, function(isConfirm) {
                        $.unblockUI();
                        location.reload();
                    });
                },
                error: function (error){
                    sword();
                    swal({
                        title: "Internal Server Error",
                        type: "error",
                        text: error,
                        confirmButtonColor: "#01c853",
                    });
                    return false;
                }
            })
        } else {
            swal("Dibatalkan", "", "error");
        }
    });
    return false;
});

$(document).on('click', '#checkout', function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        async: true,
        type: 'GET',
        url: '/checkout_reguler',
        beforeSend: function(request) {
            loading();
        },
        success: function(response) {
            $.unblockUI();
            bell();
            swal({
                title: "",
                type: "success",
                text: "Order berhasil dibuat",
                confirmButtonColor: "#01c853",
            }, function(isConfirm) {
                window.location.href = '/checkout_reguler';
            });
        },
        error: function (error){
            sword();
            swal({
                title: "Internal Server Error",
                type: "error",
                text: error,
                confirmButtonColor: "#01c853",
            });
            return false;
        }
    });
});

$(document).on('click', '#disabled-pay', function() {
    sword();
    swal({
        title: "",
        type: "error",
        text: "Pilih item terlebih dahulu",
        confirmButtonColor: "#01c853",
    });
    return false;
});

const add = () => {
    const audio = new Audio('../sound/add.mp3');
    audio.play();
}

const beep = () => {
    const audio = new Audio('../sound/beep.mp3');
    audio.play();
}

const click = () => {
    const audio = new Audio('../sound/click.mp3');
    audio.play();
}

const dlt = () => {
    const audio = new Audio('../sound/remove.mp3');
    audio.play();
}

const rst = () => {
    const audio = new Audio('../sound/reset.mp3');
    audio.play();
}

const sword = () => {
    const audio = new Audio('../sound/sword.mp3');
    audio.play();
}

const bell = () => {
    const audio = new Audio('../sound/bell.mp3');
    audio.play();
}

$('#dt-package-reguler').DataTable({
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
        "url": "/proses_reguler",
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
        orderable: false,
        targets: [0, 1, 2, 3, 4]
    }],
    dom: "<'row mb-3'<'col-sm-12 col-md-8 pull-right'f><'toolbar col-sm-12 col-md-4 float-left'B>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    initComplete: function() {
        $('div.toolbar').html('<h6>Daftar Paket Harga</h6>').appendTo('.float-left');
    }
});