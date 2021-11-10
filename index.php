<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Syndash - Bootstrap4 Admin Template</title>
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<!-- Icons CSS -->
	<link rel="stylesheet" href="assets/css/icons.css" />
	<!-- App CSS -->
	<link rel="stylesheet" href="assets/css/app.css" />
</head>

<body class="bg-login">
	<!-- wrapper -->
	<div class="wrapper">
		<div class="section-authentication-login d-flex align-items-center justify-content-center">
			<div class="row">
				<div class="col-12 col-lg-10 mx-auto">
					<div class="card radius-15">
						<div class="row no-gutters">
							<div class="col-lg-6">
								<div class="card-body p-md-5">
									<div class="text-center">
										<img src="assets/images/logo-icon.png" width="80" alt="">
										<h3 class="mt-4 font-weight-bold">Welcome Back</h3>
									</div>
									
									<div class="login-separater text-center"> <span>OR LOGIN WITH EMAIL</span>
										<hr/>
									</div>
									<form method="post">
										<div class="form-group mt-4">
											<label>Email Address</label>
											<input type="text" class="form-control" name="username" placeholder="Enter your email address" />
										</div>
										<div class="form-group">
											<label>Password</label>
											<input type="password" class="form-control" name="password" placeholder="Enter your password" />
										</div>
										<div class="form-row">
											<div class="form-group col">
												<div class="custom-control custom-switch">
													<input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
													<label class="custom-control-label" for="customSwitch1">Remember Me</label>
												</div>
											</div>
											<div class="form-group col text-right"> <a href="authentication-forgot-password.html"><i class='bx bxs-key mr-2'></i>Forget Password?</a>
											</div>
										</div>
										<div class="btn-group mt-3 w-100">
											<button name="submit" class="btn btn-primary btn-block">Log In</button>
											<button name="submit"  class="btn btn-primary"><i class="lni lni-arrow-right"></i>
											</button>
										</div>
									</form>
									<?php
									include "koneksi.php";

									if( isset( $_REQUEST['submit'] ) ){
										$username = $_REQUEST['username'];
										$password = $_REQUEST['password'];

										$sql = mysqli_query($koneksi,"SELECT iduser,username,admin,fullname FROM user WHERE username='$username' AND password=md5('$password')");

										if( mysqli_num_rows($sql) > 0 ){
											list($iduser,$username,$admin,$fullname) = mysqli_fetch_array($sql);

          								  //session_start();
											$_SESSION['iduser'] = $iduser;
											$_SESSION['username'] = $username;
											$_SESSION['admin'] = $admin;
											$_SESSION['fullname'] = $fullname;

											header("Location: ./admin.php");
											die();
										} else {
          									  //$err = '<strong>ERROR!</strong> Username dan Password tidak ditemukan.';
          									  //header('Location: ./?err='.urlencode($err));

											$_SESSION['err'] = '<strong>ERROR!</strong> Username dan Password tidak ditemukan.';
											header('Location: ./');
											die();
										}

									}
									?>
									<hr>
									<div class="text-center">
										<p class="mb-0">Don't have an account? <a href="authentication-register.html">Sign up</a>
										</p>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<img src="assets/images/login-images/login-frent-img.jpg" class="card-img login-img h-100" alt="...">
							</div>
						</div>
						<!--end row-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
</body>

</html>