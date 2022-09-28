<!-- jQuery -->


<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<!-- Data table JavaScript -->
<script src="{{ asset('vendors/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>

<!-- Slimscroll JavaScript -->
<script src="{{ asset('dist/js/jquery.slimscroll.js') }}"></script>

<!-- simpleWeather JavaScript -->
<script src="{{ asset('vendors/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js') }}"></script>
<script src="{{ asset('dist/js/simpleweather-data.js') }}"></script>

<!-- Progressbar Animation JavaScript -->
<script src="{{ asset('vendors/bower_components/waypoints/lib/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('vendors/bower_components/jquery.counterup/jquery.counterup.min.js') }}"></script>

<!-- Fancy Dropdown JS -->
<script src="{{ asset('dist/js/dropdown-bootstrap-extended.js') }}"></script>

<!-- Sparkline JavaScript -->
{{-- <script src="{{ asset('vendors/jquery.sparkline/dist/jquery.sparkline.min.js') }}"></script> --}}

<!-- Owl JavaScript -->
<script src="{{ asset('vendors/bower_components/owl.carousel/dist/owl.carousel.min.js') }}"></script>

<script src="{{ asset('vendors/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js') }}"></script>

<!-- ChartJS JavaScript -->
<script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>

<!-- Bootstrap Switches CSS -->
<script src="{{ asset('vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') }}">
</script>
<!-- <link href="{{ asset('vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" /> -->
<script src="{{ asset('vendors/bower_components/bootstrap-switch/dist/js/bootstrap-switch.js') }}"></script>


<!-- Morris Charts JavaScript -->
<script src="{{ asset('vendors/bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('vendors/bower_components/morris.js/morris.min.js') }}"></script>
<script src="{{ asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>

<!-- Switchery JavaScript -->
<script src="{{ asset('vendors/bower_components/switchery/dist/switchery.min.js') }}"></script>
<script src="{{ asset('vendors/bower_components/sweetalert/dist/sweetalert.min.js') }}"></script>
<script src="{{ asset('vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}">
</script>
<!-- Init JavaScript -->
<script src="{{ asset('/dist/js/init.js') }}"></script>
<script src="{{ asset('/dist/js/dashboard-data.js') }}"></script>
<script src="{{ asset('/dist/js/dashboard3-data.js') }}"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script type="text/javascript" src="{{ asset('/dist/js/printThis.js') }}"></script>
{{-- Font Awesome --}}
<script src="https://kit.fontawesome.com/cc01c97c5b.js" crossorigin="anonymous"></script>
<script src="{{ asset('/sw.js') }}"></script>
@stack('scripts')
<script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function(reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
    $('.download-kartu-tamu').on("click", function() {
        $('#cetak-kartu').printThis({
            base: "https://jasonday.github.io/printThis/"
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
    $(function() {
        $('[data-toogle="tooltip"]').tooltip()
    })
    $(".vertical-spin").TouchSpin({
        verticalbuttons: true,
        verticalupclass: 'ti-plus',
        verticaldownclass: 'ti-minus'
    });
    // kartu-tamu(transaksi)
    $('#transaksi').DataTable({
        "processing": true,
        "serverSide": true,
        "lengthChange": false,
        "searching": true,
        "paginate": {
            "first": "First",
            "last": "Last",
            "next": "Next",
            "previous": "Previous"
        },
        "ajax": {
            "url": "{{ route('kartu-tamu') }}",
            "type": "GET",
            "datatype": "json"
        },
        "render": $.fn.dataTable.render.text(),
        "columns": [{
                data: 'id',
                searchable: true,
                orderable: false
            },
            {
                data: 'status',
                searchable: true,
                orderable: false
            },
        ],
        order: [],
        responsive: true,
        language: {
            search: "",
            searchPlaceholder: "Cari",
            emptyTable: "Tidak ada data pada tabel ini",
            info: "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
            infoFiltered: "(difilter dari _MAX_ total data)",
            infoEmpty: "Tidak ada data pada tabel ini",
            lengthMenu: "Menampilkan _MENU_ data",
            zeroRecords: "Tidak ada data pada tabel ini"
        },
        columnDefs: [{
            className: 'text-left',
            targets: [1, 2, 3, ]
        }],
    });

    $('#show-qr-scan').on('click', function() {
        $('.disabled-scan').addClass('d-none');

        function onScanSuccess(decodedText, decodedResult) {
            $("#resultTEXT").val(decodedText)
            $('#resultDECODE').val(JSON.stringify(decodedResult));
            html5QrcodeScanner.clear();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'GET',
                url: "{{ route('visitor.qrcode') }}",
                data: {
                    qrCode: decodedText
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === "VALID") {
                        swal({
                            title: "Verifikasi berhasil",
                            type: "success",
                            text: "Atas nama " + response.data.name,
                            confirmButtonColor: "#01c853",
                            closeOnConfirm: false,
                            closeOnCancel: false,
                            showCancelButton: false,
                            showConfirmButton: false,
                            timer: 2000,
                        }, function() {
                            window.location.href = decodedText;
                        });
                    } else {
                        swal({
                            icon: 'error',
                            title: response.status,
                            text: response.message,
                            allowOutsideClick: false
                        }, function() {
                            window.location.reload(true)
                        });
                    }
                }
            });
        }

        function onScanFailure(error) {
            console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 144,
                qrbox: {
                    width: 200,
                    height: 200
                }
            },
            true);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    });
</script>
{{-- Input Stepper --}}
<script>
    function stepper(btn, ids) {
        let myInput = document.getElementById("my-input-" + ids);
        // myInput = document.getElementById("my-input");
        // console.log(id);
        let id = btn;
        // let id = btn.getAttribute("id");
        let min = myInput.getAttribute("min");
        let max = myInput.getAttribute("max");
        let step = myInput.getAttribute("step");
        let val = myInput.getAttribute("value");
        let calcStep = (id == "increment") ? (step * 1) :
            (step * -1);
        let newValue = parseInt(val) + calcStep;
        if (newValue >= min && newValue <= max) {
            myInput.setAttribute("value", newValue);
        }
        // console.log(id, min, max, step, val);
    }
</script>
{{-- Tooltip --}}
