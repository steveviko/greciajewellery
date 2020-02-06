<?php

// core configuration
include_once "config/core.php";
 
// set page title
$page_title = "Register";
 
// include login checker
include_once "login_checker.php";
 
// include classes
include_once 'config/database.php';
include_once 'objects/user.php';
include_once "libs/php/utils.php";

?>
<!DOCTYPE html>
<head>
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
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
<div class="reg-w3">
<div class="w3layouts-main">
<?php
// if form was posted
if($_POST){
 
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
 
    // initialize objects
    $user = new User($db);
    $utils = new Utils();
 
    // set user email to detect if it already exists
    $user->email=$_POST['email'];
 
    // check if email already exists
    if($user->emailExists()){
        echo "<div class='alert alert-danger'>";
            echo "The email you specified is already registered. Please try again or <a href='login_form.php.php'>login.</a>";
        echo "</div>";
    }
 
    else{
        // create user will be here
		// set values to object properties
$user->firstname=$_POST['firstname'];
$user->lastname=$_POST['lastname'];
$user->contact_number=$_POST['contact_number'];
$user->address=$_POST['address'];
$user->password=$_POST['password'];
$user->access_level='Customer';
$user->status=1;
 
// create the user
if($user->create()){
 
    echo "<div class='alert alert-info'>";
        echo "Successfully registered. <a href='login_form.php'>Please login</a>.";
    echo "</div>";
 
    // empty posted values
    $_POST=array();
 
}else{
    echo "<div class='alert alert-danger' role='alert'>Unable to register. Please try again.</div>";
}
    }
}
?>
	<h2>Register Now</h2>
		<form action="#" method="post">
			<input type="text" class="ggg" name="firstname" placeholder="First Name" required value="<?php echo isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname'], ENT_QUOTES) : "";  ?>">
			<input type="text" class="ggg" name="lastname" placeholder="Last Name" required value="<?php echo isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname'], ENT_QUOTES) : "";  ?>">
			<input type="email" class="ggg" name="email" placeholder="E-MAIL" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES) : "";  ?>">
			<input type="text" class="ggg" name="contact_number" placeholder="PHONE" required value="<?php echo isset($_POST['contact_number']) ? htmlspecialchars($_POST['contact_number'], ENT_QUOTES) : "";  ?>" >	
			<input type="text" class="ggg" name="address" placeholder="Address" required value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address'], ENT_QUOTES) : "";  ?>">
			<input type="password" class="ggg" name="password" placeholder="PASSWORD" required id='passwordInput'>
			<h4><input type="checkbox" />I agree to the Terms of Service and Privacy Policy</h4>
			
				<div class="clearfix"></div>
				<input type="submit" value="submit" name="register">
		</form>
		<p>Already Registered.<a href="login_form.php">Login</a></p>
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
