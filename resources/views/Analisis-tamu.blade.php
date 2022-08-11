@extends('Layouts.Main')
<!-- Main Content -->
<div class="page-wrapper">
    <div class="container-fluid">
        {{-- <div class="row heading-bg">
            <!-- Breadcrumb -->
            <!-- /Breadcrumb -->
        </div> --}}
        <!-- Row Kalkulasi Tamu-->
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
                                                    class="counter-anim">914,001</span></span>
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
                                                    class="counter-anim">914,001</span></span>
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
                                                    class="counter-anim">914,001</span></span>
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
        <!-- /Row -->
        <!-- Row Statistika Tamu-->
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
                                    <span class="block txt-dark weight-500 font-18"><span
                                            class="counter-anim">3,24,222</span></span>
                                </li>
                                <li>
                                    <span class="block">Tamu Bulanan</span>
                                    <span class="block txt-dark weight-500 font-18"><span
                                            class="counter-anim">1,23,432</span></span>
                                </li>
                                <li>
                                    <span class="block">Total Tamu Berkunjung</span>
                                    <span class="block txt-dark weight-500 font-18"><span
                                            class="counter-anim">1,23,432</span></span>
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
                        <div class="pull-right">
                            <div class="pull-left inline-block dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"
                                    role="button"><i class="zmdi zmdi-more-vert"></i></a>
                                <ul class="dropdown-menu bullet dropdown-menu-right" role="menu">
                                    <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i
                                                class="icon wb-reply" aria-hidden="true"></i>option 1</a></li>
                                    <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i
                                                class="icon wb-share" aria-hidden="true"></i>option 2</a></li>
                                    <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i
                                                class="icon wb-trash" aria-hidden="true"></i>option 3</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div id="ct_chart_5" class="ct-chart ct-perfect-fourth ct-chart-before-pad-zero"
                                style="height:10px; width:5px;"></div>
                            <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%"
                                class="ct-chart-bar" style="width: 100%; height: 350px;">
                                <g class="ct-grids">
                                    <line x1="30" x2="30" y1="15" y2="309"
                                        class="ct-grid ct-horizontal"></line>
                                    <line x1="112.6656265258789" x2="112.6656265258789" y1="15"
                                        y2="309" class="ct-grid ct-horizontal"></line>
                                    <line x1="195.3312530517578" x2="195.3312530517578" y1="15"
                                        y2="309" class="ct-grid ct-horizontal"></line>
                                    <line x1="277.9968795776367" x2="277.9968795776367" y1="15"
                                        y2="309" class="ct-grid ct-horizontal"></line>
                                    <line y1="309" y2="309" x1="30" x2="360.6625061035156"
                                        class="ct-grid ct-vertical"></line>
                                    <line y1="272.25" y2="272.25" x1="30" x2="360.6625061035156"
                                        class="ct-grid ct-vertical"></line>
                                    <line y1="235.5" y2="235.5" x1="30" x2="360.6625061035156"
                                        class="ct-grid ct-vertical"></line>
                                    <line y1="198.75" y2="198.75" x1="30" x2="360.6625061035156"
                                        class="ct-grid ct-vertical"></line>
                                    <line y1="162" y2="162" x1="30" x2="360.6625061035156"
                                        class="ct-grid ct-vertical"></line>
                                    <line y1="125.25" y2="125.25" x1="30" x2="360.6625061035156"
                                        class="ct-grid ct-vertical"></line>
                                    <line y1="88.5" y2="88.5" x1="30" x2="360.6625061035156"
                                        class="ct-grid ct-vertical"></line>
                                    <line y1="51.75" y2="51.75" x1="30" x2="360.6625061035156"
                                        class="ct-grid ct-vertical"></line>
                                    <line y1="15" y2="15" x1="30" x2="360.6625061035156"
                                        class="ct-grid ct-vertical"></line>
                                </g>
                                <g>
                                    <g class="ct-series ct-series-a">
                                        <line x1="56.33281326293945" x2="56.33281326293945" y1="309"
                                            y2="88.5" class="ct-bar" ct:value="600"></line>
                                        <line x1="138.99843978881836" x2="138.99843978881836" y1="309"
                                            y2="162" class="ct-bar" ct:value="400"></line>
                                        <line x1="221.66406631469727" x2="221.66406631469727" y1="309"
                                            y2="15" class="ct-bar" ct:value="800"></line>
                                        <line x1="304.3296928405762" x2="304.3296928405762" y1="309"
                                            y2="51.75" class="ct-bar" ct:value="700"></line>
                                    </g>
                                    <g class="ct-series ct-series-b">
                                        <line x1="71.33281326293945" x2="71.33281326293945" y1="309"
                                            y2="162" class="ct-bar" ct:value="400"></line>
                                        <line x1="153.99843978881836" x2="153.99843978881836" y1="309"
                                            y2="198.75" class="ct-bar" ct:value="300"></line>
                                        <line x1="236.66406631469727" x2="236.66406631469727" y1="309"
                                            y2="51.75" class="ct-bar" ct:value="700"></line>
                                        <line x1="319.3296928405762" x2="319.3296928405762" y1="309"
                                            y2="88.5" class="ct-bar" ct:value="600"></line>
                                    </g>
                                    <g class="ct-series ct-series-c">
                                        <line x1="86.33281326293945" x2="86.33281326293945" y1="309"
                                            y2="15" class="ct-bar" ct:value="800"></line>
                                        <line x1="168.99843978881836" x2="168.99843978881836" y1="309"
                                            y2="198.75" class="ct-bar" ct:value="300"></line>
                                        <line x1="251.66406631469727" x2="251.66406631469727" y1="309"
                                            y2="272.25" class="ct-bar" ct:value="100"></line>
                                        <line x1="334.3296928405762" x2="334.3296928405762" y1="309"
                                            y2="77.475" class="ct-bar" ct:value="630"></line>
                                    </g>
                                </g>
                                <g class="ct-labels">
                                    <foreignObject style="overflow: visible;" x="30" y="314"
                                        width="82.6656265258789" height="10"><span
                                            class="ct-label ct-horizontal ct-end" style="width: 83px; height: 10px"
                                            xmlns="http://www.w3.org/2000/xmlns/">Senin</span></foreignObject>
                                    <foreignObject style="overflow: visible;" x="112.6656265258789" y="314"
                                        width="82.6656265258789" height="10"><span
                                            class="ct-label ct-horizontal ct-end" style="width: 83px; height: 10px"
                                            xmlns="http://www.w3.org/2000/xmlns/">Selasa</span></foreignObject>
                                    <foreignObject style="overflow: visible;" x="195.3312530517578" y="314"
                                        width="82.6656265258789" height="10"><span
                                            class="ct-label ct-horizontal ct-end" style="width: 83px; height: 10px"
                                            xmlns="http://www.w3.org/2000/xmlns/">Rabu</span></foreignObject>
                                    <foreignObject style="overflow: visible;" x="277.9968795776367" y="314"
                                        width="82.6656265258789" height="10"><span
                                            class="ct-label ct-horizontal ct-end" style="width: 83px; height: 10px"
                                            xmlns="http://www.w3.org/2000/xmlns/">Kamis</span></foreignObject>

                                </g>
                            </svg>
                            <div class="label-chatrs">
                                <div class="inline-block mr-15">
                                    <span class="clabels inline-block bg-yellow mr-5"></span>
                                    <span
                                        class="clabels-text font-12 inline-block txt-dark capitalize-font">Laki-laki</span>
                                </div>
                                <div class="inline-block mr-15">
                                    <span class="clabels inline-block bg-green mr-5"></span>
                                    <span
                                        class="clabels-text font-12 inline-block txt-dark capitalize-font">Perempuan</span>
                                </div>
                                <div class="inline-block">
                                    <span class="clabels inline-block bg-blue mr-5"></span>
                                    <span
                                        class="clabels-text font-12 inline-block txt-dark capitalize-font">Unknown</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /Row -->

        {{-- Total tamu VIP & VVIP --}}
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12
			ol-lg-6 col-md-12 col-sm-12 col-xs-12"">
                <div class="panel panel-default card-view panel-refresh">
                    <h6>Total Tamu VVIP</h6>
                    <hr class="light-grey-hr row mt-10 mb-15" />
                    <div class="label-chatrs col-lg-6">
                        {{-- <span class="clabels clabels-lg inline-block bg-green mr-10 pull-left"></span> --}}
                        <span class="clabels-text font-12 inline-block txt-dark capitalize-font pull-left"><span
                                class="block font-22 weight-500 mb-5"><span
                                    class="counter-anim">112</span></span><span
                                class="block txt-grey">Laki-laki</span></span>
                        <i class="big-rpsn-icon zmdi zmdi-male-alt pull-right txt-success"></i>
                        <div class="clearfix"></div>
                    </div>
                    <div class="label-chatrs">
                        <div class="">
                            {{-- <span class="clabels clabels-lg inline-block bg-yellow mr-10 pull-left"></span> --}}
                            <span class="clabels-text font-12 inline-block txt-dark capitalize-font pull-left"><span
                                    class="block font-22 weight-500 mb-5"><span
                                        class="counter-anim">70</span></span><span
                                    class="block txt-grey">Perempuan</span></span>
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
                        {{-- <span class="clabels clabels-lg inline-block bg-green mr-10 pull-left"></span> --}}
                        <span class="clabels-text font-12 inline-block txt-dark capitalize-font pull-left"><span
                                class="block font-22 weight-500 mb-5"><span
                                    class="counter-anim">112</span></span><span
                                class="block txt-grey">Laki-laki</span></span>
                        <i class="big-rpsn-icon zmdi zmdi-male-alt pull-right txt-success"></i>
                        <div class="clearfix"></div>
                    </div>
                    <div class="label-chatrs">
                        <div class="">
                            {{-- <span class="clabels clabels-lg inline-block bg-yellow mr-10 pull-left"></span> --}}
                            <span class="clabels-text font-12 inline-block txt-dark capitalize-font pull-left"><span
                                    class="block font-22 weight-500 mb-5"><span
                                        class="counter-anim">70</span></span><span
                                    class="block txt-grey">Perempuan</span></span>
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
                            <div class="pull-left inline-block dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#"
                                    aria-expanded="false" role="button"><i class="zmdi zmdi-more-vert"></i></a>
                                <ul class="dropdown-menu bullet dropdown-menu-right" role="menu">
                                    <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i
                                                class="icon wb-reply" aria-hidden="true"></i>Edit</a></li>
                                    <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i
                                                class="icon wb-share" aria-hidden="true"></i>Delete</a></li>
                                    <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i
                                                class="icon wb-trash" aria-hidden="true"></i>New</a></li>
                                </ul>
                            </div>
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
                                            <tr>
                                                <td><span class="txt-dark weight-500">#13324</span></td>
                                                <td>Yudistira Ramadan Kalimasada</td>
                                                <td>15 Januari 2022</td>
                                                <td>
                                                    <span class="label label-warning">VVIP</span>
                                                </td>
                                                <td>11.32 WIB</td>
                                            </tr>
                                            <tr>
                                                <td><span class="txt-dark weight-500">#13324</span></td>
                                                <td>Dhiyaudin Adha Suhadi</td>
                                                <td>15 Januari 2022</td>
                                                <td>
                                                    <span class="label label-success">VIP</span>
                                                </td>
                                                <td>11.32 WIB</td>
                                            </tr>
                                            <tr>
                                                <td><span class="txt-dark weight-500">#13324</span></td>
                                                <td>Imas Nurdianto</td>
                                                <td>15 Januari 2022</td>
                                                <td>
                                                    <span class="label label-warning">VVIP</span>
                                                </td>
                                                <td>11.32 WIB</td>
                                            </tr>
                                            <tr>
                                                <td><span class="txt-dark weight-500">#13324</span></td>
                                                <td>Dhana anahd</td>
                                                <td>15 Januari 2022</td>
                                                <td>
                                                    <span class="label label-success">VIP</span>
                                                </td>
                                                <td>11.32 WIB</td>
                                            </tr>
                                            <tr>
                                                <td><span class="txt-dark weight-500">#13324</span></td>
                                                <td>Kevin Anggara</td>
                                                <td>15 Januari 2022</td>
                                                <td>
                                                    <span class="label label-warning">VVIP</span>
                                                </td>
                                                <td>11.32 WIB</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row -->
        @include('Layouts.Footer')
    </div>
</div>
<!-- /Main Content -->
