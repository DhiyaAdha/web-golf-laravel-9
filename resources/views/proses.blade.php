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
                <div class="col-lg-8">
                    <div style="height: 373px;" class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Default</h6>
                            </div>
                            <div class="pull-right">
                                <div class='d-flex '>
                                    <span class="text-muted mr-15" style="float: right;">{{ $date_now }}, </span>
                                    <span class="label label-default" id='time-part' style="float: right;"></span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="d-flex flex-wrap">
                            @foreach ($default as $item)
                                <div class="d-flex">
                                    <div class="checkbox checkbox-success mr-15">
                                        <input name="price" type="checkbox"
                                            class="form-control select-item form-control-{{ $item->id }}"
                                            data-name="{{ $item->name }}" data-today="{{ $today }}"
                                            onclick="totalIt()"
                                            value="{{ $today == 'Sabtu' && 'Minggu' ? $item->price_weekend : $item->price_weekdays }}"
                                            onchange="valueChanged({{ $item->id }}, {{ $today == 'Sabtu' && 'Minggu' ? $item->price_weekend : $item->price_weekdays }})">
                                        <label for="checkbox3">
                                            {{ $item->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Tambahan</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="d-flex flex-wrap mb-15">
                            @foreach ($additional as $item)
                                <div class="d-flex">
                                    <div class="checkbox checkbox-success mr-15">
                                        <input name="price" type="checkbox"
                                            class="form-control select-item form-control-{{ $item->id }}"
                                            data-name="{{ $item->name }}" data-today="{{ $today }}"
                                            onclick="totalIt()"
                                            value="{{ $today == 'Sabtu' && 'Minggu' ? $item->price_weekend : $item->price_weekdays }}"
                                            onchange="valueChanged({{ $item->id }}, {{ $today == 'Sabtu' && 'Minggu' ? $item->price_weekend : $item->price_weekdays }})">
                                        <label for="checkbox3">
                                            {{ $item->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-default border-panel card-view">
                        <div class="panel-heading">
                            <div class="d-flex">
                                <h6 class="panel-title flex-grow-1" style="font-weight: 500">Daftar Order</h6>
                                <h6 class="panel-title"><i class="fa fa-shopping-cart"></i></h6>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="panel-heading">
                            <div class="pull-left">
                                <p class="text-muted">Produk</p>
                            </div>
                            <div class="pull-right">
                                <p class="text-muted">Sub total</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div style="overflow-x: scroll; height: 150px;"
                            class="d-flex justify-content-center align-items-center text-center isi-">
                            <span class="not-found text-muted">Keranjang masih kosong</span>
                        </div>
                        <div class="panel-heading">
                            <div class="pull-left">
                                <strong class="txt-dark">Total</strong>
                            </div>
                            <div class="pull-right">
                                <strong class="txt-dark" id="total-pay">Rp. 0</strong>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <button type="submit" class="mt-15 mb-15 btn-xs btn btn-success btn-block btn-anim">
                            <i class="icon-rocket"></i>
                            <span class="btn-text">Checkout</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
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
            @include('Layouts.Footer')
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function totalIt() {
            var input = $("input[name='price']");
            var total = 0;
            for (var i = 0; i < input.length; i++) {
                if (input[i].checked) {
                    total += parseFloat(input[i].value);
                }
            }
            $("#total-pay").text('Rp. ' + formatIDR(total));
        }

        function formatIDR(price) {
            var number_string = price.toString(),
                split = number_string.split(','),
                remainder = split[0].length % 3,
                rupiah = split[0].substr(0, remainder),
                ribuan = split[0].substr(remainder).match(/\d{1,3}/gi);
            if (ribuan) {
                separator = remainder ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            return split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        }

        function valueChanged(id, price) {
            $(document).on('change', '.form-control-' + id, function() {
                var today = $(this).data('today');
                var name = $(this).data('name');
                if (this.checked) {
                    $('.isi-').append(`<div class="panel-heading g remove-${id}">
                                        <div class="pull-left d-flex align-items-center">
                                            <p class="text-muted mr-5">${name}</p>
                                        </div>
                                        <div class="pull-right d-flex">
                                            <p class="text-muted price-${id}">Rp.${formatIDR(price)}</p>
                                            <button class="cart-qty-minus-${id}" type="button" value="-"><i class="fa fa-minus-square"></i></button>
                                            <input type="number" min="0" value="1" name="qty" class="qty-${id}" data-price="${price}" maxlength="10" style="width: 30px;" />
                                            <button class="cart-qty-plus-${id}" type="button" value="+"><i class="fa fa-plus-square"></i></button>
                                        </div>
                                        <div class="clearfix"></div>
                                        </div>`).removeClass(
                        'd-flex justify-content-center align-items-center text-center');
                    $('.not-found').remove();
                    let a = $('.form-control-' + id).data('id');

                    var buttonPlus = $(".cart-qty-plus-" + id);
                    var buttonMinus = $(".cart-qty-minus-" + id);

                    buttonPlus.click(function(e) {
                        e.preventDefault();
                        var $n = $(".qty-" + id);
                        $n.val(Number($n.val()) + 1);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('qty.plus') }}",
                            data: {
                                id: id,
                                qty_plus: parseInt($n.val()),
                                price: price
                            },
                            dataType: 'json',
                            success: function(response) {
                                var total = response.plus * response.price;
                                var output = parseInt(total).toLocaleString();
                                $('.price-' + response.id).text('Rp ' + output);
                            }
                        });
                    });

                    buttonMinus.click(function() {
                        var $n = $(".qty-" + id);
                        var amount = Number($n.val());
                        if (amount > 0) {
                            $n.val(amount - 1);
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                type: 'POST',
                                url: "{{ route('qty.minus') }}",
                                data: {
                                    id: id,
                                    qty_minus: parseInt($n.val()),
                                    price: price
                                },
                                dataType: 'json',
                                success: function(response) {
                                    var total = response.minus * response.price;
                                    var minus = total - response.price;
                                    var output = parseInt(minus).toLocaleString();
                                    $('.price-' + response.id).text('Rp ' + output);
                                }
                            });
                        }
                    });
                } else {
                    $('.remove-' + id).remove();
                    // location.reload();
                }
            });
        };

        var interval = setInterval(function() {
            var momentNow = moment().locale('fr');
            $('#time-part').html(momentNow.format('hh:mm:ss A'));
        }, 100);

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
        /* data package */
    </script>
@endpush
