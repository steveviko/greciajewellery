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
 
 // set ID property of category to be read
$category->id = $id;
 
// read the details of category to be read
$category->readOne();

// set page title
$page_title = "Read One category";
 
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
	<h4>Category View</h4>
	<?php
		// read categories button
		echo "<div class='right-button-margin'>";
			echo "<a href='categories.php' class='btn btn-primary pull-right' style='margin-bottom:20px;'>";
				echo "<span class='glyphicon glyphicon-list' ></span> Read categories";
			echo "</a>";
		echo "</div>";
		 echo '<div class="clearfix"> </div>';
		 // HTML table for displaying a category details
		echo "<table class='table table-hover table-responsive table-bordered'>";
		 
			echo "<tr>";
				echo "<td>Name</td>";
				echo "<td>{$category->name}</td>";
			echo "</tr>";
		 
			
		 
			
		 
		echo "</table>";
  
 
?>
</section>
 <?php
 // include page header HTML
include_once "layout_footer.php";

?>
</section>

