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

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$user = new User($db);
// pass connection to objects
$product = new Product($db);
$category = new Category($db);
$cart_item = new CartItem($db);
// to prevent undefined index notice
$action = isset($_GET['action']) ? $_GET['action'] : "";
 
// for pagination purposes
$page = isset($_GET['page']) ? $_GET['page'] : 1; // page is the current page, if there's nothing set, default is page 1
$records_per_page = 6; // set records or rows of data per page
$from_record_num = ($records_per_page * $page) - $records_per_page; // calculate for the query LIMIT clause

// get search term
$search_term=isset($_GET['s']) ? $_GET['s'] : '';
 
$page_title = "You searched for \"{$search_term}\"";

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
		
		// query products
		$stmt = $product->search($search_term, $from_record_num, $records_per_page);
		 
		// specify the page where paging is used
		$page_url="search.php?s={$search_term}&";
		 
		// count total rows - used for pagination
		$total_rows=$product->countAll_BySearch($search_term);
		
		
		// display the products if there are any
		if($total_rows>0){

			
			?>
			<div class="sellers_grid">
			<ul class="sellers">
				<i class="star"> </i>
				<li class="sellers_desc"><h2>Your search results</h2></li>
				<div class="clearfix"> </div>
			</ul>
		</div>
		<?php
		 
			
		// read_template.php controls how the product list will be rendered
		include_once "read_template.php";

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
			 		<li class="list1_right"><p>Upto 5% Reward on your shipping</p></li>
			 		<div class="clearfix"> </div>
			 	</ul>
			 </div>
			</div>
			<div class="col-md-3">
			 <div class="box3">
			 	<ul class="list1">
			 		<i class="clock1"> </i>
			 		<li class="list1_right"><p>Easy Extended Returned</p></li>
			 		<div class="clearfix"> </div>
			 	</ul>
			 </div>
			</div>
			<div class="col-md-3">
			 <div class="box4">
			 	<ul class="list1">
			 		<i class="vehicle"> </i>
			 		<li class="list1_right"><p>Free Shipping on order over 99 $</p></li>
			 		<div class="clearfix"> </div>
			 	</ul>
			 </div>
			</div>
			<div class="col-md-3">
			 <div class="box5">
			 	<ul class="list1">
			 		<i class="dollar"> </i>
			 		<li class="list1_right"><p>Delivery Schedule Spread Cheer Time</p></li>
			 		<div class="clearfix"> </div>
			 	</ul>
			 </div>
			</div>
			<div class="clearfix"> </div>
			</div>
	</div>
</div>

<div class="content_middle">
	<div class="container">
		<ul class="promote">
			<i class="promote_icon"> </i>
			<li class="promote_head"><h3>Promotion</h3></li>
		</ul>
		 <ul id="flexiselDemo3">
						<li><img src="images/n1.jpg"  class="img-responsive" /><div class="grid-flex"><h4>Contrary to popular </h4><p>589,90 $</p>
							<div class="m_3"><a href="#" class="link2">Add to Cart</a></div>
							<div class="ticket"> </div>
						</div></li>
						<li><img src="images/n2.jpg"  class="img-responsive" /><div class="grid-flex"><h4>Contrary to popular </h4><p>589,90 $</p>
							<div class="m_3"><a href="#" class="link2">Add to Cart</a></div>
							<div class="ticket"> </div>
						</div></li>
						<li><img src="images/n3.jpg"  class="img-responsive" /><div class="grid-flex"><h4>Contrary to popular </h4><p>589,90 $</p>
							<div class="m_3"><a href="#" class="link2">Add to Cart</a></div>
							<div class="ticket"> </div>
						</div></li>
						<li><img src="images/n4.jpg"  class="img-responsive" /><div class="grid-flex"><h4>Contrary to popular </h4><p>589,90 $</p>
							<div class="m_3"><a href="#" class="link2">Add to Cart</a></div>
							<div class="ticket"> </div>
						</div></li>
						<li><img src="images/n5.jpg"  class="img-responsive" /><div class="grid-flex"><h4>Contrary to popular </h4><p>589,90 $</p>
							<div class="m_3"><a href="#" class="link2">Add to Cart</a></div>
							<div class="ticket"> </div>
						</div></li>
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