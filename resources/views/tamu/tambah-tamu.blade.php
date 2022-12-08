@extends('layouts.main', ['title' => 'TGCC | Tambah Tamu'])
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Tambah Tamu</h5>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('analisis-tamu') }}">Dashboard</a></li>
                        <li><a href="{{ url('daftar-tamu') }}">Daftar Tamu</a></li>
                        <li class="active"><span>Tambah Tamu</span></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" style="position: relative;">
                    <div class="panel panel-default card-view">
                        <div class="panel-body">
                            <div class="form-wrap">
                                <form id="form1" action="{{ route('inserttamu') }}" method="POST" onsubmit="myFunction()">
                                    @csrf
                                    <div class="form-group @error('nik') has-error @enderror">
                                        <label class="control-label mb-10" for="">NIK KTP</label>
                                        <input type="text" name="nik" class="form-control" id="nik"
                                            size="50px" onkeypress="return event.charCode >= 48 && event.charCode <=57"
                                            placeholder="Masukan nik" value="{{ old('nik') }}" autofocus required>
                                        @error('nik')
                                            <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="checkbox checkbox-success">
                                        <input id="status_nik" name="status_nik" type="checkbox">
                                        <label for="status_nik">apakah anda yakin mengisi deposit tanpa mengisi NIK
                                            KTP?</label>
                                    </div>
                                    <div class="form-group @error('name') has-error @enderror" style="margin-top: 1.5rem;">
                                        <label class="control-label mb-10" for="">Nama Lengkap</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            size="50px" placeholder="Masukan Nama" value="{{ old('name') }}" autofocus>
                                        @error('name')
                                            <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group @error('address') has-error @enderror">
                                        <label class="control-label mb-10" for="address">Alamat</label>
                                        <input type="text" class="form-control" name="address" id="address"
                                            size="50px" placeholder="Masukan Alamat" value="{{ old('address') }}"
                                            autofocus>
                                        @error('address')
                                            <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group @error('gender') has-error @enderror">
                                        <label class="control-label mb-10 text-left">Jenis Kelamin</label>
                                        <div class="radio-list">
                                            <div class="radio-inline pl-0">
                                                <span class="radio radio-info"> <input type="radio" name="gender"
                                                        id="gender-m" value="Laki-laki"
                                                        {{ old('gender') == 'Laki-laki' ? 'checked=' . '"' . 'checked' . '"' : '' }}>
                                                    <label for="gender-m">Laki-laki</label>
                                                </span>
                                            </div>
                                            <div class="radio-inline pl-0">
                                                <span class="radio radio-info"> <input type="radio" name="gender"
                                                        id="gender-w" value="Perempuan"
                                                        {{ old('gender') == 'Perempuan' ? 'checked=' . '"' . 'checked' . '"' : '' }}>
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
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="Masukan Email" value="{{ old('email') }}">
                                        @error('email')
                                            <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group @error('phone') has-error @enderror">
                                        <label class="control-label mb-10" for="">Nomor Hp</label>
                                        <input type="text"
                                            onkeypress="return event.charCode >= 48 && event.charCode <=57" name="phone"
                                            class="form-control" id="phone" size="50px"
                                            placeholder="Masukan Nomor Hp" value="{{ old('phone') }}">
                                        @error('phone')
                                            <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group @error('company') has-error @enderror">
                                        <label class="control-label mb-10" for="">Perusahaan</label>
                                        <input type="text" name="company" class="form-control" id="company"
                                            size="50px" value="{{ old('company') }}"
                                            placeholder="Masukan Nama Perusahaan">
                                        @error('company')
                                            <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group @error('position') has-error @enderror">
                                        <label class="control-label mb-10" for="">Jabatan</label>
                                        <input type="text" name="position" class="form-control" id="position"
                                            size="50px" value="{{ old('position') }}" placeholder="Masukan Jabatan">
                                        @error('position')
                                            <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group @error('handicap') has-error @enderror">
                                        <label class="control-label mb-10" for="">Handicap</label>
                                        <input type="text" name="handicap"
                                            onkeypress="return event.charCode >= 48 && event.charCode <=57"
                                            class="form-control" id="handicap" size="50px"
                                            value="{{ old('handicap') }}" placeholder="Isi Ranking">
                                        @error('handicap')
                                            <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-10" for="">Jenis member</label>
                                        <label class="switch">
                                            <input class="cmn-toggle cmn-toggle-round-flat" type="hidden" value="VIP"
                                                name="tipe_member">
                                            <input type="checkbox" name="tipe_member" value="VVIP">
                                            <div class="slider round switch">
                                                <span class="off" style="margin-left: 10px !important;">Member</span>
                                                <span class="on">VIP</span>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="form-group @error('category') has-error @enderror">
                                        <label class="control-label mb-10 text-left">Jenis Kategori</label>
                                        <div class="radio-list">
                                            <div class="radio-inline pl-0">
                                                <span class="radio radio-info">
                                                    <input type="radio" name="category" id="category-a"
                                                        value="pertamina"
                                                        {{ old('category') == 'pertamina' ? 'checked=' . '"' . 'checked' . '"' : '' }}>
                                                    <label for="category-a">PERTAMINA</label>
                                                </span>
                                            </div>
                                            <div class="radio-inline pl-0">
                                                <span class="radio radio-info">
                                                    <input type="radio" name="category" id="category-b"
                                                        value="pensiunan"
                                                        {{ old('category') == 'pensiunan' ? 'checked=' . '"' . 'checked' . '"' : '' }}>
                                                    <label for="category-b">PENSIUNAN</label>
                                                </span>
                                            </div>
                                            <div class="radio-inline pl-0">
                                                <span class="radio radio-info">
                                                    <input type="radio" name="category" id="category-c"
                                                        value="forkopimda"
                                                        {{ old('category') == 'forkopimda' ? 'checked=' . '"' . 'checked' . '"' : '' }}>
                                                    <label for="category-c">FORKOPIMDA</label>
                                                </span>
                                            </div>
                                            <div class="radio-inline pl-0">
                                                <span class="radio radio-info">
                                                    <input type="radio" name="category" id="category-d"
                                                        value="perpesi"
                                                        {{ old('category') == 'perpesi' ? 'checked=' . '"' . 'checked' . '"' : '' }}>
                                                    <label for="category-d">PERPESI</label>
                                                </span>
                                            </div>
                                            <div class="radio-inline pl-0">
                                                <span class="radio radio-info">
                                                    <input type="radio" name="category" id="category-e" value="umum"
                                                        {{ old('category') == 'umum' ? 'checked=' . '"' . 'checked' . '"' : '' }}>
                                                    <label for="category-e">UMUM</label>
                                                </span>
                                            </div>
                                        </div>
                                        @error('category')
                                            <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-10" for="">Status Aktif</label>
                                        <label class="switch">
                                            <input class="cmn-toggle cmn-toggle-round-flat" type="hidden" name="status"
                                                value="active">
                                            <input type="checkbox" name="status" value="inactive">
                                            <div class="status-member round switch">
                                                <span class="off" style="margin-left: 10px !important;">Ya</span>
                                                <span class="on">Tidak</span>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="form-group text-left" style="margin-top: 1.5rem !important;">
                                        <button type="submit" class="btn btn-info">Selanjutnya</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts.footer')
            </div>
        </div>
    @endsection
    @push('scripts')
        <script>
            $(document).on('change', '#status_nik', function () {
                if($('#status_nik').prop('checked')) {
                    $('#nik').removeAttr('required')
                } else {
                    $('#nik').attr('required','')
                }
            })
        </script>
    @endpush
