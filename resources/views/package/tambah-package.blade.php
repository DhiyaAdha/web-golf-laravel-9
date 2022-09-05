@extends('Layouts.main')
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row heading-bg">
                @include('Layouts.Breadcrumb')
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default card-view" style="height: 650px">
                        <h5 class="mb-10 mt-10">Tambah Paket</h5>
                        <div class="panel-body">
                            <div class="form-warp">
                                <form action="/insertpackage" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="control-label mb-10 text-left">Nama Paket</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Masukan Nama Paket" required>
                                        <label class="control-label mb-10 mt-10 text-left">Deskripsi</label>
                                        <textarea class="form-control" rows="6" placeholder="Masukan Deskripsi"></textarea>
                                        <label class="control-label mb-1 mt-10 text-left">Kategori Permainan</label>
                                        <div class="row">
                                            <div class="col-lg-1">
                                                <div class="radio radio-custom">
                                                    <input type="radio" name="category" value="Package" id="package">
                                                    <label for="package"> Package </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-1">
                                                <div class="radio radio-custom">
                                                    <input type="radio" name="category" value="Additional"
                                                        id="additional">
                                                    <label for="additional"> Additional </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="control-label mb-10 mt-10 text-left">Harga Weekdays</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">Rp</div>
                                                    <input type="text" name="price_weekdays" id="">
                                                    <label class="form-control">150.000</label>
                                                </div>
                                                <label class="control-label mb-10 mt-10 text-left">Harga Weekend</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">Rp</div>
                                                    <input type="text" name="price_weekend" id="">
                                                    <label class="form-control">200.000</label>
                                                </div>
                                                <button type="submit" class="btn btn-success mt-15">Tambah Paket</button>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
