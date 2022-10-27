@if (auth()->user()->role_id == '2')
    @extends('layouts.main', ['title' => 'TGCC | Analisis Revenue'])
    @section('content')
        <div class="page-wrapper">
            <div class="container-fluid pt-25">
                {{-- Revenue --}}
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="panel panel-default card-view pa-0">
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body pa-0">
                                    <div class="sm-data-box today">
                                        <div class="container-fluid">
                                            <div class="row p-2">
                                                <div class="col-xs-8 text-left data-wrap-left">
                                                    <span class="txt-light block counter"><span
                                                            class="counter-anim"></span></span>
                                                    <span class="weight-500 txt-light block">
                                                        Revenue Today
                                                    </span>
                                                    <div class="dhiya mt-10" style="margin-left: -4px;">
                                                    <span class="label label-info">{{ date('d-m-Y'); }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-xs-4 text-right data-wrap-right">
                                                    {{-- <i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i> --}}
                                                    <i class="zmdi zmdi-money txt-light data-right-rep-icon"></i>
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
                                                            class="counter-anim"></span></span>
                                                    <span class="weight-500 txt-light block">
                                                        Revenue Permainan
                                                    </span>
                                                </div>
                                                <div class="col-xs-4 text-right data-wrap-right">
                                                    {{-- <i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i> --}}
                                                    <i class="zmdi zmdi-case-play txt-light data-right-rep-icon"></i>
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
                                                            class="counter-anim"></span></span>
                                                    <span class="weight-500 txt-light block">
                                                        Revenue Proshop & Fasilitas
                                                    </span>
                                                </div>
                                                <div class="col-xs-4 text-right data-wrap-right">
                                                    <i class="zmdi zmdi-shopping-cart txt-light data-right-rep-icon"></i>
                                                    {{-- <i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i> --}}
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
                                                            class="counter-anim"></span></span>
                                                    <span class="weight-500 txt-light block">
                                                        Revenue Kantin
                                                    </span>
                                                </div>
                                                <div class="col-xs-4 text-right data-wrap-right">
                                                    <i class="zmdi zmdi-coffee txt-light data-right-rep-icon"></i>
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
                {{-- End of Revenue --}}

                {{-- Statistika Revenue --}}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default card-view">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h6 class="pannel-title text-dark">Revenue Trendline</h6>
                                </div>
                                <div class="pull-right">
                                    <div class="pull-right">
                                        <ul role="tablist" class="nav nav-pills nav-pills-rounded" id="myTabs_6">
                                            <li class="active" role="presentation"><a aria-expanded="true" data-toggle="tab"
                                                    role="tab" id="home_tab_6" href="#all"
                                                    style="padding: 2px 20px;">All</a></li>
                                            <li role="presentation" class=""><a data-toggle="tab" id="profile_tab_6"
                                                    role="tab" href="#permainan" aria-expanded="false"
                                                    style="padding: 2px 20px;">Permainan</a></li>
                                            <li role="presentation" class=""><a data-toggle="tab" id="profile_tab_6"
                                                    role="tab" href="#proshop" aria-expanded="false"
                                                    style="padding: 2px 20px;">Proshop & Fasilitas</a></li>
                                            <li role="presentation" class=""><a data-toggle="tab"
                                                    id="profile_tab_6" role="tab" href="#kantin"
                                                    aria-expanded="false" style="padding: 2px 20px;">Kantin</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <hr class="light-grey-hr row mt-20 mb-15 mb-10" />
                            </div>

                            <div class="panel-wrapper collapse in">
                                <div class="panel-body" style="margin-top: -80px; margin-bottom:-10px;">
                                    <div class="pills-struct mt-40">
                                        <div class="tab-content" id="myTabContent_6">
                                            <div class="tab-pane fade active in" id="all" role="tabpanel"
                                                style="margin-top: 50px;">
                                                <div class="col-lg-12">
                                                    <canvas id="all-chart" height="100"></canvas>
                                                    <div class="panel-wrapper collapse in">
                                                        <ul class="flex-stat mt-1"
                                                            style="display: flex; margin-top:40px; margin-bottom:20px;">
                                                            <li>
                                                                <span class="block"></span>
                                                                <span class="block txt-dark weight-500 font-18">
                                                                    <span class="">
                                                                    </span>
                                                            </li>
                                                            <li>
                                                                <span class="block txt-dark weight-500 font-18">Total : Rp.
                                                                    <span class="counter-anim">10000000</span></span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade active in" id="permainan" role="tabpanel"
                                                style="margin-top: 50px;">
                                                <div class="col-lg-12">
                                                    <canvas id="permainan-chart" height="100"></canvas>
                                                    <div class="panel-wrapper collapse in">
                                                        <ul class="flex-stat mt-1"
                                                            style="display: flex; margin-top:40px; margin-bottom:20px;">
                                                            <li>
                                                                <span class="block"></span>
                                                                <span class="block txt-dark weight-500 font-18">
                                                                    <span class="">
                                                                    </span>
                                                            </li>
                                                            <li>
                                                                <span class="block txt-dark weight-500 font-18">Total : Rp.
                                                                    <span class="counter-anim">500000</span></span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="tab-pane fade active in" id="proshop" role="tabpanel"
                                                style="margin-top: 50px;">
                                                <div class="col-lg-12">
                                                    <canvas id="proshop-chart" height="100"></canvas>
                                                    <div class="panel-wrapper collapse in">
                                                        <ul class="flex-stat mt-1"
                                                            style="display: flex; margin-top:40px; margin-bottom:20px;">
                                                            <li>
                                                                <span class="block"></span>
                                                                <span class="block txt-dark weight-500 font-18">
                                                                    <span class="">
                                                                    </span>
                                                            </li>
                                                            <li>
                                                                <span class="block txt-dark weight-500 font-18">Total : Rp.
                                                                    <span class="counter-anim">500000</span></span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="tab-pane fade active in" id="kantin" role="tabpanel"
                                                style="margin-top: 50px;">
                                                <div class="col-lg-12">
                                                    <canvas id="kantin-chart" height="100"></canvas>
                                                    <div class="panel-wrapper collapse in">
                                                        <ul class="flex-stat mt-1"
                                                            style="display: flex; margin-top:40px; margin-bottom:20px;">
                                                            <li>
                                                                <span class="block"></span>
                                                                <span class="block txt-dark weight-500 font-18">
                                                                    <span class="">
                                                                    </span>
                                                            </li>
                                                            <li>
                                                                <span class="block txt-dark weight-500 font-18">Total : Rp.
                                                                    <span class="counter-anim">300000</span></span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- End of Statistika Revenue --}}

                {{-- Revenue Harian --}}
                {{-- <div class="row"> --}}
                    <div class="col-lg-12">
                        <div class="panel panel-default card-view">
                            <div class="tab-pane fade active in" id="permainan" role="tabpanel"
                                style="margin-top: 50px;">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h6 class="pannel-title text-dark">Revenue Trendline</h6>
                                    </div>
                                    <div class="pull-right">
                                        <div class="pull-right">
                                            <ul role="tablist" class="nav nav-pills nav-pills-rounded" id="myTabs_6">
                                                <li class="active" role="presentation"><a aria-expanded="true"
                                                        data-toggle="tab" role="tab" id="home_tab_6" href="#all2"
                                                        style="padding: 2px 20px;">All</a></li>
                                                <li role="presentation" class=""><a data-toggle="tab"
                                                        id="profile_tab_6" role="tab" href="#permainan2"
                                                        aria-expanded="false" style="padding: 2px 20px;">Permainan</a>
                                                </li>
                                                <li role="presentation" class=""><a data-toggle="tab"
                                                        id="profile_tab_6" role="tab" href="#proshop2"
                                                        aria-expanded="false" style="padding: 2px 20px;">Proshop &
                                                        Fasilitas</a></li>
                                                <li role="presentation" class=""><a data-toggle="tab"
                                                        id="profile_tab_6" role="tab" href="#kantin2"
                                                        aria-expanded="false" style="padding: 2px 20px;">Kantin</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr class="light-grey-hr row mt-20 mb-15 mb-10" />
                                </div>
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
                                        {{-- statistik pertahun --}}
                                        <li>
                                            <span class="block">Total</span>
                                            <span class="block txt-dark weight-500 font-18">
                                                <span class=""></span>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>


                        </div>
                    </div>
                {{-- </div> --}}
                {{-- End of Revenue Harian --}}


            </div>
        </div>
    @endsection
    @push('scripts')
        {{-- <script>
            // fungsi grafik-line & Grafik-bar
            // var dataMingguan = {!! json_encode($visitor_daily) !!}
            // var dataNewVisitor = {!! json_encode($visitor) !!}

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
                // order: [
                //     [1, 'asc']
                // ],
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
                    }
                ],
                dom: "<'row mb-3'<'col-sm-12 col-md-8 pull-right'f><'toolbar col-sm-12 col-md-4 float-left'B>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                initComplete: function() {
                    $('div.toolbar').html('<b>Daftar member terakhir bermain</b>').appendTo('.float-left');
                }
            });
            /* data analisis */
        </script> --}}
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