<?php
// core configuration
include_once "../config/core.php";
 
// check if logged in as admin
include_once "login_checker.php";
 
// include database and object files
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

// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// set number of records per page
$records_per_page = 5;
 
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;
 
// retrieve records here
// query products
$stmt = $product->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();

// set page header
$page_title = "Read Products";
 
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
	<h4>Product Lists</h4>
			
			
			 <?php 
			// query products
			$stmt = $product->readAll($from_record_num, $records_per_page);
			 
			// paging buttons will be here
			// the page where this paging is used
			$page_url = "products.php?";
			 
			// count all products in the database to calculate total pages
			$total_rows = $product->countAll();
			 
			 // read_template.php controls how the product list will be rendered
			include_once "read_template.php";
			 
			
			

		?>
		 
		
			 

</section>
 <?php
 // include page header HTML
include_once "layout_footer.php";

?>
</section>

