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
                <div class="col-lg-6 mt-20">
                    <div class="panel panel-default panel-dropdown card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Kartu Tamu</h6>
                            </div>
                            <div class="pull-right">
                                <div class="dropdown  pull-left">
                                    <a class="dropdown-toggle weight-500" id="examplePanelDropdown" data-toggle="dropdown" href="#" aria-expanded="false" role="button">
                                        <a href="/dist/img/kartu-tamu.png"><i class="fa-solid fa-address-card"></i></a>
                                    </a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="user-others-details">
                                    <div class="mb-15 d-flex flex-column">
                                        <span class="txt-muted">Nama Lengkap</span>
                                        <span>{{ $visitor->name }}</span>
                                    </div>
                                    <div class="mb-15 d-flex flex-column">
                                        <span class="txt-muted">Email</span>
                                        <span>{{ $visitor->email }}</span>
                                    </div>
                                    <div class="mb-15 d-flex flex-column">
                                        <span class="txt-muted">No Hp</span>
                                        <span>{{ $visitor->phone }}</span>
                                    </div>
                                    <div class="mb-15 d-flex flex-column">
                                        <span class="txt-muted">Jenis Kelamin</span>
                                        <span>{{ $visitor->gender }}</span>
                                    </div>
                                    <div class="mb-15 d-flex flex-column">
                                        <span class="txt-muted">Kategori Tamu</span>
                                        <span>{{ $visitor->tipe_member }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mt-20">
                    <div class="panel panel-default panel-dropdown card-view">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body limit" style="padding: 5px 0 2px;">
                                <div class="panel-wrapper collapse in">
                                    <div class="panel-body sm-data-box" style="padding: 5px 0 10px;">
                                        <span class="uppercase-font weight-200 font-14 block text-center txt-dark">Sisa Limit Bermain</span>
                                        <span class="uppercase-font weight-500 font-14 block text-center txt-dark">Gratis</span>
                                        <div class="cus-sat-stat weight-200 txt-success text-center mt-5">
                                            <img src="/dist/img/Golf.svg" alt="" style="display: block;  margin-left: auto; margin-right: auto;  width: 50px;">
                                        </div>
                                        <h2 class="angka" style="text-align: center; font-size:16px;">4</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default panel-dropdown card-view">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body deposit" style="padding: 5px 0 3px;">
                                <div class="panel panel-default card-tamu">
                                    <div class="panel-heding">
                                        <div class="pull">
                                            <h6 class="panel-title txt-dark" style="text-align: ;">Sisa Deposit</h6>
                                        </div>
                                        <div class="pull-right">
                                        </div>
                                        <div class="clearfix"></div>
                                        <img src="/dist/img/money.svg" alt="" style="display: block;  margin-left: 20px; margin-right: auto;  width: 50px;">
                                        <h2 class="angka" style="text-align:; font-size:16px;">IDR 3.500.000</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mt-20">
                    <div class="panel panel-default panel-dropdown card-view">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body qr" style="padding: 5px 5px 203px;">
                                <div class="pull">
                                    <h6 class="panel-title txt-dark" style="text-align: center;">Barcode Untuk diScan</h6>
                                    <h6 class="panel-title txt-dark" style="text-align: center;">Setiap Main</h6>
                                </div>
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
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div>
                <div class="panel-heading" style="padding-left: 28px;">
                    <div class="pull-left mt-20">
                        <h6 class="panel-title txt-dark">Aktifitas</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="pills-struct mt-15">
                        <ul role="tablist" class="nav nav-pills" id="myTabs_6" style="padding-left: 28px;">
                            <li class="active" role="presentation"><a aria-expanded="true" data-toggle="tab" role="tab" id="home_tab_6" href="#home_6" style="border: #A0A0A0 0.1rem solid;">Transaksi</a></li>
                            <li role="presentation" class=""><a data-toggle="tab" id="profile_tab_6" role="tab" href="#profile_6" aria-expanded="false" style="border: #A0A0A0 0.1rem solid;">Deposit</a></li>
                            <li role="presentation" class=""><a data-toggle="tab" id="profile_tab_6" role="tab" href="#profile_7" aria-expanded="false" style="border: #A0A0A0 0.1rem solid;">Limit</a></li>
                        </ul>
                        <div class="tab-content" id="myTabContent_6">
                            <div id="home_6" class="tab-pane fade active in" role="tabpanel">
                                <div class="row" style="padding: 1px 25px">
                                    <div class="col-sm-12">
                                        <div class="panel panel-default card-view">
                                            <div class="panel-heding">
                                                <div class="row">
                                                    <div class="col-lg-10 mt-10">
                                                        <h6 style="font-size: 16px; line-height: 24px; text-transform: capitalize;padding: 10px 15px 5px 0px; margin-left: -34px;">history aktifitas</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-bodi">
                                                    <div class="table-wrap mt-10">
                                                        <div class="table-responsive">
                                                            <table class="table mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Order ID</th>
                                                                        <th>Informasi</th>
                                                                        <th style="text-align: center;">Status</th>
                                                                        <th style="text-align: center;">Tanggal</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>#10021</td>
                                                                        <td>Transaksi berhasil ! Arya GP telah melakukan pembayaran sebesar Rp.1.500.000,00</td>
                                                                        <td style="text-align: center;">
                                                                            <span class="label label-berhasil">Berhasil</span>
                                                                        </td>
                                                                        <td style="text-align: center;">
                                                                            <p>12 Jan 2022</p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>#10021</td>
                                                                        <td>Transaksi berhasil ! Arya GP telah melakukan pembayaran menggunakan Limit Gratis.</td>
                                                                        <td style="text-align: center;">
                                                                            <span class="label label-berhasil">Berhasil</span>
                                                                        </td>
                                                                        <td style="text-align: center;">
                                                                            <p>12 Jan 2022</p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>#10021</td>
                                                                        <td>Transaksi dibatalkan ! Arya GP telah membatalkan transaksi Limit Gratis.</td>
                                                                        <td style="text-align: center;">
                                                                            <span class="label label-batal">Batal</span>
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
                            <div id="profile_6" class="tab-pane fade" role="tabpanel">
                                <div class="row" style="padding: 1px 25px">
                                    <div class="col-sm-12">
                                        <div class="panel panel-default card-view">
                                            <div class="panel-heding">
                                                <div class="row">
                                                    <div class="col-lg-10 mt-10">
                                                        <h6 style="font-size: 16px; line-height: 24px; text-transform: capitalize;padding: 10px 15px 5px 15px; margin-left: -34px;">Riwayat Deposit</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-bodi">
                                                    <div class="table-wrap mt-10">
                                                        <div class="table-responsive">
                                                            <table class="table mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Balance</th>
                                                                        <th>Informasi</th>
                                                                        <th style="text-align: center;">Jenis Pembayaran</th>
                                                                        <th style="text-align: center;">Tanggal</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Rp.<sapce>500.000</sapce>
                                                                        </td>
                                                                        <td>Deposit Arya GP bertambah menjadi Rp. 500.000,00</td>
                                                                        <td style="text-align: center;">
                                                                            <span class="label label-riwayat">Transfer</span>
                                                                        </td>
                                                                        <td style="text-align: center;">
                                                                            <p>12 Jan 2022</p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Rp.<sapce>500.000</sapce>
                                                                        </td>
                                                                        <td>Deposit Arya GP bertambah menjadi Rp. 1.800.000,00</td>
                                                                        <td style="text-align: center;">
                                                                            <span class="label label-riwayat">Tunai</span>
                                                                        </td>
                                                                        <td style="text-align: center;">
                                                                            <p>12 Jan 2022</p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Rp.<sapce>500.000</sapce>
                                                                        </td>
                                                                        <td>Deposit Arya GP bertambah menjadi Rp. 5.400.000,00</td>
                                                                        <td style="text-align: center;">
                                                                            <span class="label label-riwayat">Tunai</span>
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
                            <div id="profile_7" class="tab-pane fade" role="tabpanel">
                                <div class="row" style="padding: 1px 25px">
                                    <div class="col-sm-12">
                                        <div class="panel panel-default card-view">
                                            <div class="panel-heding">
                                                <div class="row">
                                                    <div class="col-lg-10 mt-5">
                                                        <h6 style="font-size: 16px; line-height: 24px; text-transform: capitalize;padding: 10px 15px 5px 15px; margin-left: -34px;">Riwayat Limit</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-bodi">
                                                    <div class="table-wrap mt-10">
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
                                                                        <td>Limit Arya GP berhasil di reset menjadi 4x main gratis pada bulan Agustus tahun 2022</td>
                                                                        <td style="text-align: center;">
                                                                            <span class="label label-reset">Reset</span>
                                                                        </td>
                                                                        <td style="text-align: center;">
                                                                            <p>12 Jan 2022</p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Limit Arya GP berkurang menjadi 3x main gratis.
                                                                            Waktu limit tersisa 20 hari pada bulan Agustus ini tahun 2022.</td>
                                                                        <td style="text-align: center;">
                                                                            <span class="label label-berkurang">Berkurang</span>
                                                                        </td>
                                                                        <td style="text-align: center;">
                                                                            <p>12 Jan 2022</p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Limit Arya GP berhasil di reset menjadi 10x main gratis pada bulan Agustus tahun 2022</td>
                                                                        <td style="text-align: center;">
                                                                            <span class="label label-reset">Reset</span>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<div class="clearfix"></div>
<div class="col-lg-12" style="margin-left: 45px;">
    @include('Layouts.Footer')
</div>
@endsection