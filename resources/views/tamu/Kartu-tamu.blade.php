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
                                    <a href="https://tse4.mm.bing.net/th?id=OIP.3S7-hQjSnc_alBueJd370AHaEu&pid=Api&P=0"><i class="fa-solid fa-address-card"></i></a>
                                </span>
                            </div>
                            <div class="clearfix"></div>
                            <div>
                                <p class="judul">Nama Lengkap</p>
                                <h6 class="title">{{ $visitor->name }}</h6>
                                <p class="judul">Email</p>
                                <h6 class="title">{{ $visitor->email }}</h6>
                                <p class="judul">Nomer Hp</p>
                                <h6 class="title">{{ $visitor->phone }}</h6>
                                <p class="judul">Jenis Kelamin</p>
                                <h6 class="title">{{ $visitor->gender }}</h6>
                                <p class="judul">Kategori Tamu</p>
                                <h6 class="title">{{ $visitor->tipe_member }}</h6>
                            </div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="morris_extra_line_chart" class="morris-chart" style="height: 30px;"></div>
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
                    <div class="panel-left">
                        <div class="refresh-container">
                            <div class="la-anim-1"></div>
                        </div>
                        <div class="panel-heading">
                            <div class="pull">
                                <h6 class="panel-title txt-dark" style="text-align: center;">Barcode Untuk diScan</h6>
                                <h6 class="panel-title txt-dark" style="text-align: center;">Setiap Main</h6>
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
            <div class="cret-btn">
                <div class="title-baru">
                    <div>
                        <p class="judul-btn">Aktifitas</p>
                    </div>
                </div>
                <div class="btn-clik">
                    <button id="btn1">Transaksi</button>
                    <button id="btn2">Deposit</button>
                    <button id="btn3">Limit</button>
                </div>
                <div>
                    <div class="row" style="padding: 5px 0px">
                        <div class="col-sm-12">
                            <div class="panel panel-default card-view">
                                <div class="panel-heding">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <h6>Riwayat Transaksi</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-wrapper collapse in">
                                    <div class="panel-bodi">
                                        <div class="table-wrap mt-40">
                                            <div class="table-responsive">
                                                <table class="table mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center;">Order ID</th>
                                                            <th>Informasi</th>
                                                            <th style="text-align: center;">Status</th>
                                                            <th style="text-align: center;">Tanggal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td style="text-align: center;"><span class="label" style="color: #000000; font-size: 14px;">#10021</span></td>
                                                            <td>Transaksi berhasil ! Arya GP telah melakukan pembayaran sebesar Rp.1.500.000,00</td>
                                                            <td style="text-align: center;">
                                                                <span class="label label-Berhasil">Berhasil</span>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <p>12 Jan 2022</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: center;"><span class="label" style="color: #000000; font-size: 14px;">#10021</span></td>
                                                            <td>Transaksi berhasil ! Arya GP telah melakukan pembayaran menggunakan Limit Gratis.</td>
                                                            <td style="text-align: center;">
                                                                <span class="label label-Berhasil">Berhasil</span>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <p>12 Jan 2022</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: center;"><span class="label" style="color: #000000; font-size: 14px;">#10021</span></td>
                                                            <td>Transaksi dibatalkan ! Arya GP telah membatalkan transaksi Limit Gratis.</td>
                                                            <td style="text-align: center;">
                                                                <span class="label label-Batal">Batal</span>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <p>12 Jan 2022</p>
                                                            </td>
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
                </div>
                <div>
                    <div class="row" style="padding: 5px 0px">
                        <div class="col-sm-12">
                            <div class="panel panel-default card-view">
                                <div class="panel-heding">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <h6>Riwayat Deposit</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-wrapper collapse in">
                                    <div class="panel-bodi">
                                        <div class="table-wrap mt-40">
                                            <div class="table-responsive">
                                                <table class="table mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center;">Balence</th>
                                                            <th></th>
                                                            <th>Informasi</th>
                                                            <th style="text-align: center;">Jenis Pembayaran</th>
                                                            <th style="text-align: center;">Tanggal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td style="text-align: center;"><span class="label" style="color: #000000; font-size: 14px;">Rp</span></td>
                                                            <td style="text-align: center;"><span class="label" style="color: #000000; font-size: 14px;">500.000</span></td>
                                                            <td>Transaksi berhasil ! Arya GP telah melakukan pembayaran sebesar Rp.1.500.000,00</td>
                                                            <td style="text-align: center;">
                                                                <span class="label label-B" style="color: #000000; font-size: 14px;">Tranfer</span>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <p>12 Jan 2022</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: center;"><span class="label" style="color: #000000; font-size: 14px;">Rp</span></td>
                                                            <td style="text-align: center;"><span class="label" style="color: #000000; font-size: 14px;">500.000</span></td>
                                                            <td>Transaksi berhasil ! Arya GP telah melakukan pembayaran menggunakan Limit Gratis.</td>
                                                            <td style="text-align: center;">
                                                                <span class="label label-B" style="color: #000000; font-size: 14px;">Tunai</span>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <p>12 Jan 2022</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: center;"><span class="label" style="color: #000000; font-size: 14px;">Rp</span></td>
                                                            <td style="text-align: center;"><span class="label" style="color: #000000; font-size: 14px;">500.000</span></td>
                                                            <td>Transaksi dibatalkan ! Arya GP telah membatalkan transaksi Limit Gratis.</td>
                                                            <td style="text-align: center;">
                                                                <span class="label label-B" style="color: #000000; font-size: 14px;">tranfer</span>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <p>12 Jan 2022</p>
                                                            </td>
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
                    <div class="row" style="padding: 5px 0px">
                        <div class="col-sm-12">
                            <div class="panel panel-default card-view">
                                <div class="panel-heding">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <h6>Riwayat Limit</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-wrapper collapse in">
                                    <div class="panel-bodi">
                                        <div class="table-wrap mt-40">
                                            <div class="table-responsive">
                                                <table class="table mb-0">
                                                    <thead>
                                                        <tr>
                                                        <th>Informasi</th>
                                                            <th style="text-align: center;">Tipe</th>
                                                            <th style="text-align: center;">Tanggal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Transaksi berhasil ! Arya GP telah melakukan pembayaran sebesar Rp.1.500.000,00</td>
                                                            <td style="text-align: center;">
                                                                <span class="label label-B" style="color: #000000; font-size: 14px;">Reset</span>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <p>12 Jan 2022</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Transaksi berhasil ! Arya GP telah melakukan pembayaran menggunakan Limit Gratis.</td>
                                                            <td style="text-align: center;">
                                                                <span class="label label-B" style="color: #000000; font-size: 14px;">Berkurang</span>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <p>12 Jan 2022</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Transaksi dibatalkan ! Arya GP telah membatalkan transaksi Limit Gratis.</td>
                                                            <td style="text-align: center;">
                                                                <span class="label label-B" style="color: #000000; font-size: 14px;">Reset</span>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <p>12 Jan 2022</p>
                                                            </td>
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
                </div>
            </div>
            @include('Layouts.Footer')
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $("#btn1").click(function() {
                document.getElementById("transaksi").style.display = "none";
            })
            $('#btn2').click(function() {
                $('#transaksi').fadeOut();
            })


        });
    </script>