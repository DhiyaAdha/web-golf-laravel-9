@extends('Layouts.Main')

@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <!-- Title -->
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Edit Admin</h5>
                </div>
                <!-- Breadcrumb -->
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="index.html">Dashboard</a></li>
                        <li><a href="#"><span>Daftar Admin</span></a></li>
                        <li class="active"><span>Edit detail admin</span></li>
                    </ol>
                </div>
                <!-- /Breadcrumb -->
            </div>
            <!-- /Title -->
            <div class="row">
<<<<<<< HEAD
                <div class="container-fluid">
                    <div class="col-lg-8">
                        <h5>Edit Admin</h5>
                    </div>
                </div>
            </div>
            <!-- /Breadcrumb -->
        </div>
        <div class="row">
            <div class="col-lg-12" style="position: relative;">
                <div style="height: 900px" class="panel panel-default card-view">
                    <h6 class="control-label mb-10">Edit Admin</h6>
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form action="{{ route('update-admin', $visitor->id) }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <label class="control-label mb-10" for="">Nama Lengkap</label>
                                    <input type="text" name="name" value="{{ $visitor->name }}" class="form-control" id="result" size="50px" placeholder="Masukan Nama" required autofocus>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="control-label mb-10" for="">Alamat</label>
                                    <input type="text" class="form-control" id="result" size="50px" placeholder="Masukan Alamat" required autofocus>
                                </div> -->
                                <div class="form-group">
                                    <label class="control-label mb-10" for="">Jenis Kelamin</label>
                                    <div class="form-check">
                                        <label class="radio-inline">
                                            <input type="radio" name="gender" id="Radios1" value="laki-laki" <?php echo ($visitor->gender == 'laki-laki') ? 'checked' : '' ?>>Pria
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="gender" id="Radios2" value="perempuan" <?php echo ($visitor->gender == 'perempuan') ? 'checked' : '' ?>>Wanita
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10" for="">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Masukan Email" @error('email') is-invalid @enderror autofocus required value="{{ $visitor->email }}">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10" for="">Nomer Hp</label>
                                    <input type="text" name="phone" value="{{ $visitor->phone }}" class="form-control" id="result" size="50px" placeholder="Masukan Nomer Hp" required autofocus>
                                </div>
                                <div class="form-check">
                                    <label class="radio-inline">
                                        <input type="radio" name="role_id" id="radio_1" value="1" checked="">Super Admin
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="role_id" id="radio_2" value="2" checked="" value="VIP" {{  ($visitor->role_id == "Admin" ? ' checked' : '') }}>Admin
                                    </label>
                                </div>
                                <div class="form-group text-left">
                                    <button type="submit" class="btn btn-info">Simpan</button>
                                </div>
                            </form>
=======
                <div class="col-lg-12" style="position: relative;">
                    <div style="height: 900px" class="panel panel-default card-view">
                        <h6 class="control-label mb-10">Edit Admin</h6>
                        <div class="panel-body">
                            <div class="form-wrap">
                                <form action="{{ route('admin.edit', $users->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="control-label mb-10" for="">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="result" size="50px"
                                            placeholder="Masukan Nama" required name="name" value="{{ $users->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-10" for="">Email</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="Masukan Email" required value="{{ $users->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-10" for="">Nomer Hp</label>
                                        <input type="text" min="0"
                                            onkeypress="return event.charCode >= 48 && event.charCode <=57" name="phone"
                                            class="form-control" id="result" size="50px"
                                            placeholder="Masukan Nomer Hp" required value="{{ $users->phone }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-10 text-left">Role</label>
                                        <div class="radio-list">
                                            <div class="radio-inline pl-0">
                                                <span class="radio radio-info"> <input type="radio" name="role_id"
                                                        id="radio_11" value="1"
                                                        {{ $users->role_id == 1 ? 'checked' : '' }} required>
                                                    <label for="radio_11">Admin</label>
                                                </span>
                                            </div>
                                            <div class="radio-inline pl-0">
                                                <span class="radio radio-info"> <input type="radio" name="role_id"
                                                        id="radio_12" value="2"
                                                        {{ $users->role_id == 2 ? 'checked' : '' }} required>
                                                    <label for="radio_12">Super Admin</label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-left">
                                        <button type="submit" class="btn btn-info">Edit Admin</button>
                                    </div>
                                </form>
                            </div>
>>>>>>> dhany
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
