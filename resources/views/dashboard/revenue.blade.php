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

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="pannel-title text-dark">Revenue Trendline 7 Hari Terakhir</h6>
                            </div>
                            <div class="pull-right">
                                {{-- <div class="dropdown">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="true" onclick="changediv()">
                                        All Revenue <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" data-dropdown-in="slideInRight" data-dropdown-out="flipOutX">
                                        <li><a href="#">All</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Permainan</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Proshop & fasilitas</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Kantin</a></li>
                                    </ul>
                                </div> --}}
                                <div class="ui-widget">
                                    <select id="filter-week">
                                        <option value="revenue_bar">All Revenue</option>
                                        <option value="revenue_bar_game">Permainan</option>
                                        <option value="revenue_bar_facility">Fasilitas</option>
                                        <option value="revenue_bar_other">Kantin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr class="light-grey-hr row mt-20 mb-15 mb-10" />
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="statistic_revenue_bar" class="morris-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('/dist/js/dashboard3-data.js') }}"></script>
    <script>
        $(document).on('change', '#filter-week', function(e) {
        let week = $(this).val();
            $.ajax({
                async: true,
                type: 'GET',
                url: "{{ url('revenue/dynamic_week') }}", 
                data: { weeks: week },
                success: function(response) {
                    createChart(response.revenue_daily, week);
                }
            }).fail(function() {
                swal({
                    title: "",
                    type: "error",
                    text: 'Terdapat kesalahan program',
                    confirmButtonColor: "#01c853",
                });
                return false;
            });
        });

    var revenueWeek = {!! json_encode($revenue_daily) !!}
    </script>
@endpush
