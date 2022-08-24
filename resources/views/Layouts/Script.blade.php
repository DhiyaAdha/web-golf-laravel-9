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
<script src="/dist/js/init.js"></script>
<script src="/dist/js/dashboard-data.js"></script>
<script src="/dist/js/dashboard3-data.js"></script>

{{-- Font Awesome --}}
<script src="https://kit.fontawesome.com/cc01c97c5b.js" crossorigin="anonymous"></script>

<script src="{{ asset('/sw.js') }}"></script>
<script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
    $('.js-switch-1').each(function() {
        new Switchery($(this)[0], $(this).data());
    });
    
    $('#dt-package').DataTable({
        "processing": true,
        "serverSide": true,
        "lengthChange": false,
        "searching": true,
        "paginate": {
            "first":      "First",
            "last":       "Last",
            "next":       "Next",
            "previous":   "Previous"
        },
        "ajax" : {
            "url" : "{{ route('package.index') }}",
            "type" : "GET",
            "datatype" : "json"
        },
        "columns" : [
            { "data": function(data) { return data.name }},
            { "data": function(data) { return data.category }},
            { "data": function(data) { 
                return `<div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Rp</div>
                                <label class="form-control">${data.price_weekdays}</label>
                            </div>
                        </div>`;  
            }},
            { "data": function(data) { 
                return `<div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Rp</div>
                                <label class="form-control">${data.price_weekend}</label>
                            </div>
                        </div>`; 
            }},
            { "data": function(data) { 
                if(data.status == 0) {
                    return `<input type="checkbox" checked class="js-switch js-switch-1"  data-color="#01c853" />`;  
                } else {
                    return `<input type="checkbox" class="js-switch js-switch-1"  data-color="#01c853" />`;  
                }
            }},
            { "data": "action"},
        ],
        order: [],
        responsive: true,
        language: {
            search: "",
            searchPlaceholder: "Cari",
            emptyTable: "Tidak ada data yang sesuai",
            info: "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
            infoFiltered: "(difilter dari _MAX_ total data)",
            infoEmpty: "Tidak ada data yang sesuai",
            lengthMenu: "Menampilkan _MENU_ data",
            zeroRecords: "Tidak ada data yang sesuai"
        },
        columnDefs: [
            { orderable: false, targets: [0, 1, 2, 3, 4, 5,] },
        ],
    });

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
