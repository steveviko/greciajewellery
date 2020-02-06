
		
		<?php
if(!isset($_SESSION['cart'])){
    $_SESSION['cart']=array();
}
 
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    extract($row);	
	
	?>
	
	<li>
	<?php 				
				echo "<img src='admin/uploads/{$image}' class='img-responsive img-response' alt='$name' />";		 
				?>
				<?php 		// cart item settings
					$cart_item->user_id=$ip; // we default to a user with ID "1" for now
					$cart_item->product_id=$id;
					
					
					
					?>
				<div class="grid-flex"><h4><?= $name ?> </h4><?php echo "<p>Ugx:".number_format($price, 2, '.', ',');echo" </p>"; ?>
				<?php echo "<div class='m_3'><a href='add_to_cart.php?id={$id}&page={$page}&p={$price}&name={$name}' class='link2 count'><input type='hidden' class='counter' name='proid' value={$id}'>Add to Cart</a></div>";?>
				 	 
							
							<div class="ticket"> </div>
						</div></li>
						



<?php }?>

		
	