@extends('Layouts.Main', ['title' => 'TGCC | Invoice'])
@section('content')
@section('content')
@endsection
{{-- Main Content --}}
<div class="page-wrapper">
    <div class="container-fluid">
        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Invoice</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="active"><span>Invoice</span></li>
                </ol>
            </div>
            <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->


        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default card-view">
                    <div class="row">
                        <div class="col-md-2">
                            <h2 style="font-size: 16px;"><strong>Invoice</strong></h2>
                        </div>

                        <div class="col-md-10 text-right">
                            <h3 class="float-right" style="font-size: 16px;"><strong>Order #0001</strong></h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-20">
                            <address>
                                <strong>Nama Tamu:</strong><br>
                                <td><span class="weight-500">{{ Auth::user()->name }}</span></td>
                                <br>
                                {{ Auth::user()->email }}<br>
                                {{ Auth::user()->phone }}<br>



                            </address>
                        </div>
                        <div class="col-md-6 text-right">
                            <address>
                                <strong>Metode Pembayaran:</strong><br>
                                <p style="color: #616161;">Limit Bulanan, Sisa Deposit</p><br>

                            </address>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-20">
                            <address>
                                <strong>Katagori Tamu:</strong><br>
                                <p style="color: #616161">VVIP</p><br>

                            </address>
                        </div>
                        <div class="col-md-6 text-right">
                            <address>
                                <strong>Order Date:</strong><br>
                                <p style="color: #616161">25 Agustus 2022</p><br><br>
                            </address>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <td><strong>Item</strong></td>
                                    <td class="text-center"><strong>Harga</strong></td>
                                    <td class="text-center"><strong>Jumlah</strong></td>
                                    <td class="text-right"><strong>Total</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                <tr>
                                    <td>
                                        <span>Practice</span>

                                    </td>
                                    <td class="text-center">Rp
                                        <span>50000</span>
                                    </td>
                                    <td class="text-center">1</td>
                                    <td class="text-right">Rp
                                        <span>50000</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Paket 1</span>
                                    </td>
                                    <td class="text-center">Rp
                                        <span>100000</span>
                                    </td>
                                    <td class="text-center">1</td>
                                    <td class="text-right">Rp
                                        <span>100000</span>
                                    </td>
                                </tr>
                                </thead>
                            <tbody>
                                <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                <tr>
                                    <td>

                                        <span>Practice</span>



                                    </td>
                                    <td class="text-center">Rp

                                        <span>50000</span>

                                    </td>
                                    <td class="text-center">1</td>
                                    <td class="text-right">Rp

                                        <span>50000</span>

                                    </td>
                                </tr>
                                <tr>
                                    <td>

                                        <span>Paket 1</span>

                                    </td>
                                    <td class="text-center">Rp

                                        <span>100000</span>

                                    </td>
                                    <td class="text-center">1</td>
                                    <td class="text-right">Rp

                                        <span>100000</span>

                                    </td>
                                </tr>

                                <tr>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line text-right">Subtotal</td>
                                    <td class="thick-line text-right">

                                        <span>Rp 150000</span>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-right">Limit Bulanan</td>
                                    <td class="no-line text-right">Rp -</td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-right">Deposit</td>
                                    <td class="no-line text-right">Rp -</td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-right"><strong>Total Bayar</strong></td>
                                    <td class="no-line text-right">

                                        <span>Rp 150000</span>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-lg-7">
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="btn-selesai">
                                    <a href="/riwayat-invoice">
                                        <p style="color: white">Selesai</p>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-12">
                                <div class="btn-print">
                                    <a href="#">
                                        <i class="fa-regular fa-file-lines">
                                            Print Struct
                                        </i>
                                    </a>
                                </div>
                            </div>
                            <div class="form-group text-right">
                                {{-- <button type="submit" class="btn btn-info">Selesai</button> --}}


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('Layouts.Footer')
</div>
@endsection
