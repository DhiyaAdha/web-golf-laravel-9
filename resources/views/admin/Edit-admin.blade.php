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
                                <div class="form-group password-container @error('password') has-error @enderror">
                                    <label class="pull-left control-label mb-10" for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Masukan Password">
                                    <i class="fa-solid fa-eye fa-eye-slash" id="eye"></i>
                                    @error('password1')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group password-container @error('password') has-error @enderror">
                                    <label class="pull-left control-label mb-10" for="confirm_password">Konfirmasi Password</label>
                                    <input type="password" name="password" class="form-control" id="confirm_password" placeholder="Masukan Ulang Password" required>
                                    <i class="fa-solid fa-eye fa-eye-slash" id="eye2"></i>
                                    @error('password1')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<script>
    const passwordField = document.querySelector("#password");
    const eyeIcon = document.querySelector("#eye");
    const passwordField2 = document.querySelector("#confirm_password");
    const eyeIcon2 = document.querySelector("#eye2");

    eye.addEventListener("click", function() {
        this.classList.toggle("fa-eye-slash");
        const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
        passwordField.setAttribute("type", type);
    })
    eye2.addEventListener("click", function() {
        this.classList.toggle("fa-eye-slash");
        const type2 = passwordField2.getAttribute("type") === "password" ? "text" : "password";
        passwordField2.setAttribute("type", type2);
    })
</script>
@endpush