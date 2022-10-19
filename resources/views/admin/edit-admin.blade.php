@extends('layouts.main')
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
                    <li><a href="{{ url('analisis-tamu') }}">Dashboard</a></li>
                    <li><a href="{{ url('daftar-admin') }}"><span>Daftar Admin</span></a></li>
                    <li class="active"><span>Edit detail admin</span></li>
                </ol>
            </div>
            <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->
        <div class="row">
            <div class="col-lg-12" style="position: relative;">
                <div class="panel panel-default card-view">
                    <h6 class="control-label mb-10">Edit Admin</h6>
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form action="{{ route('admin.edit', $users->id) }}" method="POST">
                                @csrf
                                <div class="form-group @error('name') has-error @enderror">
                                    <label class="control-label mb-10" for="">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="result" size="50px" placeholder="Masukan Nama" name="name" value="{{ $users->name }}">
                                    @error('name')
                                    <div class="text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group @error('email') has-error @enderror">
                                    <label class="control-label mb-10" for="">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Masukan Email" value="{{ $users->email }}">
                                    @error('email')
                                    <div class="text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="hidden">
                                    <div class="form-group password-container">
                                        <label class="pull-left control-label mb-10" for="password">Password</label>
                                        <input type="password" name="password"
                                            class="form-control @error('password') has-error @enderror"
                                            id="password" placeholder="Masukan Password Baru" value="{{ $users->password }}">
                                        <i style="color: rgb(114, 114, 114);" class="fa-solid fa-eye1 fa-eye-slash" id="eye_edit_admin"></i>
    
                                        @error('password')
                                            <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="hidden">
                                    <div class="form-group password-container">
                                        <label class="pull-left control-label mb-10"
                                            for="password_confirmation">Konfirmasi Password</label>
                                        <div class="clearfix"></div>
                                        <input type="password" name="password_confirmation"
                                            class="form-control @error('password') is-invalid @enderror"
                                            id="password_confirmation" placeholder="Masukan Password Baru" value="{{ $users->password }}">
                                            <div style="margin-top: 7px;" id="CheckPasswordMatch"></div>
                                        <i style="color: rgb(114, 114, 114);" class="fa-solid fa-eye2 fa-eye-slash" id="eyee_edit_admin"></i>
                                    </div>
                                </div>
                                <div class="form-group @error('phone') has-error @enderror">
                                    <label class="control-label mb-10" for="">Nomer Hp</label>
                                    <input type="text" min="0" onkeypress="return event.charCode >= 48 && event.charCode <=57" name="phone" class="form-control" id="result" size="50px" placeholder="Masukan Nomer Hp" value="{{ $users->phone }}">
                                    @error('phone')
                                    <div class="text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group @error('role') has-error @enderror">
                                    <label class="control-label mb-10 text-left">Role</label>
                                    <div class="radio-list">
                                        <div class="radio-inline pl-0">
                                            <span class="radio radio-info"> <input type="radio" name="role_id" id="radio_11" value="1" {{ $users->role_id == 1 ? 'checked' : '' }}>
                                                <label for="radio_11">Admin</label>
                                            </span>
                                        </div>
                                        <div class="radio-inline pl-0">
                                            <span class="radio radio-info"> <input type="radio" name="role_id" id="radio_12" value="2" {{ $users->role_id == 2 ? 'checked' : '' }}>
                                                <label for="radio_12">Super Admin</label>
                                            </span>
                                        </div>
                                    </div>
                                    @error('role')
                                    <div class="text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group text-left">
                                    <button type="submit" class="btn btn-info">Edit Admin</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="position: relative;">
                <div class="panel panel-default card-view">
                    <h6 class="control-label mb-10">Edit Password</h6>
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form action="{{ route('admin.edit', $users->id) }}" method="POST">
                                @csrf
                                <div class="hidden">
                                    <div class="form-group @error('name') has-error @enderror">
                                        <label class="control-label mb-10" for="">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="result" size="50px" placeholder="Masukan Nama" name="name" value="{{ $users->name }}">
                                        @error('name')
                                        <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="hidden">
                                    <div class="form-group @error('email') has-error @enderror">
                                        <label class="control-label mb-10" for="">Email</label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Masukan Email" value="{{ $users->email }}">
                                        @error('email')
                                        <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                    <div class="form-group password-container">
                                        <label class="pull-left control-label mb-10" for="password">Password</label>
                                        <input type="password" name="password"
                                            class="form-control @error('password') has-error @enderror"
                                            id="password2" placeholder="Masukan Password Baru" value="">
                                            @error('password')
                                                <div class="text-danger"> {{ $message }}</div>
                                            @enderror
                                            <input style="vertical-align: -3px" class="checkbox-showPW" type="checkbox" onclick="myFunction()">&nbsp;Lihat Password
                                        {{-- <i style="color: rgb(114, 114, 114);" class="fa-solid fa-eye1 fa-eye-slash" id="eye_edit_admin"></i> --}}
    
                                    </div>
                                    <div class="form-group password-container">
                                        <label class="pull-left control-label mb-10"
                                            for="password_confirmation">Konfirmasi Password</label>
                                        <div class="clearfix"></div>
                                        <input type="password" name="password_confirmation"
                                            class="form-control @error('password') is-invalid @enderror"
                                            id="password_confirmation2" placeholder="Masukan Password Baru" value="">
                                            <div style="margin-top: 7px;" id="CheckPasswordMatch2"></div>
                                            @error('password_confirmation')
                                                <div class="text-danger"> {{ $message }}</div>
                                            @enderror
                                            <input style="vertical-align: -3px" class="checkbox-showPW" type="checkbox" onclick="myFunction2()">&nbsp;Lihat Password
                                        {{-- <i style="color: rgb(114, 114, 114);" class="fa-solid fa-eye2 fa-eye-slash" id="eyee_edit_admin"></i> --}}

                                    </div>
                                <div class="hidden">
                                    <div class="form-group @error('phone') has-error @enderror">
                                        <label class="control-label mb-10" for="">Nomer Hp</label>
                                        <input type="text" min="0" onkeypress="return event.charCode >= 48 && event.charCode <=57" name="phone" class="form-control" id="result" size="50px" placeholder="Masukan Nomer Hp" value="{{ $users->phone }}">
                                        @error('phone')
                                        <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="hidden">
                                    <div class="form-group @error('role') has-error @enderror">
                                        <label class="control-label mb-10 text-left">Role</label>
                                        <div class="radio-list">
                                            <div class="radio-inline pl-0">
                                                <span class="radio radio-info"> <input type="radio" name="role_id" id="radio_11" value="1" {{ $users->role_id == 1 ? 'checked' : '' }}>
                                                    <label for="radio_11">Admin</label>
                                                </span>
                                            </div>
                                            <div class="radio-inline pl-0">
                                                <span class="radio radio-info"> <input type="radio" name="role_id" id="radio_12" value="2" {{ $users->role_id == 2 ? 'checked' : '' }}>
                                                    <label for="radio_12">Super Admin</label>
                                                </span>
                                            </div>
                                        </div>
                                        @error('role')
                                        <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group text-left">
                                    <button type="submit" class="btn btn-info">Edit Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
