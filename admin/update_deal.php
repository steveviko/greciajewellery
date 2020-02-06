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


// set ID property of product on dealto be edited
$deal->id = $id;
 
// read the details of product on deal  to be edited
$deal->readOne();
 
// set page header
$page_title = "Update Product on deal";
 
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
			echo "<a href='products.php' class='btn btn-default pull-right'>Read Products on deals</a>";
		echo "</div>";
?>

<div class="clearfix"> </div>

			<!-- post code will be here -->
			<?php 
			// if the form was submitted
			if($_POST){
			 
				// set product on deal property values
				$deal->name = $_POST['name'];
				$deal->price = $_POST['price'];
				$deal->description = $_POST['description'];
				$deal->category_id = $_POST['category_id'];
			 
				// update the product on deal
				if($deal->update()){
					echo "<div class='alert alert-success alert-dismissable'>";
						echo "Product was updated.";
					echo "</div>";
				}
			 
				// if unable to update the product, tell the user
				else{
					echo "<div class='alert alert-danger alert-dismissable'>";
						echo "Unable to update product.";
					echo "</div>";
				}
			}
			?>
 
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
			<table class='table table-hover table-responsive table-bordered'>
		 
				<tr>
					<td>Name</td>
					<td><input type='text' name='name' value='<?php echo $deal->name; ?>' class='form-control' /></td>
				</tr>
		 
				<tr>
					<td>Price</td>
					<td><input type='text' name='price' value='<?php echo $v->price; ?>' class='form-control' /></td>
				</tr>
		 
				<tr>
					<td>Description</td>
					<td><textarea name='description' class='form-control'><?php echo $deal->description; ?></textarea></td>
				</tr>
		 
				<tr>
					<td>Category</td>
					<td>
						<!-- categories select drop-down will be here -->
						<?php
						$stmt = $category->read();
						 
						// put them in a select drop-down
						echo "<select class='form-control' name='category_id'>";
						 
							echo "<option>Please select...</option>";
							while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
								$category_id=$row_category['id'];
								$category_name = $row_category['name'];
						 
								// current category of the product must be selected
								if($product->category_id==$category_id){
									echo "<option value='$category_id' selected>";
								}else{
									echo "<option value='$category_id'>";
								}
						 
								echo "$category_name</option>";
							}
						echo "</select>";
						?>
					</td>
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

