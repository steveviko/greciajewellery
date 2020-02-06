<?php
//
//
//Username: darwin@example.com
//Password: darwin12qw!@QW
//
//Username: mike@example.com
//Password: ninja12qw!@QW
//
// core configuration
include_once "config/core.php";
include_once "config.php";
// set page title
$page_title = "Login";
 
// include login checker
$require_login=false;
include_once "login_checker.php";
 
// default to false
$access_denied=false;


	// include classes
include_once "config/database.php";
include_once "objects/user.php";
include_once './objects/product.php';
include_once './objects/category.php';
include_once './objects/cart_item.php ';
include_once './objects/deal.php';
include_once './objects/specail.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$user = new User($db);
// pass connection to objects
$product = new Product($db);
$category = new Category($db);
$cart_item = new CartItem($db);
$deal = new Deal($db);
$specail = new Specail($db);

// to prevent undefined index notice
$action = isset($_GET['action']) ? $_GET['action'] : "";
 
// for pagination purposes
$page = isset($_GET['page']) ? $_GET['page'] : 1; // page is the current page, if there's nothing set, default is page 1
$records_per_page = 6; // set records or rows of data per page
$from_record_num = ($records_per_page * $page) - $records_per_page; // calculate for the query LIMIT clause

// post code will be here
// if the login form was submitted
if($_POST){
    // email check will be here

// check if email and password are in the database
$user->email=$_POST['email'];
 
// check if email exists, also get user details using this emailExists() method
$email_exists = $user->emailExists();
 
// login validation will be here
// validate login
if ($email_exists && password_verify($_POST['password'], $user->password) && $user->status==1){
 
    // if it is, set the session value to true
    $_SESSION['logged_in'] = true;
    $_SESSION['user_id'] = $user->id;
    $_SESSION['access_level'] = $user->access_level;
    $_SESSION['firstname'] = htmlspecialchars($user->firstname, ENT_QUOTES, 'UTF-8') ;
    $_SESSION['lastname'] = $user->lastname;
 
    // if access level is 'Admin', redirect to admin section
    if($user->access_level=='Admin'){
        header("Location: admin/index.php?action=login_success");
    }
 
    // else, redirect only to 'Customer' section
    else{
        header("Location: index.php?action=login_success");
    }
}
 
// if username does not exist or password is wrong
else{
    $access_denied=true;
}
}
 
// login form html will be here
//include_once "login_form.php";
?>
<?php include_once "layout_header.php";?>
<div class="men  ">
	<div class="container">
		
	  <div class="col-md-3 sidebar">
	  
		<a href="<?php echo $home_url; ?>"><img src="images/logo1.jpg" style= "width:97%;height:230px;" alt=""/></a>
	
		</div>
<div class="col-md-9  ">
<div class="index_slider">
	<div class="col-md-12" style="    float: left;
    width: 106.4%;margin-left: -3.3%;    padding: 3px 12px;">
	  <div class="callbacks_container ">
	      <ul class="rslides " id="slider">
	        <li><img src="images/10.jpg" class="img-responsive" alt=""/></li>
	        <li><img src="images/11.jpg" class="img-responsive" alt=""/></li>
	        <li><img src="images/12.jpg" class="img-responsive" alt=""/></li>
			 <li><img src="images/11.jpg" class="img-responsive" alt=""/></li>
	      </ul>
	  </div>
	</div> 
