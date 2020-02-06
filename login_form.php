<?php
// core configuration
include_once "config/core.php";
 
// set page title
$page_title = "LoginForm";
 
// include login checker
$require_login=false;
include_once "login_checker.php";
 
// default to false
$access_denied=false;
 

?>

<!DOCTYPE html>
<head>
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="jewellery," />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="./admin/css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="./admin/css/style.css" rel='stylesheet' type='text/css' />
<link href="./admin/css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="./admin/css/font.css" type="text/css"/>
<link href="./admin/css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="./admin/js/jquery2.0.3.min.js"></script>
</head>
<body>
<div class="log-w3">
<div class="w3layouts-main">
	<?php 
	
			// get 'action' value in url parameter to display corresponding prompt messages
			$action=isset($_GET['action']) ? $_GET['action'] : "";
			 
			// tell the user he is not yet logged in
			if($action =='not_yet_logged_in'){
				echo "<div class='alert alert-danger margin-top-40' role='alert'>Please login.</div>";
			}
			 
			// tell the user to login
			else if($action=='please_login'){
				echo "<div class='alert alert-info'>
					<strong>Please login to access that page.</strong>
				</div>";
			}
			 
			// tell the user email is verified
			else if($action=='email_verified'){
				echo "<div class='alert alert-success'>
					<strong>Your email address have been validated.</strong>
				</div>";
			}
			 
			// tell the user if access denied
			if($access_denied){
				echo "<div class='alert alert-danger margin-top-40' role='alert'>
					Access Denied.<br /><br />
					Your username or password maybe incorrect
				</div>";
			}
	?>
	<h2>Sign In Now</h2>
		<form action='login.php' method="post">
			<input type="email" class="ggg" name="email" placeholder="E-MAIL" required="">
			<input type="password" class="ggg" name="password" placeholder="PASSWORD" required="">
			<span><input type="checkbox" />Remember Me</span>
			<h6><a href="#">Forgot Password?</a></h6>
				<div class="clearfix"></div>
				<input type="submit" value="Sign In" name="login">
		</form>
		<p>Don't Have an Account ?<a href="signup.php">Create an account</a></p>
</div>
</div>
<script src="./admin/js/bootstrap.js"></script>
<script src="./admin/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="./admin/js/scripts.js"></script>
<script src="./admin/js/jquery.slimscroll.js"></script>
<script src="./admin/js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="./admin/js/jquery.scrollTo.js"></script>
</body>
</html>
