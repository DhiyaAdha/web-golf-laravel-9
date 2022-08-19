@extends('Layouts.Main', ['title' => 'TGCC | Paket Bermain'])
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
									<div class="table-wrap">
										<div class="table-responsive">
											<table class="table mb-0">
												<thead>
                                                    <tr>
                                                        <th class="table-th">Nama Produk</th>
                                                        <th class="table-th">Kategori</th>
                                                        <th class="table-th">Harga Weekdays</th>
                                                        <th class="table-th">Harga Weekend</th>
                                                        <th class="table-th">Status</th>
                                                        <th class="table-th">Opsi</th>
                                                    </tr>
												</thead>
												<tbody>
                                                    @foreach ($products as $product)
                                                    {{-- <tr>
                                                        <td>{{ $product->name }}</td>
                                                        <td>default</td>
                                                        <td>{{ $product->price }}</td>
                                                        <td>{{ $product->price }}</td>
                                                        <td>{{ $product->price }}</td>
                                                        <td>
                                                            <a href="{{ route('product.editform',['id'=>$product->id]) }}" class="btn btn-primary w-100 m-1" style="color:white;">EDIT</a>
                                                            <a href="{{ route('product.remove',['id'=>$product->id]) }}" class="btn btn-danger w-100 m-1" style="color:white;">REMOVE</a>
                                                        </td>
                                                    </tr> --}}
                                                    <tr>
                                                        <td class="table-th table-td">{{ $product->name }}</td>
                                                        <td class="table-th table-td">default</td>
                                                        <td class="table-th table-td">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">Rp</div>
                                                                    <label class="form-control">{{ $product->price }}</label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="table-th table-td">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">Rp</div>
                                                                    <label class="form-control">{{ $product->price }}</label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="table-th table-td">
                                                            <input type="checkbox" checked class="js-switch js-switch-1"  data-color="#01c853" data-size="small"/>
                                                        </td>
                                                        <td class="table-th table-td">
                                                            <div>
                                                                <a href="#">
                                                                    <img src="{{ asset('img/edit.svg') }}">
                                                                </a>
                                                                <a href="#">
                                                                    <img src="{{ asset('img/hapus.svg') }}">
                                                                </a>
                                                            </div>
                                                        </td>
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
					<!-- /Basic Table -->
				</div>
			</div>
			<!-- Footer -->
            @include('Layouts.Footer')
            <!-- /Footer -->
		</div>
		<!-- /Main Content -->
@endsection