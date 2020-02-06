<?php
// core configuration
include_once "config/core.php";
 
// set page title
$page_title="Index";

// include login checker
$require_login=true;
include_once "login_checker.php";
 
	// include classes
include_once "config/database.php";
include_once "objects/user.php";
include_once './objects/product.php';
include_once './objects/category.php';
include_once './objects/cart_item.php ';
include_once './objects/deal.php';
include_once './objects/specail.php';
include_once './objects/order.php';

 
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
$order = new Order($db);


 
 // for pagination purposes
$page = isset($_GET['page']) ? $_GET['page'] : 1; // page is the current page, if there's nothing set, default is page 1
$records_per_page = 6; // set records or rows of data per page
$from_record_num = ($records_per_page * $page) - $records_per_page; // calculate for the query LIMIT clause

// include page header HTML
 include_once "layout_header.php";
 
 ?>
<div class="men">

	<div class="container">
		
	  <div class="col-md-3 sidebar">
	  
		<a href="<?php echo $home_url; ?>"><img src="images/logo1.jpg" style= "width:99%;height:230px;" alt=""/></a>
		<div class="block block-layered-nav">
		    <div class="block-title">
		        <strong><span>My profile</span></strong>
		    </div>
			<?php// check if users / customer was logged in
			// if user was logged in, show "Edit Profile", "Orders" and "Logout" options
			//if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true && $_SESSION['access_level']=='Customer'){
			?>
			 <div class="block-title">
				<strong <?php echo $page_title=="Edit Profile" ? "class='active'" : ""; ?>>					
						<span class="glyphicon glyphicon-user" aria-hidden="true">
						&nbsp;&nbsp;<?php echo $_SESSION['firstname']; ?>
						</span>				
				</strong>
			</div>
			<div class="block-title" style="background:blue">
						<a href="user_order.php"><strong><span>Orders</span></strong></a>
			</div>
			<div class="block-title" style="background:blue">
						<a href="user_wish.php"><strong><span>WishLists</span></strong></a>
			</div>
			<div class="block-title" style="background:blue">
						<a href="logout.php"><strong><span>Logout</span></strong></a>
			</div>
			<div class="block-title" style="background:blue">
						
			</div>
			
			<div class="block-title" style="background:blue">
						<a href="#"><strong><span>View By Category</span></strong></a>
			</div>
			<?php  include_once "action.php";?>
			<?php getCats();?>		
		        
			
		</div>
		
			
			
			 <div class="box2" style="margin-top:10px;">
			 	<ul class="list1">
			 		<i class="lock"> </i>
			 		<li class="list1_right"><p  style=""> <i class="fa fa-phone"></i> call:+256 787967393</p><span style="color:#fff;" class="fa fa-whatsapp">&nbsp;+256 701419936</span></li>
			 		<div class="clearfix"> </div>
			 	</ul>
			 </div>
			
			  <div class="box2" style="margin-top:10px;">
			 		<ul class="list1">
			 		<i class="clock1"> </i>
			 		<li class="list1_right"><p style="color:#000;">Delivery Time.<br/>9:00am-6:00Pm.</p><span style="color:#000;"> From Monday-Suturday</span></li>
			 		<div class="clearfix"> </div>
			 	</ul>
			 </div>
			  <div class="box3" style="margin-top:10px;">
			 	<ul class="list1">
			 		<i class="vehicle"> </i>
			 		<li class="list1_right"><p>Free Delivery within Kampala.</p></li>
			 		<div class="clearfix"> </div>
			 	</ul>
			 </div>
			
		</div>
		
			

<div class="col-md-9">
<?php
		$action = isset($_GET['action']) ? $_GET['action'] : "";
 
		echo "<div class='col-md-12'>";
			if($action=='removed'){
				echo "<div class='alert alert-info'>";
					echo "Product was removed from your cart!";
				echo "</div>";
			}
		 
			else if($action=='quantity_updated'){
				echo "<div class='alert alert-info'>";
					echo "Product quantity was updated!";
				echo "</div>";
			}
		 
			else if($action=='exists'){
				echo "<div class='alert alert-info'>";
					echo "Product already exists in your cart!";
				echo "</div>";
			}
		 
			else if($action=='cart_emptied'){
				echo "<div class='alert alert-info'>";
					echo "Cart was emptied.";
				echo "</div>";
			}
		 
			else if($action=='updated'){
				echo "<div class='alert alert-info'>";
					echo "Quantity was updated.";
				echo "</div>";
			}
		 
			else if($action=='unable_to_update'){
				echo "<div class='alert alert-danger'>";
					echo "Unable to update quantity.";
				echo "</div>";
			}
		echo "</div>";

		 
			
				
		 
		?>
		<div class="sellers_grid">
			<ul class="sellers">
				<i class="star"> </i>
				<li class="sellers_desc"><h2>Your Order List</h2></li>
				<div class="clearfix"> </div>
			</ul>
		</div>
	<div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
			 <th>Products</th>
            <th>Delivery Address</th>
			 <th>Contact</th>
            <th>Status</th>
			 <th>Total Price</th>
            <th>Action</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
		
        <tbody>
		<?php
		 // =================
		 // query orders
		$stmt = $order->readUserOrder();
		$num = $stmt->rowCount();

		// $cart_count variable is initialized in navigation.php
			if($num>0){
			 
				
			 
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					extract($row);
			 
					
								?>
          <tr>
		  <td></td>
            <?php echo "<td class='' style='width:50px;height:50px;'>{$products} </td>";?>
            <td><?php echo $address; ?></td>
			  
			 <td><?php echo $phone; ?> </td>
			 
			
			 
            <td><span class="text-ellipsis"><?php echo $status ?></span></td>
            <td><?php echo "<h4>Ugx:" . number_format($total_amount, 2, '.', ',') . "</h4>"; ?></td>
			<td><span class="text-ellipsis">
			<?php // delete from cart
						echo "<a href='remove_from_cart.php?id={$id}' class='btn btn-danger'>";
							echo "<i class='fa fa-trash'></i>Delete";
						echo "</a>";?>
			</span></td>
            <td>
              <a href="" class="active" ui-toggle-class=""><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
		
					<?php 
		 
				
		 
				?>
        
        </tbody>
		<?php }?>
      </table>
    </div>
			<?php 
		 
			echo "<div class='col-md-8'></div>";
			echo "<div class='col-md-4 pull-left'>";
			
			echo "</div>";
			echo "<div class='col-md-12 '>";
			echo "<h4 > </h4>";
					echo "<h4 class='m-b-10px '></h4>";
			
				echo "<div class='cart-row pull-right'>";
					
					
					echo "<a href='products.php' class='btn btn-success m-b-10px '>";
						echo "<span class='fa fa-shopping-cart '></span> Continue shopping";
					echo "</a>";
					
					
					
				echo "</div>";
			echo "</div>";
		 
		}
		 
		// no products were added to cart
		else{
			echo "<div class='col-md-12'>";
				echo "<div class='alert alert-danger'>";
					echo "No orders found in Lists!";
				echo "</div>";
			echo "</div>";
		}
		
	?>
		
		
		
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