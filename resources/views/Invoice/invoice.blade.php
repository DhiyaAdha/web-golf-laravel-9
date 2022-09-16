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
                        <li><a href="{{ url('analisis-tamu') }}">Dashboard</a></li>
                        <li><a href="{{ url('riwayat-invoice') }}">Daftar invoice</a></li>
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
                        <div class="col-md-10 text-right">
                            <h3 class="float-right" style="font-size: 16px;"><strong>Order
                                    #{{ $transaction->order_number }}</strong></h3>
                        </div>
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
                    </div>
                </div>
            </div>
        </div>
        @include('Layouts.Footer')
    </div>
@endsection
@push('scripts')
    <script>
<<<<<<< HEAD
        // invoice detail
        $('#dt-invoice').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthChange": false,
            "bDestroy": true,
            "searching": false,
            "paginate": {
                "first": "First",
                "last": "Last",
                "next": "Next",
                "previous": "Previous"
            },
            "ajax": {
                "url": "{{ route('riwayat-invoice.create') }}",
                "type": "GET",
                "datatype": "json"
            },
            "render": $.fn.dataTable.render.text(),
            "columns": [{
                    data: 'name',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'harga',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'quantity',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'total',
                    searchable: true,
                    orderable: false,
                    className: 'text-right'
                },
            ],
            order: [],
            responsive: true,
            language: {
                search: "",
                searchPlaceholder: "Cari",
                emptyTable: "Tidak ada data pada tabel ini",
                info: "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                infoEmpty: "Tidak ada data pada tabel ini",
                lengthMenu: "Menampilkan _MENU_ data",
                zeroRecords: "Tidak ada data pada tabel ini"
            },
            columnDefs: [{
                    className: 'text-center',
                    targets: [1, 2]
                }
            ],
        });  
    </script>
@endpush
=======
        $('.fa-print').on("click", function() {
            $('#cetak-invoice').printThis({
                printContainer: true,
            });
        });
    </script>
@endpush
>>>>>>> dhany
