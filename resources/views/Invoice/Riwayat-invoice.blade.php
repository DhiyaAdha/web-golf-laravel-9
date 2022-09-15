@extends('Layouts.Main', ['title' => 'TGCC | Invoice'])
@section('content')
    <!-- Main Content -->
    <div class="page-wrapper">
        <div class="container-fluid">
            <!-- Title -->
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Daftar invoice</h5>
                </div>
                <!-- Breadcrumb -->
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('analisis-tamu') }}">Dashboard</a></li>
                        <li class="active"><span>Daftar invoice</span></li>
                    </ol>
                </div>
                <!-- /Breadcrumb -->
            </div>
            <!-- /Title -->

            <div class="row">
                <!-- Basic Table -->
                <div class="col-sm-12">
                    <div class="panel panel-default card-view">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Invoice</h6>
                        </div>
                        <div class="clearfix"></div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table mb-0" id="dt-riwayat">

                                            <thead>
                                                <tr>
                                                    <th class="" style="">Nama</th>
                                                    <th class="" style="">Kategori Tamu</th>
                                                    <th class="" style="">Total Bayar</th>
                                                    <th class="" style="">Tanggal Bayar</th>
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
                <!-- /Basic Table -->

            </div>
        </div>
        <!-- Footer -->
        @include('Layouts.Footer')
        <!-- /Footer -->
    </div>
    <!-- /Main Content -->
@endsection
@push('scripts')
    <script>
        /* daftar invoice */
        $('#dt-riwayat').DataTable({
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
                "url": "{{ route('riwayat-invoice.index') }}",
                "type": "GET",
                "datatype": "json"
            },
            "render": $.fn.dataTable.render.text(),
            "columns": [{
                    data: 'name'
                },
                {
                    "data": function(data) {
                        return `<span class="label ${data.tipe_member == 'VIP' ? 'label-success' : 'label-warning'}">${data.tipe_member}</span>`;
                    }
                },
                {
                    data: 'total'
                },
                {
                    data: 'created_at'
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
                targets: [1, 2, 3]
            }, {
                orderable: false,
                targets: [0, 1, 2, 3]
            }],
        });
        /* daftar invoice */
    </script>
@endpush
