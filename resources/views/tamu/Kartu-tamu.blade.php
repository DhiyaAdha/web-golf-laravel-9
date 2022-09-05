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
                <div class="col-lg-3 col-md-4 col-sm-3 col-xs-12">
                    <div class="panel panel-default card-view p">
                        <div class="panel-heading">
                            <h6 class="panel-title text-center">Limit Bulanan</h6>
                            <div class="clearfix"></div>
                        </div>
                        <div class="cus-sat-stat weight-500 txt-success text-center mt-5">
                            <img src="/dist/img/Golf.svg">
                            <h6 class="text-center">4</h6>
                        </div>
                    </div>
                    <div class="panel panel-default card-view p">
                        <div class="panel-heading">
                            <h6 class="panel-title text-center">Deposit</h6>
                            <div class="clearfix"></div>
                        </div>
                        <div class="cus-sat-stat weight-500 txt-success text-center mt-5">
                            <img src="/dist/img/money.svg">
                            <h6 class="text-center"> IDR {{ number_format($balance, 0, '', '.') }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-3 col-xs-12">
                    <div class="panel panel-default card-view b">
                        <div class="panel-heading">
                            <h6 class="panel-title text-center">Barcode</h6>
                            <div class="clearfix"></div>
                        </div>
                        <div class="d-flex justify-content-center p">
                            {!! $qrcode !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- <div class="panel-heading l">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Kartu tamu</h6>
                    </div>
                    <div class="clearfix"></div>
                </div> --}}
                <div class="panel-heading tabs">
                    <div class="d-flex">
                        <div class="flex-grow-1 d-flex align-items-center">
                            <h6 class="panel-title txt-dark">Kartu tamu</h6>
                        </div>
                        <ul role="tablist" class="nav nav-pills" id="myTabs_6">
                            <li class="active" role="presentation"><a class="tabs-log" aria-expanded="true" data-toggle="tab" role="tab" href="#transaction_tabs">Transaksi</a></li>
                            <li role="presentation" class=""><a class="tabs-log" data-toggle="tab" role="tab" href="#deposit_tabs" aria-expanded="false">Deposit</a></li>
                            <li role="presentation" class=""><a class="tabs-log" data-toggle="tab" role="tab" href="#limit_tabs" aria-expanded="false">Limit</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card-view p">
                        <div class="tab-content">
                            <div id="transaction_tabs" class="tab-pane fade active in" role="tabpanel">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
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
                                                    <td>Transaksi berhasil ! Arya GP telah melakukan
                                                        pembayaran sebesar Rp.1.500.000,00</td>
                                                    <td style="text-align: center;">
                                                        <span class="label label-success">Berhasil</span>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <p>12 Jan 2022</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>#10021</td>
                                                    <td>Transaksi berhasil ! Arya GP telah melakukan
                                                        pembayaran menggunakan Limit Gratis.</td>
                                                    <td style="text-align: center;">
                                                        <span class="label label-success">Berhasil</span>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <p>12 Jan 2022</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>#10021</td>
                                                    <td>Transaksi dibatalkan ! Arya GP telah
                                                        membatalkan transaksi Limit Gratis.</td>
                                                    <td style="text-align: center;">
                                                        <span class="label label-warning">Batal</span>
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
                            <div id="deposit_tabs" class="tab-pane fade" role="tabpanel">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
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
                                                    <td>Transaksi berhasil ! Arya GP telah melakukan
                                                        pembayaran sebesar Rp.1.500.000,00</td>
                                                    <td style="text-align: center;">
                                                        <span class="label label-success">Berhasil</span>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <p>12 Jan 2022</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>#10021</td>
                                                    <td>Transaksi berhasil ! Arya GP telah melakukan
                                                        pembayaran menggunakan Limit Gratis.</td>
                                                    <td style="text-align: center;">
                                                        <span class="label label-success">Berhasil</span>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <p>12 Jan 2022</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>#10021</td>
                                                    <td>Transaksi dibatalkan ! Arya GP telah
                                                        membatalkan transaksi Limit Gratis.</td>
                                                    <td style="text-align: center;">
                                                        <span class="label label-warning">Batal</span>
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
                            <div id="limit_tabs" class="tab-pane fade" role="tabpanel">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
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
                                                    <td>Transaksi berhasil ! Arya GP telah melakukan
                                                        pembayaran sebesar Rp.1.500.000,00</td>
                                                    <td style="text-align: center;">
                                                        <span class="label label-success">Berhasil</span>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <p>12 Jan 2022</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>#10021</td>
                                                    <td>Transaksi berhasil ! Arya GP telah melakukan
                                                        pembayaran menggunakan Limit Gratis.</td>
                                                    <td style="text-align: center;">
                                                        <span class="label label-success">Berhasil</span>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <p>12 Jan 2022</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>#10021</td>
                                                    <td>Transaksi dibatalkan ! Arya GP telah
                                                        membatalkan transaksi Limit Gratis.</td>
                                                    <td style="text-align: center;">
                                                        <span class="label label-warning">Batal</span>
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
<div class="col-lg-12">
    @include('Layouts.Footer')
</div>
@endsection