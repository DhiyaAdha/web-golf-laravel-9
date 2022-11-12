@extends('layouts.main', ['title' => 'TGCC | Invoice'])
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Detail invoice</h5>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('analisis-tamu') }}">Dashboard</a></li>
                        <li><a href="{{ url('riwayat-invoice') }}">Daftar invoice</a></li>
                        <li class="active"><span>Detail invoice</span></li>
                    </ol>
                </div>
            </div>
            <a href="javascript:void(0)" >
                <i class="fa fa-print  pull-right" target="_blank" data-toggle="tooltip" title="Klik untuk Cetak" style="font-size:24px"></i>
            </a>
            <div class="row" id="cetak-invoice">
                <body>
                    <div class="invoice-box">
                        <table cellpadding="0" cellspacing="0">
                            <tr class="top">
                                <td colspan="4">
                                    <table>
                                        <tr>
                                            <td class="title">
                                                <h2 class="invoice">INVOICE</h2>
                                            </td>
                                            <td>
                                                <strong>Order : {{ $transaction->order_number }}</strong><br />
                                                <strong>Metode Pembayaran:</strong><br>
                                                <p style="color: #616161;">{{ $method_payment }}</p><br />
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="information">
                                <td colspan="4">
                                    <table>
                                        <tr>
                                            <td>
                                                <strong>Nama Tamu:</strong><br />
                                                <span class="weight-500">{{ $visitor->name }}</span>
                                                <br />{{ $visitor->email }}<br>
                                                {{ $visitor->phone }}<br>
                                            </td>
                                            <td>
                                                <strong>Order Date:</strong><br>
                                                <p style="color: #616161"> {{ $transaction->created_at->format('d F Y | H:i:s') }}</p>
                                                <br><br>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="details">
                                <td>
                                    <strong>Jenis Tamu:&nbsp;</strong>
                                    @if ($visitor->tipe_member == 'VIP')
                                        <span class="label label-success">{{ $visitor->tipe_member == 'VIP' ? 'Member' : 'VIP' }}</span>
                                    @elseif ($visitor->tipe_member == 'VVIP')
                                        <span class="label label-warning">{{ $visitor->tipe_member == 'VVIP' ? 'VIP' : 'Member' }}</span>
                                    @else
                                        <span class="label label-primary">Umum</span>
                                    @endif
                                </td>
                            </tr>
                            <tr class="heading">
                                <td>Nama Paket</td>
                                <td class="text-left">Harga</td>
                                <td class="text-left">Qty</td>
                                <td class="text-right">Total</td>
                            </tr>
                            <tr class="item">
                                @foreach ($cart as $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td class="text-left">{{ formatrupiah($item['pricesingle']) }}</td>
                                <td class="text-left">{{ $item['qty'] }}</td>
                                <td class="text-right">{{ formatrupiah($item['price']) }}</td>
                            </tr>
                            @endforeach
                            </tr>
                            <tr>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line text-right">Jumlah Item</td>
                                <td class="thick-line text-right">{{ count($cart) }}</td>
                            </tr>
                            <tr>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line text-right">Jumlah Order</td>
                                <td class="thick-line text-right">{{ $qty }}
                                </td>
                            </tr>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-right">Diskon</td>
                                <td class="no-line text-right">{{ formatrupiah($discount) }}</td>
                            </tr>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-right">Total Bayar</td>
                                <td class="no-line text-right">{{ formatrupiah($transaction->total) }}</td>
                            </tr>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-right"><strong>Total Tagihan</strong></td>
                                <td class="no-line text-right">
                                    <span>{{ formatrupiah($total) }}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    @include('layouts.footer')
                </body>
            </div>
        </div>
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
