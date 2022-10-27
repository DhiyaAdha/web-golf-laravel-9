@extends('layouts.main', ['title' => 'TGCC | Pilih Permainan'])
@section('content')
    <!-- Main Content -->
    <div class="page-wrapper">
        <div class="container-fluid">
            <!-- Title -->
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Pilih Permainan</h5>
                </div>
                <!-- Breadcrumb -->
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('analisis-tamu') }}">Dashboard</a></li>
                        <li><a href="{{ url('proses_reguler') }}">Reguler</a></li>
                        <li class="active"><span>Pilih Permainan</span></li>
                    </ol>
                </div>
                <!-- /Breadcrumb -->
            </div>
            <!-- /Title -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <strong class="panel-title txt-dark">Jenis Permainan</strong>
                            </div>
                            <div class="pull-right">
                                <div class='d-flex '>
                                    <span class="text-muted mr-15" style="float: right;">{{ $date_now }},
                                    </span>
                                    <span class="label label-default" id='time-part' style="float: right;"></span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="d-flex flex-wrap">
                            @foreach ($default as $item)
                                <button type="button" id="package-{{ $item->id }}"
                                    onclick="addCart({{ $item->id }})" data-toggle="tooltip"
                                    title="Rp. {{ number_format($today === 'Sabtu' || $today === 'Minggu' ? $item->price_weekend : $item->price_weekdays, 0, ',', '.') }}"
                                    class="btn btn-default txt-success mr-15 mb-15">{{ $item->name }}</button>
                            @endforeach
                        </div>
                        <div class="panel-heading">
                            <div class="pull-left">
                                <strong class="panel-title txt-dark">Fasilitas</strong>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="d-flex flex-wrap">
                            @foreach ($additional as $item)
                                <button type="button" id="package-{{ $item->id }}"
                                    onclick="addCart({{ $item->id }})" data-toggle="tooltip"
                                    title="Rp. {{ number_format($today === 'Sabtu' || $today === 'Minggu' ? $item->price_weekend : $item->price_weekdays, 0, ',', '.') }}"
                                    class="btn btn-default txt-success mr-15 mb-15 package-{{ $item->id }}">{{ $item->name }}</button>
                            @endforeach
                        </div>
                        <div class="panel-heading">
                            <div class="pull-left">
                                <strong class="panel-title txt-dark">Lainnya</strong>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="d-flex flex-wrap mb-15">
                            @foreach ($others as $item)
                                <button type="button" id="package-{{ $item->id }}"
                                    onclick="addCart({{ $item->id }})" data-toggle="tooltip"
                                    title="Rp. {{ number_format($today === 'Sabtu' || $today === 'Minggu' ? $item->price_weekend : $item->price_weekdays, 0, ',', '.') }}"
                                    class="btn btn-default txt-success mr-15 mb-15 package-{{ $item->id }}">{{ $item->name }}</button>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 sticky">
                    <div class="panel panel-default border-panel card-view">
                        <div class="panel-heading">
                            <div class="d-flex">
                                <h6 class="panel-title flex-grow-1" style="font-weight: 600">Daftar Order</h6>
                                <a href="javascript:void(0)" style="position: relative">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span class="top-nav-icon-badge" style="position: absolute"
                                        id="qty">{{ count($cart_data) }}</span>
                                </a>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="panel-heading"
                            style="background-color: #d9edf7;padding: 8px 15px;border-bottom: none !important;">
                            <div class="pull-left">
                                <p class="text-muted">Produk</p>
                            </div>
                            <div class="pull-right">
                                <p class="text-muted">Sub total</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        @if (count($cart_data) > 0)
                            <div style="overflow-y: scroll;height: 270px;" id="isi-">
                                @foreach ($cart_data as $index => $item)
                                    <div class="d-flex pl disabled-cart-{{ $item['rowId'] }}"
                                        style="padding: 10px 0px 10px 0px;">
                                        <p class="flex-grow-1 text-muted mr-5">{{ Str::words($item['name'], 3) }}
                                        </p>
                                        <p class="text-muted price-{{ $item['rowId'] }}">
                                            Rp.{{ number_format($item['price'], 0, ',', '.') }}</p>
                                        <button onclick="updateQTY({{ $item['rowId'] }}, 'minus')"><i
                                                class="cart-qty-minus-{{ $item['rowId'] }} fa fa-minus-square"></i></button>
                                        <input type="number" min="1" class="qty-{{ $item['rowId'] }}"
                                            value="{{ $item['qty'] }}" style="width: 30px;" readonly />
                                        <button onclick="updateQTY({{ $item['rowId'] }}, 'plus')"><i
                                                class="cart-qty-plus-{{ $item['rowId'] }} fa fa-plus-square"></i></button>
                                        <button class="mr-10 ml-10" data-toggle="tooltip" title="Hapus"
                                            onclick="removeItem({{ $item['rowId'] }})" id="remove-item"
                                            style="color:red;"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div id="disabled-empty" style="height: 270px;"
                                class="d-flex justify-content-center align-items-center">
                                <span class="not-found text-muted">Keranjang masih kosong</span>
                            </div>
                        @endif
                        <div id="total"></div>
                        <div id="append-checkout"></div>
                        @if (count($cart_data) > 0)
                            <div class="d-flex">
                                <strong class="flex-grow-1 txt-dark">Total</strong>
                                <strong class="txt-dark" id="total-pay">Rp.
                                    {{ number_format($data_total['total'], 0, ',', '.') }}</strong>
                            </div>
                            <div id="disabled-checkout"></div>
                            <div class="d-flex justify-content-between active-checkout">
                                <a href="javascript:void(0)" id="reset-order-reguler"
                                    class="mt-15 mb-15 btn-xs btn btn-danger btn-anim">
                                    <i class="icon-rocket"></i>
                                    <span class="btn-text">Reset</span>
                                </a>
                                <button type="button" id="checkout"
                                    class="mt-15 mb-15 btn-xs btn btn-success btn-anim">
                                    <i class="icon-rocket"></i>
                                    <span class="btn-text">Checkout</span>
                                </button>
                            </div>
                        @else
                            <button type="submit" class="mt-15 mb-15 btn-xs btn-block btn btn-success btn-anim"
                                id="disabled-pay">
                                <i class="icon-rocket"></i>
                                <span class="btn-text">Checkout</span>
                            </button>
                        @endif
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="panel panel-default card-view">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0" id="dt-package-reguler">
                                            <thead>
                                                <tr>
                                                    <th class="table-th">Nama Produk</th>
                                                    <th class="table-th">Kategori</th>
                                                    <th class="table-th">Harga Weekdays</th>
                                                    <th class="table-th">Harga Weekend</th>
                                                    <th class="table-th">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            </div>
            @include('layouts.footer')
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>

    <script>
        $('[data-toggle="tooltip"]').tooltip();

        function checkout(url, title) {
            popupCenter(url, title, 1000, 700);
        }

        function popupCenter(url, title, w, h) {
            const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : window.screenX;
            const dualScreenTop = window.screenTop !== undefined ? window.screenTop : window.screenY;

            const width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document
                .documentElement.clientWidth : screen.width;
            const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document
                .documentElement.clientHeight : screen.height;

            const systemZoom = width / window.screen.availWidth;
            const left = (width - w) / 2 / systemZoom + dualScreenLeft
            const top = (height - h) / 2 / systemZoom + dualScreenTop
            const newWindow = window.open(url, title,
                `scrollbars=yes,width  = ${w / systemZoom}, height = ${h / systemZoom}, top    = ${top}, left   = ${left}`
            );
            if (window.focus) newWindow.focus();
        }

        function loading() {
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

        var format = function(num){
            var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
            if(str.indexOf(".") > 0) {
                parts = str.split(".");
                str = parts[0];
            }
            str = str.split("").reverse();
            for(var j = 0, len = str.length; j < len; j++) {
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

        function addCart(id) {
            var url = "{{ route('cart_add.reguler', ':package') }}";
            url = url.replace(':package', id);
            
            $.ajax({
                async: true,
                type: 'POST',
                url: url,
                data: {
                    url: url,
                    id: id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function(request) {
                    loading();
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
                }
            });
        }

        function updateQTY(id, type) {
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
            let url = "{{ route('reguler_update.qty', ':id') }}";
            url = url.replace(':id', id);
            click();
            $.ajax({
                async: true,
                type: 'POST',
                url: url,
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
                }
            });
        }

        function removeItem(id) {
            var url = "{{ route('cart_remove.reguler', ':package') }}";
            url = url.replace(':package', id);
            $('.disabled-cart-' + id).css('background', 'tomato');
            $('.disabled-cart-' + id).fadeOut(800, function() {
                $(this).remove();
            });
            dlt();
            $.ajax({
                async: true,
                type: 'POST',
                url: url,
                data: {
                    url: url,
                    id: id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function(request) {
                    loading();
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
                }
            });
        }

        var interval = setInterval(function() {
            var momentNow = moment().locale('fr');
            $('#time-part').html(momentNow.format('hh:mm:ss A'));
        }, 100);

        $(document).on('click', '#reset-order-reguler', function() {
            var tg = window.location.href;
            tg = tg.split("?")
            tg = tg[0];
            tg = tg.split("/");
            id = tg[tg.length - 1];

            var url = "{{ route('cart_reguler.clear') }}";
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
                        url: url,
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
                        }
                    })
                } else {
                    swal("Dibatalkan", "", "error");
                }
            });
            return false;
        });

        $(document).on('click', '#checkout', function() {
            let url = "{{ route('checkout_reguler') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                async: true,
                type: 'GET',
                url: url,
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
                        window.location.href = url;
                        // checkout(url, response.order_number);
                        // $('#checkout').attr('disabled', true);
                        // window.close();
                    });
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

        function add() {
            var audio = new Audio('../sound/add.mp3');
            audio.play();
        }

        function beep() {
            var audio = new Audio('../sound/beep.mp3');
            audio.play();
        }
        function click() {
            var audio = new Audio('../sound/click.mp3');
            audio.play();
        }

        function dlt() {
            var audio = new Audio('../sound/remove.mp3');
            audio.play();
        }

        function rst() {
            var audio = new Audio('../sound/reset.mp3');
            audio.play();
        }

        function sword() {
            var audio = new Audio('../sound/sword.mp3');
            audio.play();
        }

        function bell() {
            var audio = new Audio('../sound/bell.mp3');
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
                "url": "{{ route('proses_reguler') }}",
                "type": "GET",
                "datatype": "json"
            },
            "render": $.fn.dataTable.render.text(),
            "columns": [{
                    "data": function(data) {
                        return data.name
                    }
                },
                {
                    "data": function(data) {
                        return `<span class="label ${data.category == 'default' ? 'label-primary' : 'label-danger'}">${data.category}</span>`;
                    }
                },
                {
                    "data": function(data) {
                        return `<p>Rp ${data.price_weekdays}</p>`;
                    }
                },
                {
                    "data": function(data) {
                        return `<p>Rp ${data.price_weekend}</p>`;
                    }
                },
                {
                    "data": function(data) {
                        if (data.status == 0) {
                            return `<div class="checkbox checkbox-success checkbox-circle">
                                <input id="checkbox-10" type="checkbox" disabled checked="" data-toggle="tooltip" data-placement="top" title="ON">
                                <label for="checkbox-10"></label>
                            </div>`;
                        } else {
                            return `<div class="checkbox checkbox-danger checkbox-circle">
                                <input id="checkbox-12" type="checkbox" disabled checked=""data-toggle="tooltip" data-placement="top" title="OFF">
                                <label for="checkbox-12"></label>
                            </div>`;
                        }
                    }
                }
            ],
            order: [],
            responsive: true,
            language: {
                search: "",
                searchPlaceholder: "Cari",
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
    </script>
@endpush
