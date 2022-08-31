@extends('Layouts.Main', ['title' => 'TGCC | Daftar Tamu'])
@section('content')
<div class="page-wrapper">
    @include('sweetalert::alert')
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
                    <div class="row">
                        <div class="panel panel-default card-tamu">
                            <div class="panel-heding">
                                <div class="pull-left">
                                    <h2 style="font-size: 16px;">Kartu Tamu</h2>
                                </div>
                                <div class="pull-right">
                                    <span class="no-margin-switcher">
                                        <a href="/dist/img/kartu-tamu.png"><i class="fa-solid fa-address-card"></i></a>
                                    </span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div class="tabel">
                                        <h5 class="data">Nama Lengkap</h5>
                                        <p class="isi">Pamungkas Nuli Ramadhan</p>
                                        <h5 class="data">Email</h5>
                                        <p class="isi">PamungkasNuli@gmail.com</p>
                                        <h5 class="data">Nomer Hp</h5>
                                        <p class="isi">0845545526386</p>
                                        <h5 class="data">Jenis Kelamin</h5>
                                        <p class="isi">Laki Laki</p>
                                        <h5 class="data">Kategori Tamu</h5>
                                        <p class="isi">VVIP</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" style="padding: -5px 10px 1px 30px;">
                    <div class="panel panel-default card-tamu">
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
                    <div class="panel panel-default card-tamu">
                        <div class="panel-heding">
                            <div class="pull">
                                <h6 class="panel-title txt-dark" style="text-align: center;">Sisa Deposit</h6>
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
                    <div class="panel panel-default card-qr">
                        <div class="refresh-container">
                            <div class="la-anim-1"></div>
                        </div>
                        <div class="panel-hiding">
                            <div class="pull">
                                <h6 class="panel-title txt-dark" style="text-align: center;">Barcode Untuk diScan</h6>
                                <h6 class="panel-title txt-dark" style="text-align: center;">Setiap Main</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in" style="margin: 93px 10px;">
                            <div class="panel-body">
                                <div>
                                    <img src="/dist/img/qr.png" alt="" style="display: block;  margin-left: auto; margin-right: auto; ">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Aktifitas</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <p class="text-muted">Default version of tab add only <code>pills-struct</code> class and add <code>nav-pills</code> class with nav class.</p>
                        <div class="pills-struct mt-40">
                            <ul role="tablist" class="nav nav-pills" id="myTabs_6">
                                <li class="active" role="presentation"><a aria-expanded="true" data-toggle="tab" role="tab" id="home_tab_6" href="#home_6">active</a></li>
                                <li role="presentation" class=""><a data-toggle="tab" id="profile_tab_6" role="tab" href="#profile_6" aria-expanded="false">inactive</a></li>
                            </ul>
                            <div class="tab-content" id="myTabContent_6">
                                <div id="home_6" class="tab-pane fade active in" role="tabpanel">
                                    <p>Lorem ipsum dolor sit amet, et pertinax ocurreret scribentur sit, eum euripidis assentior ei. In qui quodsi maiorum, dicta clita duo ut. Fugit sonet quo te. Ad vel quando causae signiferumque. Aperiam luptatum senserit eu vis, eu ius purto torquatos vituperatoribus.An nec fastidii eligendi molestiae.</p>
                                </div>
                                <div id="profile_6" class="tab-pane fade" role="tabpanel">
                                    <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee.</p>
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
</div>
<div class="clearfix"></div>
<div class="col-lg-12">
    @include('Layouts.Footer')
</div>
@endsection