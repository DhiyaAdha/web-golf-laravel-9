@extends('layouts.main', ['title' => 'TGCC | Edit Tamu'])
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Edit Tamu</h5>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('analisis-tamu') }}">Dashboard</a></li>
                        <li><a href="{{ url('daftar-tamu') }}">Daftar Tamu</a></li>
                        <li class="active"><span>Paket Bermain</span></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" style="position: relative;">
                    <div style="" class="panel panel-default card-view">
                        <div class="panel-body">
                            <div class="form-wrap">
                                <form action="{{ route('update-tamu', $visitor->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="col-lg-6">
                                        <div class="form-group @error('NIK') has-error @enderror">
                                            <label class="control-label mb-10" for="name">NIK KTP</label>
                                            <input type="text" name="nik" value="{{ $visitor->nik }}" class="form-control" id="NIK" size="50px" placeholder="Masukan NIK" autofocus required>
                                            @error('nik')
                                                <div class="text-danger"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="checkbox checkbox-success">
                                            <input id="status_nik" name="status_nik" type="checkbox" {{ $visitor->status_nik == 'yes' ? 'checked' : '' }}>
                                            <label for="status_nik">apakah anda yakin mengisi deposit tanpa mengisi NIK KTP?</label>
                                        </div>
                                        <div class="form-group @error('name') has-error @enderror" style="margin-top: 1.5rem;">
                                            <label class="control-label mb-10" for="name">Nama Lengkap</label>
                                            <input type="text" name="name" value="{{ $visitor->name }}" class="form-control" id="name" size="50px" placeholder="Masukan Nama" autofocus>
                                            @error('name')
                                                <div class="text-danger"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group @error('address') has-error @enderror">
                                            <label class="control-label mb-10" for="address">Alamat</label>
                                            <input type="text" class="form-control" name="address" value="{{ $visitor->address }}" id="address" size="50px" placeholder="Masukan Alamat" autofocus>
                                                @error('address')
                                                <div class="text-danger"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group @error('gender') has-error @enderror">
                                            <label class="control-label mb-10" for="gender">Jenis Kelamin</label>
                                            <div class="radio-list">
                                                <div class="radio-inline pl-0">
                                                    <span class="radio radio-info"> 
                                                        <input type="radio" name="gender" value="laki-laki" id="laki-laki" {{  $visitor->gender == 'laki-laki' ? 'checked' : '';  }}>
                                                        <label for="laki-laki">Laki-laki</label>
                                                    </span>
                                                </div>
                                                <div class="radio-inline pl-0">
                                                    <span class="radio radio-info"> 
                                                        <input type="radio" name="gender" value="perempuan" id="perempuan" {{  $visitor->gender == 'perempuan' ? 'checked' : '';  }}>
                                                        <label for="perempuan">Perempuan</label>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group @error('email') has-error @enderror">
                                            <label class="control-label mb-10" for="">Email</label>
                                            <input type="email" name="email" value="{{ $visitor->email }}" class="form-control" id="email" placeholder="Masukan Email" @error('email') is-invalid @enderror autofocus value="{{ old('email') }}">
                                            @error('email')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group @error('phone') has-error @enderror">
                                            <label  class="control-label mb-10" for="">Nomer Hp</label>
                                            <input type="text" value="{{ $visitor->phone }}" name="phone" class="form-control" id="phone" size="50px" placeholder="Masukan Nomer Hp" autofocus>
                                            @error('phone')
                                                <div class="text-danger"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group @error('company') has-error @enderror">
                                            <label class="control-label mb-10" for="">Perusahaan</label>
                                            <input type="text" name="company" value="{{ $visitor->company }}" class="form-control" id="company" size="50px" placeholder="Masukan Nama Perusahaan" autofocus>
                                            @error('company')
                                                <div class="text-danger"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group @error('position') has-error @enderror">
                                            <label class="control-label mb-10" for="">Jabatan</label>
                                            <input type="text" name="position" value="{{ $visitor->position }}" class="form-control" id="position" size="50px" placeholder="Masukan Jabatan" autofocus>
                                                @error('position')
                                                <div class="text-danger"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group @error('handicap') has-error @enderror">
                                            <label class="control-label mb-10" for="">Handicap</label>
                                            <input type="text" name="handicap" value="{{ $visitor->handicap }}" class="form-control" id="handicap" size="50px" placeholder="Masukan Jabatan" autofocus>
                                                @error('handicap')
                                                <div class="text-danger"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-5" for="">Jenis member
                                            <label class="switch" style="margin-top:10px;">
                                                <input class="cmn-toggle cmn-toggle-round-flat" type="hidden" value="VIP" name="tipe_member">
                                                <input type="checkbox" name="tipe_member" type="checkbox" id="tipe" value="VVIP" {{ $visitor->tipe_member == 'VVIP' ? ' checked' : '' }}>
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
                                                        <input type="radio" name="category" id="category-a" value="pertamina" {{  $visitor->category == 'pertamina' ? 'checked' : '';  }}>
                                                        <label for="category-a">PERTAMINA</label>
                                                    </span>
                                                </div>
                                                <div class="radio-inline pl-0">
                                                    <span class="radio radio-info"> 
                                                        <input type="radio" name="category" id="category-b" value="pensiunan" {{  $visitor->category == 'pensiunan' ? 'checked' : '';  }}>
                                                        <label for="category-b">PENSIUNAN</label>
                                                    </span>
                                                </div>
                                                <div class="radio-inline pl-0">
                                                    <span class="radio radio-info"> 
                                                        <input type="radio" name="category" id="category-c" value="forkopimda" {{  $visitor->category == 'forkopimda' ? 'checked' : '';  }}>
                                                        <label for="category-c">FORKOPIMDA</label>
                                                    </span>
                                                </div>
                                                <div class="radio-inline pl-0">
                                                    <span class="radio radio-info"> 
                                                        <input type="radio" name="category" id="category-d" value="perpesi" {{  $visitor->category == 'perpesi' ? 'checked' : '';  }}>
                                                        <label for="category-d">PERPESI</label>
                                                    </span>
                                                </div>
                                                <div class="radio-inline pl-0">
                                                    <span class="radio radio-info"> 
                                                        <input type="radio" name="category" id="category-e" value="umum" {{  $visitor->category == 'umum' ? 'checked' : '';  }}>
                                                        <label for="category-e">UMUM</label>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-5" for="">Status Member
                                            <label class="switch" style="margin-top:10px;">
                                                <input class="cmn-toggle cmn-toggle-round-flat" type="hidden" name="status" value="active" {{ $visitor->status == 'active' ? ' checked' : '' }}>
                                                <input type="checkbox" name="status" type="checkbox" id="tipe" value="inactive" {{ $visitor->status == 'inactive' ? ' checked' : '' }}>
                                                <div class="status-member round switch">
                                                    <span class="off" style="margin-left: 10px !important;">Ya</span>
                                                    <span class="on">Tidak</span>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="form-group text-left">
                                            <button type="submit" class="btn btn-info">Simpan</button></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts.footer')
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).on('change', '#status_nik', function () {
            if($('#status_nik').prop('checked')) {
                $('#NIK').removeAttr('required')
            } else {
                $('#NIK').attr('required','')
            }
        })
    </script>
@endpush