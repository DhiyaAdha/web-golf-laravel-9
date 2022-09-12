@extends('Layouts.main', ['title' => 'TGCC | Detail Scan'])
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row heading-bg">
                <!-- Breadcrumb -->
                <div class="row">
                    <div class="">
                        <div class="col-lg-8" style="font-size: 20px">
                            Scan Tamu
                        </div>
                        <div class="col-lg-4 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="javascript:void(0)">Dashboard</a></li>
                                <li class="active"><span>Scan Tamu</span></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /Breadcrumb -->
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default card-view" style="height: 550px;">
                        <div class="col-md-auto" style="font-size: 18px">
                            Data Pengunjung
                            {{-- <div class="mt-30 d-flex">
                                <div class="control-label col-lg-3" style="font-size: 16px">
                                    ID Tamu
                                </div>
                                <div class="" style="font-size: 16px">
                                    {{ $visitor->id }}
                                </div>
                            </div> --}}
                            <div class="mt-30 d-flex">
                                <div class="control-label col-lg-3" style="font-size: 16px">
                                    Nama Lengkap
                                </div>
                                <div class="" style="font-size: 16px">
                                    {{ $visitor->name }}
                                </div>
                            </div>
                            <div class="mt-30 d-flex">
                                <div class="control-label col-lg-3" style="font-size: 16px">
                                    Alamat
                                </div>
                                <div class="" style="font-size: 16px">
                                    {{ $visitor->address }}
                                </div>
                            </div>
                            <div class="mt-30 d-flex">
                                <div class="control-label col-lg-3" style="font-size: 16px">
                                    Jenis Kelamin
                                </div>
                                <div class="" style="font-size: 16px">
                                    {{ $visitor->gender }}
                                </div>
                            </div>
                            <div class="mt-30 d-flex">
                                <div class="control-label col-lg-3" style="font-size: 16px">
                                    Nomer Hp
                                </div>
                                <div class="" style="font-size: 16px">
                                    {{ $visitor->phone }}
                                </div>
                            </div>
                            <div class="mt-30 d-flex">
                                <div class="control-label col-lg-3" style="font-size: 16px">
                                    Email
                                </div>
                                <div class="" style="font-size: 16px">
                                    {{ $visitor->email }}
                                </div>
                            </div>
                            <div class="mt-30 d-flex">
                                <div class="control-label col-lg-3" style="font-size: 16px">
                                    Perusahaan
                                </div>
                                <div class="" style="font-size: 16px">
                                    {{ $visitor->company }}
                                </div>
                            </div>
                            <div class="mt-30 d-flex">
                                <div class="control-label col-lg-3" style="font-size: 16px">
                                    Jabatan
                                </div>
                                <div class="" style="font-size: 16px">
                                    {{ $visitor->position }}
                                </div>
                            </div>
                            <div class="mt-30 d-flex">
                                <div class="control-label col-lg-3" style="font-size: 16px">
                                    Kategori Tamu
                                </div>
                                <div class="" style="font-size: 16px">
                                    @if ($visitor->tipe_member == 'VIP') 
                                        <span class='label label-success'>{{ $visitor->tipe_member }}</span>
                                    @else 
                                        <span class='label label-warning'>{{ $visitor->tipe_member }}</span>
                                    
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-default card-view" style="height: 380px;">
                        <h5 style="text-align: center;" class="mt-15 mb-5">Sisa Limit dan Deposit <strong>{{ $visitor->name }}</strong></h5>
                        <div class="col-lg-14">
                            <div class="label-pembayaran-hijau">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p style="color:white;">Deposit</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-3 col-sm-3">
                                        <h4 style="text-align:start; font-weight:500; color:white;">Rp</h4>
                                    </div>
                                    <div class="col-lg-6 col-md-3 col-sm-3">
                                        <h4 style="text-align:right; font-weight:500; color:white;">{{ formatrupiah($deposit->balance) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container col-lg-6 mt-5 d-flex">
                            <div class="label-pembayaran-hitam">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p style="color:white;">Limit Kupon</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <h4 style="text-align:start; font-weight:500; color:white;">0</h4>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <h4 style="text-align:right; font-weight:500; color:white;"></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container col-lg-6 mt-5">
                            <div class="label-pembayaran-hitam">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p style="color:white;">Limit Bulanan</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-3 col-sm-3">
                                        <h4 style="text-align:start; font-weight:500; color:white;">{{ $log_limit->quota }}</h4>
                                    </div>
                                    <div class="col-lg-6 col-md-3 col-sm-3">
                                        <h4 style="text-align:right; font-weight:500; color:white;"></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mt-10">
                                <div class="btn-deposit">
                                    <a href="#">
                                        <h6 style="color: #01c853;">Deposit</h6>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mt-10">
                                <div class="btn-proses">
                                    <a href="/proses">
                                        <h6 style="color: #ffffff;">Proses</h6>
                                    </a>
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
@endsection