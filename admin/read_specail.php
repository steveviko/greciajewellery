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
 
 // set ID property of specail to be read
$specail->id = $id;
 
// read the details of specail to be read
$specail->readOne();

// set page title
$page_title = "Read One specail product";
 
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
	<h4>Specail Product on offer View</h4>
	<?php
		// read specail button
		echo "<div class='right-button-margin'>";
			echo "<a href='specails.php' class='btn btn-primary pull-right' style='margin-bottom:20px;'>";
				echo "<span class='glyphicon glyphicon-list' ></span> Read specail Products ";
			echo "</a>";
		echo "</div>";
		 echo '<div class="clearfix"> </div>';
		 // HTML table for displaying a specail details
		echo "<table class='table  table-responsive table-bordered'>";
		 
			echo "<tr>";
				echo "<td>Name</td>";
				echo "<td>{$specail->name}</td>";
			echo "</tr>";
		 
			echo "<tr>";
				echo "<td>Price</td>";
				echo "<td>Ugx:{$specail->price}/=</td>";
			echo "</tr>";
		 
			echo "<tr>";
				echo "<td>Description</td>";
				echo "<td>{$specail->description}</td>";
			echo "</tr>";
		 
			echo "<tr>";
				echo "<td>Category</td>";
				echo "<td>";
					// display category name
					$category->id=$specail->category_id;
					$category->readName();
					echo $category->name;
				echo "</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td>First Photo</td>";
				echo "<td>";
					echo $specail->image ? "<img src='./uploads/{$specail->image}' style='width:300px;' />" : "No image found.";
				echo "</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td>Second Photo</td>";
				echo "<td>";
					echo $specail->secondimage ? "<img src='./uploads/{$specail->secondimage}' style='width:300px;' />" : "No image found.";
				echo "</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td>Third Photo</td>";
				echo "<td>";
					echo $specail->thirdimage ? "<img src='./uploads/{$specail->thirdimage}' style='width:300px;' />" : "No image found.";
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

