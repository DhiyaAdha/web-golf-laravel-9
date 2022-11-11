<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reset Password</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="Tritih Golf & Country Club" />
    <meta name="keywords" content="tgcc" />
    <meta name="author" content="inovis" />
    <meta name="theme-color" content="#6777ef" />
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="{{ asset('tgcc144.png') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('tgcc144.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <link rel="stylesheet" href="{{ asset('/dist/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dist/asset_offline/css/all.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dist/asset_offline/toastr.css') }}" type="text/css">
    <style>
        .password-container {
            width: 400px;
            position: relative;
        }

        .password-container input[type="password"],
        .password-container input[type="text"] {
            width: 100%;
            padding: 12px 36px 12px 12px;
            box-sizing: border-box;
        }
        
        #eye {
            position: absolute;
            margin-top: -100px;
            top: 236px;
            right: 30px;
        }
        #eyee {
            position: absolute;
            margin-top: -13px;
            top: 236px;
            right: 30px;
        }

        @media screen and (min-width: 480px) {
            #eye {
                top: 237px;
            }
        }

        #toast-container>.toast-success {
            background-color: #01C853;
            font-family: Arial;
        }
    </style>
</head>

<body>
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <div class="wrapper pa-0">
        <header class="sp-header">
            <div class="sp-logo-wrap pull-left">
                <a href="#">
                    <img class="brand-img mr-10" src="/dist/img/tgcc.svg" alt="brand" />
                </a>
            </div>
            <div class="clearfix"></div>
        </header>
        <div class="page-wrapper pa-0 ma-0 auth-page">
            <div class="container-fluid">
                <div class="table-struct full-width full-height">
                    <div class="table-cell vertical-align-middle auth-form-wrap">
                        <div class="auth-form  ml-auto mr-auto no-float">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <div>
                                        @if (Session::get('resetSuccess'))
                                            <div class="alert alert-danger">{!! Session::get('resetSuccess') !!}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif

                                        @if (session()->has('resetError'))
                                            <div class="alert alert-danger">{!! session('loginError') !!}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mb-30">
                                        <h5 class="text-center txt-dark mb-10">Lupa Password Tritih Golf & Country Club</h5>
                                        <h6 class="text-center nonecase-font txt-grey">Masukan Password Baru Anda</h6>
                                    </div>
                                    <div class="form-wrap">
                                        <form action="{{ route('reset-password.update') }}" method="post" autocomplete="off">
                                            @csrf
                                            <input type="hidden" name="token" value="{{ $token }}">
                                            <div class="form-group">
                                                <input type="hidden" class="form-control" name="email" placeholder="Enter email address" value="{{ $email ?? old('email') }}">
                                                <span class="text-danger">
                                            </div>
                                            <div class="form-group">
                                                <label class="pull-left control-label mb-10" for="password">Password Baru</label>
                                                <input type="password" name="password" class="form-control @error('password') has-error @enderror" id="password" placeholder="Masukan Password Baru" value="{{ old('password') }}" autocomplete="current-password">
                                                <i style="color: rgb(114, 114, 114);" class="fa-solid fa-eye1 fa-eye fa-eye-slash" id="eye"></i>
                                                @error('password')
                                                    <div class="text-danger"> {{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="pull-left control-label mb-10" for="password_confirmation">Ulangi Password</label>
                                                <div class="clearfix"></div>
                                                <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror" id="password_confirmation" placeholder="Ulangi Password Baru" value="{{ old('password_confirmation') }}" autocomplete="current-password">
                                                    <div style="margin-top: 7px;" id="CheckPasswordMatch"></div>
                                                <i style="color: rgb(114, 114, 114);" class="fa-solid fa-eye2 fa-eye fa-eye-slash" id="eyee"></i>
                                            </div>
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-info btn-rounded">Update Password</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js') }}"></script>
    <script src="{{ asset('/dist/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('/dist/js/init.js') }}"></script>
    <script src="{{ asset('dist/asset_offline/toastr.js') }}"></script>
    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if (!navigator.serviceWorker.controller) {
            navigator.serviceWorker.register("/sw.js").then(function (reg) {
                console.log("Service worker has been registered for scope: " + reg.scope);
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            const passwordField = document.querySelector("#password");
            const passwordCon = document.querySelector("#password_confirmation");
            const eyeIcon = document.querySelector("#eye");
            const eyeeIcon = document.querySelector("#eyee");

            eye.addEventListener("click", function() {
                this.classList.toggle("fa-eye-slash");
                const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
                passwordField.setAttribute("type", type);
            });
            eyee.addEventListener("click", function() {
                this.classList.toggle("fa-eye-slash");
                const typee = passwordCon.getAttribute("type") === "password" ? "text" : "password";
                passwordCon.setAttribute("type", typee);
            });

            $("#password_confirmation").on('keyup', function() {
                var password = $("#password").val();
                var confirmPassword = $("#password_confirmation").val();
                if (password != confirmPassword)
                    $("#CheckPasswordMatch").html("Password does not match !").css("color", "red");
                else
                    $("#CheckPasswordMatch").html("Password match !").css("color", "green");
            });

            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "100",
                "hideDuration": "100",
                "timeOut": "6000",
                "extendedTimeOut": "6000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            @if (Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @endif

            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "10",
                "hideDuration": "10",
                "timeOut": "3000",
                "extendedTimeOut": "3000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
            };
            @if (Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @endif
        });
    </script>
</body>
</html>