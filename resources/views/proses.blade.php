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
                <div class="col-lg-7">
                    <div style="height: 350px;" class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Pilih paket bermain</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="d-flex flex-wrap">
                            @foreach ($default as $item)
                                <div class="d-flex">
                                    <div class="checkbox checkbox-success mr-15">
                                        <input id="checkbox3" type="checkbox"
                                            class="form-control select-item form-control-{{ $item->id }}"
                                            onchange="valueChanged({{ $item->id }}, {{ $item->price_weekdays }})">
                                        <label for="checkbox3">
                                            {{ $item->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Pilih item tambahan</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="d-flex flex-wrap">
                            @foreach ($additional as $item2)
                                <div class="d-flex">
                                    <div class="checkbox checkbox-success mr-15">
                                        <input id="checkbox3" type="checkbox"
                                            class="form-control select-item form-control-{{ $item2->id }}"
                                            onchange="valueChanged({{ $item2->id }})">
                                        <label for="checkbox3">
                                            {{ $item2->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div style="height: 350px;" class="panel panel-default border-panel card-view">
                        <div class="panel-heading">
                            <h6 class="panel-title text-center">Daftar Order</h6>
                            <div class="clearfix"></div>
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
                        @foreach ($default as $item)
                            <div class="panel-heading d-none isi-{{ $item->id }}">
                                <div class="pull-left d-flex align-items-center">
                                    <p class="text-muted mr-5">
                                        {{ $item->name }}</p>
                                    <button class="cart-qty-minus-{{ $item->id }}" type="button" value="-"><i
                                            class="fa fa-minus-square"></i></button>
                                    <input type="text" min="1"
                                        onkeypress="return event.charCode >= 48 && event.charCode <=57" name="qty"
                                        class="qty-{{ $item->id }}" data-price="{{ $item->price_weekdays }}"
                                        maxlength="10" style="width: 30px;" />
                                    <button class="cart-qty-plus-{{ $item->id }}" type="button" value="+"><i
                                            class="fa fa-plus-square"></i></button>
                                </div>
                                <div class="pull-right">
                                    <p class="text-muted price-{{ $item->id }}">Rp.
                                        {{ number_format($item->price_weekdays, 0, ',', '.') }}</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        @endforeach
                        <div class="panel-heading">
                            <div class="pull-left">
                                <strong class="txt-dark">Total</strong>
                            </div>
                            <div class="pull-right">
                                <strong class="txt-dark">Rp. </strong>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <button type="submit" class="mt-15 btn-sm btn btn-success btn-block btn-anim">
                            <i class="icon-rocket"></i>
                            <span class="btn-text">Checkout</span>
                        </button>
                    </div>
                </div>
            </div>
            @include('Layouts.Footer')
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function valueChanged(id, price) {
            var incrementPlus;
            var incrementMinus;
            var buttonPlus = $(".cart-qty-plus-" + id);
            var buttonMinus = $(".cart-qty-minus-" + id);
            $(document).on('change', '.form-control-' + id, function(e) {
                e.preventDefault();
                if (this.checked) {
                    $('.isi-' + id).removeClass('d-none');
                    $(".qty-" + id).val(1);
                } else {
                    $('.isi-' + id).addClass('d-none');
                    $(".qty-" + id).val(0);
                }
            });
            var incrementPlus = buttonPlus.click(function() {
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

            var incrementMinus = buttonMinus.click(function() {
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
        };
    </script>
@endpush
