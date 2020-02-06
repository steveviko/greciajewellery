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
 
// set page headers
$page_title = "Create Deals";
 
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
				echo "<a href='deals.php' class='btn btn-default pull-right'>Read Deals</a>";
			echo "</div>";
			 
			 ?>
			 <div class="clearfix"> </div>
			 <!-- PHP post code will be here -->
			 <?php 
			// if the form was submitted - PHP OOP CRUD Tutorial
			if($_POST){
			 
				// set deal property values
				$deal->name = $_POST['name'];
				$deal->price = $_POST['price'];
				$deal->description = $_POST['description'];
				$deal->category_id = $_POST['category_id'];
				$image=!empty($_FILES["image"]["name"])
						? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
				$deal->image = $image;
				
				$secondimage=!empty($_FILES["secondimage"]["name"])
						? sha1_file($_FILES['secondimage']['tmp_name']) . "-" . basename($_FILES["secondimage"]["name"]) : "";
				$deal->secondimage = $secondimage;
				
				$thirdimage=!empty($_FILES["thirdimage"]["name"])
						? sha1_file($_FILES['thirdimage']['tmp_name']) . "-" . basename($_FILES["thirdimage"]["name"]) : "";
				$deal->thirdimage = $thirdimage;
			 
				// create the deal
				if($deal->create()){
					echo "<div class='alert alert-success'>Deal was created.</div>";
					// try to upload the submitted file
					// uploadPhoto() method will return an error message, if any.
					echo $deal->uploadPhoto();
					echo $deal->uploadPhoto2();
					echo $deal->uploadPhoto3();
				}
			 
				// if unable to create the deal, tell the user
				else{
					echo "<div class='alert alert-danger'>Unable to create deal.</div>";
				}
			}
			?>
		 
		<!-- HTML form for creating a product -->
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
		 
			<table class='table  table-responsive table-bordered'>
		 
				<tr>
					<td>Name</td>
					<td><input type='text' name='name' class='form-control' /></td>
				</tr>
		 
				<tr>
					<td>Price</td>
					<td><input type='text' name='price' class='form-control' /></td>
				</tr>
		 
				<tr>
					<td>Description</td>
					<td><textarea name='description' class='form-control'></textarea></td>
				</tr>
		 
				<tr>
					<td>Category</td>
					<td>
					<!-- categories from database will be here -->
					<?php
					// read the product categories from the database
					$stmt = $category->read();
					 
					// put them in a select drop-down
					echo "<select class='form-control' name='category_id'>";
						echo "<option>Select category...</option>";
					 
						while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
							extract($row_category);
							echo "<option value='{$id}'>{$name}</option>";
						}
					 
					echo "</select>";
					?>
					</td>
				</tr>
				<tr>
					<td>Photo</td>
					<td><input type="file" name="image" /></td>
				</tr>
				<tr>
					<td>Second Photo</td>
					<td><input type="file" name="secondimage" /></td>
				</tr>
				<tr>
					<td>Third Photo</td>
					<td><input type="file" name="thirdimage" /></td>
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

