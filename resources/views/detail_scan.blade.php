@extends('Layouts.main', ['title' => 'TGCC | Detail Scan'])
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Scan tamu</h5>
                </div>
                <!-- Breadcrumb -->
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('analisis-tamu') }}">Dashboard</a></li>
                        <li><a href="{{ url('scan-tamu') }}">Scan Tamu</a></li>
                        <li class="active"><span>Detail Tamu</span></li>
                    </ol>
                </div>
                <!-- /Breadcrumb -->
            </div>
            <div class="row">
                <div class="col-lg-7 col-md-7">
                    <div class="panel panel-default panel-dropdown card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Data Tamu</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="user-others-details">
                                    <div class="mb-15 d-flex">
                                        <div class="col-medium-3">
                                            <span class="txt-muted">Nama Lengkap</span>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <span>{{ $visitor->name }}</span>
                                        </div>
                                    </div>
                                    <div class="mb-15 d-flex">
                                        <div class="col-medium-3">
                                            <span class="txt-muted">Jenis Kelamin</span>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <span>{{ $visitor->gender }}</span>
                                        </div>
                                    </div>
                                    <div class="mb-15 d-flex">
                                        <div class="col-medium-3">
                                            <span class="txt-muted">Email</span>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <span>{{ $visitor->email }}</span>
                                        </div>
                                    </div>
                                    <div class="mb-15 d-flex">
                                        <div class="col-medium-3">
                                            <span class="txt-muted">No Hp</span>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <span>{{ $visitor->phone }}</span>
                                        </div>
                                    </div>
                                    <div class="mb-15 d-flex">
                                        <div class="col-medium-3">
                                            <span class="txt-muted">Perusahaan</span>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <span>{{ $visitor->company }}</span>
                                        </div>
                                    </div>
                                    <div class="mb-15 d-flex">
                                        <div class="col-medium-3">
                                            <span class="txt-muted">Jabatan</span>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <span>{{ $visitor->position }}</span>
                                        </div>
                                    </div>
                                    <div class="mb-15 d-flex">
                                        <div class="col-medium-3">
                                            <span class="txt-muted">Kategori Tamu</span>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <span
                                                class="{{ $visitor->tipe_member == 'VIP' ? 'label label-success' : 'label label-warning' }}">{{ $visitor->tipe_member }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5">
                    <div class="panel panel-default panel-dropdown card-view">
                        <div class="panel-heading d-flex justify-content-start k">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Sisa Limit dan Saldo
                                    <strong>{{ $visitor->name }}</strong>
                                </h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="panel-green">
                                    <div class="d-flex flex-column color-white">
                                        Saldo
                                        <div class="mt-15">
                                            <div class="pull-left">
                                                <strong>Rp</strong>
                                            </div>
                                            <div class="pull-right">
                                                <strong>
                                                    {{ formatrupiah($deposit->balance) ?? 'None' }}
                                                </strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between flex-wrap mt-15">
                                    <div class="panel-black mb-15">
                                        <div class="d-flex flex-column color-white">
                                            Limit Kupon
                                            <div class="mt-15">
                                                <div class="pull-left">
                                                    <strong>
                                                        {{ $log_limit->quota_kupon ?? 'None' }}
                                                    </strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-black mb-15">
                                        <div class="d-flex flex-column color-white">
                                            Limit Bulanan
                                            <div class="mt-15">
                                                <div class="pull-left">
                                                    <strong>
                                                        {{ $log_limit->quota ?? 'None' }}
                                                    </strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="javascript:void(0)" class="btn btn-block btn-outline-success btn-sm"
                                    data-toggle="modal" data-target="#myModal">Deposit</a>
                                <a href="{{ URL::temporarySignedRoute('order.cart', now()->addMinutes(10), ['id' => $visitor->id]) }}"
                                    class="btn btn-block btn-success btn-sm" target="_blank">Pilih paket bermain</a>
                            </div>
                            <div id="myModal" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">×</button>
                                            <h5 class="modal-title" id="myModalLabel">
                                                {{ $deposit->balance == 0 ? 'Tambah Deposit' : 'Update Deposit' }}</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ URL::signedRoute('update.deposit', ['id' => $visitor->id]) }}"
                                                method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <div class="input-group-dropdown">
                                                        <select name="payment_type" id="payment_type" class="form-control" required>
                                                            <option disabled selected value="">Pilih Pembayaran</option>
                                                            <option value="Cash" name="payment_type" id="payment_type">Cash</option>
                                                            <option value="Transfer" name="payment_type" id="payment_type">Transfer</option>
                                                        </select>
                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">Rp</div>
                                                        <input type="text" min="0"
                                                            onkeypress="return event.charCode >= 48 && event.charCode <=57"
                                                            class="form-control" name="balance"
                                                            placeholder="Masukan jumlah deposit" required>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-success btn-anim">
                                                    <i class="icon-rocket"></i>
                                                    <span class="btn-text">submit</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('Layouts.Footer')
        </div>
    </div>
@endsection
