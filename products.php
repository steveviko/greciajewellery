<?php
// core configuration
include_once "config/core.php";


 
// include login checker
$require_login=false;
include_once "login_checker.php";

// include classes
include_once './config/database.php';
include_once './objects/user.php';
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

// set page title
$page_title="products";

//set user session id
$_SESSION['user_id'] = $user->id;

// include page header HTML
 include_once "layout_header.php";
 
 ?>
<div class="men">
	<div class="container">
		
	  <div class="col-md-3 sidebar">
	  
		<a href="<?php echo $home_url; ?>"><img src="images/logo1.jpg" style= "width:99%;height:230px;" alt=""/></a>
		<div class="block block-layered-nav">
		    
			<?php  include_once "action.php";?>
			<?php getCats();?>		
		        
		    
			
			
		</div>
		 <div class="box3" style="margin-top:10px;">
			 	<ul class="list1">
			 		<i class="clock1"> </i>
			 		<li class="list1_right"><p>Easy Extended Returned</p></li>
			 		<div class="clearfix"> </div>
			 	</ul>
			 </div>
			  <div class="box2" style="margin-top:10px;">
			 	<ul class="list1">
			 		<i class="lock"> </i>
			 		<li class="list1_right"><p>Upto 5% Reward on your shipping</p></li>
			 		<div class="clearfix"> </div>
			 	</ul>
			 </div>
			  <div class="box3" style="margin-top:10px;">
			 	<ul class="list1">
			 		<i class="lock"> </i>
			 		<li class="list1_right"><p>Upto 5% Reward on your shipping</p></li>
			 		<div class="clearfix"> </div>
			 	</ul>
			 </div>
			  <div class="box4" style="margin-top:10px;">
			 	<ul class="list1">
			 		<i class="lock"> </i>
			 		<li class="list1_right"><p>Upto 5% Reward on your shipping</p></li>
			 		<div class="clearfix"> </div>
			 	</ul>
			 </div>
		</div>
		
			

<div class="col-md-9">
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
		$stmt=$product->read($from_record_num, $records_per_page);
		 
		// count number of retrieved products
		$num = $stmt->rowCount();
		 
		// if products retrieved were more than zero
		if($num>0){
			// needed for paging
			$page_url="products.php?";
			$total_rows=$product->count();
			?>
			<div class="sellers_grid">
			<ul class="sellers">
				<i class="star"> </i>
				<li class="sellers_desc"><h2>All Products</h2></li>
				<div class="clearfix"> </div>
			</ul>
		</div>
		<?php
		 
			// show products
			include_once "read_products_template.php";
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
</div>
<div class="content_top">
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