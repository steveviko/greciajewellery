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
 
// set page headers
$page_title = "Create Category";
 
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
			 echo "<div class='right-button-margin'>";
				echo "<a href='categories.php' class='btn btn-default pull-right'>Read Categories</a>";
			echo "</div>";
			 
			 ?>
			 <div class="clearfix"> </div>
			 <!-- PHP post code will be here -->
			 <?php 
			// if the form was submitted - PHP OOP CRUD Tutorial
			if($_POST){
			 
				// set Category property values
				$category->name = $_POST['name'];
				
				
				
				
			 
				// create the Category
				if($category->create()){
					echo "<div class='alert alert-success'>Category was created.</div>";
					
					
				}
			 
				// if unable to create the Category, tell the user
				else{
					echo "<div class='alert alert-danger'>Unable to create Category.</div>";
				}
			}
			?>
		 
		<!-- HTML form for creating a Category -->
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
		 
			<table class='table  table-responsive table-bordered'>
		 
				<tr>
					<td>Name</td>
					<td><input type='text' name='name' class='form-control' /></td>
				</tr>				
				
				
				<tr>
					<td></td>
					<td>
						<button type="submit" class="btn btn-primary">Create</button>
					</td>
				</tr>
		 
			</table>
		</form>
			 

</section>
 <?php
 // include page header HTML
include_once "layout_footer.php";

?>
</section>

