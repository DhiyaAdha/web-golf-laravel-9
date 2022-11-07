<script src="{{ asset('vendors/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('dist/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('vendors/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('vendors/bower_components/waypoints/lib/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('vendors/bower_components/jquery.counterup/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>
<script src="{{ asset('vendors/bower_components/sweetalert/dist/sweetalert.min.js') }}"></script>
<script src="{{ asset('/dist/js/init.js') }}"></script>
<script src="{{ asset('dist/asset_offline/fontawsome.js') }}"></script>
@stack('scripts')
<script src="{{ asset('dist/asset_offline/lottie-player.js') }}"></script>
<script defer src="{{ asset('/dist/js/printThis.js') }}"></script>
<script src="{{ asset('/sw.js') }}"></script>
<script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
</script>
<script>
    $( document ).ajaxComplete(function() {
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
    $(function() {
        $('[data-toogle="tooltip"]').tooltip()
    })
</script>