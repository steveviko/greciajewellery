<?php
//$_SESSION['cart']=isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

 

 

    // email check will be here
	// include classes
include_once "config/database.php";
include_once "objects/user.php";
include_once './objects/category.php';
include_once './objects/cart_item.php ';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
;
$cart_item = new CartItem($db);
$user = new User($db);


 

 function getip(){

   $ip = $_SERVER['REMOTE_ADDR'];


   if(!empty($_SERVER['HTTP_CLIENT_IP'])){
     
     $ip = $_SERVER['HTTP_CLIENT_IP'];


   }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){

     $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];


   }

    return $ip;
}
$ip = getip();
$ip = trim($ip, ':');
 
?>
<!DOCTYPE HTML>
<html>
<head>
<title><?php echo isset($page_title) ? strip_tags($page_title) : "GrecaiJewellery | Home"; ?> </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0 user-scalable=0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="wedding rings,Engangement rings,rings,jewellery,best jewellery shop in uganda," />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/small.css" rel='stylesheet' type='text/css' media="only screen and (min-width:50px ) and (max-width:500px)"/>
<link href="css/medium.css" rel='stylesheet' type='text/css' media="only screen and (min-width:501px ) and (max-width:800px)"/>
<link rel="stylesheet" href="css/jquery.countdown.css" />
<!-- Custom Theme files -->
<!--webfont-->
<link href='http://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>

<link href="admin/css/font-awesome.css" rel="stylesheet"> 

