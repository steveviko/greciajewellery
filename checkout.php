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

// set page title
$page_title="Cart";




// include page header HTML
 include_once "layout_header.php";
 
 ?>
 <div class="men">
	<div class="container">
		
	  <div class="col-md-3 sidebar">
	  
		<a href="<?php echo $home_url; ?>"><img src="images/logo1.jpg" style= "width:99%;height:230px;" alt=""/></a>
		<div class="block block-layered-nav">
		    <div class="block-title">
		        <strong><span>Shop By</span></strong>
		    </div>
			<div class="block-title">
		        <strong><span>Shop </span></strong>
		    </div>
			<div class="block-title">
		        <strong><span>best in town </span></strong>
		    </div>
			<div class="block-title">
		        <strong><span>upto 30% </span></strong>
		    </div>
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
	require_once("config.php");
	$grand_total = 0;
	$allItems    = "";
	$items      = array();

	$sql = "SELECT CONCAT(product_name, '(',quantity,')') AS ItemQty, totalprice FROM cart_items";
	$stmt =$conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	while($row=$result->fetch_assoc()){
		$grand_total += $row['totalprice'];
		$items[] = $row['ItemQty'];


	}
	//echo $grand_total;
	//print_r($items);

	$allItems = implode(",",$items);
	//echo $allItems;
	
				
		 
		?>
			
		
					
					
					
					
		<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 px-4 pb-4" id="order">
            <h4 class="text-center text-info p-2">Complete your order</h4>
        
        <div class="jumbotron p-3 mb-2 text-center">
            <h6 class="bg-danger lead"><b>Product(s): </b> <?= $allItems ?></h6>
            <h6 class=" lead"><b>Delivery charge : </b>Free within Kampala </h6>
            <h6 class=" lead"><b>Total Amount Payable: </b>Ugx <?= number_format($grand_total,2) ?>/=</h6>
        </div>
        <form action="" method="post" id="placeOrder">
        <input type="hidden" name="products" value="<?= $allItems ?>"/>
        <input type="hidden" name="grand_total" value="<?= $grand_total ?>"/>
		<input type="hidden" name="user_id" value="<?= $ip ?>"/>
        <div class='form-group'>
        <input type="text" name="name" class="form-control" placeholder="Enter your Name" required/>
        </div>
        <div class="form-group">
        <input type="tel" name="phone" class="form-control" placeholder="Enter your Phone Number" />
        </div>
        <div class="form-group">
        <textarea  name="address" class="form-control"  rows="3" cols="10" placeholder="Enter Delivery Location Here ..." required></textarea>
        </div>
        <h4 class="text-center lead">Select Your Area Zone</h4>
        <div class="form-group">
        <select name="area" class="form-control">
            <option value=" " selected disabled>--select Area Zone--</option>
            <option value="nakawa">Nakawa</option>
            <option value="kololo">Kololo</option>
            <option value="Naguru">Naguru</option>
            <option value="makindye">Makindye</option>
            <option value="makerere">Makerere</option>
            <option value="Bugolobi">Bugolobi</option>
            <option value="city">City centre</option>
            <option value="Mengo">Mengo</option>
            <option value="ntinda">Ntinda</option>

        </select> 
        </div>
        <div class="form-group">
        <input type="submit" name="submit" class="form-control btn btn-danger btn-block" value="Place your Order"  />
        </div>
        </form>
        </div>
    </div>


</div>
		
		
		
	
	
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
					$(document).ready(function(){
						$("#placeOrder").submit(function(e){
						e.preventDefault();
					   
					   
						$.ajax({
						  url:"action.php",
						  method:"post",
						  data:$('form').serialize() +"&action=order",
						  success:function(response){
							$("#order").html(response);
							
						  }
						});
					  });
					  });

					</script>
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