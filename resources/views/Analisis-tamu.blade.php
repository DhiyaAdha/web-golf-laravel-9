@extends('Layouts.Main', ['title' => 'TGCC | Analisis Tamu'])
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid pt-25">
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
                                <select name="period"
                                    class="pl-10 text-base sm:text-sm mt-1 form-select block w-full text-gray-500 focus:bg-gray-100">
                                    <option value="">{{ __('Pilih Tahun') }}</option>
                                    @foreach (\Carbon\CarbonPeriod::create(now(), '1 year', now()->addYears(3)) as $date)
                                        <option value="{{ $date->format('Y') }}"
                                            {{ $date->format('Y') == request()->query('period') ? 'selected' : '' }}>
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
                                <ul class="flex-stat mt-45" style="display: flex">
                                    <li>
                                        <span class="block"></span>
                                        <span class="block txt-dark weight-500 font-18">
                                            <span class="">
                                            </span>
                                    </li>
                                    {{-- statistik pertahun --}}
                                    <li>
                                        <span class="block">Statistika Pertahun</span>
                                        <span class="block txt-dark weight-500 font-18"><span
                                                {{-- class="counter-anim">{{ $visitor_year }}</span></span> --}}
                                                class="counter-anim">{{ $visitor_year }}</span></span>
                                    </li>
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
                                <ul class="flex-stat mt-1" style="display: flex">
                                    <li>
                                        <span class="block"></span>
                                        <span class="block txt-dark weight-500 font-18">
                                            <span class="">
                                            </span>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="block">Statistika Mingguan</span>
                                        <span class="block txt-dark weight-500 font-18">
                                            {{-- <span class="">{{ $visitor_week }}</span> --}}
                                        </span>
                                    </li>
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
                <div class="col-lg-12">
                    <div class="panel panel-default card-view">
                        <div class="clearfix"></div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table mb-0" id="dt-analisis">
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
        @include('Layouts.Footer')
        <!-- /Footer -->
    </div>
    </div>
    <script>
        // fungsi grafik-line & Grafik-bar
        var dataMingguan = {!! json_encode($visitor_daily) !!}
        console.log(dataMingguan);
        var dataNewVisitor = {!! json_encode($visitor) !!}
        console.log(dataNewVisitor);
    </script>
@endsection
