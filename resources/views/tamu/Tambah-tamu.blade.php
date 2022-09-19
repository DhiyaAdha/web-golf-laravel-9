@extends('Layouts.Main')

@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Tambah Tamu</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('analisis-tamu') }}">Dashboard</a></li>
                    <li><a href="{{ url('daftar-tamu') }}">Daftar Tamu</a></li>
                    <li class="active"><span>Tambah Tamu</span></li>
                </ol>
            </div>
            <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->
        <div class="row">
            <div class="col-lg-12" style="position: relative;">
                <div class="panel panel-default card-view">
                    <h6 class="control-label mb-10">Tambah Tamu</h6>
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form action="{{ route('inserttamu') }}" method="POST">
                                @csrf
                                <div class="form-group @error('name') has-error @enderror">
                                    <label class="control-label mb-10" for="">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control" id="name" size="50px" placeholder="Masukan Nama" autofocus value="{{ old('name') }}">
                                    @error('name')
                                    <div class="text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group @error('address') has-error @enderror">
                                    <label class="control-label mb-10" for="address">Alamat</label>
                                    <input type="text" class="form-control" name="address" id="address" size="50px" placeholder="Masukan Alamat" autofocus value="{{ old('address') }}">
                                    @error('address')
                                    <div class="text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group @error('gender') has-error @enderror">
                                    <label class="control-label mb-10 text-left">Jenis Kelamin</label>
                                    <div class="radio-list">
                                        <div class="radio-inline pl-0">
                                            <span class="radio radio-info"> <input type="radio" name="gender" id="gender-m" value="laki-laki">
                                                <label for="gender-m">Laki-laki</label>
                                            </span>
                                        </div>
                                        <div class="radio-inline pl-0">
                                            <span class="radio radio-info"> <input type="radio" name="gender" id="gender-w" value="perempuan">
                                                <label for="gender-w">Perempuan</label>
                                            </span>
                                        </div>
                                    </div>
                                    @error('gender')
                                    <div class="text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group @error('email') has-error @enderror">
                                    <label class="control-label mb-10" for="">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Masukan Email" value="{{ old('email') }}">
                                    @error('email')
                                    <div class="text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group @error('phone') has-error @enderror">
                                    <label class="control-label mb-10" for="">Nomer Hp</label>
                                    <input type="text" min="0" onkeypress="return event.charCode >= 48 && event.charCode <=57" name="phone" class="form-control" id="phone" size="50px" placeholder="Masukan Nomer Hp" value="{{ old('phone') }}">
                                    @error('phone')
                                    <div class="text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group @error('company') has-error @enderror">
                                    <label class="control-label mb-10" for="">Perusahaan</label>
                                    <input type="text" name="company" class="form-control" id="company" size="50px" placeholder="Masukan Nama Perusahaan" value="{{ old('company') }}">
                                    @error('company')
                                    <div class="text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group @error('position') has-error @enderror">
                                    <label class="control-label mb-10" for="">Jabatan</label>
                                    <input type="text" name="position" class="form-control" id="position" size="50px" placeholder="Masukan Jabatan" value="{{ old('position') }}">
                                    @error('position')
                                    <div class="text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10" for="">Tamu Ini Adalah Tamu VIP
                                        <div class="switch">
                                            <input class="cmn-toggle cmn-toggle-round-flat" type="hidden" value="VVIP" name="tipe_member">
                                            <input id="cmn-toggle-4" class="cmn-toggle cmn-toggle-round-flat" name="tipe_member" type="checkbox" value="VIP">
                                            <label for="cmn-toggle-4"></label>
                                        </div>
                                    </label>
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
        @include('Layouts.Footer')
    </div>
</div>
@endsection