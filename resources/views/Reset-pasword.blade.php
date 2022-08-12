
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>Reset Password</title>
		<meta name="description" content="Hound is a Dashboard & Admin Site Responsive Template by hencework." />
		<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Hound Admin, Houndadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
		<meta name="author" content="hencework"/>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		
		<!-- vector map CSS -->
		<link href="../../vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
		
		
		
		
		<!-- Custom CSS -->
		<link href="/dist/css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<!--Preloader-->
		<div class="preloader-it">
			<div class="la-anim-1"></div>
		</div>
		<!--/Preloader-->
		
		<div class="wrapper pa-0">
			<header class="sp-header">
				<div class="sp-logo-wrap pull-left">
					
					<a href="#">
						<img class="brand-img mr-10" src="/dist/img/tgcc.svg" alt="brand"/>
					</a>
				</div>
				<div class="clearfix"></div>
			</header>
			
			
			
			<!-- Main Content -->
			<div class="page-wrapper pa-0 ma-0 auth-page">
				<div class="container-fluid">
					<!-- Row -->
					<div class="table-struct full-width full-height">
						<div class="table-cell vertical-align-middle auth-form-wrap">
							<div class="auth-form  ml-auto mr-auto no-float">
								<div class="row">
									<div class="col-sm-12 col-xs-12">
										<div>

												@if (Session::get('resetSuccess')) 
												<div class="alert alert-danger">{!! Session::get('resetSuccess') !!}
													<button type="button" class="close" data-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button> 
												</div>
												@endif
										</div>
										
										<div class="mb-30">
											<h5 class="text-center txt-dark mb-10">Lupa Password Tritih Golf & Country Club</h5>
											<h6 class="text-center nonecase-font txt-grey">Masukan Password Baru Anda</h6>
										</div>
										<div class="form-wrap">

											<form action="{{ route('Reset-pasword.update') }}" method="post" autocomplete="off">
												
												@csrf
												<input type="hidden" name="token" value="{{ $token }}">
												<div class="form-group">
													{{-- <label class="" for="email">Email</label> --}}
													<input type="hidden" class="form-control" name="email" placeholder="Enter email address" value="{{ $email ?? old('email') }}">
													<span class="text-danger">
												</div>
												<div class="form-group">
													<label class="pull-left control-label mb-10" for="password">Password Baru</label>
													<input type="password" name="password" class="form-control" id="password" placeholder="Masukan Password Baru" value="{{ old('password') }}">
												</div>
												<div class="form-group">
													<label class="pull-left control-label mb-10" for="password_confirmation">Ulangi Password</label>
													<div class="clearfix"></div>
													<input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Masukan Password Baru" value="{{ old('password_confirmation') }}"required>
												</div>
												<div class="form-group text-center">
													<button type="submit" class="btn btn-info btn-rounded">Update Password</button>
												</div>
											</form>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
					<!-- /Row -->	
				</div>
				
			</div>
			<!-- /Main Content -->
		
		</div>
		<!-- /#wrapper -->
		
		<!-- JavaScript -->
		
		<!-- jQuery -->
		<script src="../../vendors/bower_components/jquery/dist/jquery.min.js"></script>
		
		<!-- Bootstrap Core JavaScript -->
		<script src="../../vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="../../vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
		
		<!-- Slimscroll JavaScript -->
		<script src="/dist/js/jquery.slimscroll.js"></script>
		
		<!-- Init JavaScript -->
		<script src="/dist/js/init.js"></script>
	</body>
</html>
