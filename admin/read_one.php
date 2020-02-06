<?php
// core configuration
include_once "../config/core.php";
 
// check if logged in as admin
include_once "login_checker.php";
 
 // get ID of the product to be read
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
 
// include classes
include_once '../config/database.php';
include_once '../objects/user.php';
include_once '../objects/product.php';
include_once '../objects/category.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$user = new User($db);
// pass connection to objects
$product = new Product($db);
$category = new Category($db);
 
 // set ID property of product to be read
$product->id = $id;
 
// read the details of product to be read
$product->readOne();

// set page title
$page_title = "Read One Product";
 
// include page header HTML
include_once "layout_header.php";
 
?>
<!--sidebar start-->
<?php // include header
include_once "layout_aside.php";

?>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
	<h4>Product View</h4>
	<?php
		// read products button
		echo "<div class='right-button-margin'>";
			echo "<a href='products.php' class='btn btn-primary pull-right' style='margin-bottom:20px;'>";
				echo "<span class='glyphicon glyphicon-list' ></span> Read Products";
			echo "</a>";
		echo "</div>";
		 echo '<div class="clearfix"> </div>';
		 // HTML table for displaying a product details
		echo "<table class='table  table-responsive table-bordered'>";
		 
			echo "<tr>";
				echo "<td>Name</td>";
				echo "<td>{$product->name}</td>";
			echo "</tr>";
		 
			echo "<tr>";
				echo "<td>Price</td>";
				echo "<td>Ugx:{$product->price}/=</td>";
			echo "</tr>";
		 
			echo "<tr>";
				echo "<td>Description</td>";
				echo "<td>{$product->description}</td>";
			echo "</tr>";
		 
			echo "<tr>";
				echo "<td>Category</td>";
				echo "<td>";
					// display category name
					$category->id=$product->category_id;
					$category->readName();
					echo $category->name;
				echo "</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td>First Photo</td>";
				echo "<td>";
					echo $product->image ? "<img src='./uploads/{$product->image}' style='width:300px;' />" : "No image found.";
				echo "</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td>Second Photo</td>";
				echo "<td>";
					echo $product->secondimage ? "<img src='./uploads/{$product->secondimage}' style='width:300px;' />" : "No image found.";
				echo "</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td>Third Photo</td>";
				echo "<td>";
					echo $product->thirdimage ? "<img src='./uploads/{$product->thirdimage}' style='width:300px;' />" : "No image found.";
				echo "</td>";
			echo "</tr>";
		 
		echo "</table>";
  
 
?>
</section>
 <?php
 // include page header HTML
include_once "layout_footer.php";

?>
</section>

