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
                            
                            @foreach ($default as $item)
                            <form class="form-inline">
                                <div class="checkbox checkbox-success">
                                    <input id="checkbox1" type="checkbox" class="form-control form-control-{{ $item->id }}" onchange="valueChanged({{ $item->id }})">
                                    <label for=""></label>
                                </div>
                                    <span class="wrap-quantity-{{ $item->id }}" style="display: none">
                                        <button type="button" id="decrement" onclick="stepper('decrement', {{ $item->id }})" >-</button>
                                        <input type="number" min="1" max="10" step="1" value="1"
                                        id="my-input-{{ $item->id }}" readonly>
                                        <button type="button" id="increment" onclick="stepper('increment', {{ $item->id }})" >+</button>
                                    </span>
                                        <label for="">{{ $item->name }}</label>
                            </form>
                        @endforeach
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <strong>Pilih Item Tambahan</strong>
                                <div class="row">
                                    @foreach ($additional as $item2)
                                        <form class="form-inline">
                                            <div class="checkbox checkbox-success">
                                                <input id="checkbox2" type="checkbox" class="form-control form-control-{{ $item2->id }}" onchange="valueChanged({{ $item2->id }})">
                                                <label for=""></label>
                                            </div>
                                                <span class="wrap-quantity-{{ $item2->id }}" style="display: none">
                                                    <button type="button" id="decrement" onclick="stepper('decrement', {{ $item2->id }})" >-</button>
                                                    <input type="number" min="1" max="10" step="1" value="1"
                                                    id="my-input-{{ $item2->id }}" readonly>
                                                    <button type="button" id="increment" onclick="stepper('increment', {{ $item2->id }})" >+</button>
                                                </span>
                                                    <label for="">{{ $item2->name }}</label>
                                        </form>
                                    @endforeach
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
                                        <input type="text" id="isChecked">

                                        <span class="wrap-txt-{{ $item->id }}" style="display: none">
                                            {{ $item->name }} <hr>
                                        </span>
                                    </p>
                                @endforeach
                            </div>
                            <div class="col-lg-6 mt-5">
                                @foreach ($package as $data)
                                <p style="color: #7D7D7D; text-align:end;">Rp. {{ formatrupiah($data->price_weekdays) }} <hr>
                                </p>
                                @endforeach
                            </div>
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
                                <p style="text-align:end;">Rp. 1.000.000,00</p>
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

    
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.min.js"></script>
    <script type="text/javascript">  
    function valueChanged(id)
    {
        if($('.form-control-'+id).is(":checked"))   
            $(".wrap-quantity-"+id).show();
        else
            $(".wrap-quantity-"+id).hide();
    }   

    $(document).ready(function(){
        $('#isChecked').change(function(){
        if($(this.checked).length)  { 
                $(".wrap-txt-"+id).show();
        }else{
                $(".wrap-txt-"+id).hide();
        }
        });
    });
    </script>
