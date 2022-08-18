@extends('Layouts.Main')
@section('content')
    <!-- Main Content -->
		<div class="page-wrapper">
			<div class="container-fluid">
				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h5 class="txt-dark">Daftar Paket</h5>
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
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Daftar Paket</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="table-wrap mt-40">
										<div class="table-responsive">
											<table class="table mb-0">
												<thead>
                                                    <tr>
                                                        <th>Nama Produk</th>
                                                        <th>Kategori</th>
                                                        <th>Harga Weekdays</th>
                                                        <th>Harga Weekend</th>
                                                        <th>Status</th>
                                                        <th>Opsi</th>
                                                    </tr>
												</thead>
												<tbody>
                                                    <tr>
                                                        <td>One Game</td>
                                                        <td>Package</td>
                                                        <td>
                                                            <div class="form-group">
																<div class="input-group">
																	<div class="input-group-addon btn btn-default">
                                                                        Rp
                                                                    </div>
																	<label class="form-control"></label>
																</div>
															</div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
																<div class="input-group">
																	<div class="input-group-addon btn btn-default">
                                                                        Rp
                                                                    </div>
																	<label class="form-control"></label>
																</div>
															</div>
                                                        </td>
                                                        <td>
                                                            <input id="check_box_switch" type="checkbox" data-off-text="Tunda" data-on-text="Aktif"  class="bs-switch">
                                                            <label></label>
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
					<!-- /Basic Table -->
				</div>
			</div>
			<!-- Footer -->
            @include('Layouts.Footer')
            <!-- /Footer -->
		</div>
		<!-- /Main Content -->
@endsection