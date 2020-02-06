<?php
// parameters
$product_id = isset($_GET['id']) ? $_GET['id'] : "";
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;
$totalprice = isset($_GET['p']) ? $_GET['p'] : "";
$product_name = isset($_GET['name']) ? $_GET['name'] : "";
// make quantity a minimum of 1
$quantity=$quantity<=0 ? 1 : $quantity;
 
// connect to database
include 'config/database.php';
 
// include object
include_once "./objects/cart_item.php";
include_once './objects/user.php';
include_once './objects/product.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$cart_item = new CartItem($db);
$user = new User($db);
$product = new Product($db);

$product->id = $id;
$product->updateViews($id);
//set user  id
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

 
// set cart item values
$cart_item->user_id=$ip; // we default to '1' because we do not have logged in user
$cart_item->product_id=$product_id;
$cart_item->quantity=$quantity;
$cart_item->totalprice=$totalprice;
 $cart_item->product_name=$product_name;
 
// check if the item is in the cart, if it is, do not add
if($cart_item->exists()){
    // redirect to product list and tell the user it was added to cart
    header("Location: cart.php?action=exists");
}
 
// else, add the item to cart
else{

	$product->updateViews($product_id);
    // add to cart
    if($cart_item->create()){
	
        // redirect to product list and tell the user it was added to cart
        header("Location: products.php?id={$product_id}&action=added");
    }else{
        header("Location: products.php?id={$product_id}&action=unable_to_add");
    }
}
?>
