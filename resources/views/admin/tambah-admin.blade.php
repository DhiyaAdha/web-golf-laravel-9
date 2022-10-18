@extends('layouts.main')
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
                                <div class="form-group @error('password') has-error @enderror">
                                    <label class="pull-left control-label mb-10" for="password">Password</label>
                                    <input type="password" name="password"
                                        class="form-control @error('password') has-error @enderror"
                                        id="password" placeholder="Masukan Password Baru"
                                        value="{{ old('password') }}" autocomplete="current-password">
                                        @error('password')
                                        <div class="text-danger"> {{ $message }}</div>
                                        @enderror    
                                        <input style="vertical-align: -3px" class="checkbox-showPW" type="checkbox" onclick="myFunction()">&nbsp;Lihat Password
                                    {{-- <i style="color: rgb(114, 114, 114);" class="fa-solid fa-eye1 fa-eye-slash" id="eye"></i> --}}

                                       
                                </div>
                                <div class="form-group @error('password') has-error @enderror">
                                    <label class="pull-left control-label mb-10"
                                        for="password_confirmation">Ulangi Password</label>
                                    <div class="clearfix"></div>
                                    <input type="password" name="password_confirmation"
                                        class="form-control @error('password') is-invalid @enderror"
                                        id="password_confirmation" placeholder="Masukan Password Baru"
                                        value="{{ old('password_confirmation') }}"
                                        autocomplete="current-password">
                                        <div style="margin-top: 7px;" id="CheckPasswordMatch"></div>
                                        <input style="vertical-align: -3px" class="checkbox-showPW" type="checkbox" onclick="myFunction2()">&nbsp;Lihat Password
                                    {{-- <i style="color: rgb(114, 114, 114);" class="fa-solid fa-eye2 fa-eye-slash" id="eyee"></i> --}}
                                </div>
                                <div class="form-group @error('phone') has-error @enderror">
                                    <label  class="control-label mb-10" for="">Nomer Hp</label>
                                    <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <=57" name="phone" class="form-control" id="result" size="50px" placeholder="Masukan Nomer Hp" value="{{ old('phone') }}">
                                    @error('phone')
                                    <div class="text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group @error('role_id') has-error @enderror">
                                    <label class="control-label mb-10 text-left">Role</label>
                                    <div class="radio-list" >
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
                                        <button type="submit" class="btn btn-info" id="gd">Tambah Admin</button>
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
<script>
    const passwordField = document.querySelector("#password");
    const passwordCon = document.querySelector("#password_confirmation");
    const eyeIcon = document.querySelector("#eye");
    const eyeeIcon = document.querySelector("#eyee");

    eye.addEventListener("click", function() {
        this.classList.toggle("fa-eye");
        const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
        passwordField.setAttribute("type", type);
    })
    eyee.addEventListener("click", function() {
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
{{-- checkbox --}}
<script>
    function myFunction() {
      var x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
    function myFunction2() {
      var y = document.getElementById("password_confirmation");
      if (y.type === "password") {
        y.type = "text";
      } else {
        y.type = "password";
      }
    }
    </script>
@endpush
