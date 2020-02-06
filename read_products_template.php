
		
		<div class="grid_2">
		
		
		<?php
if(!isset($_SESSION['cart'])){
    $_SESSION['cart']=array();
}
 
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    extract($row);	
	
	?>
	
	<div class="col-md-4 span_6" style="margin-bottom:20px">			
			  <div class="box_inner">			  
				<?php 				
				echo "<img src='admin/uploads/{$image}' class='img-responsive img-response' alt='$name' />";		 
				?>
				 <div class="sale-box"> </div>
				 <div class="desc">
				 	<h3><?php echo $name?></h3>
				 	<?php echo "<h4>Ugx:".number_format($price, 2, '.', ',');echo" </h4>"; ?>
					<?php 
				
					// cart item settings
					$cart_item->user_id=$ip; // we default to a user with ID "1" for now
					$cart_item->product_id=$id;
					
					
					
					?>

				 	<ul class="list2">
				 	  <?php echo "<li class='list2_left'><span class='m_1'><a href='add_to_cart.php?id={$id}&page={$page}&p={$price}&name={$name}' class='link count'><input type='hidden' class='counter' name='proid' value={$id}'>Add to Cart</a></span></li>";?>
				 	   <?php echo "<li class='list2_right'><span class='m_2'><a href='product.php?id={$id} ' class='link1 count'><input type='hidden' name='proid' class='counter' value={$id}'>View More</a></span></li> ";?>
				 	  <div class="clearfix"> </div>
				 	</ul>
				 	<div class="heart"> </div>
				 </div>
			   </div>
			   
			</div>
<?php }?>

		
		<div class="clearfix"> </div>
		
		
			
			<?php	include_once "paging.php";?>			
			<div class="clearfix"> </div>
		</div>
	