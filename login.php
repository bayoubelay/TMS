<?php
session_start();
include("include/config.php");
error_reporting(0);
if(isset($_POST['submit']))
{
$uname=$_POST['username'];
$dpassword=md5($_POST['password']);	
$ret=mysqli_query($con,"SELECT * FROM account WHERE username='$uname' and password='$dpassword'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
     if($num['role']=="Admin"){
		if($num['status']=="Active"){

		$_SESSION['adminlogin']=$_POST['username'];
		$_SESSION['adminid']=$num['userid'];
		$uid=$num['userid'];
		$uip=$_SERVER['REMOTE_ADDR'];
		$status=1;

header("location:admin/dashboard.php");
	 }
	 else{
			$_SESSION['errmsg'] = "Your account is blocked. Please contact the DBA!";
			header("location:login.php");
	 }
	}

    else if($num['role']=="Dispatcher"){
		if($num['status']=="Active"){
			
		$_SESSION['dispatcherlogin']=$_POST['username'];
		$_SESSION['dispatcherid']=$num['userid'];
		$uid=$num['userid'];
		$uip=$_SERVER['REMOTE_ADDR'];
		$status=1;

$log=mysqli_query($con,"insert into dispatcherlog(uid,username,userip,status) values('$uid','$uname','$uip','$status')");

header("location:dispatcher/dashboard.php");
	 }
	 else{
		$uip=$_SERVER['REMOTE_ADDR'];
			$status=0;
			mysqli_query($con,"insert into dispatcherlog(username,userip,status) values('$uname','$uip','$status')");
			$_SESSION['errmsg'] = "Your account is blocked. Please contact the admin!";
			header("location:login.php");
	 }
	}


    else if($num['role']=="Ass-Coord"){
		if($num['status']=="Active"){
		$_SESSION['asscoordlogin']=$_POST['username'];
		$_SESSION['asscoordid']=$num['userid'];
		$uid=$num['userid'];
		$uip=$_SERVER['REMOTE_ADDR'];
		$status=1;

$log=mysqli_query($con,"insert into userlog(uid,username,userip,status) values('$uid','$uname','$uip','$status')");

header("location:asscoord/dashboard.php");
	 }
	 else{
		$uip=$_SERVER['REMOTE_ADDR'];
			$status=0;
			mysqli_query($con,"insert into userlog(username,userip,status) values('$uname','$uip','$status')");
			$_SESSION['errmsg'] = "Your account is blocked. Please contact the admin!";
			header("location:login.php");
	 }
	}


	 else{
		

			$uip=$_SERVER['REMOTE_ADDR'];
			$status=0;
			mysqli_query($con,"insert into userlog(username,userip,status) values('$uname','$uip','$status')");
			$_SESSION['errmsg']="Invalid username or password";
			header("location:login.php");	
	}
	 

}
else
{

$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
mysqli_query($con,"insert into userlog(username,userip,status) values('$uname','$uip','$status')");
$_SESSION['errmsg']="Invalid username or password";
header("location:login.php");

}
}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<title>TMS | Login Page</title>
		
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
	<body class="login" style="background-color:#E1E8F2;">
		<div class="row">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="logo margin-top-30">  <br><br><br>
				<a href="../index.php">	<h2> <center>TMS | Login Page</center></h2></a>
				</div>

				<div class="box-login">
					<form class="form-login" method="post">
						<fieldset>
							<legend>
								Sign in to your account
							</legend>
							<p>
								Please enter username/email and password to log in.<br />
								<center><span style="color:red; font-size:13px; font-weight:bold;"><?php echo htmlentities($_SESSION['errmsg']); ?></span></center>

				
					</p>
							<div class="form-group">
								<span class="input-icon">
									<input type="email" class="form-control" name="username" placeholder="Username/Email">
									<i class="fa fa-user"></i> </span>
							</div>
							<div class="form-group form-actions">
								<span class="input-icon">
									<input type="password" class="form-control password" name="password" placeholder="Password">
									<i class="fa fa-lock"></i>
									 </span> <br>
									 <a href="forgot-password.php">
									Forgot Password ?
								</a>
							</div>
							<div class="form-actions">
								
								<button type="submit" class="btn btn-primary pull-right" name="submit">
									Login <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
							<a href="../index.php">Back to Home Page</a>

						
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