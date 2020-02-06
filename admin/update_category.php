<?php
// core configuration
include_once "../config/core.php";
 
// check if logged in as admin
include_once "login_checker.php";
 
 // get ID of the product to be edited
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


// set ID property of category to be edited
$category->id = $id;
 
// read the details of category to be edited
$category->readOne();
 
// set page header
$page_title = "Update category";
 
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
			echo "<a href='categories.php' class='btn btn-default pull-right'>Read categories</a>";
		echo "</div>";
?>

<div class="clearfix"> </div>

			<!-- post code will be here -->
			<?php 
			// if the form was submitted
			if($_POST){
			 
				// set category property values
				$category->name = $_POST['name'];
				
			 
				// update the category
				if($category->update()){
					echo "<div class='alert alert-success alert-dismissable'>";
						echo "category was updated.";
					echo "</div>";
				}
			 
				// if unable to update the category, tell the user
				else{
					echo "<div class='alert alert-danger alert-dismissable'>";
						echo "Unable to update category.";
					echo "</div>";
				}
			}
			?>
 
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
			<table class='table table-hover table-responsive table-bordered'>
		 
				<tr>
					<td>Name</td>
					<td><input type='text' name='name' value='<?php echo $category->name; ?>' class='form-control' /></td>
				</tr>
		 	 
				
		 
				<tr>
					<td></td>
					<td>
						<button type="submit" class="btn btn-primary">Update</button>
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

