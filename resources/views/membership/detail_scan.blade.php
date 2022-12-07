@extends('layouts.main', ['title' => 'TGCC | Detail Scan'])
@section('content')
    <div class="page-wrapper intro-foo">
        <div class="container-fluid" data-title="Halaman Detail Scan" data-intro="Halaman ini memberikan informasi data membership yang sudah melakukan verifikasi dengan scan atau no hp.">
            <div class="row heading-bg" >
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Scan tamu</h5>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('analisis-tamu') }}">Dashboard</a></li>
                        <li><a href="{{ url('scan-tamu') }}">Scan Tamu</a></li>
                        <li class="active"><span>Detail Tamu</span></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 col-md-7">
                    <div class="panel panel-default panel-dropdown card-view" data-title="Data Tamu" data-intro="Panel ini memberikan informasi detail membership tgcc, menampilkan nama lengkap, jenis kelamin, email, kode membership, perusahaan, jabatan, jenis member dan kategori member.">
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
                                            <span class="text-capitalize">{{ $visitor->gender }}</span>
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
                                            <span class="txt-muted">Nomor Hp</span>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <span>{{ $visitor->phone }}</span>
                                        </div>
                                    </div>
                                    <div class="mb-15 d-flex">
                                        <div class="col-medium-3">
                                            <span class="txt-muted">Kode Member</span>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <span>{{ $visitor->code_member }}</span>
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
                                            <span class="txt-muted">Jenis Member</span>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <span class="{{ $visitor->tipe_member == 'VIP' ? 'label label-success' : 'label label-warning' }}">{{ $visitor->tipe_member == 'VIP' ? 'Member' : 'VIP' }}</span>
                                        </div>
                                    </div>
                                    <div class="mb-15 d-flex">
                                        <div class="col-medium-3">
                                            <span class="txt-muted">Kategori</span>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <span class="text-capitalize">{{ $visitor->category }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5">
                    <div class="panel panel-default panel-dropdown card-view" style="height: 415px;" data-title="Sisa Limit & Saldo" data-intro="Panel ini memberikan informasi detail limit dan saldo membership tgcc, tamu bisa melakukan tambah deposit atau pilih paket bermain. ">
                        <div class="panel-heading d-flex justify-content-start k">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Sisa Limit dan Saldo
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
                                    <div class="panel-black1 mb-15">
                                        <div class="d-flex flex-column color-white">
                                            Limit Kupon
                                            <div class="mt-15">
                                                <div class="pull-left">
                                                    <strong>
                                                        {{ $log_coupon->quota_kupon ?? '0' }}
                                                    </strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-black2 mb-15">
                                        <div class="d-flex flex-column color-white">
                                            Limit Bulanan
                                            <div class="mt-15">
                                                <div class="pull-left">
                                                    <strong>
                                                        {{ $log_limit->quota ?? '0' }}
                                                    </strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-40">
                                    @if($visitor->expired_date <= \Carbon\Carbon::now())
                                    <a href="javascript:void(0)" class="btn btn-block btn-outline-success btn-sm" id="expired_date">Deposit</a>
                                    <a href="javascript:void(0)" class="btn btn-block btn-success btn-sm" id="expired_date">Pilih paket bermain</a>
                                @elseif ($visitor->status == 'inactive')
                                    <a href="javascript:void(0)" class="btn btn-block btn-outline-success btn-sm" id="nonactive">Deposit</a>
                                    <a href="javascript:void(0)" class="btn btn-block btn-success btn-sm" id="nonactive">Pilih paket bermain</a>
                                @else
                                    <a href="javascript:void(0)" class="btn btn-block btn-outline-success btn-sm" data-toggle="modal" data-target="#myModal">Deposit</a>
                                    <a href="{{ URL::signedRoute('order.cart', ['id' => $visitor->id]) }}" class="btn btn-block btn-success btn-sm">Pilih paket bermain</a>
                                @endif
                                </div>
                                
                            </div>
                            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h5 class="modal-title" id="myModalLabel"> {{ $deposit->balance == 0 ? 'Tambah Deposit' : 'Update Deposit' }}</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ URL::signedRoute('update.deposit', ['id' => $visitor->id]) }}"
                                                method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <div class="input-group-dropdown">
                                                        <select name="payment_type" id="payment_type" class="form-control" required>
                                                            <option disabled selected value="">Pilih Pembayaran </option>
                                                            <option value="cash" name="payment_type" id="payment_type">Cash</option>
                                                            <option value="transfer" name="payment_type" id="payment_type">Transfer</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">Rp</div>
                                                        <input type="text" min="0" onkeypress="return event.charCode >= 48 && event.charCode <=57" class="form-control" name="balance" placeholder="Masukan jumlah deposit" required>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-success btn-anim">
                                                    <i class="icon-rocket"></i>
                                                    <span class="btn-text">submit</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button id="setting_panel_btn" data-toggle="tooltip" title="Panduan" data-placement="left" class="btn btn-success btn-circle setting-panel-btn shadow-2dp"><i class="zmdi zmdi-settings"></i></button>
            @include('layouts.footer')
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function sword() {
            var audio = new Audio('../sound/sword.mp3');
            audio.play();
        }

        $("[name='balance']").autoNumeric('init', {
            aSep: '.', 
            aDec: ',',
            aForm: true,
            vMax: '999999999',
            vMin: '-999999999'
        });

        $(document).on('click', '#expired_date', function() {
            swal({
                title: "",
                type: "error",
                text: "Member sudah habis",
                confirmButtonColor: "#01c853",
            });
            sword();
            return false;
        });

        $(document).on('click', '#nonactive', function() {
            swal({
                title: "",
                type: "error",
                text: "Member tidak aktif",
                confirmButtonColor: "#01c853",
            });
            sword();
            return false;
        });
    </script>
@endpush