</div>
@endsection
@push('scripts')
<script src="../../vendors/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../../vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../../vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>

<!-- Slimscroll JavaScript -->
<script src="/dist/js/jquery.slimscroll.js"></script>

<!-- Init JavaScript -->
<script src="/dist/js/init.js"></script>
<script>
    const passwordField = document.querySelector("#password");
    const passwordCon = document.querySelector("#password_confirmation");
    const eyeIcon = document.querySelector("#eye_edit_admin");
    const eyeeIcon = document.querySelector("#eyee_edit_admin");

    eye_edit_admin.addEventListener("click", function() {
        this.classList.toggle("fa-eye");
        const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
        passwordField.setAttribute("type", type);
    })
    eyee_edit_admin.addEventListener("click", function() {
        this.classList.toggle("fa-eye");
        const typee = passwordCon.getAttribute("type") === "password" ? "text" : "password";
        passwordCon.setAttribute("type", typee);
    })
</script>
<script>
    $("#password_confirmation").on('keyup', function() {
        var password = $("#password").val();
        var confirmPassword = $("#password_confirmation").val();
        if (password != confirmPassword)
            $("#CheckPasswordMatch").html("Password tidak sama !").css("color", "red");
        else
            $("#CheckPasswordMatch").html("Password sama !").css("color", "green");
    });
</script>
<script>
    $("#password_confirmation2").on('keyup', function() {
        var password = $("#password2").val();
        var confirmPassword = $("#password_confirmation2").val();
        if (password != confirmPassword)
            $("#CheckPasswordMatch2").html("Password tidak sama !").css("color", "red");
        else
            $("#CheckPasswordMatch2").html("Password sama !").css("color", "green");
    });
</script>
{{-- checkbox --}}
<script>
    function myFunction() {
      var x = document.getElementById("password2");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
    function myFunction2() {
      var y = document.getElementById("password_confirmation2");
      if (y.type === "password") {
        y.type = "text";
      } else {
        y.type = "password";
      }
    }
    </script>
@endpush