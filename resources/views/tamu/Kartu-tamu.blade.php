@extends('Layouts.Main', ['title' => 'TGCC | Daftar Tamu'])
@section('content')
        <div class="container-fluid">
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Detail tamu</h5>
                </div>
                <!-- Breadcrumb -->
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0)">Dashboard</a></li>
                        <li><a href="javascript:void(0)">Daftar tamu</a></li>
                        <li class="active"><span>Detail tamu</span></li>
                    </ol>
                </div>
                <!-- /Breadcrumb -->
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
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
                                                                    <h6 class="panel-title txt-dark label-visitor">
                                                                        country & club</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="panel-wrapper collapse in">
                                                        <div class="panel-body card">
                                                            <div class="d-flex justify-content-center align-items-center bg-front">
                                                                <div class="pull-left">
                                                                    <img class="front-qr" src="{{ asset('/dist/img/icon-golf1.svg') }}">
                                                                </div>
                                                                <div class="pull-right">
                                                                    <img class="front-qr" src="{{ asset('/dist/img/icon-golf2.svg') }}">
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
                                                                        {{ QrCode::size(120)->generate($visitor->id) }}
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <img class="align-self-end img-footer" src="{{ asset('/dist/img/golf-footer.svg') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-card d-flex justify-content-center mb-10">
                                                <div class="panel panel-default card-view card-visitor">
                                                    <div class="panel-heading wave">
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
                                                            <div class="d-flex justify-content-center align-items-center flex-column">
                                                                <img class="back-qr" src="{{ asset('/dist/img/icon-golf1.svg') }}">
                                                                <div class="qr-code-visitor">
                                                                    {{ QrCode::size(120)->generate($visitor->id) }}
                                                                </div>
                                                            </div>
                                                            <img class="align-self-end img-footer" src="{{ asset('/dist/img/golf-footer.svg') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn download-kartu-tamu"><i
                                                    class="fa fa-download"></i> Cetak Kartu</button>

                                        </div>
                                        <button type="button" class="btn download-kartu-tamu"><i class="fa fa-download"></i> Download Kartu (PDF)</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="panel panel-default card-view p">
                        <div class="panel-heading">
                            <h6 class="panel-title text-center">Limit bulanan</h6>
                            <div class="clearfix"></div>
                        </div>
                        <div class="cus-sat-stat weight-500 txt-success text-center mt-5">
                            <img src="/dist/img/Golf.svg">
                            <h6 class="text-center">{{ $quota }}</h6>
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
                <div class="col-lg-3 col-md-3">
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
            <div class="col-lg-3 col-md-4 col-sm-3 col-xs-12">
                <div class="panel panel-default card-view p">
                    <div class="panel-heading">
                        <h6 class="panel-title text-center">Limit bulanan</h6>
                        <div class="clearfix"></div>
                    </div>
                    <div class="cus-sat-stat weight-500 txt-success text-center mt-5">
                        <img src="/dist/img/Golf.svg">
                        <h6 class="text-center">{{ $quota }}</h6>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card-view p">
                        <div class="tab-content">
                            {{-- transactions --}}
                            <div id="transaction_tabs" class="tab-pane fade active in" role="tabpanel">
                                <div class="panel-heading r">
                                    <div class="pull-left">
                                        <h6 class="panel-title txt-dark">Riwayat Transaksi</h6>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table table-hover" style="margin: 10px;">
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
                            {{-- <div id="deposit_tabs" class="tab-pane fade" role="tabpanel">
                                <div class="panel-heading r">
                                    <div class="pull-left">
                                        <h6 class="panel-title txt-dark">Riwayat Deposit</h6>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table width="100%" class="table table-hover" style="margin: 10px;" id="dt-tamu-deposit">
                                            <thead>
                                            <tr>
                                                    <th>Saldo</th>
                                                    <th>Informasi</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> --}}

                            <div id="deposit_tabs" class="tab-pane fade" role="tabpanel"> <div class="panel-heading r">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark">Riwayat Deposit</h6>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table width="100%" class="table table-hover" style="margin: 10px;" id="dt-tamu-deposit">
                                            <thead>
                                                <tr>
                                                    <th>Saldo</th>
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

                            {{-- limit --}}
                            <div id="limit_tabs" class="tab-pane fade" role="tabpanel">
                                <div class="panel-heading r">
                                    <div class="pull-left">
                                        <h6 class="panel-title txt-dark">Riwayat Limit</h6>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table table-hover" style="margin: 10px;">
                                            <thead>
                                                {{-- Table head --}}
                                                <tr>
                                                    <th>Belance</th>
                                                    <th>Informasi</th>
                                                    <th style="text-align: center;">Status</th>
                                                    <th style="text-align: center;">Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- @foreach ($limit as $item)
                                                <tr>
                                                    <td> {{ $item->id }}</td>
                                                    <td> telah {{ $item->quota }}</td>
                                                    <td> {{ $item->report_deposit->payment_type }} </td>
                                                    {{ $school->students->first_name }}
                                                    <td> {{ $item->updated_at }} </td>
                                                </tr>
                                            @endforeach  --}}
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
@push('scripts')
    <script>
        $('.download-kartu-tamu').on("click", function() {
            $('#cetak-kartu').printThis({
                printContainer: true,
            });
        });
        $('#dt-tamu-deposit').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthChange": false,
            "bDestroy": true,
            "searching": true,
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
                targets: [1, 2, 3]
            }]
        });

    </script>
@endpush

