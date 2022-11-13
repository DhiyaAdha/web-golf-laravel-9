<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8" />
    <meta name="keywords" content="tgcc" />
    <meta name="author" content="inovis" />
    <meta name="theme-color" content="#6777ef" />
    <meta name="description" content="Tritih Golf & Country Club" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <link rel="apple-touch-icon" href="{{ asset('tgcc144.png') }}">
    <link rel="icon" href="{{ asset('tgcc144.png') }}" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/style.css') }}" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/asset_offline/css/all.min.css') }}" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/asset_offline/toastr.css') }}" type="text/css">
    <style>
        .se-pre-con {
            position: fixed;
            top:0;
            left:0;
            bottom:0;
            right:0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('/animation_200_laeydhgu.gif') center no-repeat #fff;
        }
        #overlay{
            position:fixed;
            z-index:99999;
            top:0;
            left:0;
            bottom:0;
            right:0;
            background:rgba(73, 73, 73, 0.9);
            transition: 1s 0.4s;
        }
        #progress{
            height:1px;
            background:#fff;
            position:absolute;
            width:0;
            top:50%;
        }
        #progstat{
            font-size:0.7em;
            letter-spacing: 3px;
            position:absolute;
            top:50%;
            margin-top:-40px;
            width:100%;
            text-align:center;
            color:#fff;
        }
        .sp-logo-wrap {
            padding-top: 0px !important;
        }
        #bg {
            position: fixed;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
        }

        #bg img {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            min-width: 50%;
            min-height: 50%;
        }

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
            top: 236px;
            right: 30px;
        }

        @media screen and (min-width: 480px) {
            #eye {
                top: 237px;
            }
        }
        @media screen and (min-width: 480px) {
            #eyee {
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
    <div class="se-pre-con"></div>
    {{-- <div id="overlay">
        <div id="progstat"></div>
        <div id="progress"></div>
    </div> --}}
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
                                <div class="col-sm-12 col-xs-12 title">
                                    @if (session()->has('loginError'))
                                        <div class="alert alert-danger">{!! session('loginError') !!}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    @if (session()->has('info'))
                                        <div class="alert alert-success">{!! session('info') !!}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
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
                                                <input type="email" name="email" class="form-control" id="email" placeholder="Masukan email" @error('email') is-invalid @enderror autofocus required value="{{ old('email') }}">
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <a class="capitalize-font txt-primary block mb-10 pull-right font-12" href="{{ route('forgot-password') }}">Lupa Password?</a>
                                                <label class="pull-left control-label mb-10" for="password">Password</label>
                                                <input type="password" name="password" class="form-control" id="password" placeholder="Masukan password" required>
                                                <i style="color: rgb(114, 114, 114);" class="fa-solid fa-eye fa-eye-slash" id="eye"></i>
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
    <script defer src="{{ asset('vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js') }}"></script>
    <script defer src="{{ asset('dist/asset_offline/lottie-player.js') }}"></script>
    <script defer src="{{ asset('dist/js/init.js') }}"></script>
    <script defer src="{{ asset('dist/js/jquery.slimscroll.js') }}"></script>
    <script defer src="{{ asset('dist/asset_offline/jquery.blockUI.min.js') }}"></script>
    <script defer src="{{ asset('dist/asset_offline/toastr.js') }}"></script>
    <script defer src="{{ asset('/sw.js') }}"></script>
    <script>
        if (!navigator.serviceWorker.controller) {
            navigator.serviceWorker.register("/sw.js").then(function (reg) {
                console.log("Service worker has been registered for scope: " + reg.scope);
            });
        }
    </script>
    <script>
        const passwordField = document.querySelector("#password");
        const eyeIcon = document.querySelector("#eye");
        eye.addEventListener("click", function() {
            this.classList.toggle("fa-eye-slash");
            const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
            passwordField.setAttribute("type", type);
        });

        function wrong() {
            var audio = new Audio('../sound/wrong.mp3');
            audio.play();
        }

        function empty() {
            var audio = new Audio('../sound/empty.mp3');
            audio.play();
        }

        $(document).ready(function() {
            $(window).load(function() {
            $(".se-pre-con").fadeOut("slow");
        });
            $(document).on('click', '.btn-rounded', function(e) {
                if($("input[name='email']").val() == '' || $("input[name='password']").val() == '') {
                    empty();
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
                wrong();
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