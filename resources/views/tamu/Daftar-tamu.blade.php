@extends('Layouts.Main', ['title' => 'TGCC | Daftar Tamu'])

@section('content')
    @include('sweetalert::alert')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row heading-bg">
                <div class="row">
                    <div class="container-fluid">
                        <div class="col-lg-8">
                            <h5>Daftar-Tamu</h5>
                        </div>
                        <div class="col-lg-4 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="javascript:void(0)">Dashboard</a></li>
                                <li class="active"><span>Daftar-Tamu</span></li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="row" style="padding: 2px 10px 10px 10px">
                    <div class="col-sm-12">
                        <div class="panel panel-default card-view">
                            <div class="panel-heding">
                                {{-- <div class="clearfix"></div> --}}
                                <div class="row">
                                    <div class="col-lg-10">
                                        <h6>Daftar Tamu</h6>
                                    </div>
                                    <div class="col-lg-2" style="text-align: end;">
                                        <a href="">
                                            <i class="fa-2x zmdi zmdi-fullscreen"
                                                style="border: 0px solid silver; border-radius: 0.25em; padding: 0.5em;"></i>
                                        </a>
                                        <a href="{{ route('tambah-tamu') }}">
                                            <i class="fa-2x fa-plus"></i>
                                        </a>
                                        <div class="row">
                                            <div class="col-lg-0"></div>
                                            <div class="col-lg-4">
                                                <div class="boxcontainer">
                                                    <table class="elementcontainer">
                                                        <tr>
                                                            <td>
                                                                <input type="text" placeholder="search" class="search">
                                                            </td>
                                                            <td>
                                                                <a href="#"><i
                                                                        class="fa-solid fa-magnifying-glass"></i></a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div class="table-wrap mt-1">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>Email</th>
                                                        <th style="text-align: center;">Nomer hp</th>
                                                        <th style="text-align: center;">Kategori Tamu</th>
                                                        <th style="text-align: center;">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($visitor as $item)
                                                        <tr>
                                                            <td>{{ $item->name }}</td>
                                                            <td>{{ $item->email }}</td>
                                                            <td style="text-align: center;">{{ $item->phone }}</td>
                                                            <td style="text-align: center;">

                                                                @if ($item->tipe_member == 'VVIP')
                                                                    <span class="label label-vvip">VVIP</span>
                                                                @else
                                                                    <span class="label label-vip">VIP</span>
                                                                @endif

                                                            </td>
                                                            <td style="text-align: center;">
                                                                <a href="{{ route('generate', $item->id) }}">
                                                                    <img src="dist/img/Card-Tamu.svg" alt=""
                                                                        style="padding: 2px 7px 2px 2px;">
                                                                </a>
                                                                <a href="/edit-tamu">
                                                                    <img src="dist/img/edit.svg" alt=""
                                                                        style="padding: 2px 7px 2px 2px;">
                                                                </a>
                                                                <a href="/daftar-tamu/hapus/{{ $item->id }}"
                                                                    class="delete-confirm">
                                                                    <img src="dist/img/hapus.svg" alt="Hapus"
                                                                        style="padding: 2px 7px 2px 2px;">
                                                                </a>


                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>

                                            </table>
                                            {{ $visitor->links() }}
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
        $('.delete-confirm').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Are you sure?',
                text: 'This record and it`s details will bes deleted!',
                icon: '{{ asset('warning.png') }}',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    window.location.href = url;
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                }
            });
        });
    </script>
@endsection
