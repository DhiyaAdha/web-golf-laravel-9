@extends('layouts.main', ['title' => 'TGCC | Pilih Permainan'])
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Pilih Permainan</h5>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('analisis-tamu') }}">Dashboard</a></li>
                        <li><a href="{{ url('scan-tamu') }}">Scan Tamu</a></li>
                        <li class="active"><span>Pilih Permainan</span></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <strong class="panel-title txt-dark">Permainan</strong>
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
                                <strong class="panel-title txt-dark">Proshop & Fasilitas</strong>
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
                                <strong class="panel-title txt-dark">Kantin</strong>
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
                                    <span class="top-nav-icon-badge" style="position: absolute" id="qty">{{ count($cart_data) }}</span>
                                </a>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="panel-heading" style="background-color: #d9edf7;padding: 8px 15px;border-bottom: none !important;">
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
                                    <div class="d-flex pl disabled-cart-{{ $item['rowId'] }}" style="padding: 10px 0px 10px 0px;">
                                        <p class="flex-grow-1 text-muted mr-5">{{ Str::words($item['name'], 3) }}</p>
                                        <p class="text-muted price-{{ $item['rowId'] }}">Rp.{{ number_format($item['price'], 0, ',', '.') }}</p>
                                        <button onclick="updateQTY({{ $item['rowId'] }}, 'minus')">
                                            <i class="cart-qty-minus-{{ $item['rowId'] }} fa fa-minus-square"></i>
                                        </button>
                                        <input type="number" min="1" class="qty-{{ $item['rowId'] }}" value="{{ $item['qty'] }}" style="width: 30px;" readonly />
                                        <button onclick="updateQTY({{ $item['rowId'] }}, 'plus')">
                                            <i class="cart-qty-plus-{{ $item['rowId'] }} fa fa-plus-square"></i>
                                        </button>
                                        <button class="mr-10 ml-10" data-category="{{ $item['category'] }}" data-toggle="tooltip" title="Hapus" onclick="removeItem({{ $item['rowId'] }})" id="remove-item" style="color:red;">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div id="disabled-empty" style="height: 270px;" class="d-flex justify-content-center align-items-center">
                                <span class="not-found text-muted">Keranjang masih kosong</span>
                            </div>
                        @endif
                        <div id="total"></div>
                        <div id="append-checkout"></div>
                        @if (count($cart_data) > 0)
                            <div class="d-flex">
                                <strong class="flex-grow-1 txt-dark">Total</strong>
                                <strong class="txt-dark" id="total-pay">Rp. {{ number_format($data_total['total'], 0, ',', '.') }}</strong>
                            </div>
                            <div id="disabled-checkout"></div>
                            <div class="d-flex justify-content-between active-checkout">
                                <a href="javascript:void(0)" id="reset-order" class="mt-15 mb-15 btn-xs btn btn-danger btn-anim">
                                    <i class="icon-rocket"></i>
                                    <span class="btn-text">Reset</span>
                                </a>
                                <a href="{{ url('kartu-tamu/' . Crypt::encryptString($get_visitor->id)) }}" id="riwayat" class="mt-15 mb-15 btn-xs btn btn-primary btn-anim" target="_blank">
                                    <i class="icon-rocket"></i>
                                    <span class="btn-text">Riwayat</span>
                                </a>
                                <button type="button" id="checkout" class="mt-15 mb-15 btn-xs btn btn-success btn-anim">
                                    <i class="icon-rocket"></i>
                                    <span class="btn-text">Checkout</span>
                                </button>
                            </div>
                        @else
                            <button type="submit" class="mt-15 mb-15 btn-xs btn-block btn btn-success btn-anim" id="disabled-pay">
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
            @include('layouts.footer')
            <div id="lds-facebook"></div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('dist/asset_offline/jquery.blockUI.min.js') }}"></script>
    <script src="{{ asset('dist/asset_offline/popper.min.js') }}"></script>
    <script src="{{ asset('dist/asset_offline/cart_member.js') }}"></script>
@endpush
