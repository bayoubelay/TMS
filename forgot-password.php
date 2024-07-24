<?php
session_start();
error_reporting(0);
include("include/config.php");

// Handle form submission to generate OTP and redirect to OTP verification page
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $role = $_POST['user_type'];
	$_SESSION['rolee'] = $role;

    $query = mysqli_query($con,"SELECT * FROM account WHERE username='$email' AND role='$role'");
    $row = mysqli_fetch_assoc($query);

    if($row) {
        // Generate OTP and store it in session
        $otp = rand(100000, 999999); // Generating a 6-digit OTP
        $_SESSION['otp'] = $otp;
		$query = mysqli_query($con, "INSERT INTO forgot_password (email, otp) VALUES ('$email', '$otp')");
        $_SESSION['email'] = $email;
        include('asscoord/PHPMailer/sendemail.php');
        // Open OTP verification popup window
        echo "<script>window.open('verify-otp.php', '_self', 'width=600,height=400');</script>";
    } else {
		echo "<script>alert('The entered email is not registered. Please try with a valid email.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>TMS | Password Recovery</title>
		
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="icon" href="../h.jpg">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
	</head>
	<body class="login">
		<div class="row">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="logo margin-top-30">
     			<center><a href="login.php"><h2 style="font-size:23px; margin-top:70px;"> TMS | Password Recovery</h2></a></center>		
			</div>

				<div class="box-login">
					<form class="form-login" method="post">
						<fieldset>
							<legend>
								 Password Recovery
							</legend>
							<p>
								Please Enter your Email to recover your password.<br />
					
							</p>

							

							<div class="form-group">
								<span class="input-icon">
									<input type="email" class="form-control" name="email" style="text-align: center;" placeholder="Registered Email">
									<i class="fa fa-envelope"></i> </span>
							</div>

							<div class="form-group form-actions">
							<span class="input-icon">
							<i class="fa fa-user"></i> 

								<select name="user_type" class="form-control">
									<option  style="text-align: center;" value="Admin">Admin</option>
									<option  style="text-align: center;" value="Dispatcher">Dispatcher</option>
									<option   style="text-align: center;" value="Ass-Coord">Ass-Coord</option>
								</select>
							</span>
						    </div>


							<div class="form-actions">
								
								<button type="submit" class="btn btn-primary pull-right" name="submit">
									Reset <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
							<div class="new-account">
								Already have an account? 
								<a href="login.php">
									Log-in
								</a>
							</div>
						</fieldset>
					</form>

					<div class="copyright">
					<span class="text-bold text-uppercase"> Transport Management System</span>
					</div>
			
				</div>

			</div>
		</div>
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
	
		<script src="assets/js/main.js"></script>

		<script src="assets/js/login.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
		</script>
	
	</body>
	<!-- end: BODY -->
</html>