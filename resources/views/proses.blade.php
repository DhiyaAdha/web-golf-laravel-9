@extends('Layouts.main', ['title' => 'TGCC | Proses'])
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row heading-bg">
                <!-- Breadcrumb -->
                <div class="row">
                    <div class="container-fluid">
                        <div class="col-lg-8">
                            <h5>Proses Invoice</h5>
                        </div>
                        <div class="col-lg-4 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="javascript:void(0)">Dashboard</a></li>
                                <li class="active"><span>Proses</span></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /Breadcrumb -->
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default card-view" style="height: 900px;">
                        <div class="form-group mt-10 ml-20">
                            <strong>
                                Pilih Paket Bermain
                            </strong>
                            {{-- Radio Button --}}
                            <div class="pull-right">
                                <div class="radio radio-success">
                                    <input type="radio" name="GameType" id="radio1" class="selected-price"
                                        value="weekdays" checked>
                                    <label for="radio1">
                                        <strong class="text-muted">Price Weekdays</strong>
                                    </label>
                                </div>
                                <br>
                                <div class="radio radio-success">
                                    <input type="radio" name="GameType" id="radio2" class="selected-price"
                                        value="weekend">
                                    <label for="radio2">
                                        <strong class="text-muted">Price Weekends</strong>
                                    </label>
                                </div>
                            </div>
                            @foreach ($default as $item)
                                <form class="form-inline">
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox" type="checkbox"
                                            class="form-control select-item form-control-{{ $item->id }}"
                                            onchange="valueChanged({{ $item->id }})">
                                        <label for=""></label>
                                    </div>
                                    <span class="wrap-quantity-{{ $item->id }}" style="display: none">
                                        {{-- <div class="input-group bootstrap-touchspin">
                                            <span class="input-group-addon bootstrap-touchspin-prefix"
                                                style="display: none;"></span>
                                            <input class="vertical-spin form-control" type="text"
                                                data-bts-button-down-class="btn btn-default"
                                                data-bts-button-up-class="btn btn-default"
                                                value="20"name="vertical-spin" style="display: block;">
                                            <span class="input-group-addon bootstrap-touchspin-postfix"
                                                style="display: none;"></span>
                                            <span class="input-group-btn-vertical">
                                                <button class="btn btn-default bootstrap-touchspin-up" type="button"><i
                                                        class="ti-plus"></i></button>
                                                <button class="btn btn-default bootstrap-touchspin-down" type="button"><i
                                                        class="ti-minus"></i></button>
                                            </span>
                                        </div> --}}
                                        <button type="button" id="decrement"
                                            onclick="stepper('decrement', {{ $item->id }})"
                                            data-name="{{ $item->name }}" data-priceday="{{ $item->price_weekdays }}"
                                            data-priceend="{{ $item->price_weekend }}">-</button>
                                        <input name="input1" type="number" min="0" max="100" step="1"
                                            value="0" id="my-input-{{ $item->id }}"
                                            onchange="valuePackage({{ $item->id }})" readonly>
                                        <button type="button" id="increment"
                                            onclick="stepper('increment', {{ $item->id }})"
                                            data-name="{{ $item->name }}" data-priceday="{{ $item->price_weekdays }}"
                                            data-priceend="{{ $item->price_weekend }}">+</button>
                                    </span>
                                    <label for="">{{ $item->name }}</label>
                                </form>
                            @endforeach
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <strong>Pilih Item Tambahan</strong>
                                <div class="row">
                                    <form class="form-inline">
                                        @foreach ($additional as $item2)
                                            <div>
                                                <div class="checkbox checkbox-success">
                                                    <div class="row">
                                                        <input id="checkbox2" type="checkbox"
                                                            class="form-control select-item form-control-{{ $item2->id }}"
                                                            onchange="valueChanged({{ $item2->id }})"
                                                            data-name="{{ $item2->name }}"
                                                            data-priceday="{{ $item2->price_weekdays }}"
                                                            data-priceend="{{ $item2->price_weekend }}">
                                                        <label for=""></label>
                                                    </div>
                                                </div>
                                                <span class="wrap-quantity-{{ $item2->id }}" style="display: none">
                                                    {{-- <button id="decrement"
                                                        onclick="stepper('decrement', {{ $item2->id }})">-</button>
                                                    <input name="input2" type="number" min="0" max="100"
                                                        step="1" value="0" id="my-input-{{ $item2->id }}"
                                                        readonly>
                                                    <button id="increment"
                                                        onclick="stepper('increment', {{ $item2->id }})"
                                                        data-id="{{ $item2->id }}">+</button> --}}
                                                </span>
                                                <label for="">{{ $item2->name }}</label>
                                            </div>
                                        @endforeach
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-default card-view" style="height: 900px;">
                        <h5 style="text-align: center;" class="mt-15 mb-5"><strong>DAFTAR ORDER</strong></h5>
                        <div class="col-lg-6 mt-5">
                            <p style="color: #7D7D7D; text-align:left;" class="ml-12">Product</p>
                        </div>
                        <div class="col-lg-6 mt-5">
                            <p style="color: #7D7D7D; text-align:end;">Sub-Total</p>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <hr class="h">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mt-5">
                                @foreach ($default as $item)
                                    <p style="color: #7D7D7D; text-align:start;">
                                        

                                        <span class="wrap-txt-{{ $item->id }}" style="display: ">
                                            {{ $item->name }}
                                            <hr>
                                        </span>
                                    </p>
                                @endforeach
                                @foreach ($additional as $item2)
                                    <p style="color: #7D7D7D; text-align:start;">


                                        <span class="wrap-txt-{{ $item2->id }}" style="display: ">
                                            {{ $item2->name }}
                                            <hr>
                                        </span>
                                    </p>
                                @endforeach
                            </div>
                            <div class="col-lg-6 mt-5">
                                @foreach ($package as $data)
                                    <p style="color: #7D7D7D; text-align:end;">Rp.
                                        {{ formatrupiah($data->price_weekdays) }}
                                        <hr>
                                    </p>
                                @endforeach
                            </div>
                        <div class="wrap-selected-item">
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <hr class="h">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mt-5">
                                <p style="text-align:start;"><strong>Total</strong></p>
                            </div>
                            <div class="col-lg-6 mt-5">
                                <p style="text-align:end;"></p>
                                {{-- <p style="text-align:end;">Rp. 1.000.000,00</p> --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mt-10">
                                <div class="btn-proses">
                                    <a href="/metode_pembayaran">
                                        <h6 style="color: #ffffff;">Checkout</h6>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.min.js"></script>
    <script type="text/javascript">
        function valueChanged(id) {
            if ($('.form-control-' + id).is(":checked"))
                $(".wrap-quantity-" + id).show();
            else
                $(".wrap-quantity-" + id).hide();
        };

        function valuePackage(id) {

        };

        $(document).on('input', '#increment', function() {
            let jumlah = parseInt($(this).val());
            console.log(jumlah)
        });

        // $(document).on('click', '#increment', function() {
        //     let id = $(this).data('id');
        //     console.log
        //     let jumlah = parseInt($(this).val());
        // var radio = $(".selected-price:checked").val();
        // var name = $(this).data('name');
        // var price = (radio == 'weekdays') ? $(this).data('priceday') : $(this).data('priceend');

        // var html = `<div class="row">
    //                 <div class="col-lg-6 mt-5">
    //                     <p style="color: #7D7D7D; text-align:start;">${name}</p>
    //                 </div>
    //                 <div class="col-lg-6 mt-5">

    //                     <p style="color: #7D7D7D; text-align:end;">RP ${price}</p>
    //                 </div>
    //             </div>`;
        // $('.wrap-selected-item').append(html)
        // })
    </script>
@endsection