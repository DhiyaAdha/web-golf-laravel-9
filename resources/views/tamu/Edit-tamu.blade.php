@extends('Layouts.Main')

@section('content')


    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row heading-bg">
                <!-- Breadcrumb -->
                <div class="row">
                    <div class="container-fluid">
                        <div class="col-lg-8">
                            <h5>Edit Tamu</h5>
                        </div>
                    </div>
                </div>
                <!-- /Breadcrumb -->
            </div>
                <div class="row">
                <div class="col-lg-8" style="position: relative;">
                    <div style="height: 900px" class="panel panel-default card-view">
                        <h6 class="control-label mb-10">Edit Tamu</h6>
                            <div class="panel-body">
                                <div class="form-wrap">
                                    <form action="/inserttamu" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="">Nama Lengkap</label>
                                            <input type="text" name="name" class="form-control" id="name" size="50px" placeholder="Masukan Nama" required autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="address">Alamat</label>
                                            <input type="text" class="form-control" name="address" id="address" size="50px" placeholder="Masukan Alamat" required autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="gender">Jenis Kelamin</label>
                                            <div class="form-check">
                                                <label class="radio-inline">
                                                    <input type="radio" name="gender" id="gender" value="laki-laki">Pria
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="gender" id="gender" value="perempuan">Wanita
                                                </label> 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="">Email</label>
                                            <input type="email" name="email" class="form-control" id="email" placeholder="Masukan Email" @error('email') is-invalid @enderror autofocus required value="{{ old('email') }}">
                                            @error('email')
												<div class="invalid-feedback">
													{{ $message }}
												</div>
											@enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="">Nomer Hp</label>
                                            <input type="number" name="phone" class="form-control" id="phone" size="50px" placeholder="Masukan Nomer Hp" required autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="">Perusahaan</label>
                                            <input type="text" name="company" class="form-control" id="company" size="50px" placeholder="Masukan Nama Perusahaan" required autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="">Jabatan</label>
                                            <input type="text" name="position" class="form-control" id="position" size="50px" placeholder="Masukan Jabatan" required autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="">Tamu Ini Adalah Tamu VIP
                                            <div class="switch">
                                                <input class="cmn-toggle cmn-toggle-round-flat" type="hidden" value="VVIP" name="tipe_member">
                                                <input id="cmn-toggle-4"  class="cmn-toggle cmn-toggle-round-flat" name="tipe_member" type="checkbox" value="VIP">
                                                <label for="cmn-toggle-4"></label>
                                            </div>
                                        </div>
                                        <div class="form-group text-left">
                                            <button type="submit" class="btn btn-info">Simpan</button>
                                        </div>
                                    </form>
                            </div>
                            <!-- /Basic Table -->   
                    </div>
                </div>
            </div>  
        </div>
    </div>
@endsection
<script>    
</script>
