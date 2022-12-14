@extends('layouts.main', ['title' => 'TGCC | Analisis Revenue'])
@push('css')
    <link href="{{ asset('vendors/bower_components/morris.js/morris.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="page-wrapper intro-foo">
        <div class="container-fluid pt-25"  
        data-title="Halaman Revenue" data-intro="Halaman ini memberikan informasi total revenue setiap kategori di tgcc. ">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-default card-view pa-0">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <div class="sm-data-box today" style="background-color:#01C853;" data-title="Jumlah Revenue <br> Hari Ini" data-intro="Panel ini memberikan informasi total keseluruhan Revenue pada hari ini.">
                                    <div class="container-fluid">
                                        <div class="row p-2">
                                            <div class="col-xs-8 text-left data-wrap-left">
                                                <span class="txt-light block counter">Rp.
                                                    <span class="counter-anim">{{ number_format($revenue_today) }}</span>
                                                </span>
                                                <span class="weight-500 txt-light block">Revenue hari ini</span>
                                            </div>
                                            <div class="col-xs-4 text-right data-wrap-right">
                                                <i class="zmdi zmdi-money txt-light data-right-rep-icon"></i>
                                            </div>
                                            <img src="{{ asset('/img/circle.svg') }}" class="card-img-absolute" alt="circle-image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-default card-view pa-0">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <div class="sm-data-box vvip" data-title="Jumlah Revenue Permainan Hari Ini" data-intro="Panel ini memberikan informasi total keseluruhan revenue kategori permaian pada hari ini.">
                                    <div class="container-fluid">
                                        <div class="row p-2">
                                            <div class="col-xs-8 text-left data-wrap-left">
                                                <span class="txt-light block counter">Rp.
                                                    <span class="counter-anim">{{ number_format($revenue_game) }}</span>
                                                </span>
                                                <span class="weight-500 txt-light block">Revenue permainan hari ini</span>
                                            </div>
                                            <div class="col-xs-4 text-right data-wrap-right">
                                                <i class="zmdi zmdi-case-play txt-light data-right-rep-icon"></i>
                                            </div>
                                            <img src="{{ asset('/img/circle.svg') }}" class="card-img-absolute" alt="circle-image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-default card-view pa-0">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <div class="sm-data-box vip" data-title="Jumlah Revenue Proshop & Fasilitas Hari Ini" data-intro="Panel ini memberikan informasi total keseluruhan revenue kategori proshop & fasilitas pada hari ini.">
                                    <div class="container-fluid">
                                        <div class="row p-2">
                                            <div class="col-xs-8 text-left data-wrap-left">
                                                <span class="txt-light block counter">Rp. <span class="counter-anim">{{ number_format($revenue_proshop) }}</span></span>
                                                <span class="weight-500 txt-light block"> Revenue proshop & fasilitas hari ini </span>
                                            </div>
                                            <div class="col-xs-4 text-right data-wrap-right">
                                                <i class="zmdi zmdi-shopping-cart txt-light data-right-rep-icon"></i>
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
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-default card-view pa-0">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <div class="sm-data-box reguler" data-title="Jumlah Revenue <br> Kantin Hari Ini" data-intro="Panel ini memberikan informasi total keseluruhan revenue kategori kantin pada hari ini.">
                                    <div class="container-fluid">
                                        <div class="row p-2">
                                            <div class="col-xs-8 text-left data-wrap-left">
                                                <span class="txt-light block counter">Rp. 
                                                    <span class="counter-anim">{{ number_format($revenue_store) }}</span>
                                                </span>
                                                <span class="weight-500 txt-light block"> Revenue kantin hari ini </span>
                                            </div>
                                            <div class="col-xs-4 text-right data-wrap-right">
                                                <i class="zmdi zmdi-coffee txt-light data-right-rep-icon"></i>
                                            </div>
                                            <img src="{{ asset('/img/circle.svg') }}" class="card-img-absolute" alt="circle-image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-default card-view pa-0">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <div class="sm-data-box rental" data-title="Jumlah Revenue <br> Kantin Hari Ini" data-intro="Panel ini memberikan informasi total keseluruhan revenue kategori kantin pada hari ini.">
                                    <div class="container-fluid">
                                        <div class="row p-2">
                                            <div class="col-xs-8 text-left data-wrap-left">
                                                <span class="txt-light block counter">Rp. 
                                                    <span class="counter-anim">{{ number_format($revenue_rental) }}</span>
                                                </span>
                                                <span class="weight-500 txt-light block"> Revenue penyewaan hari ini </span>
                                            </div>
                                            <div class="col-xs-4 text-right data-wrap-right">
                                                <i class="zmdi zmdi-assignment txt-light data-right-rep-icon"></i>
                                            </div>
                                            <img src="{{ asset('/img/circle.svg') }}" class="card-img-absolute" alt="circle-image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-default card-view pa-0">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <div class="sm-data-box fee" style="background-color:#01C853;" data-title="Jumlah Revenue <br> Hari Ini" data-intro="Panel ini memberikan informasi total keseluruhan Revenue pada hari ini.">
                                    <div class="container-fluid">
                                        <div class="row p-2">
                                            <div class="col-xs-8 text-left data-wrap-left">
                                                <span class="txt-light block counter">Rp.
                                                    <span class="counter-anim">{{ number_format($revenue_service) }}</span>
                                                </span>
                                                <span class="weight-500 txt-light block">Service Fee</span>
                                            </div>
                                            <div class="col-xs-4 text-right data-wrap-right">
                                                <i class="zmdi zmdi-minus-square txt-light data-right-rep-icon"></i>
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
                    <div class="panel panel-default card-view" data-title="Revenue 7 Hari Terakhir" data-intro="Panel ini berbentuk bar chart dan bersifat data objektif dinamis memberikan informasi nominal revenue setiap hari berdasarkan kategori dalam kurun waktu satu minggu terakhir.">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="pannel-title text-dark">Revenue Trendline 7 Hari Terakhir</h6>
                            </div>
                            <div class="pull-right">
                                <div class="pull-right">
                                    <ul role="tablist" class="nav nav-pills nav-pills-rounded" id="myTabs_6">
                                        <li class="active" role="presentation" id="a">
                                            <a data-toggle="tab" role="tab" href="#all" aria-expanded="true">All</a>
                                        </li>
                                        <li role="presentation" class="" id="b">
                                            <a data-toggle="tab" role="tab" href="#game" aria-expanded="true">Permainan</a>
                                        </li>
                                        <li role="presentation" class="" id="c">
                                            <a data-toggle="tab" role="tab" href="#facility" aria-expanded="true">Proshop & Fasilitas</a>
                                        </li>
                                        <li role="presentation" class="" id="d">
                                            <a data-toggle="tab" role="tab" href="#other" aria-expanded="true">Kantin</a>
                                        </li>
                                        <li role="presentation" class="" id="i">
                                            <a data-toggle="tab" role="tab" href="#rental" aria-expanded="true">Sewa</a>
                                        </li>
                                        <li role="presentation" class="" id="j">
                                            <a data-toggle="tab" role="tab" href="#fee" aria-expanded="true">Service Fee</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr class="light-grey-hr row mt-20 mb-15 mb-10" />
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body" >
                                <div class="tab-content">
                                    <div id="all" class="tab-pane fade active in" role="tabpanel">
                                        <div class="panel-body">
                                            <div id="revenue_bar" class="morris-chart"></div>
                                        </div>
                                    </div>
                                    <div id="game" class="tab-pane fade active in" role="tabpanel">
                                        <div class="panel-body">
                                            <div id="revenue_bar_game" class="morris-chart" style="display: none"></div>
                                        </div>
                                    </div>
                                    <div id="facility" class="tab-pane fade active in" role="tabpanel">
                                        <div class="panel-body">
                                            <div id="revenue_bar_facility" class="morris-chart" style="display: none"></div>
                                        </div>
                                    </div>
                                    <div id="other" class="tab-pane fade active in" role="tabpanel">
                                        <div class="panel-body">
                                            <div id="revenue_bar_other" class="morris-chart" style="display: none"></div>
                                        </div>
                                    </div>
                                    <div id="rental" class="tab-pane fade active in" role="tabpanel">
                                        <div class="panel-body">
                                            <div id="revenue_bar_rental" class="morris-chart" style="display: none"></div>
                                        </div>
                                    </div>
                                    <div id="fee" class="tab-pane fade active in" role="tabpanel">
                                        <div class="panel-body">
                                            <div id="revenue_bar_fee" class="morris-chart" style="display: none"></div>
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
                    <div class="panel panel-default card-view" data-title="Revenue 12 Bulan Terakhir" data-intro="Panel ini berbentuk line chart dan bersifat data objektif dinamis memberikan informasi nominal revenue setiap bulan berdasarkan kategori dalam kurun waktu satu tahun terakhir.">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="pannel-title text-dark">Revenue Trendline 12 Bulan Terakhir</h6>
                            </div>
                            <div class="pull-right">
                                <div class="pull-right">
                                    <ul role="tablist" class="nav nav-pills nav-pills-rounded" id="myTabs_7">
                                        <li class="active" role="presentation" id="e">
                                            <a data-toggle="tab" role="tab" href="#all_line" aria-expanded="true">All</a>
                                        </li>
                                        <li role="presentation" class="" id="f">
                                            <a data-toggle="tab" role="tab" href="#game_line" aria-expanded="true">Permainan</a>
                                        </li>
                                        <li role="presentation" class="" id="g">
                                            <a data-toggle="tab" role="tab" href="#facility_line" aria-expanded="true">Proshop & Fasilitas</a>
                                        </li>
                                        <li role="presentation" class="" id="h">
                                            <a data-toggle="tab" role="tab" href="#other_line" aria-expanded="true">Kantin</a>
                                        </li>
                                        <li role="presentation" class="" id="k">
                                            <a data-toggle="tab" role="tab" href="#rental_line" aria-expanded="true">Sewa</a>
                                        </li>
                                        <li role="presentation" class="" id="l">
                                            <a data-toggle="tab" role="tab" href="#service_line" aria-expanded="true">Service Fee</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr class="light-grey-hr row mt-20 mb-15 mb-10" />
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div id="all_line" class="tab-pane fade active in" role="tabpanel">
                                        <div class="panel-body">
                                            <div id="revenue_line" class="morris-chart"></div>
                                        </div>
                                    </div>
                                    <div id="game_line" class="tab-pane fade active in" role="tabpanel">
                                        <div class="panel-body">
                                            <div id="revenue_line_game" class="morris-chart" style="display: none"></div>
                                        </div>
                                    </div>
                                    <div id="facility_line" class="tab-pane fade active in" role="tabpanel">
                                        <div class="panel-body">
                                            <div id="revenue_line_facility" class="morris-chart" style="display: none"></div>
                                        </div>
                                    </div>
                                    <div id="other_line" class="tab-pane fade active in" role="tabpanel">
                                        <div class="panel-body">
                                            <div id="revenue_line_other" class="morris-chart" style="display: none"></div>
                                        </div>
                                    </div>
                                    <div id="rental_line" class="tab-pane fade active in" role="tabpanel">
                                        <div class="panel-body">
                                            <div id="revenue_line_rental" class="morris-chart" style="display: none"></div>
                                        </div>
                                    </div>
                                    <div id="service_line" class="tab-pane fade active in" role="tabpanel">
                                        <div class="panel-body">
                                            <div id="revenue_line_fee" class="morris-chart" style="display: none"></div>
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
@endsection
@push('scripts')
    <script defer src="{{ asset('vendors/bower_components/raphael/raphael.min.js') }}"></script>
    <script defer src="{{ asset('vendors/bower_components/morris.js/morris.min.js') }}"></script>
    <script defer src="{{ asset('/dist/js/dashboard3-data.js') }}"></script>

    <script>
        $(document).on('click', '#setting_panel_btn', function() {
            introJs('.intro-foo').setOptions({
                'showProgress': true,
                'tooltipPosition': 'right'
            }).start();
        });
    </script>

@endpush
