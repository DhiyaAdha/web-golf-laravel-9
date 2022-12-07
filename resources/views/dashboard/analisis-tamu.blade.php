@if (auth()->user()->role_id == '2')
    @extends('layouts.main', ['title' => 'TGCC | Analisis Tamu'])
    @push('css')
        <link href="{{ asset('vendors/bower_components/morris.js/morris.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{asset('vendors/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    @endpush
    @section('content')
        <div class="page-wrapper intro-foo">
            <div class="container-fluid pt-25" data-title="Halaman Analisis Tamu" data-intro="Halaman ini memberikan informasi transaksi jumlah pengunjung yang datang di tgcc">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="panel panel-default card-view pa-0">
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body pa-0">
                                    <div class="sm-data-box today" style="background-color:#01C853;" data-title="Jumlah Pengunjung Hari Ini" data-intro="Panel ini memberikan informasi total keseluruhan pengunjung yang sudah melakukan transaksi pada hari ini.">
                                        <div class="container-fluid">
                                            <div class="row p-2">
                                                <div class="col-xs-8 text-left data-wrap-left">
                                                    <span class="txt-light block counter">
                                                        <span class="counter-anim">{{ $visitor_today }}</span>
                                                    </span>
                                                    <span class="weight-500 txt-light block">Transaksi <br> Hari ini</span>
                                                </div>
                                                <div class="col-xs-4 text-right data-wrap-right">
                                                    <i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i>
                                                </div>
                                                <img src="{{ asset('/img/circle.svg') }}" class="card-img-absolute" alt="circle-image">
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
                                    <div class="sm-data-box vvip" data-title="Jumlah Pengunjung VIP Hari Ini" data-intro="Panel ini memberikan informasi total keseluruhan pengunjung VIP yang sudah melakukan transaksi pada hari ini.">
                                        <div class="container-fluid">
                                            <div class="row p-2">
                                                <div class="col-xs-8 text-left data-wrap-left">
                                                    <span class="txt-light block counter">
                                                        <span class="counter-anim">{{ $visitor_vvip }}</span>
                                                    </span>
                                                    <span class="weight-500 txt-light block">Transaksi VIP <br> Hari Ini</span>
                                                </div>
                                                <div class="col-xs-4 text-right data-wrap-right">
                                                    <i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i>
                                                </div>
                                                <img src="{{ asset('/img/circle.svg') }}" class="card-img-absolute" alt="circle-image">
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
                                    <div class="sm-data-box vip" data-title="Jumlah Pengunjung Member Hari Ini" data-intro="Panel ini memberikan informasi total keseluruhan pengunjung Member yang sudah melakukan transaksi pada hari ini.">
                                        <div class="container-fluid">
                                            <div class="row p-2">
                                                <div class="col-xs-8 text-left data-wrap-left">
                                                    <span class="txt-light block counter">
                                                        <span class="counter-anim">{{ $visitor_vip }}</span>
                                                    </span>
                                                    <span class="weight-500 txt-light block">Transaksi Member <br> Hari Ini </span>
                                                </div>
                                                <div class="col-xs-4 text-right data-wrap-right">
                                                    <i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i>
                                                </div>
                                                <img src="{{ asset('/img/circle.svg') }}" class="card-img-absolute" alt="circle-image">
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
                                    <div class="sm-data-box reguler" data-title="Jumlah Pengunjung Non Member Hari Ini" data-intro="Panel ini memberikan informasi total keseluruhan pengunjung Umum yang sudah melakukan transaksi pada hari ini.">
                                        <div class="container-fluid">
                                            <div class="row p-2">
                                                <div class="col-xs-8 text-left data-wrap-left">
                                                    <span class="txt-light block counter">
                                                        <span class="counter-anim">{{ $visitor_reguler }}</span>
                                                    </span>
                                                    <span class="weight-500 txt-light block">Transaksi Reguler <br> Hari Ini </span>
                                                </div>
                                                <div class="col-xs-4 text-right data-wrap-right">
                                                    <i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i>
                                                </div>
                                                <img src="{{ asset('/img/circle.svg') }}" class="card-img-absolute" alt="circle-image">
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
                        <div class="panel panel-default card-view panel-refresh relative" data-title="Pengunjung 7 Hari Terakhir" data-intro="Panel ini berbentuk bar chart dan bersifat data objektif dinamis memberikan informasi jumlah pengunjung setiap hari dalam kurun waktu satu minggu terakhir.">
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
                        <div class="panel panel-default card-view" data-title="Pengunjung 12 Bulan Terakhir" data-intro="Panel ini berbentuk line chart dan bersifat data objektif dinamis memberikan informasi jumlah pengunjung setiap bulan dalam kurun waktu satu tahun terakhir.">
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
                        <div class="panel panel-default card-view" data-title="Kategori Pengunjung 12 Bulan Terakhir" data-intro="Panel ini berbentuk line chart dan bersifat data objektif dinamis memberikan informasi jumlah kategori pengunjung VIP/Member setiap bulan dalam kurun waktu satu tahun terakhir.">
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default card-view" data-title="Tabel Daftar Nama Terakhir Berkunjung" data-intro="Panel ini menampilkan seluruh data membership tgcc dan data pada tabel diurutkan berdasarkan tanggal terakhir member yang berkunjung ke tgcc">
                            <div class="clearfix"></div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div class="table-wrap">
                                        <button class="btn btn-primary btn-filter">Filter</button>
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0" id="dt-analisis">
                                                <thead>
                                                    <tr>
                                                        <th class="">NAMA TAMU</th>
                                                        <th class="">Kategori</th>
                                                        <th class="">JENIS MEMBER</th>
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
            <button id="setting_panel_btn" data-toggle="tooltip" title="Panduan" data-placement="left" class="btn btn-success btn-circle setting-panel-btn shadow-2dp"><i class="zmdi zmdi-settings"></i></button>
            @include('layouts.footer')
        </div>
        </div>
        <div id="modal-filter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h5 class="modal-title" id="myModalLabel"></h5>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="POST">
                            <div class="form-group">
                                <label class="control-label mb-10" for="">Jenis</label>
                                <select class="form-control" name="category">
                                    <option value="all">- Semua -</option>
                                    @foreach ($category as $value)
                                        <option value="{{$value}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10" for="">Tanggal</label>
                                <div class="input-group">
                                    <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                                        <span><i class="fa fa-calendar"></i> Date range picker</span><i class="fa fa-caret-down"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success">Download</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('scripts')
        <script defer src="{{ asset('vendors/bower_components/raphael/raphael.min.js') }}"></script>
        <script defer src="{{ asset('vendors/bower_components/morris.js/morris.min.js') }}"></script>
        <script src="{{asset('vendors/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
        <script defer src="{{ asset('/dist/js/dashboard-data.js') }}"></script>
        <script>
        $(function () {

            if(sessionStorage.getItem('TOUR') !== 'true') {
                introJs().setOption("dontShowAgain", true).start();
                sessionStorage.setItem('TOUR', true);
            }
            $(document).on('click', '#setting_panel_btn', function() {
                introJs('.intro-foo').setOptions({
                    'showProgress': true,
                    'tooltipPosition': 'right'
                }).start();
            });
            $(document).on('click', '.btn-filter', function () {
                $('#modal-filter').modal('toggle');
            });

            $('#daterange-btn').daterangepicker(
                {
                    ranges   : {
                    'Today'       : [moment(), moment()],
                    'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                    'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate  : moment()
                },
                function (start, end) {
                    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                }
            );
        });

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