@extends('Layouts.Main')
<!-- Main Content -->
<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row heading-bg">
			<!-- Breadcrumb -->
			@include('Layouts.Breadcrumb')
			<!-- /Breadcrumb -->
		</div>

{{-- statistik atas --}}
		<!-- Row -->
		<div class="row">
			<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box" style="background-color:#01C853;">
								<div class="container-fluid">
									<div class="row p-2">
										<div class="col-xs-6 text-left data-wrap-left">
											<span class="txt-light block counter"><span class="counter-anim">{{ $visitor_today }}</span></span>
											<span class="weight-500 uppercase-font txt-light block font-13">Jumlah tamu hari ini</span>
										</div>
										<div class="col-xs-6 text-right data-wrap-right">
											<i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box" style="background-color: #FFDE32;">
								<div class="container-fluid">
									<div class="row p-2">
										<div class="col-xs-6 text-left data-wrap-left">
											<span class="txt-light block counter"><span class="counter-anim">{{ $visitor_vvip }}</span></span>
											<span class="weight-500 uppercase-font txt-light block font-13">Total tamu VVIP</span>
										</div>
										<div class="col-xs-6 text-right data-wrap-right">
											<i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box" style="background-color: #32FFC1;">
								<div class="container-fluid">
									<div class="row p-2">
										<div class="col-xs-6 text-left data-wrap-left">
											<span class="txt-light block counter"><span class="counter-anim">{{ $visitor_vip }}</span></span>
											<span class="weight-500 uppercase-font txt-light block font-13">Total tamu VIP</span>
										</div>
										<div class="col-xs-6 text-right data-wrap-right">
											<i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Row -->


		<!-- Row -->

		{{-- Chart --}}
		<div class="row">
				<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
				<div class="panel panel-default card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-dark">Statistika Tamu Berkunjung</h6>
						</div>
						<div class="pull-right">
							<span class="no-margin-switcher">
								<input type="checkbox" id="morris_switch"  class="js-switch" data-color="#ff2a00" data-secondary-color="#2879ff" data-size="small"/>	
							</span>	
						</div>
						<div class="clearfix"></div>
					</div>

					{{-- Total Charts --}}

					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div id="morris_extra_line_chart" class="morris-chart" style="height:293px;"></div>
							<ul class="flex-stat mt-40">
								<li>
									<span class="block">Laki-Laki VVIP</span>
									<span class="block txt-dark weight-500 font-18"><span class="counter-anim">{{ $visitor_vvip_male }}</span></span>
								</li>
								<li>
									<span class="block">Perempuan VVIP</span>
									<span class="block txt-dark weight-500 font-18"><span class="counter-anim">{{ $visitor_vvip_female }}</span></span>
								</li>
								{{-- <li>
									<span class="block">Trend</span>
									<span class="block">
										<i class="zmdi zmdi-trending-up txt-success font-24"></i>
									</span>
								</li> --}}
							</ul>
							<ul class="flex-stat mt-40">
								<li>
									<span class="block">Laki-Laki VIP</span>
									<span class="block txt-dark weight-500 font-18"><span class="counter-anim">{{ $visitor_vip_male }}</span></span>
								</li>
								<li>
									<span class="block">Perempuan VIP</span>
									<span class="block txt-dark weight-500 font-18"><span class="counter-anim">{{ $visitor_vip_female }}</span></span>
								</li>
								{{-- <li>
									<span class="block">Trend</span>
									<span class="block">
										<i class="zmdi zmdi-trending-up txt-success font-24"></i>
									</span>
								</li> --}}
							</ul>
						</div>
					</div>
				</div>
			</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view">
					<div class="panel-wrapper collapse in">
						<div class="panel-body sm-data-box-1">
							<span class="uppercase-font weight-500 font-14 block text-center txt-dark">customer satisfaction</span>	
							<div class="cus-sat-stat weight-500 txt-success text-center mt-5">
								<span class="counter-anim">93.13</span><span>%</span>
							</div>
							<div class="progress-anim mt-20">
								<div class="progress">
									<div class="progress-bar progress-bar-success wow animated progress-animated" role="progressbar" aria-valuenow="93.12" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<ul class="flex-stat mt-5">
								<li>
									<span class="block">Previous</span>
									<span class="block txt-dark weight-500 font-15">79.82</span>
								</li>
								<li>
									<span class="block">% Change</span>
									<span class="block txt-dark weight-500 font-15">+14.29</span>
								</li>
								<li>
									<span class="block">Trend</span>
									<span class="block">
										<i class="zmdi zmdi-trending-up txt-success font-20"></i>
									</span>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="panel panel-default card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-dark">browser stats</h6>
						</div>
						<div class="pull-right">
							<a href="#" class="pull-left inline-block mr-15">
								<i class="zmdi zmdi-download"></i>
							</a>
							<a href="#" class="pull-left inline-block close-panel" data-effect="fadeOut">
								<i class="zmdi zmdi-close"></i>
							</a>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div>
								<span class="pull-left inline-block capitalize-font txt-dark">
									google chrome
								</span>
								<span class="label label-warning pull-right">50%</span>
								<div class="clearfix"></div>
								<hr class="light-grey-hr row mt-10 mb-10"/>
								<span class="pull-left inline-block capitalize-font txt-dark">
									mozila firefox
								</span>
								<span class="label label-danger pull-right">10%</span>
								<div class="clearfix"></div>
								<hr class="light-grey-hr row mt-10 mb-10"/>
								<span class="pull-left inline-block capitalize-font txt-dark">
									Internet explorer
								</span>
								<span class="label label-success pull-right">30%</span>
								<div class="clearfix"></div>
								<hr class="light-grey-hr row mt-10 mb-10"/>
								<span class="pull-left inline-block capitalize-font txt-dark">
									safari
								</span>
								<span class="label label-primary pull-right">10%</span>
								<div class="clearfix"></div>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
		<!-- /Row -->

		{{-- ROW TAMU --}}
		<!-- Row -->
		<div class="row">
			<div class="col-lg-12 col-md-7 col-sm-12 col-xs-12">
				<div class="panel panel-default card-view panel-refresh">
					<div class="refresh-container">
						<div class="la-anim-1"></div>
					</div>
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-dark">Terakhir Tamu Berkunjung</h6>
						</div>
						<div class="pull-right">
							<a href="#" class="pull-left inline-block refresh mr-15">
								<i class="zmdi zmdi-replay"></i>
							</a>
							<a href="#" class="pull-left inline-block full-screen mr-15">
								<i class="zmdi zmdi-fullscreen"></i>
							</a>
							<div class="pull-left inline-block dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="zmdi zmdi-more-vert"></i></a>
								<ul class="dropdown-menu bullet dropdown-menu-right"  role="menu">
									<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i>Edit</a></li>
									<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-share" aria-hidden="true"></i>Delete</a></li>
									<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-trash" aria-hidden="true"></i>New</a></li>
								</ul>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body row pa-0">
							<div class="table-wrap">
								<div class="table-responsive">
									<table class="table table-hover mb-0">
										<thead>
											<tr>
												{{-- <th>Campaign</th>
												<th>Client</th>
												<th>Changes</th>
												<th>Budget</th>
												<th>Status</th> --}}
												<th>ID</th>
												<th>Nama Tamu</th>
												<th>Tanggal</th>
												<th>Kategori Tamu</th>
												<th>Pukul</th>
											</tr>
										</thead>
										
										<tbody>
											{{-- analisis-tamu --}}
											
											@foreach ($visitor as $item)

											<tr>
												<td><span class="txt-dark weight-500">#{{ $item->id }}</span></td>
												<td>{{ $item->name }}</td>
												{{-- <td>{{ $item['name'] }}</td> --}}
												{{-- <td>{{ $item['name'] }}</td> --}}
												<td><span class="txt-success"><i class="zmdi zmdi-caret-up mr-10 font-20"></i><span>{{ date('d F Y', strtotime($item->created_at)) }}</span></span></td>
												<td>
													@if($item->tipe_member == 'VVIP')
														<span class="label label-success">VVIP</span>
													@else
														<span class="label label-warning">VIP</span>
													@endif
													{{-- <span class="txt-dark weight-500">{{ $item->tipe_member }}</span> --}}
												</td>
												<td>
													{{ date('H:i', strtotime($item->created_at)) }}
												</td>
											</tr>
											@endforeach


											{{-- <tr>
												<td><span class="txt-dark weight-500">Youtube</span></td>
												<td>Felix</td>
												<td><span class="txt-success"><i class="zmdi zmdi-caret-up mr-10 font-20"></i><span>1.43%</span></span></td>
												<td>
													<span class="txt-dark weight-500">$951</span>
												</td>
												<td>
													<span class="label label-danger">Closed</span>
												</td>
											</tr>
											<tr>
												<td><span class="txt-dark weight-500">Twitter</span></td>
												<td>Cannibus</td>
												<td><span class="txt-danger"><i class="zmdi zmdi-caret-down mr-10 font-20"></i><span>-8.43%</span></span></td>
												<td>
													<span class="txt-dark weight-500">$632</span>
												</td>
												<td>
													<span class="label label-default">Hold</span>
												</td>
											</tr>
											
											<tr>
												<td><span class="txt-dark weight-500">Spotify</span></td>
												<td>Neosoft</td>
												<td><span class="txt-success"><i class="zmdi zmdi-caret-up mr-10 font-20"></i><span>7.43%</span></span></td>
												<td>
													<span class="txt-dark weight-500">$325</span>
												</td>
												<td>
													<span class="label label-default">Hold</span>
												</td>
											</tr>

											
											<tr>
												<td><span class="txt-dark weight-500">Instagram</span></td>
												<td>Hencework</td>
												<td><span class="txt-success"><i class="zmdi zmdi-caret-up mr-10 font-20"></i><span>9.43%</span></span></td>
												<td>
													<span class="txt-dark weight-500">$258</span>
												</td>
												<td>
													<span class="label label-primary">Active</span>
												</td>
											</tr> --}}
											
										</tbody>

										

									</table>
								</div>
							</div>	
						</div>	
					</div>
				</div>
			</div>	
		</div>	
		<!-- Row -->
		@include('Layouts.Footer')
	</div>
</div>
<script>
	var vvip_jan = "{{ $january }}";
</script>
<!-- /Main Content -->