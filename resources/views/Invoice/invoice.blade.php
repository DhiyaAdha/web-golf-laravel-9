@extends('Layouts.Main', ['title' => 'TGCC | Invoice'])
@section('content')
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="page-wrapper">
{{-- <div class="container-fluid">
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
	<!-- /Title --> --}}
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <div class="row">
        <div class="col-md-2">
            <h2 style="font-size: 16px;"><strong>Invoice</strong></h2>
        </div>
		
        <div class="col-md-10 text-right">
            <h3 class="float-right" style="font-size: 16px;"><strong>Order #0001</strong></h3>
        </div>
        </div>
    		<hr>
    		<div class="row">
    			<div class="col-md-6">
    				<address>
    				<strong>Nama Tamu:</strong><br>
					<td><span class="txt-dark weight-500">{{ Auth::user()->name }}</span></td>
					<br>
					{{  Auth::user()->email }}<br>
					{{  Auth::user()->phone }}<br>

					
    					
    				</address>
    			</div>
    			<div class="col-md-6 text-right">
    				<address>
        			<strong>Metode Pembayaran:</strong><br>
					Cash<br>
    				
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-md-6">
    				<address>
    					<strong>Katagori Tamu:</strong><br>
    					VVIP<br>
    					
    				</address>
    			</div>
    			<div class="col-md-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					25 Agustus 2022<br><br>
    				</address>
    			</div>
    		</div>
    	</div>
		
    </div>
    
    <div class="row">
    	<div class="col-md-12">

    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Item</strong></td>
        							<td class="text-center"><strong>Harga</strong></td>
        							<td class="text-center"><strong>Jumlah</strong></td>
        							<td class="text-right"><strong>Total</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
    							<tr>
    								<td>
										
											<span>Practice</span>
										
											
										
									</td>
    								<td class="text-center">Rp
										
											<span>50000</span>
										
									</td>
    								<td class="text-center">1</td>
    								<td class="text-right">Rp
										
											<span>50000</span>
										
									</td>
    							</tr>
								<tr>
    								<td>
										
											<span>Paket 1</span>
										
									</td>
    								<td class="text-center">Rp
										
											<span>100000</span>
										
									</td>
    								<td class="text-center">1</td>
    								<td class="text-right">Rp
										
											<span>100000</span>
										
									</td>
    							</tr>
                               
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-right">Subtotal</td>
    								<td class="thick-line text-right">
										
											<span>Rp 150000</span>
										
									</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-right">Limit Bulanan</td>
    								<td class="no-line text-right">Rp -</td>
    							</tr>
								<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-right">Deposit</td>
    								<td class="no-line text-right">Rp -</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-right"><strong>Total Bayar</strong></td>
    								<td class="no-line text-right">
										
											<span>Rp 150000</span>
										
									</td>
    							</tr>
    						</tbody>
    					</table>
						<div class="form-group text-right">
									<button type="submit" class="btn btn-info">Selesai</button>
									&nbsp;&nbsp;
									<button type="submit" class="">Print Struk</button>
								</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>
</div>
@endsection