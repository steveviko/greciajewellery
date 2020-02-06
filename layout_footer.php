
<div class="footer">
	<div class="container">
		
		<ul class="footer_nav">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="products.php">Products</a></li>
		  <li><a href="#">Hot Deals</a></li>
		  <li><a href="#">specail offers</a></li>
		 
		  <li><a href="#">About Us</a></li>
		  <li><a href="contact.php">Contact Us</a></li>
		  <li>Like , follow, Join us on our socail media Platforms</li>
		  <li><a href="#"><i class="fa fa-facebook" style="color:#3B5998;"></i></a></li>
		<li><a href="#"><i class="fa fa-twitter" style="color:#55ACEE;"></i></a></li>
		<li><a href="#"><i class="fa fa-instagram" style="color:#3F729B;"></i></a></li>
		<li><a href="#"><i class="fa fa-whatsapp" style="color:green;"></i></a></li>
		</ul>
		<p class="copy">Copyright&copy; 2018  Develop by <a href="" target="_blank"> Venviko</a></p>
	</div>
</div>
<script>
$(document).ready(function(){
    // add to cart button listener
    $('.add-to-cart-form').on('submit', function(){
 
        // info is in the table / single product layout
        var id = $(this).find('.product-id').text();
        var quantity = $(this).find('.cart-quantity').val();
		 var totalprice = $(this).find('.pprice').val();
 
        // redirect to add_to_cart.php, with parameter values to process the request
        window.location.href = "add_to_cart.php?id=" + id + "&quantity=" + quantity + "&totalprice=" + totalprice;
        return false;
    });
	
	   // add to views button listener
    $('.c').on('click', function(){
 
        // info is in the table / single product layout
        var cid = $(this).find('.count').val();
        
 
        // redirect to action.php, with parameter value to process the request
        window.location.href = "action.php?id=" + cid;
        return false;
    });
	
	
// update quantity button listener
$('.cart-quantity').on('change', function(){
 
    // get basic information for updating the cart
    var id = $(this).find('.pro_id').text();
    var quantity = $(this).find('.cart-quantity').val();
	 var pprice = $(this).find('.pprice').val();
 
    // redirect to update_quantity.php, with parameter values to process the request
    window.location.href = "update_quantity.php?id=" + id + "&quantity=" + quantity + "&pprice=" + pprice;
    return false;
});
});
</script>
<script src="./js/bootstrap.min.js"></script>
  
</body>
</html>		