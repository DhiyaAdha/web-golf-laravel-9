@extends('Layouts.Main', ['title' => 'TGCC | Invoice'])
@section('content')
    {{-- Main Content --}}
    <div class="page-wrapper">
        <div class="container-fluid">
            <!-- Title -->
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Detail invoice</h5>
                </div>
                <!-- Breadcrumb -->
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0)">Dashboard</a></li>
                        <li><a href="javascript:void(0)">Daftar invoice</a></li>
                        <li class="active"><span>Detail invoice</span></li>
                    </ol>
                </div>
                <!-- /Breadcrumb -->
            </div>
            <!-- /Title -->


            <div class="row" id="cetak-invoice">
                <div class="panel panel-default card-view" data-size="A4">
                    <a href="javascript:void(0)"><i class="fa fa-print pull-right"></i></a>
                    <div class="row">
                        <div class="col-md-2">
                            <h2 class="invoice">INVOICE</h2>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-20">
                                <address>
                                    <strong>Nama Tamu:</strong><br>
                                    <td><span class="weight-500">{{ $visitor->name }}</span></td>
                                    <br>
                                    {{ $visitor->email }}<br>
                                    {{ $visitor->phone }}<br>
                                </address>
                            </div>
                            <div class="col-md-6 text-right">
                                <address>
                                    <strong>Metode Pembayaran:</strong><br>
                                    <p style="color: #616161;">{{ $transaction->payment_type }}</p><br>
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-20">
                                <address>
                                    <strong>Katagori Tamu:</strong><br>
                                    <p style="color: #616161">{{ $visitor->tipe_member }}</p><br>

                                </address>
                            </div>
                            <div class="col-md-6 text-right">
                                <address>
                                    <strong>Order Date:</strong><br>
                                    <p style="color: #616161">{{ $transaction->created_at->format('d F Y | H:i:s') }}
                                    </p>
                                    <br><br>
                                </address>
                            </div>
                        </div>
<<<<<<< HEAD
                        <div class="col-md-6 text-right">
                            <address>
                                <strong>Order Date:</strong><br>
                                <p style="color: #616161">{{ $transaction->created_at->format('d F Y | H:i:s') }}
                                </p>
                                <br><br>
                            </address>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="table-responsive">
                        <table class="mb-15" id="dt-invoice">
                            <thead style="text-align: center">
                                <tr>
                                    <td class="text-left"><strong>Paket Bermain</strong></td>
                                    <td class="text-left"><strong>Harga</strong></td>
                                    <td class="text-left"><strong>Jumlah</strong></td>
                                    <td class="text-right"><strong>Total</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-left">{{ $visitor->name }}</td>
                                    <td class="text-left">Rp.{{ formatrupiah($package->price_weekdays) }}</td>
                                    <td class="text-left">{{ $detail->quantity }}</td>
                                    <td class="text-right">Rp.{{ formatrupiah($transaction->total) }}</td>
                                </tr>
                            </thead>
                            <tr></tr>
                            <tbody>
                                <tr>
                                    <td class="text-left"></td>
                                    <td class="text-left"></td>
                                    <td class="text-left">Subtotal</td>
                                    <td class="text-right">
                                        Rp. {{ formatrupiah($detail->harga * $detail->quantity * 2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left"></td>
                                    <td class="text-left"></td>
                                    <td class="text-left">Limit Bulanan</td>
                                    <td class="text-right">Rp. -</td>
                                </tr>
                                <tr>
                                    <td class="text-left"></td>
                                    <td class="text-left"></td>
                                    <td class="text-left">Deposit</td>
                                    <td class="text-right">Rp. -</td>
                                </tr>
                                <tr>
                                    <td class="text-left"></td>
                                    <td class="text-left"></td>
                                    <td class="text-left"><strong>Total Bayar</strong></td>
                                    <td class="text-right">
                                        Rp. {{ formatrupiah($transaction->total) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
=======
                        <div class="clearfix"></div>
                        <div class="table-responsive">
                            <table class="mb-0" id="dt-invoice">
                                <thead style="text-align: center">
                                    <tr>
                                        <td style="text-align: left"><strong>Nama</strong></td>
                                        <td class=""><strong>Harga</strong></td>
                                        <td class=""><strong>Jumlah</strong></td>
                                        <td style="text-align: right"><strong>Total</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left">{{ $visitor->name }}</td>
                                        <td>Rp.{{ formatrupiah($package->price_weekdays) }}</td>
                                        <td class="">{{ $detail->quantity }}</td>
                                        <td style="text-align: right">Rp.{{ formatrupiah($transaction->total) }}</td>
                                    </tr>
                                </thead>
                                <tr></tr>
                                <tbody>
                                    <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line text-right">Subtotal</td>
                                        <td class="thick-line text-right">
                                            <span>Rp. {{ formatrupiah($detail->harga * $detail->quantity * 2) }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-right">Limit Bulanan</td>
                                        <td class="no-line text-right">Rp. -</td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-right">Deposit</td>
                                        <td class="no-line text-right">Rp. -</td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-right"><strong>Total Bayar</strong></td>
                                        <td class="no-line text-right">
                                            <span>Rp. {{ formatrupiah($transaction->total) }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            {{-- <div class="row">
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
                                        <a href="printpdf">
                                            <i class="fa-regular fa-file-lines">
                                                Print Struct
                                            </i>
                                        </a>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                </div>
                            </div> --}}
                        </div>
>>>>>>> imas
                    </div>
                </div>
            </div>
        </div>
        @include('Layouts.Footer')
    </div>
@endsection
@push('scripts')
    <script>
        $('.fa-print').on("click", function() {
            $('#cetak-invoice').printThis({
                printContainer: true,
            });
        });
    </script>
@endpush
