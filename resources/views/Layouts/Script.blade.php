<!-- /#wrapper -->

<!-- JavaScript -->

<!-- jQuery -->
<script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Data table JavaScript -->
<script src="vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>

<!-- Slimscroll JavaScript -->
<script src="dist/js/jquery.slimscroll.js"></script>

<!-- simpleWeather JavaScript -->
<script src="vendors/bower_components/moment/min/moment.min.js"></script>
<script src="vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>
<script src="dist/js/simpleweather-data.js"></script>

<!-- Progressbar Animation JavaScript -->
<script src="vendors/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="vendors/bower_components/jquery.counterup/jquery.counterup.min.js"></script>

<!-- Fancy Dropdown JS -->
<script src="dist/js/dropdown-bootstrap-extended.js"></script>

<!-- Sparkline JavaScript -->
{{-- <script src="vendors/jquery.sparkline/dist/jquery.sparkline.min.js"></script> --}}

<!-- Owl JavaScript -->
<script src="vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>

<script src="vendors/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>

<!-- ChartJS JavaScript -->
<script src="vendors/chart.js/Chart.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="vendors/bower_components/raphael/raphael.min.js"></script>
<script src="vendors/bower_components/morris.js/morris.min.js"></script>
<script src="vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script>

<!-- Switchery JavaScript -->
<script src="vendors/bower_components/switchery/dist/switchery.min.js"></script>
<!-- Init JavaScript -->
<script src="dist/js/init.js"></script>
<script src="dist/js/dashboard-data.js"></script>
<script src="dist/js/dashboard3-data.js"></script>

{{-- Font Awesome --}}
<script src="https://kit.fontawesome.com/cc01c97c5b.js" crossorigin="anonymous"></script>

{{-- <script src="{{ asset('/sw.js') }}"></script> --}}
<script>
<<<<<<< HEAD
    $('#check_box_value').text($("#check_box_switch").bootstrapSwitch('state'));
    $('#check_box_switch').on('switchChange.bootstrapSwitch', function () {
        $("#check_box_value").text($('#check_box_switch').bootstrapSwitch('state'));
    });
    // if (!navigator.serviceWorker.controller) {
    //     navigator.serviceWorker.register("/sw.js").then(function (reg) {
    //         console.log("Service worker has been registered for scope: " + reg.scope);
    //     });
    // }

    $(document).on("click", "#show-scan", function() {
        $(".disabled-scan").css("display", "none");

        function onScanSuccess(decodedText, decodedResult) {
            $("#result").val(decodedText)
        }

        function onScanFailure(error) {
            console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            },
            false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    })
</script>
