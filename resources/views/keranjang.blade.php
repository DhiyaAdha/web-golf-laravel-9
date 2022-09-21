@extends('Layouts.main', ['title' => 'TGCC | Pilih Permainan'])
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
                        <li><a href="{{ url('scan-tamu') }}">Scan Tamu</a></li>
                        <li class="active"><span>Pilih Permainan</span></li>
                    </ol>
                </div>
                <!-- /Breadcrumb -->
            </div>
            <!-- /Title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default border-panel card-view jt">
                        <div class="icon-tgcc">
                            <img src="{{ asset('dist/img/tgcc_icon.svg') }}" alt="">
                        </div>
                        <img src="{{ asset('img/lapangan-golf.jpg') }}" style="width: 100%;">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div style="height: 387px;" class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <strong class="panel-title txt-dark">Default</strong>
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
                                <a href="{{ route('cart.add', ['package' => $item->id]) }}"
                                    class="btn btn-default txt-success mr-15 mb-15">{{ $item->name }}</a>
                            @endforeach
                        </div>
                        <div class="panel-heading">
                            <div class="pull-left">
                                <strong class="panel-title txt-dark">Tambahan</strong>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="d-flex flex-wrap mb-15">
                            @foreach ($additional as $item)
                                <a href="{{ route('cart.add', ['package' => $item->id]) }}"
                                    class="btn btn-default txt-success mr-15 mb-15">{{ $item->name }}</a>
                            @endforeach
                        </div>
                        <div class="panel-heading fk d-flex align-items-center">
                            <div class="d-flex align-items-center justify-content-between" style="width: 100%">
                                <span class="text-size">Terbilang</span>
                                <span class="counted">
                                    @if (!Session::has('cart'))
                                        -
                                    @else
                                        {{ $counted }}
                                    @endif
                                </span>
                            </div>
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
                                        id="qty">{{ $totalQuantity }}</span>
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
                        @if (!Session::has('cart'))
                            <div style="height: 242px;" class="d-flex justify-content-center align-items-center isi-">
                                <span class="not-found text-muted">Keranjang masih kosong</span>
                            </div>
                        @else
                            <div style="overflow-x: scroll; height: 242px;" class="isi-">
                                @foreach ($orders as $item)
                                    <div class="panel-heading g">
                                        <div class="pull-left d-flex align-items-center">
                                            <p class="text-muted">{{ $item['item']['name'] }}</p>
                                        </div>
                                        <div class="pull-right mr-5">
                                            <div class="d-flex">
                                                <p class="text-muted mr-15">{{ $item['price'] }}</p>
                                                <a href="javascript:void(0)" data-item-name="{{ $item['item']['name'] }}"
                                                    data-item="{{ key($orders) }}" id="remove-item"><i
                                                        class="fa fa-trash-o"></i></a>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="panel-heading gu">
                            <div class="pull-left">
                                <strong class="txt-dark">Total</strong>
                            </div>
                            <div class="pull-right">
                                <strong class="txt-dark" id="total-pay">Rp. {{ $totalPrice }}</strong>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        @if (Session::has('cart'))
                            <div class="pull-left">
                                <a href="javascript:void(0)" data-order="{{ key($orders) }}" id="reset-order"
                                    class="mt-15 mb-15 btn-xs btn btn-primary btn-anim">
                                    <i class="icon-rocket"></i>
                                    <span class="btn-text">Reset</span>
                                </a>
                            </div>
                            <div class="pull-right">
                                <a href="javascript:void(0)" id="checkout"
                                    class="mt-15 mb-15 btn-xs btn btn-success btn-anim">
                                    <i class="icon-rocket"></i>
                                    <span class="btn-text">Checkout</span>
                                </a>
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
                                        <table class="table table-hover mb-0" id="dt-package">
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
            @include('Layouts.Footer')
            <div id="lds-facebook"></div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
    <script>
        function checkout(url, title) {
            popupCenter(url, title, 625, 500);
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
                `
            scrollbars=yes,
            width  = ${w / systemZoom}, 
            height = ${h / systemZoom}, 
            top    = ${top}, 
            left   = ${left}
        `
            );

            if (window.focus) newWindow.focus();
        }

        $(document).on('click', '#remove-item', function() {
            var key = $(this).data('item');
            var name = $(this).data('item-name');
            var url = "{{ route('cart.remove', [':package']) }}";
            url = url.replace(':package', key);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $.toast({
                        text: 'Item ' + name + ' terhapus',
                        position: 'top-right',
                        loaderBg: '#fec107',
                        icon: 'success',
                        hideAfter: 1000,
                        stack: 6
                    });
                    window.setTimeout(function() {
                        location.reload();
                    }, 1200);
                }
            });
        });

        $(document).on('click', '#checkout', function() {
            var url = "{{ route('checkout') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                async: true,
                type: 'GET',
                url: "{{ route('checkout') }}",
                beforeSend: function(request) {
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
                },
                success: function(response) {
                    $.unblockUI();
                    swal({
                        title: "",
                        type: "success",
                        text: "Order berhasil dibuat",
                        confirmButtonColor: "#01c853",
                    }, function(isConfirm) {
                        checkout(url, 'testing');
                    });
                }
            });
        });

        $(document).on('click', '#reset-order', function() {
            var key = $(this).data('order');
            var url = "{{ route('cart.remove_all', [':package']) }}";
            url = url.replace(':package', key);
            swal({
                title: "Anda yakin reset order semua?",
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
                        url: url,
                        beforeSend: function() {
                            $('#ok_button').text('Hapus Order');
                        },
                        success: function(data) {
                            swal("Terhapus!", "", "success");
                            window.setTimeout(function() {
                                location.reload();
                            }, 1200);
                        }
                    })
                } else {
                    swal("Dibatalkan", "", "error");
                }
            });
            return false;
        });

        $(document).on('click', '#disabled-pay', function() {
            swal({
                title: "",
                type: "error",
                text: "silakan pilih setidaknya satu item produk",
                confirmButtonColor: "#01c853",
            });
            return false;
        });

        var interval = setInterval(function() {
            var momentNow = moment().locale('fr');
            $('#time-part').html(momentNow.format('hh:mm:ss A'));
        }, 100);

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
                "url": "{{ route('order.cart', Request::segment(2)) }}",
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
