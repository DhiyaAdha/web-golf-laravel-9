@extends('layouts.main', ['title' => 'TGCC | Pengaturan'])
@section('content')
    <div class="page-wrapper intro-foo">
        <div class="container-fluid" data-title="Halaman Daftar Tamu" data-intro="Halaman ini memberikan informasi data tamu yang sudah terdaftar sebagai membership.">
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Pengaturan</h5>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('analisis-tamu') }}">Dashboard</a></li>
                        <li class="active"><span>Pengaturan</span></li>
                    </ol>
                </div>
            </div>

            @if (auth()->user()->role_id == '2')
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default card-view" data-title="Daftar Riwayat Deposit" data-intro="Tabel ini memberikan informasi log deposit membership tgcc diurutkan berdasarkan data baru deposit.">
                            <div class="panel-heading">
                                    <div class="col-lg-6">
                                        <form action="{{ route('setting.limit') }}" method="POST">
                                            <div class="form-group">
                                                @csrf
                                                <label class="control-label mb-10" for="">Ubah limit</label>
                                                <select name="tipe_member" class="form-control" onchange="showDiv(this)" required>
                                                    <option disabled selected>Pilih jenis member</option>
                                                    <option value="VIP" name="tipe_member">Member</option>
                                                    <option value="VVIP" name="tipe_member">VIP</option>
                                                </select>
                                                <br>
                                                <label class="control-label mb-10" for="" style="display:none;" id="hidden_div">
                                                    <label class="control-label mb-10" for="">Ubah Jumlah Limit</label>
                                                    <input type="text" min="0" onkeypress="return event.charCode >= 48 && event.charCode <=57" class="form-control" name="limit" size="50px" placeholder="Masukan Jumlah limit" id="limit">
                                                </label>
                                            </div>
                                            <div class="form-group text-left">
                                                <a href="daftar-tamu"><button type="submit" class="btn btn-info">Submit</button></a>   
                                            </div>  
                                        </form>
                                    </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <button id="setting_panel_btn" data-toggle="tooltip" title="Panduan" data-placement="left" class="btn btn-success btn-circle setting-panel-btn shadow-2dp"><i class="zmdi zmdi-settings"></i></button>
            @include('layouts.footer')
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        let showDiv = (select) => {
            if (select.value == 'VIP') {
                document.getElementById('hidden_div').style.display = "block";
            } else if (select.value == 'VVIP') {
                document.getElementById('hidden_div').style.display = "block";
            } else {
                document.getElementById('hidden_div').style.display = "none";
                document.getElementById("limit").value = "0";
            }
            $.ajax({
                type: 'GET',
                url: '/select/member',
                data: {
                    type_member: select.value
                },
                dataType: 'json',
                success: (response) => {
                    $('#limit').val(response.limit);
                }
            });
        }
    </script>
@endpush