<!-- /#wrapper -->

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
</script>

<!-- jQuery -->
<script src="{{ asset('vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>

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
<script>
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
    $(document).on('click', '.delete', function() {
        id = $(this).attr('id');
        swal({
            title: "Anda yakin ingin menghapus paket ini?",
            imageUrl: "../img/Warning.svg",
            showCancelButton: true,
            confirmButtonColor: "#FF2A00",
            confirmButtonText: "Hapus paket",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "package/destroy/" + id,
                    beforeSend: function() {
                        $('#ok_button').text('Hapus Data');
                    },
                    success: function(data) {
                        setTimeout(function() {
                            $('#confirmModal').modal('hide');
                            $('#dt-package').DataTable().ajax.reload(null, false);
                        });

                        window.setTimeout(function() {
                            $.toast({
                                text: 'Product berhasil dihapus permanen',
                                position: 'top-right',
                                loaderBg: '#fec107',
                                icon: 'success',
                                hideAfter: 2000,
                                stack: 6
                            });
                        }, 1000);
                        swal("Terhapus!", "", "success");
                    }
                })
            } else {
                swal("Dibatalkan", "Paket Tidak Dihapus", "error");
            }
        });
        return false;
    });
    /* delete package */

    // Edit

    // data analisis
    $('#dt-analisis').DataTable({
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
            "url": "{{ route('analisis-tamu.index') }}",
            "type": "GET",
            "datatype": "json"
        },

        "render": $.fn.dataTable.render.text(),
        "columns": [{
                data: 'name'
            },
            {
                data: 'updated_at'
            },
            {
                "data": function(data) {
                    if (data.tipe_member == 'VIP') {
                        return `<span class='label label-success'>${data.tipe_member}</span>`;
                    } else {
                        return `<span class='label label-warning'>${data.tipe_member}</span>`;
                    }
                }
            },
            {
                data: 'times',
            }
        ],
        order: [
            [1, 'desc']
        ],
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
                targets: [0, 1, 2, 3, ]
            }

        ],
        dom: "<'row mb-3'<'col-sm-12 col-md-8 pull-right'f><'toolbar col-sm-12 col-md-4 float-left'B>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        // dom: '<"toolbar">frtip',
        initComplete: function() {
            $('div.toolbar').html('<b>Daftar nama terakhir bermain</b>').appendTo('.float-left');
        }
    });

    /* data package */
    $('#dt-package').DataTable({
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
            "url": "{{ route('package.index') }}",
            "type": "GET",
            "datatype": "json"
        },
        "render": $.fn.dataTable.render.text(),
        "columns": [{
                "data": function(data) {
                    return data.name
                }
            },
            {
                "data": function(data) {
                    return `<span class="label ${data.category == 'default' ? 'label-primary' : 'label-danger'}">${data.category}</span>`;
                }
            },
            {
                "data": function(data) {
                    return `<p>Rp ${data.price_weekdays}</p>`;
                }
            },
            {
                "data": function(data) {
                    return `<p>Rp ${data.price_weekend}</p>`;
                }
            },
            {
                "data": function(data) {
                    if (data.status == 0) {
                        return `<div class="checkbox checkbox-success checkbox-circle">
                                    <input id="checkbox-10" type="checkbox" disabled checked="" data-toggle="tooltip" data-placement="top" title="ON">
                                    <label for="checkbox-10"></label>
                                </div>`;
                    } else {
                        return `<div class="checkbox checkbox-danger checkbox-circle">
                                    <input id="checkbox-12" type="checkbox" disabled checked=""data-toggle="tooltip" data-placement="top" title="OFF">
                                    <label for="checkbox-12"></label>
                                </div>`;
                    }
                }
            },
            {
                "data": "action"
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
            orderable: false,
            targets: [0, 1, 2, 3, 4, 5, ]
        }],
    });
    /* data package */

    /* data tamu */
    $('#dt-tamu').DataTable({
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
            "url": "{{ route('daftar-tamu') }}",
            "type": "GET",
            "datatype": "json"
        },
        "render": $.fn.dataTable.render.text(),
        "columns": [{
                data: 'name',
                searchable: true,
                orderable: false
            },
            {
                data: 'email',
                searchable: true,
                orderable: false
            },
            {
                data: 'phone',
                searchable: true,
                orderable: false
            },
            {
                data: 'tipe_member',
                searchable: true,
                orderable: false
            },
            {
                data: 'action',
                searchable: false,
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
            targets: [1, 2, 3, 4]
        }],
    });
    /* data tamu */

    /* data aktifitas */
    $('#dt-aktifitas').DataTable({
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
            "url": "{{ route('admin.aktifitas') }}",
            "type": "GET",
            "datatype": "json"
        },
        "render": $.fn.dataTable.render.text(),
        "columns": [{
                data: 'role',
                searchable: true,
                orderable: false
            },
            {
                data: 'user_name',
                searchable: true,
                orderable: false
            },
            {
                data: 'information',
                searchable: true,
                orderable: false
            },
            {
                data: 'status_action',
                searchable: true,
                orderable: false
            },
            {
                data: 'date_activity',
                searchable: true,
                orderable: false
            }
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
            targets: [1, 2, 3, 4]
        }],
    });
    /* data aktifitas */

    /* daftar admin */
    $('#dt-admin').DataTable({
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
            "url": "{{ route('daftar-admin') }}",
            "type": "GET",
            "datatype": "json"
        },

        "render": $.fn.dataTable.render.text(),
        "columns": [{
                data: 'name',
                searchable: true,
                orderable: false
            },
            {
                data: 'email',
                searchable: true,
                orderable: false
            },
            {
                data: 'phone',
                searchable: true,
                orderable: false
            },
            {
                data: 'role',
                searchable: true,
                orderable: false
            },
            {
                data: 'action',
                searchable: false,
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
            targets: [0, 1, 2, 3]
        }, {
            orderable: false,
            targets: [0, 1, 2, 3]
        }],
    });
    /* daftar admin */

    /* delete admin */
    $(document).on('click', '.delete-admin', function() {
        id = $(this).attr('id');
        swal({
            title: "Anda yakin ingin menghapus admin ini?",
            imageUrl: "../img/Warning.svg",
            showCancelButton: true,
            confirmButtonColor: "#FF2A00",
            confirmButtonText: "Hapus admin",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "/daftar-admin/destroy/" + id,
                    beforeSend: function() {
                        $('#ok_button').text('Hapus Data');
                    },
                    success: function(data) {
                        setTimeout(function() {
                            $('#confirmModal').modal('hide');
                            $('#dt-admin').DataTable().ajax.reload(null, false);
                        });

                        window.setTimeout(function() {
                            $.toast({
                                text: 'Data admin berhasil dihapus',
                                position: 'top-right',
                                loaderBg: '#fec107',
                                icon: 'success',
                                hideAfter: 2000,
                                stack: 6
                            });
                        }, 1000);
                        swal("Terhapus!", "", "success");
                    }
                })
            } else {
                swal("Dibatalkan", "", "error");
            }
        });
        return false;
    });
    /* delete admin *

    /* delete tamu */
    $(document).on('click', '.delete-confirm', function() {
        id = $(this).attr('id');
        swal({
            title: "Anda yakin ingin menghapus tamu ini?",
            imageUrl: "../img/Warning.svg",
            showCancelButton: true,
            confirmButtonColor: "#FF2A00",
            confirmButtonText: "Hapus paket",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "/daftar-tamu/destroy/" + id,
                    beforeSend: function() {
                        $('#ok_button').text('Hapus Data');
                    },
                    success: function(data) {
                        setTimeout(function() {
                            $('#confirmModal').modal('hide');
                            $('#dt-tamu').DataTable().ajax.reload(null, false);
                        });

                        window.setTimeout(function() {
                            $.toast({
                                text: 'Data berhasil dihapus',
                                position: 'top-right',
                                loaderBg: '#fec107',
                                icon: 'success',
                                hideAfter: 2000,
                                stack: 6
                            });
                        }, 1000);
                        swal("Terhapus!", "", "success");
                    }
                })
            } else {
                swal("Dibatalkan", "", "error");
            }
        });
        return false;
    });
    /* delete tamu *

    /* daftar invoice */
    $('#dt-riwayat').DataTable({
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
            "url": "{{ route('riwayat-invoice.index') }}",
            "type": "GET",
            "datatype": "json"
        },
        "render": $.fn.dataTable.render.text(),
        "columns": [{
                data: 'name'
            },
            {
                "data": function(data) {
                    return `<span class="label ${data.tipe_member == 'VIP' ? 'label-success' : 'label-warning'}">${data.tipe_member}</span>`;
                }
            },
            {
                data: 'total'
            },
            {
                data: 'created_at'
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
            className: 'text-center',
            targets: [1, 2, 3]
        }, {
            orderable: false,
            targets: [0, 1, 2, 3]
        }],
    });
    /* daftar invoice */

    // invoice detail
    $('#dt-invoice').DataTable({
        "processing": true,
        "serverSide": true,
        "lengthChange": false,
        "searching": false,
        "paginate": {
            "first": "First",
            "last": "Last",
            "next": "Next",
            "previous": "Previous"
        },
        "ajax": {
            "url": "{{ route('riwayat-invoice.create') }}",
            "type": "GET",
            "datatype": "json"
        },
        "render": $.fn.dataTable.render.text(),
        "columns": [{
                data: 'name',
                searchable: true,
                orderable: false
            },
            {
                data: 'harga',
                searchable: true,
                orderable: false
            },
            {
                data: 'quantity',
                searchable: true,
                orderable: false
            },
            {
                data: 'total',
                searchable: true,
                orderable: false,
                className: 'text-right'
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
                className: 'text-center',
                targets: [1, 2]
            }
        ],
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
                type: 'POST',
                url: "{{ route('visitor.qrcode') }}",
                data: {
                    qrCode: decodedText
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === "VALID") {
                        console.log(response.data)
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
                            window.location.href = "/detail_scan/" + response.data.id;
                        });
                    } else {
                        swal({
                            icon: 'error',
                            title: response.status,
                            text: response.message,
                            allowOutsideClick: false
                        }, function() {
                            // Untuk reload Page jika gagal
                            window.location.reload(true)
                        });
                    }

                    $('#resultTEXT').val("");
                    $('#resultDECODE').val("");
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
            false);
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