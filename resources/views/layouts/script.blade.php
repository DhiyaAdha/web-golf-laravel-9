    <script src="{{ asset('vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('vendors/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dist/asset_offline/intro.min.js') }}"></script>
    <script defer src="{{ asset('dist/asset_offline/html5-qrcode.js') }}"></script>
    <script defer src="{{ asset('vendors/bower_components/moment/min/moment.min.js') }}"></script>
    <script defer src="{{ mix('js/app.js') }}"></script>
    @stack('scripts')
    <script>
        $(window).load(function() {
            $('.se-pre-con').fadeOut('slow');
        });
        $(document).ajaxComplete(function() {
            $('[data-toggle="tooltip"]').tooltip({
                "html": true,
            });
        });
        @if (Session::has('success'))
            window.setTimeout(function() {
                $.toast({
                    text: '{{ Session('success') }}',
                    position: 'top-right',
                    loaderBg: '#fec107',
                    icon: 'success',
                    hideAfter: 2000,
                    stack: 6
                });
            }, 1000);
        @endif
        @if (Session::has('error'))
            window.setTimeout(function() {
                $.toast({
                    text: '{{ Session('error') }}',
                    position: 'top-right',
                    loaderBg: '#fec107',
                    icon: 'error',
                    hideAfter: 3000,
                    stack: 6
                });
            }, 1000);
        @endif
    </script>