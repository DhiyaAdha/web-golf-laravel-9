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
                                        <table class="table mb-30">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center;">Nama</th>
                                                    <th style="text-align: center;">Kategori Tamu</th>
                                                    <th style="text-align: center;">Total Bayar</th>
                                                    <th style="text-align: center;">Tanggal Bayar</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($visitor as $item)
                                                <tr>
                                                    <td style="text-align: light;">{{ $item->name }}</td>
                                                    <td style="text-align: center;">

                                                        @if($item->tipe_member == 'VVIP')
                                                            <span class="label label-success">VVIP</span>
                                                        @else
                                                            <span class="label label-warning">VIP</span>
                                                        @endif
                                                        
                                                    </td>
                                                    <td style="text-align: center;">{{ $item->email }}</td>
                                                    <td style="text-align: center;">{{ $item->phone }}</td>
                                                </tr>
                                                
                                                @endforeach
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
