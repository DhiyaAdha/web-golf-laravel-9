@extends('Layouts.Main', ['title' => 'TGCC | Daftar Tamu'])
@include('sweetalert::alert')

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row heading-bg">
            <div class="row">
                <div class="container-kartu">
                    <div class="col-lg-8">
                        <h5>Lihat Kartu</h5>
                    </div>
                    <div class="col-lg-4 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="active"><span>Daftar-Tamu</span></li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="panel-hading">
                        <div class="panel-hading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Kartu Tamu</h6>
                            </div>
                            <div class="pull-right">
                                <span class="no-margin-switcher">
                                    <a href="http://"><i class="fa-solid fa-address-card"></i></a>
                                </span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="morris_extra_line_chart" class="morris-chart" style="height:293px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-default card-view">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body sm-data-box-1">
                                <span class="uppercase-font weight-500 font-14 block text-center txt-dark">Sisa Limit Bermain</span>
                                <span class="uppercase-font weight-500 font-14 block text-center txt-dark">Gratis</span>
                                <div class="cus-sat-stat weight-500 txt-success text-center mt-5">
                                    <img src="/dist/img/Golf.svg" alt="" style="display: block;  margin-left: auto; margin-right: auto;  width: 50px;">
                                </div>
                                <h2 class="angka" style="text-align: center; font-size:16px;">4</h2>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default card-view">
                        <div class="panel-heding">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Sisa Deposit</h6>
                            </div>
                            <div class="pull-right">
                            </div>
                            <div class="clearfix"></div>
                            <img src="/dist/img/money.svg" alt="" style="display: block;  margin-left: auto; margin-right: auto;  width: 50px;">
                            <h2 class="angka" style="text-align: center; font-size:16px;">IDR 3.500.000</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="panel-left">
                        <div class="refresh-container">
                            <div class="la-anim-1"></div>
                        </div>
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Barcode Untuk diScan</h6>
                                <h6 class="panel-title txt-dark">Setiap Main</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div>
                                    <img src="/dist/img/qr.png" alt="" style="display: block;  margin-left: auto; margin-right: auto;  width: 200px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('Layouts.Footer')
        </div>
    </div>
</div>