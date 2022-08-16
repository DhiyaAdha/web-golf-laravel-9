@extends('Layouts.Main')
<div class="page-wrapper">
    <h5>Daftar Tamu</h5>
    <div class="container-fluid">
        <div class="row heading-bg">
            @include('Layouts.Breadcrumb')
            <div class="row" style="padding: 25px 25px">
                <div class="col-sm-12">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Daftar Tamu</h6>
                            </div>
                            <div class="clearfix"></div>
                            <form action="#" style="text-align: end;">
                                <i class="zmdi zmdi-fullscreen"></i>
                                <i class="fa fa-plus"></i>
                                <div id="search" style="justify-content: right">
                                    <input type="text" id="input" placeholder="Search">
                                    <button id="button"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="table-wrap mt-40">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Nomer hp</th>
                                                    <th>Kategori Tamu</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>#13324</td>
                                                    <td>Pamungkas Nuli Ramadhan</td>
                                                    <td>pamungkasnuli@rocketmail.com</td>
                                                    <td>081126458792</td>
                                                    <td><span class="label label-vip">VIP</span> </td>
                                                    <td><i class="fa fa-qrcode"></i>
                                                        <i class="fa fa-file-pen"></i>
                                                        <i data-fa-symbol="delete" class="fas fa-trash fa-fw"></i>
                                                        <i class="fa fa-square-dashed"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>#13324</td>
                                                    <td>Pamungkas Nuli Ramadhan</td>
                                                    <td>pamungkasnuli@rocketmail.com</td>
                                                    <td>081126458792</td>
                                                    <td><span class="label label-vip">VIP</span> </td>
                                                    <td> <i class="fa fa-qrcode"></i>
                                                        <i class="fa fa-file-pen"></i>
                                                        <i data-fa-symbol="delete" class="fas fa-trash fa-fw"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>#13324</td>
                                                    <td>Pamungkas Nuli Ramadhan</td>
                                                    <td>pamungkasnuli@rocketmail.com</td>
                                                    <td>081126458792</td>
                                                    <td><span class="label label-vip">VIP</span> </td>
                                                    <td> <i class="fa fa-qrcode"></i>
                                                        <i class="fa fa-file-pen"></i>
                                                        <i data-fa-symbol="delete" class="fas fa-trash fa-fw"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>#13324</td>
                                                    <td>Pamungkas Nuli Ramadhan</td>
                                                    <td>pamungkasnuli@rocketmail.com</td>
                                                    <td>081126458792</td>
                                                    <td><span class="label label-vip">VIP</span> </td>
                                                    <td> <i class="fa fa-qrcode"></i>
                                                        <i class="fa fa-file-pen"></i>
                                                        <i data-fa-symbol="delete" class="fas fa-trash fa-fw"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>#13324</td>
                                                    <td>Pamungkas Nuli Ramadhan</td>
                                                    <td>pamungkasnuli@rocketmail.com</td>
                                                    <td>081126458792</td>
                                                    <td><span class="label label-vvip">VVIP</span> </td>
                                                    <td> <i class="fa fa-qrcode"></i>
                                                        <i class="fa fa-file-pen"></i>
                                                        <i data-fa-symbol="delete" class="fas fa-trash fa-fw"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>#13324</td>
                                                    <td>Pamungkas Nuli Ramadhan</td>
                                                    <td>pamungkasnuli@rocketmail.com</td>
                                                    <td>081126458792</td>
                                                    <td><span class="label label-vvip">VVIP</span> </td>
                                                    <td> <i class="fa fa-qrcode"></i>
                                                        <i class="fa fa-file-pen"></i>
                                                        <i data-fa-symbol="delete" class="fas fa-trash fa-fw"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>#13324</td>
                                                    <td>Pamungkas Nuli Ramadhan</td>
                                                    <td>pamungkasnuli@rocketmail.com</td>
                                                    <td>081126458792</td>
                                                    <td><span class="label label-vip">VIP</span> </td>
                                                    <td> <i class="fa fa-qrcode"></i>
                                                        <i class="fa fa-file-pen"></i>
                                                        <i data-fa-symbol="delete" class="fas fa-trash fa-fw"></i>
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
