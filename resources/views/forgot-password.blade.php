<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lupa Password</title>
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
    <link rel="stylesheet" href="{{ asset('dist/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dist/css/custom.css') }}" type="text/css">
</head>
<body>
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <div class="wrapper pa-0">
        <header class="sp-header">
            <div class="sp-logo-wrap pull-left">
                <a href="analisis-tamu">
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
                                    <div>
                                        @if (session()->has('resetSuccess'))
                                            <div class="alert alert-success">{!! session('resetSuccess') !!}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mb-30">
                                        <h3 class="text-center txt-dark mb-10">Anda Lupa Password?</h3>
                                    </div>
                                    <div class="form-wrap">
                                        <form action="{{ route('email_test') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="email">Email</label>
                                                <input type="email" name="email" class="form-control" id="email" placeholder="Masukan Email" @error('email') is-invalid @enderror autofocus required value="{{ old('email') }}">
                                                @error('email')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-info btn-rounded">Reset</button>
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
    <script src="{{ asset('dist/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('dist/js/init.js') }}"></script>
    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if (!navigator.serviceWorker.controller) {
            navigator.serviceWorker.register("/sw.js").then(function (reg) {
                console.log("Service worker has been registered for scope: " + reg.scope);
            });
        }
    </script>
</body>
</html>
