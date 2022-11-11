<head>
    <title>{{ $title ?? 'TGCC' }}</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="Tritih Golf & Country Club" />
    <meta name="author" content="inovis" />
    <meta name="keywords" content="tgcc" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="theme-color" content="#6777ef" />
    <link rel="icon" href="{{ asset('tgcc144.png') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('tgcc144.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <link rel="icon" href="{{ asset('tgcc144.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('vendors/bower_components/datatables/media/css/jquery.dataTables.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendors/bower_components/sweetalert/dist/sweetalert.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dist/css/style.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('dist/css/custom.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('dist/asset_offline/css/all.min.css') }}">
    @stack('css')
    <script src="{{ asset('vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/asset_offline/html5-qrcode.js') }}"></script>
</head>