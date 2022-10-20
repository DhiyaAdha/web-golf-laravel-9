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
                                <h6 class="panel-title txt-dark">Revenue Trendline</h6>
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
                                    <li>
                                        <span class="block">Total</span>
                                        <span class="block txt-dark weight-500 font-18"><span
                                                class="counter-anim">15000</span></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Chart Rekap Harian --}}
                
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default card-view panel-refresh relative">
                        <div class="refresh-container">
                            <div class="la-anim-1"></div>
                        </div>
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Revenue Harian</h6>
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
                                            <span class=""></span>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End of Statistika Revenue --}}

            <div class="row">
                <div>
                    <canvas id="myChart"></canvas>
                  </div>
                  
            </div>



        </div>
    </div>
    @endsection
@endif
@push('scripts')
<script>
    const labels = [
      'January',
      'February',
      'March',
      'April',
      'May',
      'June',
    ];
  
    const data = {
      labels: labels,
      datasets: [{
        label: 'My First dataset',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: [0, 10, 5, 2, 20, 30, 45],
      }]
    };
  
    const config = {
      type: 'line',
      data: data,
      options: {}
    };
  </script>
<script>
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );
  </script>
@endpush