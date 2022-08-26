@extends('Layouts.Main', ['title' => 'TGCC | Daftar Tamu'])
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
                                    {{-- tambah tamu --}}
                                    {{-- <a href="{{ route('tambah-tamu') }}"> --}}
                                    {{-- <a href="{{ route('Tambah-tamu') }}"> --}}
                                    
                                    {{-- <a href="{{ URL('/daftar-tamu.tambahtamu') }}"> --}}
                                    <a href="{{ route('tambah-tamu.create') }}">
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
                                                        {{-- hapus-tamu --}}
                                                        {{-- revisi --}}
                                                        <td style="text-align: center;">
                                                            <a  href="{{ route('daftar-tamu.destroy',$item->id) }}">
                                                                <img src="dist/img/Card-Tamu.svg" alt=""
                                                                ></a>
                                                            <a  href="{{ route('daftar-tamu.edit',$item->id) }}">
                                                                <img src="dist/img/edit.svg" alt=""
                                                                ></a>
                                                            <a  href="{{ route('daftar-tamu.delete',$item->id) }}">
                                                                <img src="dist/img/edit.svg" alt=""
                                                                ></a>
                                                                {{-- pop up script hilang --}}
                                                            {{-- <form action="{{ route('daftar-tamu.destroy',$item->id) }}" method="Post" id="delete-confirm">
                                                                <a class="btn" href="#">
                                                                    <img src="dist/img/Card-Tamu.svg" alt=""
                                                                    style="padding: 2px 7px 2px 2px;"></a>
                                                                <a class="btn" href="{{ route('daftar-tamu.edit',$item->id) }}">
                                                                    <img src="dist/img/edit.svg" alt=""
                                                                    style="padding: 2px 7px 2px 2px;"></a>
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn" style="background-color: white" class="delete-confirm">
                                                                    <img src="dist/img/hapus.svg" alt="Hapus" class="delete-confirm"
                                                                    style="padding: 2px 7px 2px 2px;" ></button>
                                                            </form> --}}

                                                            {{-- <a href="#">
                                                                <img src="dist/img/Card-Tamu.svg" alt=""></a>
                                                            <a href="{{ route('daftar-tamu.edit',$item->id) }}">
                                                                <img src="dist/img/edit.svg" alt=""></a>
                                                            <button type="submit" style="background-color: white" class="delete-confirm">
                                                                <img src="dist/img/hapus.svg" alt="Hapus" class="delete-confirm"></button> --}}


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
    document.querySelector('#delete-confirm').addEventListener('submit', function(e) {
    var form = this;
    e.preventDefault();

    
        swal({
            title: 'Are you sure?',
            text: 'Will be deleted!',
            icon: '{{ asset('warning.png') }}',
            buttons: ["Batal", "Yes!"],
        }).then(function(isConfirm) {
        if (isConfirm) {
            swal({
            title: 'Deleted!',
            text: 'Data berhasil dihapus!',
            icon: 'success'
        }).then(function() {
            form.submit(); 
        });
    } 
    })
    });
</script>
