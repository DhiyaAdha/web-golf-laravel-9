@extends('layouts.main', ['title' => 'TGCC | Tambah Paket Bermain'])
@section('content')
    <div class="page-wrapper" style="min-height: 259px;">
        <div class="container-fluid" data-title="Halaman Tambah Paket" data-intro="Admin dapat menambah data paket baru dengan mengisi formulir dan harga">
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Tambah Paket</h5>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('analisis-tamu') }}">Dashboard</a></li>
                        <li><a href="{{ url('package') }}"><span>Tambah paket</span></a></li>
                        <li class="active"><span>Tambah paket bermain</span></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default card-view">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="form-wrap">
                                    <form action="{{ route('package.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group  @error('name') has-error @enderror">
                                            <label class="control-label mb-10 text-left" for="example-email">Nama Paket
                                                <span class="help"></span>
                                            </label>
                                            <input type="text" id="example-email" value="{{ old('name') }}" name="name" class="form-control" placeholder="Masukan nama paket">
                                            @error('name')
                                                <div class="text-danger"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-30 @error('category') has-error @enderror">
                                            <label class="control-label mb-10 text-left" for="examp">
                                                <label class="control-label mb-10 text-left">Kategori Paket</label>
                                                <div class="radio-list">
                                                    <div class="radio-inline pl-0">
                                                        <span class="radio radio-info"> 
                                                            <input type="radio" name="category" id="radio_9" value="default" {{ old('category') == 'default' ? 'checked' : '' }}>
                                                            <label for="radio_9">Permainan</label>
                                                        </span>
                                                    </div>
                                                    <div class="radio-inline pl-0">
                                                        <span class="radio radio-info"> 
                                                            <input type="radio" name="category" id="radio_10" value="additional" {{ old('category') == 'additional' ? 'checked' : '' }}>
                                                            <label for="radio_10">Fasilitas</label>
                                                        </span>
                                                    </div>
                                                    <div class="radio-inline pl-0">
                                                        <span class="radio radio-info"> 
                                                            <input type="radio" name="category" id="radio_11" value="others" {{ old('category') == 'others' ? 'checked' : '' }}>
                                                            <label for="radio_11">Kantin</label>
                                                        </span>
                                                    </div>
                                                    <div class="radio-inline pl-0">
                                                        <span class="radio radio-info"> 
                                                            <input type="radio" name="category" id="radio_12" value="rental" {{ old('category') == 'rental' ? 'checked' : '' }}>
                                                            <label for="radio_12">Sewa</label>
                                                        </span>
                                                    </div>
                                                    <div class="radio-inline pl-0">
                                                        <span class="radio radio-info"> 
                                                            <input type="radio" name="category" id="radio_13" value="service" {{ old('category') == 'service' ? 'checked' : '' }}>
                                                            <label for="radio_13">Service Fee</label>
                                                        </span>
                                                    </div>
                                                </div>
                                                @error('category')
                                                    <div class="text-danger"> {{ $message }}</div>
                                                @enderror
                                        </div>
                                        <div class="form-group mb-30 @error('status') has-error @enderror">
                                            <label class="control-label mb-10 text-left" for="examp">
                                                <label class="control-label mb-10 text-left">Status Paket</label>
                                                <div class="radio-list">
                                                    <div class="radio-inline pl-0">
                                                        <span class="radio radio-info"> 
                                                            <input type="radio" name="status" id="radio_14" value="0" {{ old('status') == '0' ? 'checked' : '' }}>
                                                            <label for="radio_14">ON</label>
                                                        </span>
                                                    </div>
                                                    <div class="radio-inline pl-0">
                                                        <span class="radio radio-info"> 
                                                            <input type="radio" name="status" id="radio_15" value="1" {{ old('status') == '1' ? 'checked' : '' }}>
                                                            <label for="radio_15">OFF</label>
                                                        </span>
                                                    </div>
                                                </div>
                                                @error('status')
                                                    <div class="text-danger"> {{ $message }}</div>
                                                @enderror
                                        </div>
                                        <div class="checkbox checkbox-primary">
                                            <input id="checkbox-harga" type="checkbox" value="hrg" onclick="myFunction()">
                                            <label for="checkbox-harga">
                                                Harga Sama Senin-Minggu?
                                            </label>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="form-group @error('price_discount') has-error @enderror">
                                                <label class="control-label mb-10 text-left" for="examp">
                                                    <label id="senin" class="control-label mb-10 text-left" for="example-email">senin<span class="help"></label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">Rp</div>
                                                        <input type="text" min="0" onkeypress="return event.charCode >= 48 && event.charCode <=57" class="form-control" name="price_discount" placeholder="masukkan harga">
                                                    </div>
                                                    @error('price_discount')
                                                        <div class="text-danger"> {{ $message }}</div>
                                                    @enderror
                                            </div>
                                            <div id="isi" class="form-group @error('price_weekdays') has-error @enderror hrg">
                                                <label class="control-label mb-10 text-left" for="examp">
                                                    <label class="control-label mb-10 text-left" for="example-email">selasa - jumat<span class="help"></span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">Rp</div>
                                                        <input id="hrg_input1" type="text" min="0" onkeypress="return event.charCode >= 48 && event.charCode <=57" class="form-control" name="price_weekdays" placeholder="masukkan harga">
                                                    </div>
                                                    @error('price_weekdays')
                                                        <div class="text-danger"> {{ $message }}</div>
                                                    @enderror
                                            </div>
                                            <div id="isi2" class="form-group @error('price_weekend') has-error @enderror hrg">
                                                <label class="control-label mb-10 text-left" for="examp">
                                                    <label class="control-label mb-10 text-left" for="example-email">sabtu - minggu<span class="help"></span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">Rp</div>
                                                        <input id="hrg_input2" type="text" min="0" onkeypress="return event.charCode >= 48 && event.charCode <=57" class="form-control" name="price_weekend" placeholder="masukkan harga">
                                                    </div>
                                                    @error('price_weekend')
                                                        <div class="text-danger"> {{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
@endsection
@push('scripts')
    <script>
        $("[name='price_discount']").autoNumeric('init', {
            aSep: '.', 
            aDec: ',',
            aForm: true,
            vMax: '999999999',
            vMin: '-999999999'
        });
        $("[name='price_weekdays']").autoNumeric('init', {
            aSep: '.', 
            aDec: ',',
            aForm: true,
            vMax: '999999999',
            vMin: '-999999999'
        });
        $("[name='price_weekend']").autoNumeric('init', {
            aSep: '.', 
            aDec: ',',
            aForm: true,
            vMax: '999999999',
            vMin: '-999999999'
        });
        $('input[type="checkbox"]').click(function() {
            var inputValue = $(this).attr("value");
            $("#hrg_input1").val('');
            $("#hrg_input2").val('');
            $("." + inputValue).toggle();
        });
        function myFunction() {
        var checkBox = document.getElementById("checkbox-harga");
        var senin = document.getElementById("senin");
        if (checkBox.checked == true){
            $("#senin").html("Senin-Minggu");
        } else {
            $("#senin").html("Senin");
        }
        }
        
    </script>
@endpush