<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<!-- dropdown -->
<script src="js/jquery.easydropdown.js"></script>
<!-- start menu -->
<link href="css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/megamenu.js"></script>
<script type="text/javascript" src="js/profilemenu.js"></script>
<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
<script src="js/responsiveslides.min.js"></script>
<script>
    $(function () {
      $("#head").responsiveSlides({
      	auto: true,
      	nav: false,
      	speed: 3900,
        namespace: "callbacks",
        pager: true,
      });
    });
	$(function () {
      $("#slider").responsiveSlides({
      	auto: true,
      	nav: false,
      	speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
</script>
<link rel="stylesheet" href="css/etalage.css">
<script src="js/jquery.etalage.min.js"></script>
<script>
			jQuery(document).ready(function($){

				$('#etalage').etalage({
					thumb_image_width: 300,
					thumb_image_height: 400,
					source_image_width: 900,
					source_image_height: 1200,
					show_hint: true,
					click_callback: function(image_anchor, instance_id){
						alert('Callback example:\nYou clicked on an image with the anchor: "'+image_anchor+'"\n(in Etalage instance: "'+instance_id+'")');
					}
				});

			});
		</script>
<script src="js/jquery.countdown.js"></script>
<script src="js/script.js"></script>
</head>
<body>
<div class="header_top" style="backround:#0b0b0b;">
  <div class="container">
  	<div class="header_top-box">
     <div class="header-top-left">
			 <ul class="social box">
			<li><a href="" style="color:#3B5998;"> <i class="fa fa-facebook fa-lg" > </i> </a></li>
		    <li><a href="" style="color:#3B5998;"><i class="fa fa-instagram fa-lg" > </i> </a></li>			
			<li><a href="" style="color:#3B5998;"><i class="fa fa-twitter fa-lg" > </i> </a></li>
			<li><a href="" style="color:green;"><i class="fa fa-whatsapp fa-lg text-green" > </i> </a></li>
			<li><a href="#" style="color:white"> <span class="fa fa-phone"></span>&nbsp; +256 787967393 </a></li>
			<li><a href="#" style="color:white"><span class="fa fa-phone"></span>&nbsp;+256 701419936</a></li>
		</ul>
   				    <div class="clearfix"></div>
   			 </div>
			 <div class="cssmenu">
				
				<?php // check if users / customer was logged in
				// if user was logged in, show "Edit Profile", "Orders" and "Logout" options
				if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true && $_SESSION['access_level']=='Customer'){
				?>
				<ul>
				
					<?php
					// if given page title is 'Login', do not display the title
					if($page_title!="Login"){
					?>
					<li class="active"><a href="index.php"><?php echo isset($page_title) ? "My Account": ""; ?> </a></li> 
								
					<?php
					}
					?>
					<li><a href="user_wish.php">Wishlist</a></li> 
					<li><a href="logout.php">Logout</a></li> 
					
				</ul>
				<?php }
				// if user was not logged in, show the "login" and "register" options
				else{

				?><ul>
					<li class="active"><a href="index.php">Account</a></li> 
					<li><a href="user_wish.php">Wishlist</a></li> 
					<li><a href="login_form.php">LogIn</a></li> 
					<li><a href="signup.php">Sign Up</a></li>
					
				</ul>
				<?php }?>
				
			</div>
			<div class="clearfix"></div>
   </div>
</div>
</div>
<div class="header_bottom">
	<div class="container">
	 <div class="header_bottom-box">
		
		<div class="header_bottom_right">
			
			<div class="col-md-9 right-slide"  >
			
			 <ul class="rslides " id="head" style="height:44px;">
	        <li><img src="images/banner1.jpg" class="img-responsive" alt=""/></li>
	        <li><img src="images/banner2.jpg" class="img-responsive" alt=""/></li>
	        <li><img src="images/banner3.jpg" class="img-responsive" alt=""/></li>
	      </ul>
			</div>
			
	  		<ul class="bag">
	  			<a href="#"><i class=""> </i></a>
				<?php
				
                         // count products in cart
						$cart_item->user_id=$ip; // default to user with ID "1" for now
						$cart_count=$cart_item->count();
						
						echo "<a href='cart.php'><li class='fa fa-shopping-cart'>
						($cart_count)Items
						 </li></a>";
						
                        ?>
	  			
						
						
	  			<div class="clearfix"> </div>
	  		</ul>
			
		</div>
		
	</div>
</div>
</div>
<div class="menu">
	<div class="container">
		<div class="menu_box">
	     <ul class="megamenu skyblue">
			<li class="active grid"><a class="color2" <?php echo $page_title=="Index" ? "class='active'" : ""; ?>
                     href="<?php echo $home_url; ?>">Home</a></li>
						
			<li><a class="color10" href="#">Men Jewellery</a>
				<div class="megapanel">
					<div class="row">
						<div class="col1">
							<div class="h_nav">
								<h4>Men</h4>
								<ul>
									<li><a href="men.html">Jackets</a></li>
									<li><a href="men.html">Blazers</a></li>
									<li><a href="men.html">Suits</a></li>
									<li><a href="men.html">Trousers</a></li>
									<li><a href="men.html">Jeans</a></li>
									<li><a href="men.html">Shirts</a></li>
									<li><a href="men.html">Sweatshirts & Hoodies</a></li>
									<li><a href="men.html">Swem Wear</a></li>
									<li><a href="men.html">Accessories</a></li>
								</ul>	
							</div>							
						</div>
						
						<div class="col2">
							<div class="h_nav">
								<h4>Trends</h4>
								<ul>
									<li class>
										<div class="p_left">
										   <img src="images/t1.jpg" class="img-responsive" alt=""/>
										</div>
										<div class="p_right">
											<h4><a href="#">Denim shirt</a></h4>
											<span class="item-cat"><small><a href="#">Jackets</a></small></span>
											<span class="price">29.99 $</span>
										</div>
										<div class="clearfix"> </div>
									</li>
									<li>
										<div class="p_left">
										  <img src="images/t2.jpg" class="img-responsive" alt=""/>
										</div>
										<div class="p_right">
											<h4><a href="#">Denim shirt</a></h4>
											<span class="item-cat"><small><a href="#">Jackets</a></small></span>
											<span class="price">29.99 $</span>
										</div>
										<div class="clearfix"> </div>
									</li>
									<li>
										<div class="p_left">
										   <img src="images/t3.jpg" class="img-responsive" alt=""/>
										</div>
										<div class="p_right">
											<h4><a href="#">Denim shirt</a></h4>
											<span class="item-cat"><small><a href="#">Jackets</a></small></span>
											<span class="price">29.99 $</span>
										</div>
										<div class="clearfix"> </div>
									</li>
								</ul>	
							</div>												
						</div>
					  </div>
					</div>
			</li>
			<li><a class="color3" href="products.php">All Products</a></li>
			<li><a class="color7" href="#">Women's Jewellery</a>
				<div class="megapanel">
					<div class="row">
						
						<div class="col1">
							<div class="h_nav">
								<h4>Women</h4>
								<ul>
									<li><a href="men.html">Outerwear</a></li>
									<li><a href="men.html">Dresses</a></li>
									<li><a href="men.html">Handbags</a></li>
									<li><a href="men.html">Trousers</a></li>
									<li><a href="men.html">Jeans</a></li>
									<li><a href="men.html">T-Shirts</a></li>
									<li><a href="men.html">Shoes</a></li>
									<li><a href="men.html">Coats</a></li>
									<li><a href="men.html">Accessories</a></li>
								</ul>	
							</div>							
						</div>
						<div class="col2">
							<div class="h_nav">
								<h4>Trends</h4>
								<ul>
									<li class>
										<div class="p_left">
										   <img src="images/t1.jpg" class="img-responsive" alt=""/>
										</div>
										<div class="p_right">
											<h4><a href="#">Denim shirt</a></h4>
											<span class="item-cat"><small><a href="#">Jackets</a></small></span>
											<span class="price">29.99 $</span>
										</div>
										<div class="clearfix"> </div>
									</li>
									<li>
										<div class="p_left">
										  <img src="images/t2.jpg" class="img-responsive" alt=""/>
										</div>
										<div class="p_right">
											<h4><a href="#">Denim shirt</a></h4>
											<span class="item-cat"><small><a href="#">Jackets</a></small></span>
											<span class="price">29.99 $</span>
										</div>
										<div class="clearfix"> </div>
									</li>
									<li>
										<div class="p_left">
										   <img src="images/t3.jpg" class="img-responsive" alt=""/>
										</div>
										<div class="p_right">
											<h4><a href="#">Denim shirt</a></h4>
											<span class="item-cat"><small><a href="#">Jackets</a></small></span>
											<span class="price">29.99 $</span>
										</div>
										<div class="clearfix"> </div>
									</li>
								</ul>	
							</div>												
						</div>
					  </div>
					</div>
			</li>
			<li><a class="color8" href="about.php">About</a></li>
			<li><a class="color8" href="contact.php">contact</a></li>
			<li><span class="search">
			  <?php 
			  // search form
echo "<form role='search' action='search.php'>";
    echo "<div class='input-group col-md-9 pull-right' style='margin-right:-1.2em'>";
        $search_value=isset($search_term) ? "value='{$search_term}'" : "";
        echo "<input type='text' class='form-control' placeholder='Type product name or description...' name='s' id='srch-term' required {$search_value} />";
        echo "<div class=''>";
            echo "<button class='btn btn-info' type='submit'><i class='fa fa-search'></i></button>";
        echo "</div>";
    echo "</div>";
echo "</form>";
?>
	  		</span></li>
			<div class="clearfix"> </div>
		 </ul>
	  </div>
</div>
</div>