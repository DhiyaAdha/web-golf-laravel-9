@extends('Layouts.Main')

@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <h3 mt-15>Scan Tamu</h3>
                <div class="col-lg-8">
                    <div class="panel panel-default card-view">
                        <h6>Data Pengunjung</h6>
                        <div class="col-sm-12">
                            <div class="panel-body">
                                <div class="table-wrap mt-40">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Username</th>
                                                    <th>Role</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Jens</td>
                                                    <td>Brincker</td>
                                                    <td>Brincker123</td>
                                                    <td><span class="label label-danger">admin</span> </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Mark</td>
                                                    <td>Hay</td>
                                                    <td>Hay123</td>
                                                    <td><span class="label label-info">member</span> </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Anthony</td>
                                                    <td>Davie</td>
                                                    <td>Davie123</td>
                                                    <td><span class="label label-warning">developer</span> </td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>David</td>
                                                    <td>Perry</td>
                                                    <td>Perry123</td>
                                                    <td><span class="label label-success">supporter</span> </td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Anthony</td>
                                                    <td>Davie</td>
                                                    <td>Davie123</td>
                                                    <td><span class="label label-info">member</span> </td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>Alan</td>
                                                    <td>Gilchrist</td>
                                                    <td>Gilchrist123</td>
                                                    <td><span class="label label-success">supporter</span> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            </ </div>
                            <!-- /Basic Table -->
                        </div>

                        <div class="row">
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="panel-panel default card-view" style="text-align: center;">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h4 class="card-title">Data Pengunjung</h4>
                                <i class="fa-solid fa-qrcode fa-10x mt-20 mb-10"></i><br><br>
                                <a href="/order" class="btn btn-primary mb-20">Scan Barcode</a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    @endsection
