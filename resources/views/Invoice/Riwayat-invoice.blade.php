@extends('Layouts.Main', ['title' => 'TGCC | Invoice'])
@section('content')
    <!-- Main Content -->
		<div class="page-wrapper">
			<div class="container-fluid">
				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h5 class="txt-dark">Invoice</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="active"><span>Invoice</span></li>
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
                                <h6 class="panel-title txt-dark">Invoice</h6>
                            </div>
                            <div class="clearfix"></div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="table-wrap">
										<div class="table-responsive">
											<table class="table mb-0" id="dt-riwayat">
												<thead>
                                                    <tr>
                                                        <th class="table-th" style="text-align:center">Nama</th>
                                                        <th class="table-th" style="text-align:center">Kategori Tamu</th>
                                                        <th class="table-th" style="text-align:center">Total Bayar</th>
                                                        <th class="table-th" style="text-align:center">Tanggal Bayar</th>
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