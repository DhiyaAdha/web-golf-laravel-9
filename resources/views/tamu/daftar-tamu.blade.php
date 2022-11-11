@extends('layouts.main', ['title' => 'TGCC | Daftar Tamu'])
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Daftar Tamu</h5>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('analisis-tamu') }}">Dashboard</a></li>
                        <li class="active"><span>Daftar Tamu</span></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <a href="{{ route('tambah-tamu') }}" class="btn btn-xs btn-success" style="margin-bottom: 20px;">Tambah Tamu</a>
                            </div>
                            <div class="pull-right">
                                <div class="d-flex">
                                    <span class="mr-5" style="right: 420px; top: 27px; position: responsive; margin-top: 4px;">Filter satuan</span>
                                    <div class="form-group mr-5">
                                        <select class="form-control" style="height: 32px" id="filter-data" name="category">
                                            <option selected disabled>Kategori</option>
                                            @foreach($category as $ct)
                                                <option class="text-capitalize" value="{{ $ct }}">{{ $ct }}</option>
                                            @endforeach
                                        </select>
                                    </div>	
                                    <div class="form-group mr-5">
                                        <select class="form-control" style="height: 32px" id="filter-data" name="type">
                                            <option selected disabled>Jenis member</option>
                                            @foreach($types as $type)
                                                <option class="text-capitalize" value="{{ $type }}">{{ $type == 'VIP' ? 'member' : 'VIP' }}</option>
                                            @endforeach
                                        </select>
                                    </div>	
                                    <div class="form-group mr-5">
                                        <select class="form-control" style="height: 32px" id="filter-data" name="status">
                                            <option selected disabled>Status</option>
                                            @foreach($status as $st)
                                                <option class="text-capitalize" value="{{ $st }}">{{ $st == 'active' ? 'aktif' : 'non aktif' }}</option>
                                            @endforeach
                                        </select>
                                    </div>	
                                    @if (auth()->user()->role_id == '2')
                                    <a href="{{ url('export_excel_tamu') }}" target="_blank" name="excel" data-toggle="tooltip" data-placement="top" title="Download Excel">
                                        <img src="dist/img/excel.svg" width="25px" height="25px">
                                    </a>
                                    @endif
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div style="position: absolute; padding-top: 5px">
                                    <h6 class="panel-title txt-dark mr-5" style="margin-top: 4px;">Daftar Tamu</h6>
                                </div>
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-hover" id="dt-tamu">
                                            <thead>
                                                <tr>
                                                    <th class="" style="margin-left: 20px;">Nama</th>
                                                    <th class="">Email</th>
                                                    <th class="">Jenis member</th>
                                                    <th class="">Status</th>
                                                    <th class="">Masa habis</th>
                                                    <th class="" style="text-align: center">Opsi</th>
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
            @include('layouts.footer')
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).on("change", "#filter-data", function(e) {
            // member.column($(this).data('column')).search($(this).val()).draw();
            var filter_data = [];
            var option = $(this).find(':selected');
            var url = window.location.href;

            $.each(option, function(index, value) {
                filter_data.push(option.val());
            });

            var param = filter_data.join(","); 
            if(param != "") {
                if (url.indexOf('?') > -1) {
                    url += '&filter='+param
                } else {
                    url += '?filter='+param
                }
            }

            var EndUrl = url.split("?")[1];
            if(EndUrl != "") {
                $('#dt-tamu').DataTable().ajax.url("/daftar-tamu?"+EndUrl).load();
            } else {
                $('#dt-tamu').DataTable().ajax.url("/daftar-tamu").load();
            }
        });
        /* data tamu */
        var member = $('#dt-tamu').DataTable({
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
                },
                {
                    data: 'email',
                },
                {
                    "data": function(data) {
                        if (data.tipe_member == 'VIP') {
                            return `<span class='label label-success'>${data.tipe_member == 'VIP' ? 'Member' : 'VIP'}</span>`;
                        } else {
                            return `<span class='label label-warning'>${data.tipe_member == 'VVIP' ? 'VIP' : 'Member'}</span>`;
                        }
                    }
                },
                {
                    "data": function(data) {
                        return data.status == 'active' ? 'Aktif' : 'Non Aktif'
                    }
                },
                {
                    "data": function(data) {
                        return data.expired_date;
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
                // 
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
                    targets: [0, 1, 2, 3, 4,5]
                },
                {
                    className: 'text-center',
                    targets: [4]
                }, {
                    width: '25%',
                    targets: [0,1, 5]
                }, {
                    width: '12%',
                    targets: [2, 3, 4]
                }
            ]
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
                confirmButtonText: "Hapus Tamu",
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