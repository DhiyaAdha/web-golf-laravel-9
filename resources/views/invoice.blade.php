@extends('Layouts.Main')
@section('content')
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="page-wrapper">
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <div class="row">
        <div class="col-md-2">
            <h2 style="font-size: 16px;">Invoice</h2>
        </div>
		@foreach ($invoice as $item)
        <div class="col-md-10 text-right">
            <h3 class="float-right" style="font-size: 16px;">Order #{{ $item->unique_number }}</h3>
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
					{{ $item->payment_type }}<br>
    				
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
    					{{ $item->created_at->format('d-m-Y') }}<br><br>
    				</address>
    			</div>
    		</div>
    	</div>
		@endforeach
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
										@if($item->package_default_id == '1')
											<span>Practice</span>
										@else
											
										@endif
									</td>
    								<td class="text-center">Rp
										@if($item->package_default_id == '1')
											<span>50000</span>
										@else
											
										@endif
									</td>
    								<td class="text-center">1</td>
    								<td class="text-right">Rp
										@if($item->package_default_id == '1')
											<span>50000</span>
										@else
											
										@endif
									</td>
    							</tr>
								<tr>
    								<td>
										@if($item->package_additional_id == '1')
											<span>Paket 1</span>
										@else
											
										@endif
									</td>
    								<td class="text-center">Rp
										@if($item->package_additional_id == '1')
											<span>100000</span>
										@else
											
										@endif
									</td>
    								<td class="text-center">1</td>
    								<td class="text-right">Rp
										@if($item->package_default_id == '1')
											<span>100000</span>
										@else
											
										@endif
									</td>
    							</tr>
                               
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-right">Subtotal</td>
    								<td class="thick-line text-right">
										@if($item->package_default_id == '1' && $item->package_additional_id == '1')
											<span>Rp 150000</span>
										@else
											
										@endif
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
										@if($item->package_default_id == '1' && $item->package_additional_id == '1')
											<span>Rp 150000</span>
										@else
											
										@endif
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
</div>
@endsection