<?php
// get the product id
$product_id = isset($_GET['id']) ? $_GET['id'] : "";
 
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


// remove cart item from database
$cart_item->user_id=$ip; // we default to '1' because we do not have logged in user
$cart_item->product_id=$product_id;
$cart_item->delete();
 
// redirect to product list and tell the user it was added to cart
header('Location: cart.php?action=removed&id=' . $id);
?>
