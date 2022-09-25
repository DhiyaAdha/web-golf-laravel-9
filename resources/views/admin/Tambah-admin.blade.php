@extends('Layouts.Main')
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <!-- Title -->
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Tambah Admin</h5>
                </div>
                <!-- Breadcrumb -->
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('analisis-tamu') }}">Dashboard</a></li>
                        <li><a href="{{ url('daftar-admin') }}"><span>Daftar Admin</span></a></li>
                        <li class="active"><span>Tambah admin</span></li>
                    </ol>
                </div>
                <!-- /Breadcrumb -->
            </div>
            <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->
        <div class="row">
            <div class="col-lg-12" style="position: relative;">
                <div class="panel panel-default card-view">
                    <h6 class="control-label mb-10">Tambah Admin</h6>
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form action="{{ route('insertadmin') }}" method="POST">
                                @csrf
                                <div class="form-group @error('name') has-error @enderror">
                                    <label class="control-label mb-10" for="">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="result" size="50px" placeholder="Masukan Nama" name="name" value="{{ old('name') }}">
                                    @error('name')
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
                                <div class="form-group @error('name') has-error @enderror">
                                    <label class="control-label mb-10" for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Masukan Password">
                                    <span class="show-hide1" onclick="myfunction()">
                                        <i id="hide1" class="fa fa-eye"></i>
                                        <i id="hide2" class="fa fa-eye-slash"></i>
                                    </span>
                                    @error('password')
                                    <div class="text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group @error('name') has-error @enderror">
                                    <label class="control-label mb-10" for="confirm-password">Konfirmasi
                                        Password</label>
                                    <input type="password" name="password" class="form-control" id="confirm_password" placeholder="Masukan Ulang Password">
                                    <div style="margin-top: 7px;" id="CheckPasswordMatch"></div>
                                    <span class="show-hide2" onclick="myfunction2()">
                                        <i id="hide3" class="fa fa-eye"></i>
                                        <i id="hide4" class="fa fa-eye-slash"></i>
                                    </span>
                                    @error('password')
                                    <div class="text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group @error('phone') has-error @enderror">
                                    <label class="control-label mb-10" for="">Nomer Hp</label>
                                    <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <=57" name="phone" class="form-control" id="result" size="50px" placeholder="Masukan Nomer Hp" value="{{ old('phone') }}">
                                    @error('phone')
                                    <div class="text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group @error('role_id') has-error @enderror">
                                    <label class="control-label mb-10 text-left">Role</label>
                                    <div class="radio-list">
                                        <div class="radio-inline pl-0">
                                            <span class="radio radio-info"> <input type="radio" name="role_id" id="radio_11" value="1" {{ old('role_id') == "1" ? 'checked' : '' }}>
                                                <label for="radio_11">Admin</label>
                                            </span>
                                        </div>
                                        <div class="radio-inline pl-0">
                                            <span class="radio radio-info"> <input type="radio" name="role_id" id="radio_12" value="2" {{ old('role_id') == "2" ? 'checked' : '' }}>
                                                <label for="radio_12">Super Admin</label>
                                            </span>
                                        </div>
                                        @error('role_id')
                                            <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group text-left">
                                        <button type="" class="btn btn-info" id="gd">Tambah Admin</button>
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
@push('scripts')
    <script>
        function myfunction() {
            var x = document.getElementById("password");
            var y = document.getElementById("hide1");
            var z = document.getElementById("hide2");
            if (x.type === 'password') {
                x.type = "text";
                y.style.display = "block";
                z.style.display = "none";
            } else {
                x.type = "password";
                y.style.display = "none";
                z.style.display = "block";
            }
        }

        function myfunction2() {
            var x = document.getElementById("confirm_password");
            var y = document.getElementById("hide3");
            var z = document.getElementById("hide4");
            if (x.type === 'password') {
                x.type = "text";
                y.style.display = "block";
                z.style.display = "none";
            } else {
                x.type = "password";
                y.style.display = "none";
                z.style.display = "block";
            }
        }

        $("#confirm_password").on('keyup', function() {
            var password = $("#password").val();
            var confirmPassword = $("#confirm_password").val();
            if (password != confirmPassword)
                $("#CheckPasswordMatch").html("Password does not match !").css("color", "red");
            else
                $("#CheckPasswordMatch").html("Password match !").css("color", "green");
        });
    </script>
@endpush
