<?php 
require_once("config.php");
 
if(isset($_GET['cid'])){ 
$pid = $_GET['cid'];
$views = 0;
	$views += 1; 
	

    $stmt =$conn->prepare("UPDATE products SET noviews=? WHERE id=?");   
    $stmt->bind_param("ii",$views,$pid);
    $stmt->execute();

	header('location:product.php');
}

if(isset($_POST['contact']) && isset($_POST['contact'])== 'message'){
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $email = $_POST['email'];
    $message = $_POST['message'];
   $created = date('Y-m-d H:i:s');
   $status="unread";
    
    $data = "";

    $stmt=$conn->prepare("INSERT INTO  messages(name,email,subject,description,created,status) VALUES(?,?,?,?,?,?)");
    $stmt->bind_param("ssssss",$name,$email,$subject,$message,$created,$status);
    $stmt->execute();

    
  
    $data .='
    <div class="text-center">
        <h1 class="display-4 text-danger mt-2">Thank you!</h1>
        <h1 class="text-success">Your message has been sent successfully</h1>
       
    </div>
    ';
   

    echo $data;
   
  
}


if(isset($_GET['remove'])){
    $id =$_GET['remove'];
       
    $stmt =$conn->prepare("DELETE  from cart_items WHERE id =?");
    $stmt->bind_param("i",$id);
    $stmt->execute();

    $_SESSION['showAlert'] = "block";
    $_SESSION['message'] ="item removed from the cart";
    header('location:cart.php');

}
if(isset($_GET['clear'])){   
       
    $stmt =$conn->prepare("DELETE   FROM  cart");   
    $stmt->execute();

    $_SESSION['showAlert'] = "block";
    $_SESSION['message'] ="All items removed from the cart";
    header('location:cart.php');
}
if(isset($_POST['pqty'])){ 
    $qty = $_POST['pqty'];
    $proid = $_POST['pid'];
    $proprice=$_POST['pprice'];

    $tprice = $qty * $proprice;

    $stmt =$conn->prepare("UPDATE cart_items SET quantity=?,totalprice=? WHERE product_id=?");   
    $stmt->bind_param("isi",$qty,$tprice,$proid);
    $stmt->execute();



}

if(isset($_POST['action']) && isset($_POST['action'])== 'order'){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $products = $_POST['products'];
    $areazone =$_POST['area'];
    $grand_total = $_POST['grand_total'];
	$user_id = $_POST['user_id'];
	$created=date('Y-m-d H:i:s');
	$status = "pending";
	
    
    $data = "";

    $stmt=$conn->prepare("INSERT INTO  orders(user_id,total_amount,status,products,name,phone,address,AreaZone,created) VALUES(?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("issssssss",$user_id,$grand_total,$status,$products,$name,$phone,$address,$areazone,$created);
    $stmt->execute();

    
  
    $data .='
    <div class="text-center">
        <h1 class="display-4 text-danger mt-2">Thank you!</h1>
        <h1 class="text-success">Your order has been placed successfully</h1>
        <h4 class="bg-danger text-light rounded p-2">Items ordered:'.$products.'</h4>
        <h4 class="display-4 text-danger mt-2" >personal Details</h4>
        <h4  >Name:'.$name.'</h4>
        <h4 >Phone Number:'.$phone.'</h4>
        <h4  >Delivery Address:'.$address.'</h4>
        <h4  >Total Amount to be Paid:'.number_format($grand_total, 2).'</h4>
    </div>
    ';
    $stmt =$conn->prepare("DELETE   FROM  cart_items");   
    $stmt->execute();

    echo $data;
   
  
}
function getCats(){

	global $conn;

	 $getcat = "SELECT * FROM  categories ";
	 $run_cat= mysqli_query($conn,$getcat);
	 
	 while($row_cats = mysqli_fetch_array($run_cat)){
	  $cat_id = $row_cats['id'];
	  $cat_title = $row_cats['name'];
	   $image = $row_cats['image'];
	  
	 echo "
	 <div class='block-title' >
	<strong><span><a href='categories.php?cat=$cat_id &cat_name=$cat_title' style='color:white;text-align:center;'>$cat_title </a></span></strong>
	 </div>
	 
	 ";
	 
	 }
	}
	
function getCatPro(){
if(isset($_GET['cat'])){
global $conn;
$cat= $_GET['cat'];
 $getcatPro = "SELECT * FROM products where category_id='$cat'";
 $run_catProd =mysqli_query($conn,$getcatPro);
	while($row_catProd=mysqli_fetch_array($run_catProd)){
	$prod_id =$row_catProd['id'];
	$prod_name =$row_catProd['name'];
	$prod_image =$row_catProd['image'];
	$prod_price = $row_catProd['price'];
	$prod_price= number_format($prod_price, 2);
	echo "
		<div class='col-md-4 product-men mt-5'>
		<div class='men-pro-item simpleCart_shelfItem'>
		<div class='men-thumb-item text-center'>
			<a href='single.php?pro_id=$prod_id' ><img src='images1/$prod_image' alt='$prod_name' width='200px' height='200px'></a>
			<div class='men-cart-pro'>
				<div class='inner-men-cart-pro'>
					<a href='single.php?pro_id=$prod_id' class='link-product-add-cart'>Quick View</a>
				</div>
			</div>
			<span class='product-new-top'>Top Daily Deals</span>
		</div>
		<div class='item-info-product text-center border-top mt-4'>
			<h4 class='pt-1 ' >
				<a href='single.php?pro_id=$prod_id' >$prod_name</a>
			</h4>
			<div class='info-product-price my-2 '>
				<span class='item_price mt-4'>Ugx:$prod_price</span>
				
			</div>
			<div class='snipcart-details top_brand_home_details item_add single-item hvr-outline-out'>
				
						
						<a href='index.php?addcart=$prod_id'><input type='submit' name='submit' value='Add to cart' class='button btn' /></a>
					
			</div>
		</div>
	</div>
	</div>
	
	
	";
	
	
	}
}
}
?>