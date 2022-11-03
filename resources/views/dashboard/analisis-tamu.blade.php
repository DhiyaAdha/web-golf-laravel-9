@if (auth()->user()->role_id == '2')
<head>
    <!-- Morris Charts CSS -->
    <link href="{{ asset('vendors/bower_components/morris.js/morris.css') }}" rel="stylesheet" type="text/css" />
</head>
    @extends('layouts.main', ['title' => 'TGCC | Analisis Tamu'])
    @section('content')
        <div class="page-wrapper">
            <div class="container-fluid pt-25">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="panel panel-default card-view pa-0">
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body pa-0">
                                    <div class="sm-data-box today" style="background-color:#01C853;">
                                        <div class="container-fluid">
                                            <div class="row p-2">
                                                <div class="col-xs-8 text-left data-wrap-left">
                                                    <span class="txt-light block counter">
                                                        <span class="counter-anim">{{ $visitor_today }}</span>
                                                    </span>
                                                    <span class="weight-500 txt-light block">
                                                        Transaksi <br> Hari ini
                                                    </span>
                                                </div>
                                                <div class="col-xs-4 text-right data-wrap-right">
                                                    <i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i>
                                                </div>
                                                <img src="{{ asset('/img/circle.svg') }}" class="card-img-absolute"
                                                    alt="circle-image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="panel panel-default card-view pa-0">
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body pa-0">
                                    <div class="sm-data-box vvip">
                                        <div class="container-fluid">
                                            <div class="row p-2">
                                                <div class="col-xs-8 text-left data-wrap-left">
                                                    <span class="txt-light block counter"><span
                                                            class="counter-anim">{{ $visitor_vvip }}</span></span>
                                                    <span class="weight-500 txt-light block">Transaksi VIP <br> Hari Ini
                                                    </span>
                                                </div>
                                                <div class="col-xs-4 text-right data-wrap-right">
                                                    <i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i>
                                                </div>
                                                <img src="{{ asset('/img/circle.svg') }}" class="card-img-absolute"
                                                    alt="circle-image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="panel panel-default card-view pa-0">
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body pa-0">
                                    <div class="sm-data-box vip">
                                        <div class="container-fluid">
                                            <div class="row p-2">
                                                <div class="col-xs-8 text-left data-wrap-left">
                                                    <span class="txt-light block counter"><span
                                                            class="counter-anim">{{ $visitor_vip }}</span></span>
                                                    <span class="weight-500 txt-light block">Transaksi
                                                        Member <br> Hari Ini
                                                    </span>
                                                </div>
                                                <div class="col-xs-4 text-right data-wrap-right">
                                                    <i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i>
                                                </div>
                                                <img src="{{ asset('/img/circle.svg') }}" class="card-img-absolute"
                                                    alt="circle-image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="panel panel-default card-view pa-0">
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body pa-0">
                                    <div class="sm-data-box reguler">
                                        <div class="container-fluid">
                                            <div class="row p-2">
                                                <div class="col-xs-8 text-left data-wrap-left">
                                                    <span class="txt-light block counter"><span
                                                            class="counter-anim">{{ $visitor_reguler }}</span></span>
                                                    <span class="weight-500 txt-light block">Transaksi
                                                        Umum <br> Hari Ini
                                                    </span>
                                                </div>
                                                <div class="col-xs-4 text-right data-wrap-right">
                                                    <i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i>
                                                </div>
                                                <img src="{{ asset('/img/circle.svg') }}" class="card-img-absolute"
                                                    alt="circle-image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default card-view panel-refresh relative">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark">Statistika Pengunjung 7 Hari Terakhir</h6>
                                </div>
                                <div class="pull-right">
                                    <div class="d-flex align-items-center">
                                        <div id="visitor_week" class="bar-chart-legend"></div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div id="statistic_visitor_bar" class="morris-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="panel panel-default card-view">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark">Statistika Pengunjung 12 Bulan Terakhir</h6>
                                </div>
                                <div class="pull-right">
                                    <div class="d-flex align-items-center">
                                        <div id="visitor_month" class="bar-chart-legend"></div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div id="statistic_visitor_line" class="morris-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="panel panel-default card-view">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark">Kategori Pengunjung 12 Bulan Terakhir</h6>
                                </div>
                                <div class="pull-right">
                                    <div class="d-flex align-items-center">
                                        <div id="visitor_legend" class="bar-chart-legend"></div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div id="bar-chart" height="200"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Row Tabel Tamu-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default card-view">
                            <div class="clearfix"></div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div class="table-wrap">
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0" id="dt-analisis">
                                                <thead>
                                                    <tr>
                                                        <th class="">NAMA TAMU</th>
                                                        <th class="">Kategori</th>
                                                        <th class="">JENIS TAMU</th>
                                                        <th class="table-th">PUKUL</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
        </div>
    @endsection
    @push('scripts')
        <script src="{{ asset('vendors/bower_components/raphael/raphael.min.js') }}"></script>
        <script src="{{ asset('vendors/bower_components/morris.js/morris.min.js') }}"></script>
        <script src="{{ asset('/dist/js/dashboard-data.js') }}"></script>
        <script>
            // fungsi grafik-line & Grafik-bar
            var dataMingguan = {!! json_encode($visitor_daily) !!}
            var dataNewVisitor = {!! json_encode($visitor) !!}

            /* data analisis */
            $('#dt-analisis').DataTable({
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "bDestroy": true,
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
                        "data": function(data) {
                            return `<span class='text-capitalize'>${data.name}</span>`;
                        }
                    },
                    {
                        "data": function(data) {
                            return `<span class='text-capitalize'>${data.category}</span>`;
                        }
                    },
                    {
                        "data": function(data) {
                            if (data.tipe_member == 'VIP') {
                                return `<span class='label label-success'>${data.tipe_member == 'VIP' ? 'Member' : 'VIP'}</span>`;
                            } else {
                                return `<span class='label label-warning'>${data.tipe_member == 'VVIP' ? 'VIP' : 'Member'}</span>`;
                            }
                        }
                    },
                    {
                        data: 'times',

                    }
                ],
                order: [
                    [3, 'desc']
                ],
                responsive: true,
                language: {
                    search: "",
                    searchPlaceholder: "Cari nama",
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
                    },
                    {
                        className: 'text-right',
                        targets: [2]
                    },
                    {
                        width: '40%',
                        targets: [0]
                    },
                    {
                        width: '20%',
                        targets: [1, 2, 3]
                    }
                ],
                dom: "<'row mb-3'<'col-sm-12 col-md-8 pull-right'f><'toolbar col-sm-12 col-md-4 float-left'B>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                initComplete: function() {
                    $('div.toolbar').html('<h6>Daftar member terakhir bermain</h6>').appendTo('.float-left');
                }
            });
            /* data analisis */
        </script>
    @endpush
@else
    <!DOCTYPE HTML>
    <html lang="en-US">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="0; url=/scan-tamu">
        <script type="text/javascript">
            window.location.href = "/scan-tamu"
        </script>
    </head>

    <body>
        Halaman Tidak Ada <a href='/scan-tamu'>Kembali</a>.
    </body>

    </html>
@endif
