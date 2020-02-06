<?php 

$conn = new mysqli("localhost","root","","ecomm");
if($conn->connect_error){
    die("Connection Failed".$conn->connect_error);
}


?>