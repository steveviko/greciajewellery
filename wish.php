<?php
// core configuration
include_once "config/core.php";

// include classes
include_once './config/database.php';
include_once './objects/user.php';
include_once './objects/product.php';
include_once './objects/category.php';
include_once './objects/cart_item.php ';
include_once './objects/wish_item.php ';
include_once './config.php ';
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$user = new User($db);
// pass connection to objects
$product = new Product($db);
$category = new Category($db);
$cart_item = new CartItem($db);
$wish_item = new WishItem($db);
 
// get ID of the product to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

$action = isset($_GET['action']) ? $_GET['action'] : "";


 
// set the id as product id property
$product->id = $id;


// to read single record product
$product->readOne();
$product->updateViews($id);
 
// set page title
$page_title = $product->name;


// include login checker
$require_login=false;
include_once "login_checker.php";
 
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
							echo "<div class='col-md-12'>";
								if($action=='added'){
									echo "<div class='alert alert-info'>";
										echo "Product was added to your Wish List!";
										//print_r($cart_item->create());
									echo "</div>";
								}
							 
								else if($action=='unable_to_add'){
									echo "<div class='alert alert-info'>";
										echo "Unable to add product to wish List. Please contact Admin.";
									echo "</div>";
								}
							echo "</div>";
							
								
								 
								
										
							?>
					<div class="grid images_3_of_2">
						<ul id="etalage">
						<?php $image =" admin/uploads/{$product->image}" ;?>
						<?php $secondimage =" admin/uploads/{$product->secondimage}" ;?>
						<?php $thirdimage =" admin/uploads/{$product->thirdimage}" ;?>
							<li>
								<a href="optionallink.html">
									  <img  class='etalage_thumb_image' src="<?php echo $image ?> " alt="<?php echo '{$product->name}' ;?>"  style ='min-width:300px !important; height:404px;' class="img-responsive">  
									<img class="etalage_source_image" src="<?php echo $image ?>" class="img-responsive" title=""  />
								</a>
							</li>
							<li>
								 <?php echo "<img  class='etalage_thumb_image' src='admin/uploads/{$product->secondimage}' alt='{$product->name}'  style ='min-width:300px !important; height:404px;' class='img-responsive'> ";?> 
								<img class="etalage_source_image" src="<?php echo $secondimage ?>" class="img-responsive" title="" />
							</li>
							<li>
								 <?php echo "<img  class='etalage_thumb_image' src='admin/uploads/{$product->thirdimage}' alt='{$product->name}' style ='min-width:300px !important; height:404px;' class='img-responsive'> ";?> 
								<img class="etalage_source_image" src="<?php echo $thirdimage ?>" class="img-responsive" title="" />
							</li>
						    <li>
							<?php echo "<img  class='etalage_thumb_image' src='admin/uploads/{$product->secondimage}' alt='{$product->name}'style ='min-width:300px !important; height:404px;' class='img-responsive'> ";?> 
								<img class="etalage_source_image" src="<?php echo $secondimage ?>" class="img-responsive" title="" />
							</li>
						</ul>
						 <div class="clearfix"></div>		
				  </div> 
				  <div class="desc1 span_3_of_2">
				    <h1>Name:<?php echo "{$product->name}";?> &nbsp;&nbsp;<a href="products.php" class="btn btn-info pull-right">Continue shopping</a></h1>
				    <p class="m_5">Ugx.<?php echo number_format($product->price, 2);?>/=</p>
					
					
				    <div class="btn_form">
				
							<?php $price = number_format($product->price, 2);?>
							<?php $name =$product->name;?>
					<ul class="list2">
				 	  <li class="list2_left"><span class="m_1"><a href=" add_to_cart.php?id=<?=$id?>&page=<?=$page ?>&p=<?=$price?>&name=<?=$name?>" class="link">Add to Cart</a></span></li>
				 	  <li class=""><span class="m_2"><a href="add_to_wish.php?id=<?=$id?>&page=<?=$page ?>&p=<?=$price?>&name=<?=$name?>" class="link1 disabled" >Add to WishList</a></span></li>
					  
				 	  <div class="clearfix"> </div>
				 	</ul>
						
					 </div>
					
					 
					 <span class="m_link"><a href="#">login to save in wishlist</a> </span>
					 <p class="m_text2"><?php echo "{$product->description }"?> </p>
				  </div>
				  <div class="clearfix"></div>	
				  
				  
				  <h4 class="head_single">Related Products</h4>
     <div class="span_3">
	          	 <div class="col-sm-3 grid_1">
	          	    <a href="single.html">
				     <img src="images/pic9.jpg" class="img-responsive" alt=""/>
				     <h3>parum clari</h3>
				   	 <p>Duis autem vel eum iriure</p>
				   	 <h4>Rs.399</h4>
			         </a>  
				  </div> 
				<div class="col-sm-3 grid_1">
	          	    <a href="single.html">
				     <img src="images/pic8.jpg" class="img-responsive" alt=""/>
				     <h3>parum clari</h3>
				   	 <p>Duis autem vel eum iriure</p>
				   	 <h4>Rs.399</h4>
			         </a>  
				  </div> 
				 <div class="col-sm-3 grid_1">
	          	    <a href="single.html">
				     <img src="images/pic1.jpg" class="img-responsive" alt=""/>
				     <h3>parum clari</h3>
				   	 <p>Duis autem vel eum iriure</p>
				   	 <h4>Rs.399</h4>
			         </a>  
				  </div> 
				  <div class="col-sm-3 grid_1">
	          	    <a href="single.html">
				     <img src="images/pic3.jpg" class="img-responsive" alt=""/>
				     <h3>parum clari</h3>
				   	 <p>Duis autem vel eum iriure</p>
				   	 <h4>Rs.399</h4>
			         </a>  
				  </div> 
				  <div class="clearfix"></div>
	     </div>
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
				   <link href="css/flexslider.css" rel='stylesheet' type='text/css' />
							  <script defer src="js/jquery.flexslider.js"></script>
							  <script type="text/javascript">
								$(function(){
								  SyntaxHighlighter.all();
								});
								$(window).load(function(){
								  $('.flexslider').flexslider({
									animation: "slide",
									start: function(slider){
									  $('body').removeClass('loading');
									}
								  });
								});
							  </script>
	</div>
</div>
<?php include_once "layout_footer.php";?>