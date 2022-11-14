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
    <script defer src="{{ asset('dist/asset_offline/list_member.js') }}"></script>
@endpush