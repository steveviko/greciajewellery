<?php
// core configuration
include_once "../config/core.php";
 
// check if logged in as admin
include_once "login_checker.php";
 
// include classes
include_once '../config/database.php';
include_once '../objects/user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$user = new User($db);
 
// set page title
$page_title = "Users";
 
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
	<div class='col-md-12'>
	<h4>Customer Lists</h4>
	<?php
	
    // read all users from the database
    $stmt = $user->readAll($from_record_num, $records_per_page);
 
    // count retrieved users
    $num = $stmt->rowCount();
 
    // to identify page for paging
    $page_url="read_users.php?";
 
    // include products table HTML template
    include_once "read_users_template.php";
 
?>
</div>
</section>
 <?php
 // include page header HTML
include_once "layout_footer.php";

?>
</section>

