<?php
session_start();
include("include/config.php");

// Code for updating Password
if(isset($_POST['change'])) {
    $role = $_SESSION['rolee'];
    $email = $_SESSION['email'];
    $newpassword = md5($_POST['password']);

    // Check if the password already exists for the given email
    $que = mysqli_query($con, "SELECT * FROM account WHERE username='$email' AND password='$newpassword'");
    if(mysqli_num_rows($que) == 0) {
        // Update password based on email and role
        $query = mysqli_query($con, "UPDATE account SET password='$newpassword' WHERE username='$email' AND role='$role'");

        // Check if password was successfully updated
        if ($query) {
            echo "<script>alert('Password successfully updated.');</script>";
            echo "<script>window.location.href ='login.php'</script>";
        } else {
            echo "<script>alert('Error! Please change another password.');</script>";
            echo "<script>window.location.href ='reset-password.php'</script>";
        }
    } else {
        echo "<script>alert('Error! Please change another password.');</script>";
        echo "<script>window.location.href ='reset-password.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>TMS | Reset Password</title>
		
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

		<script type="text/javascript">
function valid() {
    var password = document.passwordreset.password.value;
    var confirmPassword = document.passwordreset.password_again.value;

    // Check if password length is at least 8 characters
    if(password.length < 8) {
        alert("Password length must be at least 8 characters.");
        document.passwordreset.password.focus();
        return false;
    }

    // Check if Password and Confirm Password fields match
    if(password !== confirmPassword) {
        alert("Password and Confirm Password fields do not match.");
        document.passwordreset.password_again.focus();
        return false;
    }

    return true;
}
</script>

	</head>
	<body class="login">
		<div class="row">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="logo margin-top-30">
               <center>	<a href="login.php"><h2 style="font-size:23px;"> TMS | Reset Password</h2></a></center>
			</div>

				<div class="box-login">
					<form class="form-login" name="passwordreset" method="post" onSubmit="return valid();">
						<fieldset>
							<legend>
							 Reset Password
							</legend>
							<p>
								Please set your new password.<br />
								<span style="color:red;"><?php echo $_SESSION['errmsg']; ?><?php echo $_SESSION['errmsg']="";?></span>
							</p>

<div class="form-group">
<span class="input-icon">
<input type="password" class="form-control" id="password" name="password" style="text-align: center;" placeholder="New Password" required>
<i class="fa fa-lock"></i> </span>
</div>
	

<div class="form-group">
<span class="input-icon">
<input type="password" class="form-control"  id="password_again" name="password_again" style="text-align: center;" placeholder="Confirm Password " required>
<i class="fa fa-lock"></i> </span>
</div>
							

							<div class="form-actions">
								
								<button type="submit" class="btn btn-primary pull-right" name="change">
									Change <i class="fa fa-arrow-circle-right"></i>
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