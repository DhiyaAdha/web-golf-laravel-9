@extends('Layouts.Main')
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <!-- Title -->
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Daftar Admin</h5>
                </div>
                <!-- Breadcrumb -->
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('daftar-admin') }}">Dashboard</a></li>
                        <li class="active"><span>Daftar Admin</span></li>
                    </ol>
                </div>
                <!-- /Breadcrumb -->
            </div>
            <!-- /Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Daftar Paket</h6>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('tambah-admin') }}" class="btn btn-xs btn-success">Tambah
                                    Admin</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-hover" id="dt-admin">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Nomer hp</th>
                                                    <th>Kategori Admin</th>
                                                    <th>Aksi</th>
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
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Riwayat Aktifitas</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-hover" id="dt-aktifitas">
                                            <thead>
                                                <tr>
                                                    <th>Role</th>
                                                    <th>Nama</th>
                                                    <th>Informasi</th>
                                                    <th>Status</th>
                                                    <th>Tanggal</th>
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
    </div>
@endsection
@push('scripts')
    <script>
        /* daftar admin */
        $('#dt-admin').DataTable({
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
                "url": "{{ route('daftar-admin') }}",
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
                    data: 'email',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'phone',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'role',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'action',
                    searchable: false,
                    orderable: false
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
                className: 'text-left',
                targets: [0, 1, 2, 3]
            }, {
                orderable: false,
                targets: [0, 1, 2, 3]
            }],
        });
        /* daftar admin */

        /* delete admin */
        $(document).on('click', '.delete-admin', function() {
            id = $(this).attr('id');
            swal({
                title: "Anda yakin ingin menghapus admin ini?",
                imageUrl: "../img/Warning.svg",
                showCancelButton: true,
                confirmButtonColor: "#FF2A00",
                confirmButtonText: "Hapus admin",
                cancelButtonText: "Batal",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "/daftar-admin/destroy/" + id,
                        beforeSend: function() {
                            $('#ok_button').text('Hapus Data');
                        },
                        success: function(data) {
                            setTimeout(function() {
                                $('#confirmModal').modal('hide');
                                $('#dt-admin').DataTable().ajax.reload(null, false);
                            });

                            window.setTimeout(function() {
                                $.toast({
                                    text: 'Data admin berhasil dihapus',
                                    position: 'top-right',
                                    loaderBg: '#fec107',
                                    icon: 'success',
                                    hideAfter: 2000,
                                    stack: 6
                                });
                            }, 1000);
                            swal("Terhapus!", "", "success");
                        }
                    })
                } else {
                    swal("Dibatalkan", "", "error");
                }
            });
            return false;
        });
        /* delete admin */

        /* data aktifitas */
        $('#dt-aktifitas').DataTable({
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
                "url": "{{ route('admin.aktifitas') }}",
                "type": "GET",
                "datatype": "json"
            },
            "render": $.fn.dataTable.render.text(),
            "columns": [{
                    data: 'role',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'user_name',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'information',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'status_action',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'date_activity',
                    searchable: true,
                    orderable: false
                }
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
                className: 'text-left',
                targets: [1, 2, 3, 4]
            }],
        });
        /* data aktifitas */
    </script>
@endpush
