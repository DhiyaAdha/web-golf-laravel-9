@extends('layouts.main', ['title' => 'TGCC | Edit Paket Bermain'])
@section('content')
    <div class="page-wrapper intro-foo">
        <div class="container-fluid">
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Edit Paket</h5>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('analisis-tamu') }}">Dashboard</a></li>
                        <li><a href="{{ url('package') }}"><span>Daftar Paket</span></a></li>
                        <li class="active"><span>Edit paket bermain</span></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" >
                    <div class="panel panel-default card-view" data-title="Edit Paket" data-intro="Panel ini merupakan panel proses edit data atau informasi paket. Proses edit bersifat opsional sesuai kebutuhan.">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="form-wrap">
                                    <form action="{{ route('package.update', $package->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group @error('name') has-error @enderror">
                                            <label class="control-label mb-10 text-left" for="example-email">Nama Paket
                                                <span class="help"></span>
                                            </label>
                                            <input type="text" id="example-email" name="name" value="{{ $package->name }}" class="form-control" placeholder="Masukan nama paket">
                                            @error('name')
                                                <div class="text-danger"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-30 @error('category') has-error @enderror">
                                            <label class="control-label mb-10 text-left">Kategori Paket</label>
                                            <div class="radio-list">
                                                <div class="radio-inline pl-0">
                                                    <span class="radio radio-info"> 
                                                        <input type="radio" name="category" id="radio_9" value="default" {{ $package->category == 'default' ? 'checked' : '' }}>
                                                        <label for="radio_9">Permainan</label>
                                                    </span>
                                                </div>
                                                <div class="radio-inline pl-0">
                                                    <span class="radio radio-info"> 
                                                        <input type="radio" name="category" id="radio_10" value="additional" {{ $package->category == 'additional' ? 'checked' : '' }}>
                                                        <label for="radio_10">Fasilitas</label>
                                                    </span>
                                                </div>
                                                <div class="radio-inline pl-0">
                                                    <span class="radio radio-info"> 
                                                        <input type="radio" name="category" id="radio_11" value="others" {{ $package->category == 'others' ? 'checked' : '' }}>
                                                        <label for="radio_11">Kantin</label>
                                                    </span>
                                                </div>
                                            </div>
                                            @error('category')
                                                <div class="text-danger"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-30 @error('status') has-error @enderror">
                                            <label class="control-label mb-10 text-left">Status Paket</label>
                                            <div class="radio-list">
                                                <div class="radio-inline pl-0">
                                                    <span class="radio radio-info"> 
                                                        <input type="radio" name="status" id="radio_12" value="0" {{ $package->status == 0 ? 'checked' : '' }}>
                                                        <label for="radio_12">ON</label>
                                                    </span>
                                                </div>
                                                <div class="radio-inline pl-0">
                                                    <span class="radio radio-info"> 
                                                        <input type="radio" name="status" id="radio_13" value="1" {{ $package->status == 1 ? 'checked' : '' }}>
                                                        <label for="radio_13">OFF</label>
                                                    </span>
                                                </div>
                                            </div>
                                            @error('status')
                                                <div class="text-danger"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="form-group @error('price_discount') has-error @enderror">
                                                <label class="control-label mb-10 text-left" for="examp">
                                                    <label class="control-label mb-10 text-left" for="example-email">senin<span class="help"></span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">Rp</div>
                                                        <input type="text" value="{{ $package->price_discount }}" min="0" onkeypress="return event.charCode >= 48 && event.charCode <=57" class="form-control" name="price_discount" placeholder="harga hari senin">
                                                    </div>
                                                    @error('price_discount')
                                                        <div class="text-danger"> {{ $message }}</div>
                                                    @enderror
                                            </div>
                                            <div class="form-group @error('price_weekdays') has-error @enderror">
                                                <label class="control-label mb-10 text-left" for="examp">
                                                    <label class="control-label mb-10 text-left" for="example-email">selasa - jumat<span class="help"></span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">Rp</div>
                                                        <input type="text" value="{{ $package->price_weekdays }}" min="0" onkeypress="return event.charCode >= 48 && event.charCode <=57" class="form-control" name="price_weekdays" placeholder="harga selasa - jumat">
                                                    </div>
                                                    @error('price_weekdays')
                                                        <div class="text-danger"> {{ $message }}</div>
                                                    @enderror
                                            </div>
                                            <div class="form-group @error('price_weekend') has-error @enderror">
                                                <label class="control-label mb-10 text-left" for="examp">
                                                    <label class="control-label mb-10 text-left" for="example-email">sabtu - minggu<span class="help"></span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">Rp</div>
                                                        <input type="text" value="{{ $package->price_weekend }}"min="0"onkeypress="return event.charCode >= 48 && event.charCode <=57"class="form-control" name="price_weekend" placeholder="harga sabtu - minggu">
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
        <button id="setting_panel_btn" data-toggle="tooltip" title="Panduan" data-placement="left" class="btn btn-success btn-circle setting-panel-btn shadow-2dp"><i class="zmdi zmdi-settings"></i></button>
        @include('layouts.footer')
    </div>
@endsection

@push('scripts')
    <script defer src="{{ asset('dist/asset_offline/list_invoice.js') }}"></script>
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
        
        $(document).on('click', '#setting_panel_btn', function() {
            introJs('.intro-foo').setOptions({
                'showProgress': true,
                'tooltipPosition': 'right'
            }).start();
        });
    </script>
@endpush
