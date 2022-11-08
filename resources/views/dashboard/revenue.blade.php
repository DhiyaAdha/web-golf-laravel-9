<head>
    <!-- Morris Charts CSS -->
    <link href="{{ asset('vendors/bower_components/morris.js/morris.css') }}" rel="stylesheet" type="text/css" />
</head>
@extends('layouts.main', ['title' => 'TGCC | Analisis Revenue'])
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid pt-25">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-default card-view pa-0">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <div class="sm-data-box today">
                                    <div class="container-fluid">
                                        <div class="row p-2">
                                            <div class="col-xs-8 text-left data-wrap-left">
                                                <span class="txt-light block counter">Rp.
                                                    <span class="counter-anim">{{ number_format($revenue_today) }}</span>
                                                </span>
                                                <span class="weight-500 txt-light block">
                                                    Revenue hari ini
                                                </span>
                                            </div>
                                            <div class="col-xs-4 text-right data-wrap-right">
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
                                                <span class="txt-light block counter">Rp.
                                                    <span class="counter-anim">{{ number_format($revenue_game) }}</span>
                                                </span>
                                                <span class="weight-500 txt-light block">
                                                    Revenue permainan hari ini
                                                </span>
                                            </div>
                                            <div class="col-xs-4 text-right data-wrap-right">
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
                                                <span class="txt-light block counter">Rp. <span
                                                        class="counter-anim">{{ number_format($revenue_proshop) }}</span></span>
                                                <span class="weight-500 txt-light block">
                                                    Revenue proshop & fasilitas hari ini
                                                </span>
                                            </div>
                                            <div class="col-xs-4 text-right data-wrap-right">
                                                <i class="zmdi zmdi-shopping-cart txt-light data-right-rep-icon"></i>
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
                                                <span class="txt-light block counter">Rp. <span
                                                        class="counter-anim">{{ number_format($revenue_store) }}</span></span>
                                                <span class="weight-500 txt-light block">
                                                    Revenue kantin hari ini
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
            {{-- Start Trendline --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default card-view">
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
                                    </ul>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr class="light-grey-hr row mt-20 mb-15 mb-10" />
                        </div>

                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
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
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default card-view">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Finish Trendline --}}
@endsection
@push('scripts')
    <script src="{{ asset('vendors/bower_components/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('vendors/bower_components/morris.js/morris.min.js') }}"></script>
    <script src="{{ asset('/dist/js/dashboard3-data.js') }}"></script>
    <script>
        var revenueWeek = {!! json_encode($revenue_daily) !!}
        var revenueMonth = {!! json_encode($revenue) !!}

        $('#b').click(function() {
            document.getElementById('revenue_bar_game').style = 'display:visible;';
        });
        $('#c').click(function() {
            document.getElementById('revenue_bar_facility').style = 'display:visible;';
        });
        $('#d').click(function() {
            document.getElementById('revenue_bar_other').style = 'display:visible;';
        });
        $('#f').click(function() {
            document.getElementById('revenue_line_game').style = 'display:visible;';
        });
        $('#g').click(function() {
            document.getElementById('revenue_line_facility').style = 'display:visible;';
        });
        $('#h').click(function() {
            document.getElementById('revenue_line_other').style = 'display:visible;';
        });
    </script>
@endpush
