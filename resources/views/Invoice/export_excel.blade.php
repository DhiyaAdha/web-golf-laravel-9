<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export Riwayat Invoice</title>
</head>

<body>
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
                                            <th class="" style="">Action</th>
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
    <!-- /Footer -->
    </div>
    <!-- /Main Content -->
</body>

</html>
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
                "url": "{{ route('export_excel.export_excel') }}",
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
                {
                    data: 'action'
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
                targets: [1, 2, 3, 4]
            }, {
                orderable: false,
                targets: [0, 1, 2, 3, 4]
            }],
        });
        /* daftar invoice */
    </script>
@endpush
