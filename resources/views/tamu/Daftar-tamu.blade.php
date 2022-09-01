@extends('Layouts.Main', ['title' => 'TGCC | Daftar Tamu'])
@section('content')
    <!-- Main Content -->
    <div class="page-wrapper">
        <div class="container-fluid">
            <!-- Title -->
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Daftar Tamu</h5>
                </div>
                <!-- Breadcrumb -->
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="active"><span>Paket Bermain</span></li>
                    </ol>
                </div>
                <!-- /Breadcrumb -->
            </div>
            <!-- /Title -->

            <div class="row">
                <!-- Basic Table -->
                <div class="col-sm-12">
                    <div class="panel panel-default card-view">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Daftar Tamu</h6>
                        </div>
                        <div class="col-lg-11" style="text-align: end;">
                            <a href="{{ route('tambah-tamu') }}">
                                <i class="fa-2x fa-plus"></i></a>
                        </div>
                        <div class="clearfix"></div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table mb-0" id="dt-tamu">
                                            <thead>
                                                <tr>
                                                    <th class="" style="margin-left: 20px;">Nama</th>
                                                    <th class="">Email</th>
                                                    <th class="">Phone</th>
                                                    <th class="">Tipe</th>
                                                    <th class="">Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
							<div class="col-lg-11" style="text-align: end;">
                                <a href="{{ route('tambah-tamu') }}">
                                        <i class="fa-2x fa-plus"
                                        ></i></a>
                            </div>
                            <div class="clearfix"></div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="table-wrap">
										<div class="table-responsive">
											<table class="table mb-0" id="dt-tamu">
												<thead>
                                                    <tr>
                                                        <th class="" style="margin-left: 20px;"> <a href="{{ route('tambah-deposit') }}" >Nama</a> </th>
                                                        <th class="">Email</th>
                                                        <th class="">Phone</th>
                                                        <th class="">Tipe</th>
                                                        <th class="">Opsi</th>
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
					<!-- /Basic Table -->
				</div>
			</div>
			<!-- Footer -->
            @include('Layouts.Footer')
            <!-- /Footer -->
		</div>
		<!-- /Main Content -->
@endsection
