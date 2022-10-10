@if (auth()->user()->role_id == '2')
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
                                                    <span class="txt-light block counter"><span
                                                            class="counter-anim">{{ $visitor_today }}</span></span>
                                                    <span class="weight-500 uppercase-font txt-light block font-13">Jumlah
                                                        Transaksi <br>hari ini
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
                                                    <span class="weight-500 uppercase-font txt-light block font-13">Total
                                                        transaksi
                                                        VVIP PERTAHUN
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
                                                    <span class="weight-500 uppercase-font txt-light block font-13">Total
                                                        transaksi
                                                        VIP PERTAHUN
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
                                                    <span class="weight-500 uppercase-font txt-light block font-13">Total
                                                        transaksi
                                                        REGULER PERTAHUN
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

                {{-- Total tamu VIP & VVIP --}}
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 ol-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-default card-view panel-refresh">
                            <h6>Detail Tamu VVIP Pertahun</h6>
                            <hr class="light-grey-hr row mt-10 mb-15" />
                            <div class="label-chatrs col-lg-6 mb-15">
                                <span class="clabels-text inline-block txt-dark capitalize-font">
                                    <span class="block font-22 weight-500 mb-5">
                                        <span class="counter-anim">{{ $visitor_vvip_male }}</span>
                                    </span>
                                    <span class="block txt-grey">Laki-laki</span>
                                </span>
                                <i class="big-rpsn-icon zmdi zmdi-male-alt pull-right txt-success"></i>
                                <div class="clearfix"></div>
                            </div>
                            <div class="label-chatrs col-lg-6 mb-15">
                                <span class="clabels-text inline-block txt-dark capitalize-font">
                                    <span class="block font-22 weight-500 mb-5">
                                        <span class="counter-anim">{{ $visitor_vvip_female }}</span>
                                    </span>
                                    <span class="block txt-grey">Perempuan</span>
                                </span>
                                <i class="big-rpsn-icon zmdi zmdi-female pull-right txt-warning"></i>
                                <div class="clearfix"></div>
                            </div>
                            <hr class="light-grey-hr row mt-10 mb-15" />
                        </div>
                    </div>
                    {{-- Total tamu VIP & VIP --}}
                    <div
                        class="col-lg-4 col-md-12 col-sm-12 col-xs-12
                                ol-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-default card-view panel-refresh">
                            <h6>Detail Tamu VIP Pertahun</h6>
                            <hr class="light-grey-hr row mt-10 mb-15" />
                            <div class="label-chatrs col-lg-6 mb-15">
                                <span class="clabels-text inline-block txt-dark capitalize-font">
                                    <span class="block font-22 weight-500 mb-5">
                                        <span class="counter-anim">{{ $visitor_vip_male }}</span>
                                    </span>
                                    <span class="block txt-grey">Laki-laki</span>
                                </span>
                                <i class="big-rpsn-icon zmdi zmdi-male-alt pull-right txt-success"></i>
                                <div class="clearfix"></div>
                            </div>
                            <div class="label-chatrs col-lg-6 mb-15">
                                <span class="clabels-text inline-block txt-dark capitalize-font">
                                    <span class="block font-22 weight-500 mb-5">
                                        <span class="counter-anim">{{ $visitor_vip_female }}</span>
                                    </span>
                                    <span class="block txt-grey">Perempuan</span>
                                </span>
                                <i class="big-rpsn-icon zmdi zmdi-female pull-right txt-warning"></i>
                                <div class="clearfix"></div>
                            </div>
                            <hr class="light-grey-hr row mt-10 mb-15" />
                        </div>
                    </div>
                    <div
                        class="col-lg-4 col-md-12 col-sm-12 col-xs-12
                                ol-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-default card-view panel-refresh">
                            <h6>Detail Tamu REGULER Pertahun</h6>
                            <hr class="light-grey-hr row mt-10 mb-15" />
                            <div class="label-chatrs col-lg-6 mb-15">
                                <span class="clabels-text inline-block txt-dark capitalize-font">
                                    <span class="block font-22 weight-500 mb-5">
                                        <span class="counter-anim">{{ $visitor_reguler_male }}</span>
                                    </span>
                                    <span class="block txt-grey">Laki-laki</span>
                                </span>
                                <i class="big-rpsn-icon zmdi zmdi-male-alt pull-right txt-success"></i>
                                <div class="clearfix"></div>
                            </div>
                            <div class="label-chatrs col-lg-6 mb-15">
                                <span class="clabels-text inline-block txt-dark capitalize-font">
                                    <span class="block font-22 weight-500 mb-5">
                                        <span class="counter-anim">{{ $visitor_reguler_female }}</span>
                                    </span>
                                    <span class="block txt-grey">Perempuan</span>
                                </span>
                                <i class="big-rpsn-icon zmdi zmdi-female pull-right txt-warning"></i>
                                <div class="clearfix"></div>
                            </div>
                            <hr class="light-grey-hr row mt-10 mb-15" />
                        </div>
                    </div>
                </div>

                {{-- Row Statistika Tamu --}}
                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-default card-view">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark">Statistika Transaksi Pertahun</h6>
                                </div>
                                <a href="javascript:void(0)" class="pull-right inline-block full-screen mr-15"
                                    data-toggle="tooltip" title="Fullscreen">
                                    <i class="zmdi zmdi-fullscreen"></i>
                                </a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div id="statistic_visitor_line" class="morris-chart" style="d:293px;"></div>
                                    <ul class="flex-stat mt-1" style="display: flex">
                                        <li>
                                            <span class="block"></span>
                                            <span class="block txt-dark weight-500 font-18">
                                                <span class="">
                                                </span>
                                        </li>
                                        {{-- statistik pertahun --}}
                                        <li>
                                            <span class="block">Total </span>
                                            <span class="block txt-dark weight-500 font-18"><span
                                                    class="counter-anim">{{ $visitor_year }}</span></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Chart Rekap Harian --}}
                    <div class="col-lg-6">
                        <div class="panel panel-default card-view panel-refresh relative">
                            <div class="refresh-container">
                                <div class="la-anim-1"></div>
                            </div>
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark">Statistika Transaksi Harian</h6>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div id="statistic_visitor_bar" class="morris-chart" style="height:340px;"></div>
                                    <ul class="flex-stat mt-1" style="display: flex">
                                        <li>
                                            <span class="block"></span>
                                            <span class="block txt-dark weight-500 font-18">
                                                <span class="">
                                                </span>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="block">Total</span>
                                            <span class="block txt-dark weight-500 font-18">
                                                <span class="">{{ $visitor_week }}</span>
                                            </span>
                                        </li>
                                    </ul>
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
                                                        <th class="">TANGGAL</th>
                                                        <th class="">KATAGORI TAMU</th>
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
            <!-- Footer -->
            @include('layouts.footer')
            <!-- /Footer -->
        </div>
        </div>
    @endsection

    @push('scripts')
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
                    [1, 'asc']
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
                initComplete: function() {
                    $('div.toolbar').html('<b>Daftar nama terakhir bermain</b>').appendTo('.float-left');
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