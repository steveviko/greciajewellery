<?php
// core configuration
include_once "../config/core.php";
 
// check if logged in as admin
include_once "login_checker.php";
 
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
 


// get search term
$search_term=isset($_GET['s']) ? $_GET['s'] : '';
 
$page_title = "You searched for \"{$search_term}\"";

 
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
	<?php
 
			// query products
		$stmt = $category->search($search_term, $from_record_num, $records_per_page);
		 
		// specify the page where paging is used
		$page_url="search_category.php?s={$search_term}&";
		 
		// count total rows - used for pagination
		$total_rows=$category->countAll_BySearch($search_term);
		 
		// read_template.php controls how the category list will be rendered
		include_once "read_categories_template.php";
 
?>
</section>
 <?php
 // include page header HTML
include_once "layout_footer.php";

?>
</section>

