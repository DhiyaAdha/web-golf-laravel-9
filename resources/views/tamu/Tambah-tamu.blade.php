
@extends('Layouts.main')
@section('content')
    <div class="page-wrapper" style="min-height: 259px;">
        <div class="container-fluid">
            <!-- Title -->
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Tambah tamu</h5>
                </div>

                <!-- Breadcrumb -->
                
                <!-- /Breadcrumb -->

            </div>
            <!-- /Title -->

            <!-- Row -->
            
            {{-- daha --}}

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
                                    <form action="/inserttamu" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="">Nama Lengkap</label>
                                            <input type="text" name="name" class="form-control" id="name"
                                                size="50px" placeholder="Masukan Nama" required autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="address">Alamat</label>
                                            <input type="text" class="form-control" name="address" id="address"
                                                size="50px" placeholder="Masukan Alamat" required autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="gender">Jenis Kelamin</label>
                                            <div class="form-check">
                                                <label class="radio-inline">
                                                    <input type="radio" name="gender" id="gender" value="laki-laki">Pria
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="gender" id="gender" value="perempuan">Wanita
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="">Email</label>
                                            <input type="email" name="email" class="form-control" id="email"
                                                placeholder="Masukan Email" @error('email') is-invalid @enderror required
                                                value="{{ old('email') }}">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="">Nomer Hp</label>
                                            <input type="text" min="0" name="phone" class="form-control"
                                                id="phone" size="50px" placeholder="Masukan Nomer Hp" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="">Perusahaan</label>
                                            <input type="text" name="company" class="form-control" id="company"
                                                size="50px" placeholder="Masukan Nama Perusahaan" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="">Jabatan</label>
                                            <input type="text" name="position" class="form-control" id="position"
                                                size="50px" placeholder="Masukan Jabatan" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="">Tamu Ini Adalah Tamu VIP
                                                <div class="switch">
                                                    <input class="cmn-toggle cmn-toggle-round-flat" type="hidden"
                                                        value="VVIP" name="tipe_member">
                                                    <input id="cmn-toggle-4" class="cmn-toggle cmn-toggle-round-flat"
                                                        name="tipe_member" type="checkbox" value="VIP">
                                                    <label for="cmn-toggle-4"></label>
                                                </div>
                                        </div>
                                        <div class="form-group text-left">
                                            <button type="submit" class="btn btn-info">Selanjutnya</button>
                                        </div>
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