@extends('Layouts.main')
@section('content')
    <div class="page-wrapper" style="min-height: 259px;">
        <div class="container-fluid">
            <!-- Title -->
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Edit Paket</h5>
                </div>
                <!-- Breadcrumb -->
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('analisis-tamu') }}">Dashboard</a></li>
                        <li><a href="{{ url('package') }}"><span>Daftar Paket</span></a></li>
                        <li class="active"><span>Edit paket bermain</span></li>
                    </ol>
                </div>
                <!-- /Breadcrumb -->
            </div>
            <!-- /Title -->

            <!-- Row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Edit Paket</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="form-wrap">
                                    <form action="{{ route('package.update', $package->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group @error('name') has-error @enderror">
                                            <label class="control-label mb-10 text-left" for="example-email">Nama Paket<span
                                                    class="help"></span></label>
                                            <input type="text" id="example-email" name="name"
                                                value="{{ $package->name }}" class="form-control"
                                                placeholder="Masukan nama paket">
                                                @error('name')
                                                <div class="text-danger"> {{ $message }}</div>
                                                @enderror
                                        </div>
                                        <div class="form-group mb-30 @error('category') has-error @enderror">
                                            <label class="control-label mb-10 text-left">Kategori Paket</label>
                                            <div class="radio-list">
                                                <div class="radio-inline pl-0">
                                                    <span class="radio radio-info"> <input type="radio" name="category"
                                                            id="radio_9" value="default"
                                                            {{ $package->category == 'default' ? 'checked' : '' }}>
                                                        <label for="radio_9">Default</label>
                                                    </span>
                                                </div>
                                                <div class="radio-inline pl-0">
                                                    <span class="radio radio-info"> <input type="radio" name="category"
                                                            id="radio_10" value="additional"
                                                            {{ $package->category == 'additional' ? 'checked' : '' }}
                                                        >
                                                        <label for="radio_10">Additional</label>
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
                                                    <span class="radio radio-info"> <input type="radio" name="status"
                                                            id="radio_11" value="0"
                                                            {{ $package->status == 0 ? 'checked' : '' }}>
                                                        <label for="radio_11">ON</label>
                                                    </span>
                                                </div>
                                                <div class="radio-inline pl-0">
                                                    <span class="radio radio-info"> <input type="radio" name="status"
                                                            id="radio_12" value="1"
                                                            {{ $package->status == 1 ? 'checked' : '' }}>
                                                        <label for="radio_12">OFF</label>
                                                    </span>
                                                </div>
                                            </div>
                                            @error('status')
                                                <div class="text-danger"> {{ $message }}</div>
                                                @enderror
                                        </div>
                                        <div class="form-group @error('price_weekdays') has-error @enderror">
                                            <label class="control-label mb-10 text-left" for="example-email">Harga
                                                Weekdays<span class="help"></span></label>
                                            <div class="input-group">
                                                <div class="input-group-addon">Rp</div>
                                                <input type="text" min="0"
                                                    onkeypress="return event.charCode >= 48 && event.charCode <=57"
                                                    class="form-control" name="price_weekdays"
                                                    value="{{ $package->price_weekdays }}"
                                                    placeholder="Masukan harga weekdays">
                                            </div>
                                            @error('price_weekdays')
                                                <div class="text-danger"> {{ $message }}</div>
                                                @enderror
                                        </div>
                                        <div class="form-group @error('price_weekend') has-error @enderror">
                                            <label class="control-label mb-10 text-left" for="example-email">Harga
                                                Weekend<span class="help"></span></label>
                                            <div class="input-group">
                                                <div class="input-group-addon">Rp</div>
                                                <input type="text" min="0"
                                                    onkeypress="return event.charCode >= 48 && event.charCode <=57"
                                                    class="form-control" name="price_weekend"
                                                    value="{{ $package->price_weekend }}"
                                                    placeholder="Masukan harga weekend">
                                            </div>
                                            @error('price_weekend')
                                                <div class="text-danger"> {{ $message }}</div>
                                                @enderror
                                        </div>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Row -->
        </div>

        <!-- Footer -->
        @include('Layouts.Footer')
        <!-- /Footer -->
    </div>
@endsection