</div>
</div>
</div>
</div>
<div class="content_top ">
	<div class="container">
		<div class="grid_1">
			<div class="col-md-3">
			 <div class="box2">
			 	<ul class="list1">
			 		<i class="lock"> </i>
			 		<li class="list1_right"><p  style=""> <i class="fa fa-phone"></i> call:+256 787967393</p><span style="color:#fff;" class="fa fa-whatsapp">&nbsp;+256 701419936</span></li>
			 		<div class="clearfix"> </div>
			 	</ul>
			 </div>
			 
			</div>
			<div class="col-md-3">
			 <div class="box3">
			 	<ul class="list1">
			 		<i class="clock1"> </i>
			 		<li class="list1_right"><p style="color:#000;">Delivery Time.<br/>9:00am-6:00Pm.</p><span style="color:#000;"> From Monday-Suturday</span></li>
			 		<div class="clearfix"> </div>
			 	</ul>
			 </div>
			</div>
			<div class="col-md-3">
			 <div class="box4">
			 	<ul class="list1">
			 		<i class="vehicle"> </i>
			 		<li class="list1_right"><p>Free Delivery within Kampala.</p></li>
			 		<div class="clearfix"> </div>
			 	</ul>
			 </div>
			</div>
			<div class="col-md-3">
			 <div class="box5">
			 	<ul class="list1">
			 		<i class="clock1"> </i>
			 		<li class="list1_right"><p>Working Hrs 24/7. Only </p><span style="color:#fff;">On Our socail Media Platform
							<a href="#"><i class="fa fa-facebook" style="color:#3B5998;"></i></a>&nbsp;
							<a href="#"><i class="fa fa-twitter" style="color:#55ACEE;"></i></a>&nbsp;
							<a href="#"><i class="fa fa-instagram" style="color:#3F729B;"></i></a>&nbsp;
							<a href="#"><i class="fa fa-whatsapp" style="color:green;"></i></a>
					
					</span></li>
			 		<div class="clearfix"> </div>
			 	</ul>
			 </div>
			</div>
			<div class="clearfix"> </div>
			</div>
			<div class="sellers_grid">
			<ul class="sellers" style="background:rgb(67, 76, 82);margin-bottom:40px;" >				
				<li class="soc-media"><span style="color:#fff;">connect with us on
							<a href="#"><i class="fa fa-facebook" style="color:#3B5998;margin-left:20px;font-size:20px;"></i></a>&nbsp;
							<a href="#"><i class="fa fa-twitter" style="color:#55ACEE;margin-left:20px;font-size:20px;"></i></a>&nbsp;
							<a href="#"><i class="fa fa-instagram" style="color:#3F729B;margin-left:20px;font-size:20px;"></i></a>&nbsp;
							<a href="#"><i class="fa fa-whatsapp" style="color:green;margin-left:20px;font-size:20px;"></i></a>
					
					</span></li>
				<div class="clearfix"> </div>
			</ul>
		</div>
		<div class="clearfix"> </div>
		<div class="clearfix"> </div>
			<?php
		echo "<div class='col-md-12'>";
			if($action=='added'){
				echo "<div class='alert alert-info'>";
					echo "Product was added to your cart!";
				echo "</div>";
			}
		 
			if($action=='exists'){
				echo "<div class='alert alert-info'>";
					echo "Product already exists in your cart!";
				echo "</div>";
			}
		echo "</div>";
		
		// read all products in the database
		$stmt=$product->readLate($from_record_num, $records_per_page);
		 
		// count number of retrieved products
		$num = $stmt->rowCount();
		 
		// if products retrieved were more than zero
		if($num>0){
			// needed for paging
			$page_url="login.php?";
			$total_rows=$product->count();
			?>
		
		<div class="sellers_grid">
			<ul class="sellers" style="background:rgba(1, 110, 182, 1);" >
				<i class="star" style="color:white"> </i>
				<li class="sellers_desc" style="color:white"><h2>Latest Arrivals</h2></li>
				<div class="clearfix"> </div>
			</ul>
		</div>
		<?php
		 
			// show products
			include_once "read_latest_template.php";
		}
		 
		// tell the user if there's no products in the database
		else{
			echo "<div class='col-md-12'>";
				echo "<div class='alert alert-danger'>No products found.</div>";
			echo "</div>";
		}

		?>
		
		
					<?php
		echo "<div class='col-md-12'>";
			if($action=='added'){
				echo "<div class='alert alert-info'>";
					echo "Product was added to your cart!";
				echo "</div>";
			}
		 
			if($action=='exists'){
				echo "<div class='alert alert-info'>";
					echo "Product already exists in your cart!";
				echo "</div>";
			}
		echo "</div>";
		
		// read all products in the database
		$stmt=$product->readBest($from_record_num, $records_per_page);
		 
		// count number of retrieved products
		$num = $stmt->rowCount();
		 
		// if products retrieved were more than zero
		if($num>0){
			// needed for paging
			$page_url="login.php?";
			$total_rows=$product->count();
			?>
		<div class="sellers_grid">
			<ul class="sellers" style="background:rgba(246, 202, 108, 1)">
				<i class="star"> </i>
				<li class="sellers_desc"><h2>Best Sellers</h2></li>
				<div class="clearfix"> </div>
			</ul>
		</div>
		<?php
		 
			// show products
			include_once "read_Best_template.php";
		}
		 
		// tell the user if there's no products in the database
		else{
			echo "<div class='col-md-12'>";
				echo "<div class='alert alert-danger'>No products found.</div>";
			echo "</div>";
		}

		?>
		<?php
		echo "<div class='col-md-12'>";
			if($action=='added'){
				echo "<div class='alert alert-info'>";
					echo "Product was added to your cart!";
				echo "</div>";
			}
		 
			if($action=='exists'){
				echo "<div class='alert alert-info'>";
					echo "Product already exists in your cart!";
				echo "</div>";
			}
		echo "</div>";
		
		// read all products in the database
		$stmt=$deal->readHot($from_record_num, $records_per_page);
		 
		// count number of retrieved products
		$num = $stmt->rowCount();
		 
		// if products retrieved were more than zero
		if($num>0){
			// needed for paging
			$page_url="login.php?";
			$total_rows=$deal->count();
			?>
		
		<div class="sellers_grid">
			<ul class="sellers">
				<i class="star"> </i>
				<li class="sellers_desc"><h2>Our Weekly Deals</h2></li>
				<div class="clearfix"> </div>
			</ul>
		</div>
		<?php
		 
			// show products
			include_once "read_deals_template.php";
		}
		 
		// tell the user if there's no products in the database
		else{
			echo "<div class='col-md-12'>";
				echo "<div class='alert alert-danger'>No products found.</div>";
			echo "</div>";
		}

		?>
			<?php
		echo "<div class='col-md-12'>";
			if($action=='added'){
				echo "<div class='alert alert-info'>";
					echo "Product was added to your cart!";
				echo "</div>";
			}
		 
			if($action=='exists'){
				echo "<div class='alert alert-info'>";
					echo "Product already exists in your cart!";
				echo "</div>";
			}
		echo "</div>";
		
		// read all products in the database
		$stmt=$product->readPick($from_record_num, $records_per_page);
		 
		// count number of retrieved products
		$num = $stmt->rowCount();
		 
		// if products retrieved were more than zero
		if($num>0){
			// needed for paging
			$page_url="login.php?";
			$total_rows=$product->count();
			?>
		<div class="sellers_grid">
			<ul class="sellers" style="background:rgba(13, 200, 246, 1)">
				<i class="star"> </i>
				<li class="sellers_desc"><h2>PICKED FOR YOU</h2></li>
				<div class="clearfix"> </div>
			</ul>
		</div>
			<?php
		 
			// show products
			include_once "read_pick_template.php";
		}
		 
		// tell the user if there's no products in the database
		else{
			echo "<div class='col-md-12'>";
				echo "<div class='alert alert-danger'>No products found.</div>";
			echo "</div>";
		}

		?>
		
	</div>
