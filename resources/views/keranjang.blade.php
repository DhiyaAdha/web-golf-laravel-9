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
                                    class="btn btn-default mr-15 mb-15">{{ $item->name }}</a>
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
                                    class="btn btn-default mr-15 mb-15">{{ $item->name }}</a>
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
                <div class="col-lg-4" style="position: sticky; top: 0;">
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
                                <strong>Produk</strong>
                            </div>
                            <div class="pull-right">
                                <strong>Sub total</strong>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        @if (!Session::has('cart'))
                            <div style="height: 203px;" class="d-flex justify-content-center align-items-center isi-">
                                <span class="not-found text-muted">Keranjang masih kosong</span>
                            </div>
                        @else
                            <div style="overflow-x: scroll; height: 203px;" class="isi-">
                                @foreach ($orders as $item)
                                    <div class="panel-heading g">
                                        <div class="pull-left d-flex align-items-center">
                                            <p class="text-muted">{{ $item['item']['name'] }}</p>
                                        </div>
                                        <div class="pull-right mr-5">
                                            <p class="text-muted">{{ $item['price'] }}</p>
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
                        <div class="pull-left">
                            <button type="button" class="mt-15 mb-15 btn-xs btn btn-primary btn-anim" id="reset-qty">
                                <i class="icon-rocket"></i>
                                <span class="btn-text">Reset</span>
                            </button>
                        </div>
                        <div class="pull-right">
                            <button type="submit" class="mt-15 mb-15 btn-xs btn btn-success btn-anim">
                                <i class="icon-rocket"></i>
                                <span class="btn-text">Checkout</span>
                            </button>
                        </div>
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
        </div>
    </div>
@endsection
@push('scripts')
    <script>
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
                "url": "{{ route('package.index') }}",
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
