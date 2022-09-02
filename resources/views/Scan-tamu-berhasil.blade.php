@extends('Layouts.Main')

@section('content')
    {{-- Script --}}
    {{-- <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script> --}}
    {{-- Script --}}

    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row heading-bg">
                <!-- Breadcrumb -->
                {{-- @include('Layouts.Breadcrumb') --}}
                <div class="row">
                    <div class="container-fluid">
                        <div class="col-lg-8">
                            <h5>Scan Tamu</h5>
                        </div>
                        <div class="col-lg-4 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="javascript:void(0)">Dashboard</a></li>
                                <li class="active"><span>scan tamu</span></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /Breadcrumb -->
            </div>
            <div class="row">
                <div class="col-lg-8" style="position: relative;">
                    <div style="height: 600px" class="panel panel-default card-view">
                        <h5>Data Pengunjung</h6>
                            <div class="row">
                                <table class="table">
                                    <tr>
                                        <td>ID Tamu</td>
                                        <td>A09283</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Lengkap</td>
                                        <td>Yudistira Ramadan Kalimasada</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>Jl. Sulawesi Perum Puri Tanjung Intan B-2 Gunung Simping</td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td>Pria</td>
                                    </tr>
                                    <tr>
                                        <td>No Hp</td>
                                        <td>085228409840</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>yudistirainovis36@gmail.com</td>
                                    </tr>
                                    <tr>
                                        <td>Perusahaan</td>
                                        <td>PT Inovis Berkah</td>
                                    </tr>
                                    <tr>
                                        <td>Jabatan</td>
                                        <td>CEO</td>
                                    </tr>
                                    <tr>
                                        <td>Kategori Tamu</td>
                                        <td>VVIP</td>
                                    </tr>

                                </table>
                            </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div style="height: 600px" class="panel panel-default card-view">
                        <h6>Sisa Limit dan Deposit Yudistira</h6>
                        <div class="box-deposit">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p class="ml-30 mt-10">Deposit</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-2 col-sm-2" style="text-align: left;">
                                    <h4 class="ml-30" style="color: white;">Rp.</h4>
                                </div>
                                <div class="col-lg-6 col-md-2 col-sm-2" style="text-align: right;">
                                    <h4 class="mr-30" style="color: white;">12.000.000</h4>
                                </div>
                            </div>
                        </div>

                        {{-- Coba rev tpi gajadi --}}
                        {{-- <div class="box-deposit-rev">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p>Deposit</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-2 col-sm-2" style="text-align: left;">
                                    <h4 class="ml-30" style="color: white;">Rp.</h4>
                                </div>
                                <div class="col-lg-6 col-md-2 col-sm-2" style="text-align: right;">
                                    <h4 class="mr-30" style="color: white;">12.000.000</h4>
                                </div>
                            </div>
                        </div> --}}

                        {{-- <div class="box-limit-kupon">
                            <div class="row">
                                <p class="ml-30 mt-10">Limit Kupon</p>
                            </div>
                        </div> --}}


                        <div class="col-lg-6">
                            <div class="box-limit-kupon-rev">
                                <p>Limit Kupon</p>
                                <h4 style="color: white">0</h4>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="box-limit-bulanan-rev">
                                <p>Limit Bulanan</p>
                                <h4 style="color: white">2</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 mt-10">
                                <div class="btn-deposit">
                                    <a href="#">
                                        <h6 style="color: #01c853;">Deposit</h6>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mt-10">
                                <div class="btn-proses">
                                    <a href="/proses">
                                        <h6 style="color: #ffffff;">Proses</h6>
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col-lg-6">
                            <div class="box-limit-kupon">
                                <div class="box-1">
                                    <p class="">Limit Kupon</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="box-limit-bulanan">
                                <div class="box-2">
                                    <p class="ml-20 mt-10">Limit Bulanan</p>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
