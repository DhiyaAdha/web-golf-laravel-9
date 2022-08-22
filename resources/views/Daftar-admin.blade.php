    @extends('Layouts.Main')
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
                                <div class="col-lg-10">
                                    <h6>Daftar Admin</h6>
                                </div>
                                <div class="col-lg-2" style="text-align: end;">
                                <a href="{{ route('tambah-admin') }}">
                                        <i class="fa-2x fa-plus"
                                        ></i></a>

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
                            <div class="panel-bodi">
                                <div class="table-wrap mt-40">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center;">Nama</th>
                                                    <th style="text-align: center;">Email</th>
                                                    <th style="text-align: center;">Nomer hp</th>
                                                    <th style="text-align: center;">Kategori Admin</th>
                                                    <th style="text-align: center;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="text-align: center;">Pamungkas Nuli Ramadhan</td>
                                                    <td style="text-align: center;">pamungkasnuli@rocketmail.com</td>
                                                    <td style="text-align: center;">081126458792</td>
                                                    <td style="text-align: center;"><span
                                                            class="label label-Super-Admin">Super Admin</span> </td>
                                                    <td style="text-align: center;">
                                                        <img src="dist/img/edit.svg" alt=""
                                                            style="padding: 2px 7px 2px 2px;">
                                                        <img src="dist/img/hapus.svg" alt=""
                                                            style="padding: 2px 7px 2px 2px;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center;">Pamungkas Nuli Ramadhan</td>
                                                    <td style="text-align: center;">pamungkasnuli@rocketmail.com</td>
                                                    <td style="text-align: center;">081126458792</td>
                                                    <td style="text-align: center;"><span
                                                            class="label label-Admin">Admin</span> </td>
                                                    <td style="text-align: center;">
                                                        <img src="dist/img/edit.svg" alt=""
                                                            style="padding: 2px 7px 2px 2px;">
                                                        <img src="dist/img/hapus.svg" alt=""
                                                            style="padding: 2px 7px 2px 2px;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center;">Pamungkas Nuli Ramadhan</td>
                                                    <td style="text-align: center;">pamungkasnuli@rocketmail.com</td>
                                                    <td style="text-align: center;">081126458792</td>
                                                    <td style="text-align: center;"><span
                                                            class="label label-Admin">Admin</span> </td>
                                                    <td style="text-align: center;">
                                                        <img src="dist/img/edit.svg" alt=""
                                                            style="padding: 2px 7px 2px 2px;">
                                                        <img src="dist/img/hapus.svg" alt=""
                                                            style="padding: 2px 7px 2px 2px;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center;">Pamungkas Nuli Ramadhan</td>
                                                    <td style="text-align: center;">pamungkasnuli@rocketmail.com</td>
                                                    <td style="text-align: center;">081126458792</td>
                                                    <td style="text-align: center;"><span
                                                            class="label label-Admin">Admin</span> </td>
                                                    <td style="text-align: center;">
                                                        <img src="dist/img/edit.svg" alt=""
                                                            style="padding: 2px 7px 2px 2px;">
                                                        <img src="dist/img/hapus.svg" alt=""
                                                            style="padding: 2px 7px 2px 2px;">
                                                    </td>
                                                </tr>
                                            </tbody>
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
                        <div class="panel-heding">

                            {{-- <div class="clearfix"></div> --}}
                            <div class="row">
                                <div class="col-lg-10">
                                    <h6>history aktifitas</h6>
                                </div>
                            </div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-bodi">
                                <div class="table-wrap mt-40">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center;">Role</th>
                                                    <th>Nama Admin</th>
                                                    <th>Informasi</th>
                                                    <th style="text-align: center;">Status</th>
                                                    <th style="text-align: center;">Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="text-align: center;"><span class="label label-sa">SA</span></td>
                                                    <td>Pamungkas Nuli Ramadhan</td>
                                                    <td>Menambah membership VIP/VVIP baru bernama Arya GP</td>
                                                    <td style="text-align: center;">
                                                    <span class="label label-tambah">Tambah</span></td>
                                                    <td style="text-align: center;">
                                                        <img src="dist/img/edit.svg" alt=""
                                                            style="padding: 2px 7px 2px 2px;">
                                                        <img src="dist/img/hapus.svg" alt=""
                                                            style="padding: 2px 7px 2px 2px;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center;"><span class="label label-sa">SA</span></td>
                                                    <td>Pamungkas Nuli Ramadhan</td>
                                                    <td>Menambah membership VIP/VVIP baru bernama Arya GP</td>
                                                    <td style="text-align: center;"><span class="label label-update">Update</span></td>
                                                    <td style="text-align: center;">
                                                        <img src="dist/img/edit.svg" alt=""
                                                            style="padding: 2px 7px 2px 2px;">
                                                        <img src="dist/img/hapus.svg" alt=""
                                                            style="padding: 2px 7px 2px 2px;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center;"><span class="label label-sa">SA</span></td>
                                                    <td>Pamungkas Nuli Ramadhan</td>
                                                    <td>Menambah membership VIP/VVIP baru bernama Arya GP</td>
                                                    <td style="text-align: center;"><span class="label label-hapus">Hapus</span></td>
                                                    <td style="text-align: center;">
                                                        <img src="dist/img/edit.svg" alt=""
                                                            style="padding: 2px 7px 2px 2px;">
                                                        <img src="dist/img/hapus.svg" alt=""
                                                            style="padding: 2px 7px 2px 2px;">
                                                    </td>
                                                </tr>
                                            </tbody>
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