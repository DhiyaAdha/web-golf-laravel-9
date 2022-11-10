<head>
    <link href="{{ asset('vendors/bower_components/morris.js/morris.css') }}" rel="stylesheet" type="text/css" />
</head>
@extends('layouts.main', ['title' => 'TGCC | Daftar Tamu'])
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Detail tamu</h5>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('analisis-tamu') }}">Dashboard</a></li>
                        <li><a href="{{ url('daftar-tamu') }}">Daftar tamu</a></li>
                        <li class="active"><span>Detail tamu</span></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default border-panel card-view jt">
                        <img src="{{ asset('img/detail-kartutamu.jpg') }}" style="width: 100%; height: 200px;">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-default panel-dropdown card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Kartu Tamu</h6>
                            </div>
                            <div class="pull-right">
                                <div class="dropdown  pull-left">
                                    <a class="weight-500" data-toggle="modal" href="javascript:void(0)"
                                        data-target="#kartu-tamu">
                                        <i class="fa-solid fa-address-card"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <!-- sample modal content -->
                        <div class="modal fade" id="kartu-tamu" tabindex="-1" role="dialog"
                            aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content hidden-content">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <div class="resolution">
                                                    <div class="d-flex flex-column">
                                                        <div class="mb-5">
                                                            <img src="{{ $visitor->tipe_member == 'VVIP' ? asset('dist/img/kartutamu/bg-vip.svg') : asset('dist/img/kartutamu/bg-reguler.svg') }}" alt="{{ $visitor->tipe_member }}">
                                                            <div class="qr-code">
                                                                {{ QrCode::size(80)->eye('circle')->style('round')->generate($visitor->unique_qr) }}
                                                            </div>
                                                            <div class="identity">
                                                                <h6>{{ $visitor->name }}</h6>
                                                            </div>
                                                        </div>
                                                        <div class="mt-5">
                                                            <img src="{{ $visitor->tipe_member == 'VVIP' ? asset('dist/img/kartutamu/bg-vip.svg') : asset('dist/img/kartutamu/bg-reguler.svg') }}" alt="{{ $visitor->tipe_member }}">
                                                            <div class="qr-code">
                                                                {{ QrCode::size(80)->eye('circle')->style('round')->generate($visitor->unique_qr) }}
                                                            </div>
                                                            <div class="identity">
                                                                <h6>{{ $visitor->name }}</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-sm download-kartu-tamu" style="margin-top: 200px;"><i class="fa fa-download"></i> Download Kartu (PDF)</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.modal -->
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
                                        <span class="txt-muted">Kode Member</span>
                                        <span>{{ $visitor->phone }}</span>
                                    </div>
                                    <div class="mb-15 d-flex flex-column">
                                        <span class="txt-muted">Jenis Kelamin</span>
                                        <span class="text-capitalize">{{ $visitor->gender }}</span>
                                    </div>
                                    <div class="mb-15 d-flex flex-column">
                                        <span class="txt-muted">Jenis Tamu</span>
                                        <span class="{{ $visitor->tipe_member == 'VIP' ? 'col-lg-1 col-md-1 col-sm-1 col-xs-1 label label-success' : 'col-lg-1 col-md-1 col-sm-1 col-xs-1 label label-warning' }}" style="width:70px;">{{ $visitor->tipe_member == 'VVIP' ? 'VIP' : 'Member' }}</span>
                                    </div>
                                    <div class="mb-15 d-flex flex-column">
                                        <span class="txt-muted">Kategori</span>
                                        <span class="text-capitalize">{{ $visitor->category }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="panel panel-default card-view limit" style="height: 209.4px;">
                        <div class="panel-heading">
                            <h6 class="panel-title text-center">Limit</h6>
                            <div class="clearfix"></div>
                        </div>
                        <div>
                            <div class="cus-sat-stat weight-500 txt-success text-center mt-5">
                                <img src="/dist/img/Golf.svg">
                                <h6 class="text-center">{{ $quota }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default card-view limit" style="height: 209.4px;">
                        <div class="panel-heading">
                            <h6 class="panel-title text-center">Kupon</h6>
                            <div class="clearfix"></div>
                        </div>
                        <div>
                            <div class="cus-sat-stat weight-500 txt-success text-center mt-5">
                                <img src="/dist/img/Golf.svg">
                                <h6 class="text-center">{{ $quota_kupon }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="panel panel-default card-view limit" style="height: 209.4px;">
                        <div class="panel-heading">
                            <h6 class="panel-title text-center">Saldo</h6>
                            <div class="clearfix"></div>
                        </div>
                        <div>
                            <div class="cus-sat-stat weight-500 txt-success text-center mt-5">
                                <img src="{{ asset('/dist/img/money.svg') }}">
                                <h6 class="text-center">IDR {{ number_format($balance, 0, '', '.') }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default card-view b" style="height: 209.4px;">
                        <div class="panel-heading">
                            <h6 class="panel-title text-center">Barcode</h6>
                            <div class="clearfix"></div>
                        </div>
                        <div class="d-flex justify-content-center p">
                            {{ QrCode::size(100)->eye('circle')->style('round')->generate($visitor->unique_qr) }}
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="panel-heading tabs">
                    <div class="d-flex">
                        <div class="flex-grow-1 d-flex align-items-center">
                            <h6 class="panel-title txt-dark">Riwayat tamu</h6>
                        </div>
                        <ul role="tablist" class="nav nav-pills" id="myTabs_6">
                            <li class="active" role="presentation"><a class="tabs-log" aria-expanded="true"
                                    data-toggle="tab" role="tab" href="#chart_tabs">Grafik</a></li>
                            <li role="presentation" class=""><a class="tabs-log" data-toggle="tab" role="tab"
                                    href="#transaction_tabs" aria-expanded="false">Transaksi</a></li>
                            <li role="presentation" class=""><a class="tabs-log" data-toggle="tab" role="tab"
                                    href="#deposit_tabs" aria-expanded="false">Deposit</a></li>
                            <li role="presentation" class=""><a class="tabs-log" data-toggle="tab" role="tab"
                                    href="#limit_tabs" aria-expanded="false">Limit</a></li>
                            @if ($quota_kupon != 0)
                                <li role="presentation" class=""><a class="tabs-log" data-toggle="tab"
                                        role="tab" href="#limit_kupon_tabs" aria-expanded="false">Kupon</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="tab-content">
                        <div id="chart_tabs" class="tab-pane fade active in" role="tabpanel">
                            <div class="panel panel-default card-view">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h6 class="panel-title text-dark">Invoice 12 Bulan Terakhir</h6>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr class="light-grey-hr row mt-20 mb-15 mb-10" />
                                </div>
                                <div class="panel-wrapper collapse in">
                                    <div class="panel-body">
                                        <div class="tab-content">
                                            <div id="all_line" class="tab-pane fade active in" role="tabpanel">
                                                <div class="panel-body">
                                                    @if ($visitor->tipe_member == 'VIP')
                                                    <div id="invoice_line_member" class="morris-chart"></div>
                                                    <div id="invoice_line_vip" class="morris-chart" hidden></div>
                                                    @else
                                                    <div id="invoice_line_member" class="morris-chart" hidden></div>
                                                    <div id="invoice_line_vip" class="morris-chart"></div>
                                                    @endif
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="transaction_tabs" class="tab-pane fade active" role="tabpanel">
                            <div class="panel panel-default card-view">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h6 class="panel-title txt-dark">Riwayat Transaksi</h6>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-wrapper collapse in">
                                    <div class="panel-body">
                                        <div class="table-wrap">
                                            <div class="table-responsive">
                                                <table width="100%" class="table table-hover mb-0" id="dt-tamu-transaksi">
                                                    <thead>
                                                        <tr>
                                                            <th>Order ID</th>
                                                            <th>Informasi</th>
                                                            <th>Total Transaksi</th>
                                                            <th style="text-align: center;">Status</th>
                                                            <th style="text-align: center;">Tanggal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- deposit --}}
                        <div id="deposit_tabs" class="tab-pane fade" role="tabpanel">
                            <div class="panel panel-default card-view">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h6 class="panel-title txt-dark">Riwayat Deposit</h6>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-wrapper collapse in">
                                    <div class="panel-body">
                                        <div class="table-wrap">
                                            <div class="table-responsive">
                                                <table width="100%" class="table table-hover mb-0"
                                                    id="dt-tamu-deposit">
                                                    <thead>
                                                        <tr>
                                                            <th>Saldo</th>
                                                            <th>Jumlah Transaksi</th>
                                                            <th class="text-center">Tipe Pembayaran</th>
                                                            <th class="text-center">Status</th>
                                                            <th class="text-center">Tanggal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- limit --}}
                        <div id="limit_tabs" class="tab-pane fade" role="tabpanel">
                            <div class="panel panel-default card-view">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h6 class="panel-title txt-dark">Riwayat Limit</h6>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-wrapper collapse in">
                                    <div class="panel-body">
                                        <div class="table-wrap">
                                            <div class="table-responsive">
                                                <table width="100%" class="table table-hover mb-0" id="dt-tamu-limit">
                                                    <thead>
                                                        <tr>
                                                            <th>Sisa Limit</th>
                                                            <th>Jumlah Transaksi</th>
                                                            <th style="padding-left: 10px">Status</th>
                                                            <th>Tanggal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- limit-kupon --}}
                        @if ($quota_kupon != 0)
                            <div id="limit_kupon_tabs" class="tab-pane fade" role="tabpanel">
                                <div class="panel panel-default card-view">
                                    <div class="panel-heading">
                                        <div class="pull-left">
                                            <h6 class="panel-title txt-dark">Riwayat Kupon</h6>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body">
                                            <div class="table-wrap">
                                                <div class="table-responsive">
                                                    <table width="100%" class="table table-hover mb-0"
                                                        id="dt-tamu-kupon">
                                                        <thead>
                                                            <tr>
                                                                <th>Sisa Kupon </th>
                                                                <th>Jumlah Transaksi</th>
                                                                <th style="padding-left: 10px">Status</th>
                                                                <th>Tanggal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal fade modal-detail-invoice" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <strong><span class="modal-title text-capitalize" id="myLargeModalLabel"></span></strong>
                        </div>
                        <div class="modal-body">
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
                                                        <strong>Metode Pembayaran:</strong><br>
                                                        <p id="method_payment" style="color: #616161;"></p><br />
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
                                                        <span id="name_visitor" class="weight-500" style="color: #616161;"></span>
                                                        <br /><p id="visitor_email"></p><p  id="visitor_phone"></p>
                                                        <br>
                                                    </td>
                                                    <td>
                                                        <strong>Order Date:</strong><br>
                                                        <p id="date" style="color: #616161">
                                                            
                                                        </p>
                                                        <br><br>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr class="details">
                                        <td>
                                            <strong>Jenis Tamu:&nbsp;</strong>
                                                <span class="text-capitalize" id="type_tamu"></span>
                                        </td>
                                    </tr>
                                </table>
                                <table>
                                    <thead style="background: #EEEEEE;">
                                        <tr>
                                            <th>Nama Paket</th>
                                            <th class="text-right">Harga</th>
                                            <th class="text-right">Qty</th>
                                            <th class="text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="products"></tbody>
                                </table>
                                <table>
                                    <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line text-right">Jumlah Item</td>
                                        <td  id="amount_item" class="thick-line text-right"></td>
                                    </tr>
                                    <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line text-right">Jumlah Order</td>
                                        <td id="amount_order" class="thick-line text-right">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-right">Diskon</td>
                                        <td id="discount" class="no-line text-right">Rp. </td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-right">Total Bayar</td>
                                        <td id="total_payment" class="no-line text-right">Rp. </td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-right"><strong>Total Tagihan</strong></td>
                                        <td id="total_bill" class="no-line text-right">
                                            <span>Rp. </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('vendors/bower_components/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('vendors/bower_components/morris.js/morris.min.js') }}"></script>
    <script src="{{ asset('/dist/js/line-chart-invoice-data.js') }}"></script>
    <script src="{{ asset('dist/asset_offline/jquery.blockUI.min.js') }}"></script>
    <script>
        var invoiceMonth = {!! json_encode($invoice_chart) !!}
        $('.modal-detail-invoice').on('show.bs.modal', function(e){
            var id = $(e.relatedTarget).data('id');
            var url = "{{ route('modal.invoice', ':id') }}";
            url = url.replace(':id', id);

            $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {
                    id: id,
                },
                dataType: 'json',
                success: function(data) {
                    $('.products').html('');
                    $('#myLargeModalLabel').text('ORDER ID : '+ data.order_number);
                    $('#name_visitor').text(data.name);
                    $('#method_payment').text(data.pay);
                    $('#date').text(data.date);
                    $('#type_tamu').addClass(data.type_member == 'VIP' ? 'label label-success' : 'label label-warning').text(data.type_member == 'VIP' ? 'member' : 'VIP');
                    $('#visitor_email').text(data.visitor_email);
                    $('#visitor_phone').text(data.visitor_phone);
                    $('#amount_item').text(data.amount_item);
                    $('#amount_order').text(data.amount_order);
                    $('#discount').text(data.discount);
                    $('#total_payment').text(data.total_payment);
                    $('#total_bill').text(data.total_bill);
                    $.each(data.products, function(b, val) {
                        $('.products').append(`<tr>
                                <td>${val.name}</td>    
                                <td class="text-right">${val.pricesingle}</td>    
                                <td class="text-right">${val.qty}</td>    
                                <td class="text-right">${val.price}</td>    
                            </tr>`).one();
                    });
                }
            });
        })

        $('.download-kartu-tamu').on("click", function() {
            $('.resolution').printThis({
                base: "https://jasonday.github.io/printThis/"
            });
        });

        $('#dt-tamu-transaksi').DataTable({
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
                "url": "{{ route('transaksi.report.data', Request::segment(2)) }}",
                "type": "GET",
                "datatype": "json"
            },
            "render": $.fn.dataTable.render.text(),
            "columns": [{
                    'data' : function(data) {
                        return `<div data-toggle="tooltip" title="Lihat invoice"><a href="javascript:void(0)" data-id="${data.id}" data-toggle="modal" data-target=".modal-detail-invoice">${data.order_number}</a></div>`;
                    }
                },
                {
                    data: 'information',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'total_gross',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'status',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'created_at',
                    searchable: true,
                    orderable: false
                }
            ],
            order: [],
            responsive: true,
            language: {
                emptyTable: "Tidak ada data pada tabel ini",
                info: "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                infoEmpty: "Tidak ada data pada tabel ini",
                lengthMenu: "Menampilkan _MENU_ data",
                zeroRecords: "Tidak ada data pada tabel ini"
            },
            columnDefs: [{
                className: 'text-left',
                targets: [0]
            },{
                className: 'text-center',
                targets: [1, 2, 3, 4]
            }, {
                width: '20%',
                targets: [0]
            }, {
                width: '30%',
                targets: [1]
            }, {
                width: '10%',
                targets: [2, 4]
            }, {
                width: '7%',
                targets: [3]
            },{
                orderable: false,
                targets: [0]
            }]
        });

        $('#dt-tamu-deposit').DataTable({
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
                "url": "{{ route('deposit.report.data', Request::segment(2)) }}",
                "type": "GET",
                "datatype": "json"
            },
            "render": $.fn.dataTable.render.text(),
            "columns": [{
                    data: 'report_balance',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'transaction',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'payment_type',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'status',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'created_at',
                    searchable: true,
                    orderable: false
                }
            ],
            order: [],
            responsive: true,
            language: {
                // search: "",
                // searchPlaceholder: "Cari",
                emptyTable: "Tidak ada data pada tabel ini",
                info: "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                infoEmpty: "Tidak ada data pada tabel ini",
                lengthMenu: "Menampilkan _MENU_ data",
                zeroRecords: "Tidak ada data pada tabel ini"
            },
            columnDefs: [{
                className: 'text-left',
                targets: [0, 1]
            },{
                className: 'text-center',
                targets: [2, 3, 4]
            }]
        });

        $('#dt-tamu-limit').DataTable({
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
                "url": "{{ route('limit.report.data', Request::segment(2)) }}",
                "type": "GET",
                "datatype": "json"
            },
            "render": $.fn.dataTable.render.text(),
            "columns": [{
                    data: 'limit',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'Informasi',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'status',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'created_at',
                    searchable: true,
                    orderable: false
                }
            ],
            order: [],
            responsive: true,
            language: {
                emptyTable: "Tidak ada data pada tabel ini",
                info: "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                infoEmpty: "Tidak ada data pada tabel ini",
                lengthMenu: "Menampilkan _MENU_ data",
                zeroRecords: "Tidak ada data pada tabel ini"
            },
            columnDefs: [{
                className: 'text-left',
                targets: [0]
            },{
                className: 'text-center',
                targets: [2, 3]
            }]
        });

        $('#dt-tamu-kupon').DataTable({
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
                "url": "{{ route('kupon.report.data', Request::segment(2)) }}",
                "type": "GET",
                "datatype": "json"
            },
            "render": $.fn.dataTable.render.text(),
            "columns": [{
                    data: 'kupon',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'Informasi',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'status',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'created_at',
                    searchable: true,
                    orderable: false
                }
            ],
            order: [],
            responsive: true,
            language: {
                emptyTable: "Tidak ada data pada tabel ini",
                info: "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                infoEmpty: "Tidak ada data pada tabel ini",
                lengthMenu: "Menampilkan _MENU_ data",
                zeroRecords: "Tidak ada data pada tabel ini"
            },
            columnDefs: [{
                className: 'text-left',
                targets: [0]
            },{
                className: 'text-center',
                targets: [2, 3]
            }]
        });
    </script>
@endpush
