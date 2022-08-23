@extends('Layouts.Main')
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row heading-bg">
            <div class="row">
                <div class="container-fluid">
                    <div class="col-lg-8">
                        <h5>Invoice</h5>
                    </div>
                    <div class="col-lg-4 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="active"><span>Invoice</span></li>
                        </ol>
                    </div>
                </div>
            </div>
            
            <div class="row" style="padding: 25px 25px">
                <div class="col-sm-12">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">

                            {{-- <div class="clearfix"></div> --}}
                            <div class="row">
                                <div class="col-lg-10">
                                    <h6>Invoice</h6>
                                </div>
                                <div class="col-lg-2" style="text-align: end;">
                                  
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
                                <div class="table-wrap mt-0">
                                    <div class="table-responsive">
                                        <table class="table mb-0" id="dt-riwayat-invoice">
                                            <thead>
                                                <tr>
                                                    <th class="table-th">Nama</th>
                                                    <th class="table-th">Kategori Tamu</th>
                                                    <th class="table-th">Total Bayar</th>
                                                    <th class="table-th">Tanggal Bayar</th>
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

            @include('Layouts.Footer')
        </div>
    </div>
</div>
