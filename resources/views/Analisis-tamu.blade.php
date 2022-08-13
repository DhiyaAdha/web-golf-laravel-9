@extends('Layouts.Main')
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
			<div class="row heading-bg">
				<!-- Breadcrumb -->
				@include('Layouts.Breadcrumb')
				<!-- /Breadcrumb -->
			</div>
            {{-- Row Kalkulasi Tamu --}}
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-default card-view pa-0">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <div class="sm-data-box" style="background-color:#01C853;">
                                    <div class="container-fluid">
                                        <div class="row p-2">
                                            <div class="col-xs-6 text-left data-wrap-left">
                                                <span class="txt-light block counter"><span class="counter-anim">{{ $visitor_today }}</span></span>
                                                <span class="weight-500 uppercase-font txt-light block font-13">Jumlah tamu hari ini</span>
                                            </div>
                                            <div class="col-xs-6 text-right data-wrap-right">
                                                <i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i>
                                            </div>
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
                                <div class="sm-data-box" style="background-color: #FFDE32;">
                                    <div class="container-fluid">
                                        <div class="row p-2">
                                            <div class="col-xs-6 text-left data-wrap-left">
                                                <span class="txt-light block counter"><span class="counter-anim">{{ $visitor_vvip }}</span></span>
                                                <span class="weight-500 uppercase-font txt-light block font-13">Total tamu VVIP</span>
                                            </div>
                                            <div class="col-xs-6 text-right data-wrap-right">
                                                <i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i>
                                            </div>
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
                                <div class="sm-data-box" style="background-color: #32FFC1;">
                                    <div class="container-fluid">
                                        <div class="row p-2">
                                            <div class="col-xs-6 text-left data-wrap-left">
                                                <span class="txt-light block counter"><span class="counter-anim">{{ $visitor_vip }}</span></span>
                                                <span class="weight-500 uppercase-font txt-light block font-13">Total tamu VIP</span>
                                            </div>
                                            <div class="col-xs-6 text-right data-wrap-right">
                                                <i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Row Statistika Tamu --}}
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Statistika Tamu Berkunjung</h6>
                            </div>
                            <div class="pull-right">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="morris_extra_line_chart" class="morris-chart" style="height:293px;"></div>
                                <ul class="flex-stat mt-40">
                                    <li>
                                        <span class="block">Tamu Mingguan</span>
                                        <span class="block txt-dark weight-500 font-18">
											<span class="counter-anim">3,24,222</span>
										</span>
                                    </li>
                                    <li>
                                        <span class="block">Tamu Bulanan</span>
                                        <span class="block txt-dark weight-500 font-18">
											<span class="counter-anim">1,23,432</span>
										</span>
                                    </li>
                                    <li>
                                        <span class="block">Total Tamu Berkunjung</span>
                                        <span class="block txt-dark weight-500 font-18">
											<span class="counter-anim">1,23,432</span>
										</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-default card-view panel-refresh relative">
                        <div class="refresh-container">
                            <div class="la-anim-1"></div>
                        </div>
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Rekap Harian</h6>
                            </div>
                            <div class="ct-chart ct-perfect-fourth"></div>
                            <script>
                                var data = {
                                    labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                                    series: [
                                        [75, 105, 80, 60, 70, 100, 30],
                                        [150, 55, 110, 110, 110, 60, 40]
                                    ]
                                };

                                var options = {
                                    seriesBarDistance: 15
                                };

                                var responsiveOptions = [
                                    ['screen and (min-width: 641px) and (max-width: 1024px)', {
                                        seriesBarDistance: 10,
                                        axisX: {
                                            labelInterpolationFnc: function(value) {
                                                return value;
                                            }
                                        }
                                    }],
                                    ['screen and (max-width: 640px)', {
                                        seriesBarDistance: 5,
                                        axisX: {
                                            labelInterpolationFnc: function(value) {
                                                return value[0];
                                            }
                                        }
                                    }]
                                ];

                                new Chartist.Bar('.ct-chart', data, options, responsiveOptions);
                            </script>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Total tamu VIP & VVIP --}}
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 ol-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-default card-view panel-refresh">
                        <h6>Total Tamu VVIP</h6>
                        <hr class="light-grey-hr row mt-10 mb-15" />
                        <div class="label-chatrs col-lg-6">
                            <span class="clabels-text font-12 inline-block txt-dark capitalize-font pull-left">
								<span class="block font-22 weight-500 mb-5">
									<span class="counter-anim">{{ $visitor_vvip_male }}</span>
								</span>
								<span class="block txt-grey">Laki-laki</span>
							</span>
                            <i class="big-rpsn-icon zmdi zmdi-male-alt pull-right txt-success"></i>
                            <div class="clearfix"></div>
                        </div>
                        <div class="label-chatrs">
                            <div class="">
                                <span class="clabels-text font-12 inline-block txt-dark capitalize-font pull-left">
									<span class="block font-22 weight-500 mb-5">
										<span class="counter-anim">{{ $visitor_vvip_female }}</span>
									</span>
									<span class="block txt-grey">Perempuan</span>
								</span>
                                <i class="big-rpsn-icon zmdi zmdi-female pull-right txt-warning"></i>
                                <div class="clearfix"></div>
                                <hr class="light-grey-hr row mt-10 mb-15" />
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Total tamu VIP & VIP --}}
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12
					ol-lg-6 col-md-12 col-sm-12 col-xs-12"">
                    <div class="panel panel-default card-view panel-refresh">
                        <h6>Total Tamu VIP</h6>
                        <hr class="light-grey-hr row mt-10 mb-15" />
                        <div class="label-chatrs col-lg-6">
                            <span class="clabels-text font-12 inline-block txt-dark capitalize-font pull-left">
								<span class="block font-22 weight-500 mb-5">
									<span class="counter-anim">{{ $visitor_vip_male }}</span>
								</span>
								<span class="block txt-grey">Laki-laki</span>
							</span>
                            <i class="big-rpsn-icon zmdi zmdi-male-alt pull-right txt-success"></i>
                            <div class="clearfix"></div>
                        </div>
                        <div class="label-chatrs">
                            <div class="">
                                <span class="clabels-text font-12 inline-block txt-dark capitalize-font pull-left">
									<span class="block font-22 weight-500 mb-5">
										<span class="counter-anim">{{ $visitor_vip_female }}</span>
									</span>
									<span class="block txt-grey">Perempuan</span>
								</span>
                                <i class="big-rpsn-icon zmdi zmdi-female pull-right txt-warning"></i>
                                <div class="clearfix"></div>
                                <hr class="light-grey-hr row mt-10 mb-15" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row Tabel Tamu-->
            <div class="row">
                <div class="col-lg-12 col-md-7 col-sm-12 col-xs-12">
                    <div class="panel panel-default card-view panel-refresh">
                        <div class="refresh-container">
                            <div class="la-anim-1"></div>
                        </div>
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">terakhir tamu berkunjung</h6>
                            </div>
                            <div class="pull-right">
                                <a href="#" class="pull-left inline-block full-screen mr-15">
                                    <i class="zmdi zmdi-fullscreen"></i>
                                </a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body row pa-0">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
											<thead>
												<tr>
													<th>ID</th>
													<th>Nama Tamu</th>
													<th>Tanggal</th>
													<th>Kategori Tamu</th>
													<th>Pukul</th>
												</tr>
											</thead>
											
											<tbody>
												{{-- analisis-tamu --}}
												@foreach ($visitor as $item)
													<tr>
														<td><span class="txt-dark weight-500">#{{ $item->id }}</span></td>
														<td>{{ $item->name }}</td>
														<td><span class="txt-success"><i class="zmdi zmdi-caret-up mr-10 font-20"></i><span>{{ date('d F Y', strtotime($item->created_at)) }}</span></span></td>
														<td>
															@if($item->tipe_member == 'VVIP')
																<span class="label label-success">VVIP</span>
															@else
																<span class="label label-warning">VIP</span>
															@endif
														</td>
														<td>
															{{ date('H:i', strtotime($item->created_at)) }}
														</td>
													</tr>
												@endforeach
											</tbody>
										</table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            @include('Layouts.Footer')
            <!-- /Footer -->
        </div>
    </div>
	<script>
		var vvip_jan = "{{ $january }}";
	</script>
@endsection