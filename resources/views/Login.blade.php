<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Login</title>
    <meta name="description" content="Hound is a Dashboard & Admin Site Responsive Template by hencework." />
    <meta name="keywords"
        content="admin, admin dashboard, admin template, cms, crm, Hound Admin, Houndadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
    <meta name="author" content="hencework" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="{{ asset('tgcc144.PNG') }}" type="image/x-icon">

    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('tgcc144.PNG') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <!-- vector map CSS -->
    <link href="../../vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet"
        type="text/css" />

    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
    <link href="dist/css/custom.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    {{-- toastr --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />

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

        .fa-eye {
            position: absolute;
            top: 60%;
            right: 4%;
            cursor: pointer;
            color: rgb(114, 114, 114);
        }
    </style>
</head>

<body>
    <!--Preloader-->
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <!--/Preloader-->

    <div class="wrapper pa-0">
        <header class="sp-header">
            <div class="sp-logo-wrap pull-left">

                <a href="#">
                    <img class="brand-img mr-10" src="dist/img/tgcc.svg" alt="brand" />
                </a>
            </div>
            <div class="clearfix"></div>
        </header>



        <!-- Main Content -->
        <div class="page-wrapper pa-0 ma-0 auth-page">
            <div class="container-fluid">
                <!-- Row -->
                <div class="table-struct full-width full-height">
                    <div class="table-cell vertical-align-middle auth-form-wrap">
                        <div class="auth-form  ml-auto mr-auto no-float">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <div>
                                        @if (session()->has('loginError'))
                                            <div class="alert alert-danger">{!! session('loginError') !!}
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif

                                        @if (session()->has('info'))
                                            <div class="alert alert-success">{!! session('info') !!}
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mb-30">
                                        <h3 class="text-center txt-dark mb-10">Masuk Tritih Golf & Country Club</h3>
                                        <h6 class="text-center nonecase-font txt-grey">Masukan Akun Anda</h6>
                                    </div>
                                    <div class="form-wrap">
                                        <form action="/login" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="email">Email / Nomor
                                                    Telpon</label>
                                                <input type="email" name="email" class="form-control" id="email"
                                                    placeholder="Masukan Email Nomor Telepon"
                                                    @error('email') is-invalid @enderror autofocus required
                                                    value="{{ old('email') }}">
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            {{-- <div class="form-group">
                                                <label class="pull-left control-label mb-10"
                                                    for="password">Password</label>
                                                <a class="capitalize-font txt-primary block mb-10 pull-right font-12"
                                                    href="{{ route('Lupa-pasword') }}">Lupa Password?</a>
                                                <div class="clearfix"></div>
                                                <input type="password" name="password" class="form-control"
                                                    id="password" placeholder="Masukan Password" required data-toggle="password">
                                            </div> --}}



                                            <div class="clearfix"></div>

                                            <div class="form-group password-container">
                                                <a class="capitalize-font txt-primary block mb-10 pull-right font-12"
                                                    href="{{ route('Lupa-pasword') }}">Lupa Password?</a>
                                                <label class="pull-left control-label mb-10"
                                                    for="password">Password</label>
                                                <input type="password" name="password" class="form-control"
                                                    id="password" placeholder="Masukan Password" required>
                                                <i class="fa-solid fa-eye fa-eye-slash" id="eye"></i>
                                            </div>


                                            {{-- <div class="password-container">
                                                <input type="password" placeholder="Password..." id="password">
                                                <i class="fa-solid fa-eye" id="eye"></i>
                                           </div> --}}
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-info btn-rounded">sign in</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Row -->
            </div>

        </div>
        <!-- /Main Content -->

    </div>
    <!-- /#wrapper -->

    <!-- JavaScript -->

    <!-- jQuery -->
    <script src="../../vendors/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>

    <!-- Slimscroll JavaScript -->
    <script src="dist/js/jquery.slimscroll.js"></script>

    <!-- Init JavaScript -->
    <script src="dist/js/init.js"></script>

    <script>
        const passwordField = document.querySelector("#password");
        const eyeIcon = document.querySelector("#eye");

        eye.addEventListener("click", function() {
            this.classList.toggle("fa-eye-slash");
            const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
            passwordField.setAttribute("type", type);
        })
    </script>
    {{-- toastr js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

    <script>
        $(document).ready(function() {
            toastr.options.timeOut = 5000;
            @if (Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @endif
        });
    </script>
</body>

</html>
