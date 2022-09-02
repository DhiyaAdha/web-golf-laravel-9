@extends('Layouts.Main')

@section('content')


<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row heading-bg">
            <!-- Breadcrumb -->
            <div class="row">
                <div class="container-fluid">
                    <div class="col-lg-8">
                        <h5>Tambah admin</h5>
                    </div>
                </div>
            </div>
            <!-- /Breadcrumb -->
        </div>
        <div class="row">
            <div class="col-lg-12" style="position: relative;">
                <div style="height: 900px" class="panel panel-default card-view">
                    <h6 class="control-label mb-10">Tambah admin</h6>
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form action="/tambah-admin" method="post">
                                <div class="form-group">
                                    <label class="control-label mb-10" for="">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="result" size="50px" placeholder="Masukan Nama" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10" for="">Alamat</label>
                                    <input type="text" class="form-control" id="result" size="50px" placeholder="Masukan Alamat" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10" for="">Jenis Kelamin</label>
                                    <div class="form-check">
                                        <label class="radio-inline">
                                            <input type="radio" name="survey" id="Radios1" value="Yes">Pria
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="survey" id="Radios2" value="No">Wanita
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10" for="">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Masukan Email" @error('email') is-invalid @enderror autofocus required value="{{ old('email') }}">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10" for="">Nomer Hp</label>
                                    <input type="number" class="form-control" id="result" size="50px" placeholder="Masukan Nomer Hp" required autofocus>
                                </div>
                                <div class="form-check">
                                    <label class="radio-inline">
                                        <input type="radio" name="radio1" id="radio_1" value="option1" checked="">Super Admin
                                    </label>
                                    <label class="radio-inline">
                                        <input  type="radio" name="radio1" id="radio_2" value="option2" checked="">Admin
                                    </label>
                                </div>
                                <div class="form-group text-left">
                                    <button type="submit" class="btn btn-info">Selanjutnya</button>
                                </div>
                            </form>
                        </div>
                        <!-- /Basic Table -->
                    </div>
                </div>

            </div>

        </div>
    </div>
    @endsection
    <script>

    </script>