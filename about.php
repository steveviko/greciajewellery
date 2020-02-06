<?php
// core configuration
include_once "config/core.php";

// include classes
include_once './config/database.php';
include_once './objects/user.php';
include_once './objects/product.php';
include_once './objects/category.php'; 
include_once './objects/cart_item.php ';
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
 

 

// set page title
$page_title = "contact";


// include login checker
$require_login=false;
include_once "login_checker.php"; 
 
// include page header HTML
 include_once "layout_header.php";
 
 ?>
<div class="men">
	<div class="container">
		
	 
		
			<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			   <!--/contact-->
   
	 
	 <div class="col-md-12 mt-20">
			<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				
			</ul>
		</div>
	</div>
	 </div>
	 
			<div class="row">
				
					<div class="col-md-6">
						<div class="agile-contact-left">
					<div class=" address-grid">
						<h4>For More <span>Information</span></h4>
							<div class="mail-agileits-w3layouts">
								<i class="fa fa-phone" aria-hidden="true"></i>
								<div class="contact-right">
									<p>Call </p><span>+256 787 967 393</span>
									<p></p><span>+256 701 419 936</span>
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="mail-agileits-w3layouts">
								<i class="fa fa-envelope" aria-hidden="true"></i>
								<div class="contact-right">
									<p>Mail </p><a href="mailto:info@example.com">greciajewellery@gmail.com</a>
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="mail-agileits-w3layouts">
								
								<div class="contact-right">
									<p>Follow us </p><span>
									<ul class="footer-social">
							<li><a href="#"><i class="fa fa-facebook" style="background:#3B5998;color:#fff;"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter" style="background:#55ACEE;color:#fff;"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram" style="background:#3F729B;color:#fff;"></i></a></li>
							<li><a href="#"><i class="fa fa-whatsapp" style="background:green;color:#fff;"></i></a></li>
							
						</ul>
									
									</span>
								</div>
								<div class="clearfix"> </div>
							</div>
						
					</div>
					
				</div>
				<div class="clearfix"> </div>
					</div>
				
					<div class="col-md-6" id="message">
						<div class=" contact-form">
						<h4 class="white-w3ls " style="margin-top:-55px;">About <span>Us</span></h4>
						<p>
						
						
						</p>
					</div>
					</div>

					
				
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

   

</div>
</div>


<div class="content_middle">
	<div class="container">
				 <script type="text/javascript">
					$(document).ready(function(){
						$("#contact").submit(function(e){
						e.preventDefault();
					   
					   
						$.ajax({
						  url:"action.php",
						  method:"post",
						  data:$('form').serialize() +"&contact=message",
						  success:function(response){
							$("#message").html(response);
							
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