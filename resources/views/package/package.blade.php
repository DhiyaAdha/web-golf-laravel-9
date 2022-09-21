@extends('Layouts.Main', ['title' => 'TGCC | Paket Bermain'])
@section('content')
    <!-- Main Content -->
    <div class="page-wrapper">
        <div class="container-fluid">
            <!-- Title -->
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Daftar Paket</h5>
                </div>
                <!-- Breadcrumb -->
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('analisis-tamu') }}">Dashboard</a></li>
                        <li class="active"><span>Daftar paket</span></li>
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
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Daftar Paket</h6>
                            </div>
                            <div class="pull-right">
                                <div class=" pull-left">
                                    <a href="{{ route('package.create') }}" type="submit"
                                        class="btn btn-xs btn-success">Tambah
                                        Paket</a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0" id="dt-package">
                                            <thead>
                                                <tr>
                                                    <th class="table-th">Nama Produk</th>
                                                    <th class="table-th">Kategori</th>
                                                    <th class="table-th">Harga Weekdays</th>
                                                    <th class="table-th">Harga Weekend</th>
                                                    <th class="table-th">Status</th>
                                                    <th class="table-th">Opsi</th>
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
        /* data package */
        $('#dt-package').DataTable({
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
                "url": "{{ route('package.index') }}",
                "type": "GET",
                "datatype": "json"
            },
            "render": $.fn.dataTable.render.text(),
            "columns": [{
                    "data": function(data) {
                        return data.name
                    }
                },
                {
                    "data": function(data) {
                        return `<span class="label ${data.category == 'default' ? 'label-primary' : 'label-danger'}">${data.category}</span>`;
                    }
                },
                {
                    "data": function(data) {
                        return `<p>Rp ${data.price_weekdays}</p>`;
                    }
                },
                {
                    "data": function(data) {
                        return `<p>Rp ${data.price_weekend}</p>`;
                    }
                },
                {
                    "data": function(data) {
                        if (data.status == 0) {
                            return `<div class="checkbox checkbox-success checkbox-circle">
                                    <input id="checkbox-10" type="checkbox" disabled checked="" data-toggle="tooltip" data-placement="top" title="ON">
                                    <label for="checkbox-10"></label>
                                </div>`;
                        } else {
                            return `<div class="checkbox checkbox-danger checkbox-circle">
                                    <input id="checkbox-12" type="checkbox" disabled checked=""data-toggle="tooltip" data-placement="top" title="OFF">
                                    <label for="checkbox-12"></label>
                                </div>`;
                        }
                    }
                },
                {
                    "data": "action"
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
                orderable: false,
                targets: [0, 1, 2, 3, 4, 5, ]
            }],
        });
        /* data package */

        /* delete package */
        $(document).on('click', '.delete', function() {
            id = $(this).attr('id');
            var url = "{{ route('package.destroy', ':id') }}";
            url = url.replace(':id', id);
            swal({
                title: "Anda yakin ingin menghapus paket ini?",
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
                                $('#dt-package').DataTable().ajax.reload(null, false);
                            });

                            window.setTimeout(function() {
                                $.toast({
                                    text: 'Product berhasil dihapus permanen',
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
                    swal("Dibatalkan", "Paket Tidak Dihapus", "error");
                }
            });
            return false;
        });
        /* delete package */
    </script>
@endpush
