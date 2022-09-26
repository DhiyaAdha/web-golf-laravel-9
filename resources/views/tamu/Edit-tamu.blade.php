@extends('Layouts.main')
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <!-- Title -->
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Edit Tamu</h5>
                </div>
                <!-- Breadcrumb -->
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('analisis-tamu') }}">Dashboard</a></li>
                        <li><a href="{{ url('daftar-tamu') }}">Daftar Tamu</a></li>
                        <li class="active"><span>Paket Bermain</span></li>
                    </ol>
                </div>

                <!-- Breadcrumb -->

                <!-- /Breadcrumb -->
            </div>
            <!-- /Title -->
            <div class="row">
                <div class="col-lg-12" style="position: relative;">
                    <div style="height: 900px" class="panel panel-default card-view">
                        <h6 class="control-label mb-10">Edit Tamu</h6>
                        <div class="panel-body">
                            <div class="form-wrap">
                                <form action="{{ route('update-tamu', $visitor->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="name">Nama Lengkap</label>
                                            <input type="text" name="name" value="{{ $visitor->name }}"
                                                class="form-control" id="name" size="50px"
                                                placeholder="Masukan Nama" required autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="address">Alamat</label>
                                            <input type="text" class="form-control" name="address"
                                                value="{{ $visitor->address }}" id="address" size="50px"
                                                placeholder="Masukan Alamat" required autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="gender">Jenis Kelamin</label>
                                            <div class="form-check">
                                                <label class="radio-inline">
                                                    <input type="radio" name="gender" id="gender" value="laki-laki"
                                                        <?php echo $visitor->gender == 'laki-laki' ? 'checked' : ''; ?>>Pria
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="gender" id="gender" value="perempuan"
                                                        <?php echo $visitor->gender == 'perempuan' ? 'checked' : ''; ?>>Wanita
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="">Email</label>
                                            <input type="email" name="email" value="{{ $visitor->email }}"
                                                class="form-control" id="email" placeholder="Masukan Email"
                                                @error('email') is-invalid @enderror autofocus required
                                                value="{{ old('email') }}">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="">Nomer Hp</label>
                                            <input type="text" min="0"
                                                onkeypress="return event.charCode >= 48 && event.charCode <=57"
                                                name="phone" value="{{ $visitor->phone }}" class="form-control"
                                                id="phone" size="50px" placeholder="Masukan Nomer Hp" required
                                                autofocus>
                                        </div>
                                        
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="">Perusahaan</label>
                                            <input type="text" name="company" value="{{ $visitor->company }}"
                                                class="form-control" id="company" size="50px"
                                                placeholder="Masukan Nama Perusahaan" required autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="">Jabatan</label>
                                            <input type="text" name="position" value="{{ $visitor->position }}"
                                                class="form-control" id="position" size="50px"
                                                placeholder="Masukan Jabatan" required autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="">Tipe Member Tamu Ini Adalah
                                                {{-- <div class="switch">
                                                    <input class="cmn-toggle cmn-toggle-round-flat" type="hidden"
                                                        value="VVIP" name="tipe_member">
                                                    <input id="cmn-toggle-4" class="cmn-toggle cmn-toggle-round-flat"
                                                        name="tipe_member" type="checkbox" value="VIP"
                                                        {{ $visitor->tipe_member == 'VIP' ? ' checked' : '' }}>
                                                    <label for="cmn-toggle-4"></label>
                                                </div> --}}

                                                <label class="switch">
                                                    <input class="cmn-toggle cmn-toggle-round-flat" type="hidden" value="VIP" name="tipe_member">
                                                    <input type="checkbox" name="tipe_member" type="checkbox" id="tipe" value="VVIP" {{ $visitor->tipe_member == 'VVIP' ? ' checked' : '' }}>
                                                    <div class="slider round switch">
                                                        <!--ADDED HTML -->
                                                        <span class="off">VIP</span>
                                                        <span class="on">VVIP</span> 
                                                        <!--END-->
                                                    </div>
                                                </label>
                                        </div>
                                        {{-- <div class="form-group">
                                            <label class="control-label mb-10" for="">quota</label>
                                            <input type="quota  " name="quota" value="{{ $limit->quota }}"
                                            class="form-control" id="quota" placeholder="Masukan quota"
                                            autofocus required
                                            value="{{ old('quota') }}">
                                        </div> --}}
                                        <div class="form-group text-left">
                                            <button type="submit" class="btn btn-info">Simpan</button></a>
                                        </div>
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
