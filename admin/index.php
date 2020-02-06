<?php
// core configuration
include_once "../config/core.php";
 
// check if logged in as admin
include_once "login_checker.php";

// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
include_once '../objects/product.php';
include_once '../objects/category.php';
include_once '../objects/order.php';
include_once '../objects/message.php';
include_once '../objects/wish_item.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$user = new User($db);

// pass connection to objects
$product = new Product($db);
$category = new Category($db);
$order = new Order($db);
$message = new Message($db);
$wish_item = new WishItem($db);
 
// set page title
$page_title="Admin Index";

// include header
include_once "layout_header.php";
 ?>

<!--sidebar start-->
<?php // include header
include_once "layout_aside.php";

?>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<?php
		
		// get parameter values, and to prevent undefined index notice
        $action = isset($_GET['action']) ? $_GET['action'] : "";
 
        // tell the user he's already logged in
        if($action=='already_logged_in'){
            echo "<div class='alert alert-info'>";
                echo "<strong>You</strong> are already logged in.";
            echo "</div>";
        }
 
        else if($action=='logged_in_as_admin'){
            echo "<div class='alert alert-info'>";
                echo "<strong>You</strong> are logged in as admin.";
            echo "</div>";
        }
		$product_count =$product->countAll();
		$order_count =$order->countAll();
		$message_count =$message->countAll();
		$user_count =$user->countAll();
		
		?>
		<!-- //market-->
		<div class="market-updates">
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-2">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-user fa-lg"> </i>
					</div>
					 <div class="col-md-8 market-update-left">
					 <h4>Customers</h4>
					<h3><?= $user_count ?></h3>
					<p></p>
				  </div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-list fa-lg" ></i>
					</div>
					<div class="col-md-8 market-update-left">
					<h4>Products</h4>
						<h3><?= $product_count ?></h3>
						<p></p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-envelope fa-lg"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Messages</h4>
						<h3><?= $message_count ?></h3>
						<p></p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-4">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Orders</h4>
						<h3><?= $order_count ?></h3>
						<p></p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
		   <div class="clearfix"> </div>
		</div>	
		<!-- //market-->
	
		
		
</section>
 <!-- footer -->
		<?php include_once "layout_footer.php"?>
  <!-- / footer -->
