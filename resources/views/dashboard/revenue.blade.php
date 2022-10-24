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
                                                            class="counter-anim"></span></span>
                                                    <span class="weight-500 txt-light block">
                                                        Revenue Permainan
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
                                                            class="counter-anim"></span></span>
                                                    <span class="weight-500 txt-light block">
                                                        Revenue Proshop & Fasilitas
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
                                                            class="counter-anim"></span></span>
                                                    <span class="weight-500 txt-light block">
                                                        Revenue Kantin
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
                                                    role="tab" href="#profile_6" aria-expanded="false"
                                                    style="padding: 2px 20px;">Proshop & Fasilitas</a></li>
                                            <li role="presentation" class=""><a data-toggle="tab"
                                                    id="profile_tab_6" role="tab" href="#profile_6"
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
                                            <div class="tab-pane fade active in" id="all" role="tabpanel" style="margin-top: 50px;">
                                                <div class="col-lg-12">

                                                    <canvas id="all-chart" height="200"></canvas>
                                                    <div class="panel-wrapper collapse in">
                                                        <ul class="flex-stat mt-1" style="display: flex; margin-top:40px; margin-bottom:20px;">
                                                            <li>
                                                                <span class="block"></span>
                                                                <span class="block txt-dark weight-500 font-18">
                                                                    <span class="">
                                                                    </span>
                                                            </li>
                                                            <li>
                                                                <span class="block txt-dark weight-500 font-18">Total : Rp. <span
                                                                        class="counter-anim">10000000</span></span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade active in" id="permainan" role="tabpanel" style="margin-top: 50px;">
                                                <div id="tes" ></div>
                                            </div>
                                            
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- End of Statistika Revenue --}}


            </div>
        </div>
    @endsection
@endif
@push('scripts')

@endpush
