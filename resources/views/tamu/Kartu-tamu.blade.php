@extends('Layouts.Main', ['title' => 'TGCC | Daftar Tamu'])
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row heading-bg d-flex align-items-center">
                <div class="col-lg-12">
                    <h5 class="txt-dark flex-grow-1">Detail tamu</h5>
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
                    <div class="panel panel-default panel-dropdown card-view" style="height: 540px;">
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
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content hidden-content">
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <div class="d-flex justify-content-center flex-wrap" id="cetak-kartu">
                                                <div class="col-md-card d-flex justify-content-center mb-10">
                                                    <div class="panel panel-default card-view card-visitor">
                                                        <div class="panel-heading">
                                                            <div class="pull-left">
                                                                <div class="d-flex title-card">
                                                                    <img src="{{ asset('/dist/img/tgcc-icon-small.svg') }}">
                                                                    <div class="d-flex flex-column">
                                                                        <h6 class="panel-title txt-dark label-visitor">
                                                                            tritih golf</h6>
                                                                        <h6 class="panel-title txt-dark label-visitor">
                                                                            country & club</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="panel-wrapper collapse in">
                                                            <div class="panel-body card">
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center bg-front">
                                                                    <div class="pull-left">
                                                                        <img class="front-qr"
                                                                            src="{{ asset('/dist/img/icon-golf1.svg') }}">
                                                                    </div>
                                                                    <div class="pull-right">
                                                                        <img class="front-qr"
                                                                            src="{{ asset('/dist/img/icon-golf2.svg') }}">
                                                                    </div>
                                                                </div>
                                                                <div class=" text-name-card">
                                                                    <div class="d-flex-justify-content-center">
                                                                        <strong>
                                                                            <p class="text-center">{{ $visitor->name }}</p>
                                                                        </strong>
                                                                        <p class="text-center text-primary">
                                                                            {{ $visitor->tipe_member }}</p>
                                                                    </div>
                                                                    <br>
                                                                    <div class="d-flex-justify-content-center ">
                                                                        <p class="text-center text-muted">
                                                                            {{ $visitor->phone }}</p>
                                                                        <p class="text-center text-muted text-lowercase">
                                                                            {{ $visitor->email }}</p>
                                                                    </div>
                                                                </div>
                                                                <img class="align-self-end img-footer"
                                                                    src="{{ asset('/dist/img/golf-footer.svg') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-card d-flex justify-content-center mb-10">
                                                    <div class="panel panel-default card-view card-visitor">
                                                        <div class="panel-heading wave">
                                                            <div class="pull-left">
                                                                <div class="d-flex title-card">
                                                                    <img
                                                                        src="{{ asset('/dist/img/tgcc-icon-small.svg') }}">
                                                                    <div class="d-flex flex-column">
                                                                        <h6 class="panel-title txt-dark label-visitor">
                                                                            tritih golf</h6>
                                                                        <h6 class="panel-title txt-dark label-visitor">
                                                                            country & club</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="panel-wrapper collapse in">
                                                            <div class="panel-body card">
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center flex-column">
                                                                    <img class="back-qr"
                                                                        src="{{ asset('/dist/img/icon-golf2.svg') }}">
                                                                    <div class="qr-code-visitor">
                                                                        {{ QrCode::size(120)->generate($visitor->unique_qr) }}
                                                                    </div>
                                                                </div>
                                                                <img class="align-self-end img-footer"
                                                                    src="{{ asset('/dist/img/golf-footer.svg') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn download-kartu-tamu"><i
                                                    class="fa fa-download"></i> Download Kartu (PDF)</button>
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
                                        <span class="txt-muted">No Hp</span>
                                        <span>{{ $visitor->phone }}</span>
                                    </div>
                                    <div class="mb-15 d-flex flex-column">
                                        <span class="txt-muted">Jenis Kelamin</span>
                                        <span>{{ $visitor->gender }}</span>
                                    </div>
                                    <div class="mb-15 d-flex flex-column">
                                        <span class="txt-muted">Kategori Tamu</span>
                                        <span
                                            class="{{ $visitor->tipe_member == 'VIP' ? 'col-lg-1 col-md-1 col-sm-1 col-xs-1 label label-success' : 'col-lg-1 col-md-1 col-sm-1 col-xs-1 label label-warning' }}">{{ $visitor->tipe_member }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-lg-6 col-md-4 col-sm-3 col-xs-12">
                    <div class="panel panel-default card-view b">
                        <div class="panel-heading">
                            <h6 class="panel-title text-center">Barcode</h6>
                            <div class="clearfix"></div>
                        </div>
                        <div class="d-flex justify-content-center p">
                            {{ QrCode::size(180)->generate($visitor->unique_qr) }}
                        </div>
                    </div>
                </div> --}}

                <div class="row">
                    <div class="col-lg-3">
                            {{-- Limit Bulanan --}}
                                <div class="panel panel-default card-view limit" style="height: 170px;">
                                    <div class="panel-heading">
                                            <h6 class="panel-title text-center">Limit Bulanan</h6>
                                            <div class="clearfix"></div>
                                    </div>
                                    <div>
                                        <div class="cus-sat-stat weight-500 txt-success text-center mt-5">
                                            <img src="/dist/img/Golf.svg">
                                            <h6 class="text-center">{{ $quota }}</h6>
                                        </div>
                                    </div>
                                </div>
                            {{-- Limit Kupon --}}
                                <div class="panel panel-default card-view limit" style="height: 170px;">
                                    <div class="panel-heading">
                                            <h6 class="panel-title text-center">Limit Kupon</h6>
                                            <div class="clearfix"></div>
                                    </div>
                                    <div>
                                        <div class="cus-sat-stat weight-500 txt-success text-center mt-5">
                                            <img src="/dist/img/Golf.svg">
                                            <h6 class="text-center">{{ $quota_kupon }}</h6>
                                        </div>
                                    </div>
                                </div>
                             {{-- Deposit --}}
                                <div class="panel panel-default card-view limit" style="height: 170px;">
                                    <div class="panel-heading">
                                        <h6 class="panel-title text-center">Deposit</h6>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div>
                                        <div class="cus-sat-stat weight-500 txt-success text-center mt-5">
                                            <img src="/dist/img/money.svg">
                                            <h6 class="text-center">IDR {{ number_format($balance, 0, '', '.') }}</h6>
                                        </div>
                                    </div>
                                </div>
    
                    </div>
                    <div class="col-lg-3">
                        {{-- Barcode --}}
                            <div class="panel panel-default card-view b" style="height: 540px;">
                                <div class="panel-heading">
                                    <h6 class="panel-title text-center">Barcode</h6>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="d-flex justify-content-center p">
                                    {{ QrCode::size(180)->generate($visitor->unique_qr) }}
                                </div>
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
                        {{-- tab --}}
                        <ul role="tablist" class="nav nav-pills" id="myTabs_6">
                            <li class="active" role="presentation"><a class="tabs-log" aria-expanded="true"
                                    data-toggle="tab" role="tab" href="#transaction_tabs">Transaksi</a></li>
                            <li role="presentation" class=""><a class="tabs-log" data-toggle="tab" role="tab"
                                    href="#deposit_tabs" aria-expanded="false">Deposit</a></li>
                            <li role="presentation" class=""><a class="tabs-log" data-toggle="tab" role="tab"
                                    href="#limit_tabs" aria-expanded="false">Limit</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card-view p">
                        <div class="tab-content">
                            {{-- transactions --}}
                            <div id="transaction_tabs" class="tab-pane fade active in" role="tabpanel">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <table class="table table-hover" id="dt-tamu-transaksi">
                                                <thead>
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th>Informasi</th>
                                                        <th style="text-align: center;">Status</th>
                                                        <th style="text-align: center;">Tanggal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                    </div>
                                </div>
                            </div>
                            {{-- deposit --}}
                            <div id="deposit_tabs" class="tab-pane fade" role="tabpanel">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table width="100%" class="table table-hover" style="margin: 10px;"
                                            id="dt-tamu-deposit">
                                            <thead>
                                                <tr>
                                                    <th>Saldo</th>
                                                    <th>Informasi</th>
                                                    <th class="text-center">Tipe Pembayaran</th>
                                                    <th class="text-center">Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div id="deposit_tabs" class="tab-pane fade" role="tabpanel">
                                <div class="panel-heading r">
                                    <div class="pull-left">
                                        <h6 class="panel-title txt-dark">Riwayat Deposit</h6>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table width="100%" class="table table-hover" style="margin: 10px;"
                                            id="dt-tamu-deposit">
                                            <thead>
                                                <tr>
                                                    <th>Saldo</th>
                                                    <th>Informasi</th>
                                                    <th style="text-align: center;">Jenis Pembayaran</th>
                                                    <th style="text-align: center;">Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {{-- limit --}}
                            <div id="limit_tabs" class="tab-pane fade" role="tabpanel">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table width="100%" class="table table-hover" style="margin: 10px;"
                                            id="dt-tamu-limit">
                                            <thead>
                                                <tr>
                                                    <th>Informasi</th>
                                                    <th>Tipe</th>
                                                    <th style="text-align: center;">Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
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
@endsection

@push('scripts')
    <script>
        $('.download-kartu-tamu').on("click", function() {
            $('#cetak-kartu').printThis({
                printContainer: true,
            });
        });

        // Transaction Activity
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
                    data: 'order_id',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'information',
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
                targets: [0, 1, 2, 3]
            }]
        });
        // End Of Transaction Activity

        //  Deposit Activity
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
                    data: 'information',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'payment_type',
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
                targets: [0, 1, 2, 3]
            }]
        });
        // Limit Activity
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
                    data: 'information',
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
                targets: [0, 1, 2]
            }]
        });
        // End Of Limit Activity
    </script>
@endpush
