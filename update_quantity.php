<?php
// get the product id
$product_id = isset($_GET['id']) ? $_GET['id'] : 1;
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : "";
$totalprice = isset($_POST['pprice']) ? $_POST['pprice'] : "";

 
// make quantity a minimum of 1
$quantity=$quantity<=0 ? 1 : $quantity;
 
// connect to database
include 'config/database.php';

 
// include object
include_once "objects/cart_item.php";
include_once './objects/user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
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


// set cart item values
$cart_item->user_id=$ip; // we default to '1' because we do not have logged in user
$cart_item->product_id=$product_id;
$cart_item->quantity=$quantity;
$cart_item->totalprice=$totalprice;

// add to cart
if($cart_item->update()){
    // redirect to product list and tell the user it was added to cart
    header("Location: cart.php?action=updated");
}else{
    header("Location: cart.php?action=unable_to_update");
}
?>
