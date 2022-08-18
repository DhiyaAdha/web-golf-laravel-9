@extends('Layouts.Main')

@section('content')
    {{-- Script --}}
    {{-- <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script> --}}
    {{-- Script --}}

    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row heading-bg">
                <!-- Breadcrumb -->
                @include('Layouts.Breadcrumb')
                <!-- /Breadcrumb -->
            </div>
            <div class="row">
                <div class="col-lg-8" style="position: relative;">
                    <div style="height: 600px" class="panel panel-default card-view">
                        <h5>Data Pengunjung</h6>
                            <div class="row">
                                <table class="table table-dark table-borderless">
                                    <tr>
                                        <td>yudis</td>
                                        <td>tira</td>
                                    </tr>
                                    <tr>
                                        <td>yudis</td>
                                        <td>tira</td>
                                    </tr>
                                    <tr>
                                        <td>yudis</td>
                                        <td>tira</td>
                                    </tr>
                                </table>
                            </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div style="height: 400px" class="panel panel-default card-view">
                        <h6>Sisa Limit dan Deposit Yudistira</h6>
                        <div class="box-deposit">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p class="ml-30 mt-10">Deposit</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-2 col-sm-2" style="text-align: left;">
                                    <h4 class="ml-30" style="color: white;">Rp.</h4>
                                </div>
                                <div class="col-lg-6 col-md-2 col-sm-2" style="text-align: right;">
                                    <h4 class="mr-30" style="color: white;">12.000.000</h4>
                                </div>
                            </div>
                        </div>
                        <div class="box-limit-kupon">
                            <div class="row">
                                <div class="col-lg-6">
                                    <p class="ml-30 mt-10">Limit Kupon</p>
                                </div>
                                <div class="col-lg-6">
                                    <h6>yudistira</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
