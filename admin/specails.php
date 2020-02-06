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

// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// set number of records per page
$records_per_page = 5;
 
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;
 
// retrieve records here
// query products
$stmt = $specail->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();

// set page header
$page_title = "Read Specail Offers";
 
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
	<h4>Specail Offers Product Lists</h4>
			
			
			 <?php 
			// query products
			$stmt = $specail->readAll($from_record_num, $records_per_page);
			 
			// paging buttons will be here
			// the page where this paging is used
			$page_url = "specails.php?";
			 
			// count all products in the database to calculate total pages
			$total_rows = $specail->countAll();
			 
			 // read_template.php controls how the product list will be rendered
			include_once "read_specail_template.php";
			 
			
			

		?>
		 
		
			 

</section>
 <?php
 // include page header HTML
include_once "layout_footer.php";

?>
</section>

