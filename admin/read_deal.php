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
include_once '../objects/deal.php';
include_once '../objects/specail.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$user = new User($db);
// pass connection to objects
$product = new Product($db);
$category = new Category($db);
$deal = new Deal($db);
$specail = new Specail($db);
 
 // set ID property of deal to be read
$deal->id = $id;
 
// read the details of deal to be read
$deal->readOne();

// set page title
$page_title = "Read One Product Deal";
 
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
	<h4>Product Hot Deals View</h4>
	<?php
		// read deals button
		echo "<div class='right-button-margin'>";
			echo "<a href='deals.php' class='btn btn-primary pull-right' style='margin-bottom:20px;'>";
				echo "<span class='glyphicon glyphicon-list' ></span> Read Products On deals";
			echo "</a>";
		echo "</div>";
		 echo '<div class="clearfix"> </div>';
		 // HTML table for displaying a deal details
		echo "<table class='table  table-responsive table-bordered'>";
		 
			echo "<tr>";
				echo "<td>Name</td>";
				echo "<td>{$deal->name}</td>";
			echo "</tr>";
		 
			echo "<tr>";
				echo "<td>Price</td>";
				echo "<td>Ugx:{$deal->price} /=</td>";
			echo "</tr>";
		 
			echo "<tr>";
				echo "<td>Description</td>";
				echo "<td>{$deal->description}</td>";
			echo "</tr>";
		 
			echo "<tr>";
				echo "<td>Category</td>";
				echo "<td>";
					// display category name
					$category->id=$deal->category_id;
					$category->readName();
					echo $category->name;
				echo "</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td>First Photo</td>";
				echo "<td>";
					echo $deal->image ? "<img src='./uploads/{$deal->image}' style='width:300px;' />" : "No image found.";
				echo "</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td>Second Photo</td>";
				echo "<td>";
					echo $deal->secondimage ? "<img src='./uploads/{$deal->secondimage}' style='width:300px;' />" : "No image found.";
				echo "</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td>Third Photo</td>";
				echo "<td>";
					echo $deal->thirdimage ? "<img src='./uploads/{$deal->thirdimage}' style='width:300px;' />" : "No image found.";
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

