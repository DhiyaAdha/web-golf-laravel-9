@extends('Layouts.Main', ['title' => 'TGCC | Daftar Tamu'])
@section('content')
    <!-- Main Content -->
    <div class="page-wrapper">
        <div class="container-fluid">
            <!-- Title -->
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Daftar Tamu</h5>
                </div>
                <!-- Breadcrumb -->
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('analisis-tamu') }}">Dashboard</a></li>
                        <li class="active"><span>Daftar Tamu</span></li>
                    </ol>
                </div>
                <!-- /Breadcrumb -->
            </div>
            <!-- /Title -->

            <div class="row">
                <!-- Basic Table -->
                <div class="col-sm-12">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-right" >
                                <a href="{{ url('export_excel_tamu') }}" target="_blank" name="excel" data-toggle="tooltip" data-placement="top" title="Download Excel">
                                    <img src="dist/img/excel2.svg" width="25px" height="25px">
                                </a>
                            </div>
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Daftar Tamu</h6>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('tambah-tamu') }}" class="btn btn-xs btn-success">Tambah
                                    Tamu</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-hover" id="dt-tamu">
                                            <thead>
                                                <tr>
                                                    <th class="" style="margin-left: 20px;">Nama</th>
                                                    <th class="">Email</th>
                                                    <th class="">Phone</th>
                                                    <th class="">Tipe</th>
                                                    <th class="">Opsi</th>
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
            @include('Layouts.Footer')
        </div>
    </div>
    <!-- /Main Content -->
@endsection
@push('scripts')
    <script>
        /* data tamu */
        $('#dt-tamu').DataTable({
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
                "url": "{{ route('daftar-tamu') }}",
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
                    "data": function(data) {
                        if (data.tipe_member == 'VIP') {
                            return `<span class='label label-success'>${data.tipe_member}</span>`;
                        } else {
                            return `<span class='label label-warning'>${data.tipe_member}</span>`;
                        }
                    }
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
                targets: [0, 1, 2, 3, 4]
            }],
        });
        /* data tamu */

        /* delete tamu */
        $(document).on('click', '.delete-confirm', function() {
            id = $(this).attr('id');
            var url = "{{ route('hapus-tamu', ':id') }}";
            url = url.replace(':id', id);
            swal({
                title: "Anda yakin ingin menghapus tamu ini?",
                imageUrl: "../img/Warning.svg",
                showCancelButton: true,
                confirmButtonColor: "#FF2A00",
                confirmButtonText: "Hapus paket",
                cancelButtonText: "Batal",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: url,
                        beforeSend: function() {
                            $('#ok_button').text('Hapus Data');
                        },
                        success: function(data) {
                            setTimeout(function() {
                                $('#confirmModal').modal('hide');
                                $('#dt-tamu').DataTable().ajax.reload(null, false);
                            });

                            window.setTimeout(function() {
                                $.toast({
                                    text: 'Data berhasil dihapus',
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
        /* delete tamu */
    </script>
@endpush
