@extends('Layouts.Main', ['title' => 'TGCC | Analisis Tamu'])
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row heading-bg">
                <!-- Breadcrumb -->
                <div class="row">
                    <div class="container-fluid">
                        <div class="col-lg-8">
                            <h5>Analisis Tamu</h5>
                        </div>
                        <div class="col-lg-4 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="javascript:void(0)">Dashboard</a></li>
                                <li class="active"><span>analisis tamu</span></li>
                            </ol>
                        </div>
                    </div>
                </div>
                
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
                                                <span class="txt-light block counter"><span
                                                        class="counter-anim">{{ $visitor_today }}</span></span>
                                                <span class="weight-500 uppercase-font txt-light block font-13">Jumlah tamu
                                                    hari ini</span>
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
                                                <span class="txt-light block counter"><span
                                                        class="counter-anim">{{ $visitor_vvip }}</span></span>
                                                <span class="weight-500 uppercase-font txt-light block font-13">Total tamu
                                                    VVIP</span>
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
                                                <span class="txt-light block counter"><span
                                                        class="counter-anim">{{ $visitor_vip }}</span></span>
                                                <span class="weight-500 uppercase-font txt-light block font-13">Total tamu
                                                    VIP</span>
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
                                <select name="period" class="pl-10 text-base sm:text-sm mt-1 form-select block w-full text-gray-500 focus:bg-gray-100">
                                    <option value="">{{ __('Pilih Tahun') }}</option>
                                    @foreach(\Carbon\CarbonPeriod::create(now(), '1 year', now()->addYears(3)) as $date)
                                        <option value="{{ $date->format('Y') }}" {{ $date->format('Y') == request()->query('period') ? 'selected' : '' }}>
                                            {{ $date->format('Y') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="morris_extra_line_chart" class="morris-chart" style="height:293px;"></div>
                                <ul class="flex-stat mt-40">
                                    <li>
                                        <span class="block"></span>
                                        <span class="block txt-dark weight-500 font-18">
                                            <span
                                                class="">
                                            </span>
                                        </span>
                                    </li>
                                    <li>
                                        {{-- <span class="block">Total Tamu Berkunjung</span> --}}
                                        <span class="block">Statistika Pertahun</span>
                                        <span class="block txt-dark weight-500 font-18"><span
                                                class="counter-anim">{{ $visitor_year }}</span></span>
                                    </li>
                                    {{-- <li>
                                        <span class="block">Tamu Bulanan ini</span>
                                        <span class="block txt-dark weight-500 font-18"><span
                                                class="counter-anim">{{ $visitor_month }}</span></span>
                                    </li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Chart Rekap Harian --}}
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-default card-view panel-refresh relative">
                        <div class="refresh-container">
                            <div class="la-anim-1"></div>
                        </div>
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Rekap Harian</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="morris_extra_bar_chart" class="morris-chart" style="height:340px;"></div>
                                <ul class="flex-stat mt-40">

                                </ul>
                            </div>
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
					ol-lg-6 col-md-12 col-sm-12 col-xs-12">
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
														{{-- <td><span class="txt-dark weight-500">#{{ $item->id }}</span></td> --}}
														<td>{{ $item->name }}</td>
														<td><span class="txt-success"><i class="zmdi zmdi-caret-up mr-10 font-20"></i><span>{{ date('d F Y', strtotime($item->created_at)) }}</span></span></td>
														<td>
															@if($item->tipe_member == 'VVIP')
																<span class="label label-warning">VVIP</span>
															@else
																<span class="label label-success">VIP</span>
															@endif
														</td>
														<td>
															{{ date('H:i', strtotime($item->created_at)) }} WIB
														</td>
													</tr>
												@endforeach
											</tbody>
										</table>
                                        {{ $visitor->links() }}
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
			
            var vvip_jan = <?php print $Jan_vvip; ?>;
            var vip_jan = <?php print $Jan_vip; ?>;
            var vvip_feb = <?php print $Feb_vvip; ?>;
            var vip_feb = <?php print $Feb_vip; ?>;
            var vvip_mar = <?php print $Mar_vvip; ?>;
            var vip_mar = <?php print $Mar_vip; ?>;
            var vvip_apr = <?php print $Apr_vvip; ?>;
            var vip_apr = <?php print $Apr_vip; ?>;
            var vvip_mei = <?php print $Mei_vvip; ?>;
            var vip_mei = <?php print $Mei_vip; ?>;
            var vvip_jun = <?php print $Jun_vvip; ?>;
            var vip_jun = <?php print $Jun_vip; ?>;
            var vvip_jul = <?php print $Jul_vvip; ?>;
            var vip_jul = <?php print $Jul_vip; ?>;
            var vvip_aug = <?php print $Aug_vvip; ?>;
            var vip_aug = <?php print $Aug_vip; ?>;
            var vvip_sep = <?php print $Sep_vvip; ?>;
            var vip_sep = <?php print $Sep_vip; ?>;
            var vvip_oct = <?php print $Oct_vvip; ?>;
            var vip_oct = <?php print $Oct_vip; ?>;
            var vvip_nov = <?php print $Nov_vvip; ?>;
            var vip_nov = <?php print $Nov_vip; ?>;
            var vvip_dec = <?php print $Dec_vvip; ?>;
            var vip_dec = <?php print $Dec_vip; ?>;


            var vvip_min = <?php print $vvip_min; ?>;
            var vip_min = <?php print $vip_min; ?>;
            var vvip_sen = <?php print $vvip_sen; ?>;
            var vip_sen = <?php print $vip_sen; ?>;
            var vvip_sel = <?php print $vvip_sel; ?>;
            var vip_sel = <?php print $vip_sel; ?>;
            var vvip_rab = <?php print $vvip_rab; ?>;
            var vip_rab = <?php print $vip_rab; ?>;
            var vvip_kam = <?php print $vvip_kam; ?>;
            var vip_kam = <?php print $vip_kam; ?>;
            var vvip_jum = <?php print $vvip_jum; ?>;
            var vip_jum = <?php print $vip_jum; ?>;
            var vvip_sa = <?php print $vvip_sa; ?>;
            var vip_sa = <?php print $vip_sa; ?>;
        </script>


@endsection