</div>
<?php
		echo "<div class='col-md-12'>";
			if($action=='added'){
				echo "<div class='alert alert-info'>";
					echo "Product was added to your cart!";
				echo "</div>";
			}
		 
			if($action=='exists'){
				echo "<div class='alert alert-info'>";
					echo "Product already exists in your cart!";
				echo "</div>";
			}
		echo "</div>";
		
		// read all products in the database
		$stmt=$specail->readSpecail($from_record_num, $records_per_page);
		 
		// count number of retrieved products
		$num = $stmt->rowCount();
		 
		// if products retrieved were more than zero
		if($num>0){
			// needed for paging
			$page_url="login.php?";
			$total_rows=$specail->count();
			?>
<div class="content_middle">
	<div class="container">
		<ul class="promote">
			<i class="promote_icon"> </i>
			<li class="promote_head"><h3>Specail offers on Promotion</h3></li>
		</ul>
		 <ul id="flexiselDemo3">
						<?php
		 
			// show products
			include_once "read_specails_template.php";
		}
		 
		// tell the user if there's no products in the database
		else{
			echo "<div class='col-md-12'>";
				echo "<div class='alert alert-danger'>No products found.</div>";
			echo "</div>";
		}

		?>
				     </ul>
				    <script type="text/javascript">
					 $(window).load(function() {
						$("#flexiselDemo3").flexisel({
							visibleItems: 6,
							animationSpeed: 1000,
							autoPlay:true,
							autoPlaySpeed: 3000,    		
							pauseOnHover: true,
							enableResponsiveBreakpoints: true,
					    	responsiveBreakpoints: { 
					    		portrait: { 
					    			changePoint:480,
					    			visibleItems: 1
					    		}, 
					    		landscape: { 
					    			changePoint:640,
					    			visibleItems: 2
					    		},
					    		tablet: { 
					    			changePoint:768,
					    			visibleItems: 3
					    		}
					    	}
					    });
					    
					});
				   </script>
				   <script type="text/javascript" src="js/jquery.flexisel.js"></script>
	</div>
</div>
<?php include_once "layout_footer.php";?>