    @extends('Layouts.Main')
    @section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row heading-bg">
                @include('Layouts.Breadcrumb')
                <div class="row" style="padding: 20px 25px 1px 25px">
                    <div class="col-sm-12">
                        <div class="panel panel-default card-view">
                            <div class="panel-heding">
                                {{-- <div class="clearfix"></div> --}}
                                <div class="row">
                                    <div class="col-lg-10 mt-15">
                                        <h6 style="margin-left: -20px;">Daftar Admin</h6>
                                    </div>
                                    <div class="col-lg-2 mt-10" style="text-align: end; padding: 5px 30px 0px 5px;">
                                        <a href="{{ route('tambah-admin') }}">
                                            <i class="fa-2x fa-plus" style="margin-right: 10px;"></i></a>
                                        <div class="row">
                                            <!-- <div class="col-lg-0"></div> -->
                                            <!-- <div class="col-lg-4">
                                                <div class="boxcontainer">
                                                    <table class="elementcontainer">
                                                        <tr>
                                                            <td>
                                                                <input type="text" placeholder="search" class="search">
                                                            </td>
                                                            <td>
                                                                <a href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-bodi">
                                    <div class="table-wrap mt-40">
                                        <div class="table-responsive">
                                            <table class="table mb-0" id="dt-admin">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>Email</th>
                                                        <th>Nomer hp</th>
                                                        <th style="text-align: center;">Kategori Admin</th>
                                                        <th style="text-align: center;">Aksi</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- history aktifitas -->
                <div class="row" style="padding: 1px 25px">
                    <div class="col-sm-12">
                        <div class="panel panel-default card-view">
                            <div class="panel-heading">
                                {{-- <div class="clearfix"></div> --}}
                                <div class="row">
                                    <div class="col-lg-10 mt-15">
                                        <h6 style="margin-left: 20px;">history aktifitas</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-bodi">
                                    <div class="table-wrap mt-20">
                                        <div class="table-responsive">
                                            <table class="table mb-0" id="dt-admin">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center;">Role</th>
                                                        <th>Nama Admin</th>
                                                        <th>Informasi</th>
                                                        <th style="text-align: center;">Status</th>
                                                        <th style="text-align: center;">Tanggal</th>
                                                    </tr>
                                                </thead>
                                                <!--  -->
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
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.delete').click(function(event) {
            var daftaradmin = $(this).attr('')
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true, 
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });
        });
    </script>
    @endsection