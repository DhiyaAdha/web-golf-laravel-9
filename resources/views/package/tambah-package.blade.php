@extends('Layouts.main')
@section('content')
    <div class="page-wrapper" style="min-height: 259px;">
        <div class="container-fluid">
            <!-- Title -->
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Tambah Paket</h5>
                </div>

                <!-- Breadcrumb -->
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="index.html">Dashboard</a></li>
                        <li><a href="#"><span>Tambah paket</span></a></li>
                        <li class="active"><span>Tambah paket bermain</span></li>
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
                                <h6 class="panel-title txt-dark">Tambah Paket</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="form-wrap">
                                    <form action="{{ route('package.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label class="control-label mb-10 text-left" for="example-email">Nama Paket<span
                                                    class="help"></span></label>
                                            <input type="text" id="example-email" name="name" class="form-control"
                                                placeholder="Masukan nama paket" required>
                                        </div>
                                        <div class="form-group mb-30">
                                            <label class="control-label mb-10 text-left">Kategori Paket</label>
                                            <div class="radio-list">
                                                <div class="radio-inline pl-0">
                                                    <span class="radio radio-info"> <input type="radio" name="category"
                                                            id="radio_9" value="default" required>
                                                        <label for="radio_9">Default</label>
                                                    </span>
                                                </div>
                                                <div class="radio-inline pl-0">
                                                    <span class="radio radio-info"> <input type="radio" name="category"
                                                            id="radio_10" value="additional" required>
                                                        <label for="radio_10">Additional</label>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10 text-left" for="example-email">Harga
                                                Weekdays<span class="help"></span></label>
                                            <div class="input-group">
                                                <div class="input-group-addon">Rp</div>
                                                <input type="text" min="0"
                                                    onkeypress="return event.charCode >= 48 && event.charCode <=57"
                                                    class="form-control" name="price_weekdays"
                                                    placeholder="Masukan harga weekdays" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10 text-left" for="example-email">Harga
                                                Weekend<span class="help"></span></label>
                                            <div class="input-group">
                                                <div class="input-group-addon">Rp</div>
                                                <input type="text" min="0"
                                                    onkeypress="return event.charCode >= 48 && event.charCode <=57"
                                                    class="form-control" name="price_weekend"
                                                    placeholder="Masukan harga weekend" required>
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
            <!-- /Row -->
        </div>

        <!-- Footer -->
        @include('Layouts.Footer')
        <!-- /Footer -->
    </div>
@endsection
