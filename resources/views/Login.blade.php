<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Login</title>
    <meta name="description" content="Tritih Golf & Country Club" />
    <meta name="keywords" content="tgcc" />
    <meta name="author" content="inovis" />
    <meta name="theme-color" content="#6777ef" />
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="{{ asset('tgcc144.png') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('tgcc144.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/asset_offline/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/asset_offline/toastr.css') }}">
</head>
<body>
    <div id="overlay">
        <div id="progstat"></div>
        <div id="progress"></div>
    </div>
    <div class="wrapper pa-0">
        <header class="sp-header">
            <div class="sp-logo-wrap pull-left">
                <a href="#">
                    <img class="brand-img mr-10" src="dist/img/tgcc.svg" alt="brand" />
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
                                    <div class="mb-30">
                                        <h3 class="text-center txt-dark mb-10">Tritih Golf & Country Club</h3>
                                        <h6 class="text-center nonecase-font txt-grey">Masukan Akun Anda</h6>
                                    </div>
                                    <div class="form-wrap">
                                        <form action="{{ route('login') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="email">Email</label>
                                                <input type="email" name="email" class="form-control" id="email"
                                                    placeholder="Masukan email" @error('email') is-invalid @enderror
                                                    autofocus required value="{{ old('email') }}">
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <a class="capitalize-font txt-primary block mb-10 pull-right font-12"
                                                    href="{{ route('forgot-password') }}">Lupa Password?</a>
                                                <label class="pull-left control-label mb-10"
                                                    for="password">Password</label>
                                                <input type="password" name="password" class="form-control"
                                                    id="password" placeholder="Masukan password" required>
                                                <i style="color: rgb(114, 114, 114);" class="fa-solid fa-eye fa-eye-slash" id="eye_login"></i>
                                            </div>
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
            </div>
        </div>
    </div>
    <script src="{{ asset('vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js') }}"></script>
    <script src="{{ asset('dist/js/init.js') }}"></script>
    <script src="{{ asset('dist/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('dist/asset_offline/jquery.blockUI.min.js') }}"></script>
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
        const passwordField = document.querySelector("#password");
        const eyeIcon = document.querySelector("#eye_login");
        eye_login.addEventListener("click", function() {
            this.classList.toggle("fa-eye-slash");
            const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
            passwordField.setAttribute("type", type);
        });

        $(document).ready(function() {
            $(document).on('click', '.btn-rounded', function(e) {
                if($("input[name='email']").val() == '' || $("input[name='password']").val() == '') {
                    toastr.error('Email dan password wajib diisi');
                } else {
                    $.ajax({
                        async: true,
                        beforeSend: function(request) {
                            $.blockUI({
                                css: {
                                    backgroundColor: 'transparent',
                                    border: 'none'
                                },
                                message: '<img src="../img/rolling.svg">',
                                baseZ: 1500,
                                overlayCSS: {
                                    backgroundColor: '#7C7C7C',
                                    opacity: 0.4,
                                    cursor: 'wait'
                                }
                            });
                        }
                    });
                }
            });

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
                "showDuration": "100",
                "hideDuration": "100",
                "timeOut": "3000",
                "extendedTimeOut": "3000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

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

        ;(function() {
            function id(v){return document.getElementById(v); }
            function loadbar() {
                var ovrl = id("overlay"),
                    prog = id("progress"),
                    stat = id("progstat"),
                    img = document.images,
                    c = 0;
                    tot = img.length;

                function imgLoaded() {
                    c += 1;
                    var perc = ((100/tot*c) << 0) +"%";
                    prog.style.width = perc;
                    stat.innerHTML = "Loading "+ perc;
                    if(c===tot) return doneLoading();
                }
                function doneLoading() {
                    ovrl.style.opacity = 0;
                    setTimeout(function() { 
                        ovrl.style.display = "none";
                    }, 1200);
                }
                for(var i=0; i<tot; i++) {
                    var tImg     = new Image();
                    tImg.onload  = imgLoaded;
                    tImg.onerror = imgLoaded;
                    tImg.src     = img[i].src;
                }    
            }
            document.addEventListener('DOMContentLoaded', loadbar, false);
        }());
    </script>
</body>

</html>