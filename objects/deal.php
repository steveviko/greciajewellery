<?php
class Deal{
 
    // database connection and table name
    private $conn;
    private $table_name = "deals";
 
    // object properties
    public $id;
    public $name;
    public $price;
    public $description;
    public $category_id;
	public $image;
	public $secondimage;
	public $thirdimage;
    public $timestamp;
	public  $noviews ;
	
	
    public function __construct($db){
        $this->conn = $db;
		//$this->noviews += 1;
		
    }
 
    // create product
    function create(){
 
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
               SET name=:name, price=:price, description=:description,
						category_id=:category_id, image=:image, secondimage=:secondimage,thirdimage=:thirdimage, created=:created, noviews=:noviews";
 
        $stmt = $this->conn->prepare($query);
 
        // posted values
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
		$this->image=htmlspecialchars(strip_tags($this->image));
		$this->secondimage=htmlspecialchars(strip_tags($this->secondimage));
		$this->thirdimage=htmlspecialchars(strip_tags($this->thirdimage));
		 $this->noviews=htmlspecialchars(strip_tags($this->noviews));
 
        // to get time-stamp for 'created' field
        $this->timestamp = date('Y-m-d H:i:s');
 
        // bind values 
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":created", $this->timestamp);
		$stmt->bindParam(":image", $this->image);
		$stmt->bindParam(":secondimage", $this->secondimage);
		$stmt->bindParam(":thirdimage", $this->thirdimage);
		$stmt->bindParam(":noviews", $this->noviews);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
 
    }
	
			function readAll($from_record_num, $records_per_page){
		 
			$query = "SELECT
						id, name, description, price, category_id
					FROM
						" . $this->table_name . "
					ORDER BY
						name ASC
					LIMIT
						{$from_record_num}, {$records_per_page}";
		 
			$stmt = $this->conn->prepare( $query );
			$stmt->execute();
		 
			return $stmt;
		}
		
		
		// used for paging products
		public function countAll(){
		 
			$query = "SELECT id FROM " . $this->table_name . "";
		 
			$stmt = $this->conn->prepare( $query );
			$stmt->execute();
		 
			$num = $stmt->rowCount();
		 
			return $num;
		}
		
		function readOne(){
 
				$query = "SELECT
							name, price, description, category_id,image,secondimage,thirdimage
						FROM
							" . $this->table_name . "
						WHERE
							id = ?
						LIMIT
							0,1";
			 
				$stmt = $this->conn->prepare( $query );
				$stmt->bindParam(1, $this->id);
				$stmt->execute();
			 
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
			 
				$this->name = $row['name'];
				$this->price = $row['price'];
				$this->description = $row['description'];
				$this->category_id = $row['category_id'];
				$this->image = $row['image'];
				$this->secondimage = $row['secondimage'];
				$this->thirdimage = $row['thirdimage'];
			}
		
			function readCat($cat_id,$from_record_num, $records_per_page){
				$this->category_id = $cat_id;
				
				$query = "SELECT 
						id,name,price,image,description,category_id
							
						FROM
							" . $this->table_name . "
						WHERE
							category_id = ?
						ORDER BY
							category_id
						LIMIT
							{$from_record_num}, {$records_per_page}";
			 
				// prepare query statement
			$stmt = $this->conn->prepare( $query );	
			$stmt->bindParam(1, $this->category_id);
		
		 
			// execute query
			$stmt->execute();
		 
			// return values from database
			return $stmt;
			}
			
		
		function update(){
 
		$query = "UPDATE
					" . $this->table_name . "
				SET
					name = :name,
					price = :price,
					description = :description,
					category_id  = :category_id
				WHERE
					id = :id";
	 
		$stmt = $this->conn->prepare($query);
	 
		// posted values
		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->price=htmlspecialchars(strip_tags($this->price));
		$this->description=htmlspecialchars(strip_tags($this->description));
		$this->category_id=htmlspecialchars(strip_tags($this->category_id));
		$this->id=htmlspecialchars(strip_tags($this->id));
	 
		// bind parameters
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':price', $this->price);
		$stmt->bindParam(':description', $this->description);
		$stmt->bindParam(':category_id', $this->category_id);
		$stmt->bindParam(':id', $this->id);
	 
		// execute the query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
		 
	}
	
	
	// delete the product
		function delete(){
		 
			$query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
			 
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(1, $this->id);
		 
			if($result = $stmt->execute()){
				return true;
			}else{
				return false;
			}
		}
		
		// delete the product
		function updateview($id){
			$noviews +=1;
			$query = "UPDATE noviews FROM " . $this->table_name . " WHERE id = ?";
			 
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(1, $this->id);
		 
			if($result = $stmt->execute()){
				return true;
			}else{
				return false;
			}
		}
		
		// read products by search term
		public function search($search_term, $from_record_num, $records_per_page){
		 
			// select query
			$query = "SELECT
						c.name as category_name, p.id,p.image, p.name, p.description, p.price, p.category_id, p.created
					FROM
						" . $this->table_name . " p
						LEFT JOIN
							categories c
								ON p.category_id = c.id
					WHERE
						p.name LIKE ? OR p.description LIKE ?
					ORDER BY
						p.name ASC
					LIMIT
						?, ?";
		 
			// prepare query statement
			$stmt = $this->conn->prepare( $query );
		 
			// bind variable values
			$search_term = "%{$search_term}%";
			$stmt->bindParam(1, $search_term);
			$stmt->bindParam(2, $search_term);
			$stmt->bindParam(3, $from_record_num, PDO::PARAM_INT);
			$stmt->bindParam(4, $records_per_page, PDO::PARAM_INT);
		 
			// execute query
			$stmt->execute();
		 
			// return values from database
			return $stmt;
		}
		 
		public function countAll_BySearch($search_term){
		 
			// select query
			$query = "SELECT
						COUNT(*) as total_rows
					FROM
						" . $this->table_name . " p 
					                LEFT JOIN
                    categories c
                        ON p.category_id = c.id
					WHERE
						p.name LIKE ?";
		 
			// prepare query statement
			$stmt = $this->conn->prepare( $query );
		 
			// bind variable values
			$search_term = "%{$search_term}%";
			$stmt->bindParam(1, $search_term);
		 
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
		 
			return $row['total_rows'];

		}
		
		// will upload image file to server
		function uploadPhoto(){
		 
			$result_message="";
		 
			// now, if image is not empty, try to upload the image
			if($this->image){
		 
				// sha1_file() function is used to make a unique file name
				$target_directory = "uploads/";
				$target_file = $target_directory . $this->image;
				$file_type = pathinfo($target_file, PATHINFO_EXTENSION);
		 
				// error message is empty
				$file_upload_error_messages="";
				
				// make sure that file is a real image
				$check = getimagesize($_FILES["image"]["tmp_name"]);
				if($check!==false){
					// submitted file is an image
				}else{
					$file_upload_error_messages.="<div>Submitted file one is not an image.</div>";
				}
				 
				// make sure certain file types are allowed
				$allowed_file_types=array("jpg", "jpeg", "png", "gif");
				if(!in_array($file_type, $allowed_file_types)){
					$file_upload_error_messages.="<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
				}
				 
				// make sure file does not exist
				if(file_exists($target_file)){
					$file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
				}
				 
				// make sure submitted file is not too large, can't be larger than 1 MB
				if($_FILES['image']['size'] > (1024000)){
					$file_upload_error_messages.="<div>Image one must be less than 1 MB in size.</div>";
				}
				 
				// make sure the 'uploads' folder exists
				// if not, create it
				if(!is_dir($target_directory)){
					mkdir($target_directory, 0777, true);
				}
				
				// if $file_upload_error_messages is still empty
				if(empty($file_upload_error_messages)){
					// it means there are no errors, so try to upload the file
					if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
						// it means photo was uploaded
					}else{
						$result_message.="<div class='alert alert-danger'>";
							$result_message.="<div>Unable to upload photo one.</div>";
							$result_message.="<div>Update the record to upload photo one.</div>";
						$result_message.="</div>";
					}
				}
				 
				// if $file_upload_error_messages is NOT empty
				else{
					// it means there are some errors, so show them to user
					$result_message.="<div class='alert alert-danger'>";
						$result_message.="{$file_upload_error_messages}";
						$result_message.="<div>Update the record to upload photo one .</div>";
					$result_message.="</div>";
				}
						 
			}
		 
			return $result_message;
		}
		
		// will upload second image file to server
		function uploadPhoto2(){
		 
			$result_message="";
		 
			// now, if image is not empty, try to upload the image
			if($this->secondimage){
		 
				// sha1_file() function is used to make a unique file name
				$target_directory = "uploads/";
				$target_file = $target_directory . $this->secondimage;
				$file_type = pathinfo($target_file, PATHINFO_EXTENSION);
		 
				// error message is empty
				$file_upload_error_messages="";
				
				// make sure that file is a real image
				$check = getimagesize($_FILES["secondimage"]["tmp_name"]);
				if($check!==false){
					// submitted file is an image
				}else{
					$file_upload_error_messages.="<div>Submitted file two  is  not an image.</div>";
				}
				 
				// make sure certain file types are allowed
				$allowed_file_types=array("jpg", "jpeg", "png", "gif");
				if(!in_array($file_type, $allowed_file_types)){
					$file_upload_error_messages.="<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
				}
				 
				// make sure file does not exist
				if(file_exists($target_file)){
					$file_upload_error_messages.="<div>Image already exists. Try to change file name two .</div>";
				}
				 
				// make sure submitted file is not too large, can't be larger than 1 MB
				if($_FILES['secondimage']['size'] > (1024000)){
					$file_upload_error_messages.="<div>Image two must be less than 1 MB in size.</div>";
				}
				 
				// make sure the 'uploads' folder exists
				// if not, create it
				if(!is_dir($target_directory)){
					mkdir($target_directory, 0777, true);
				}
				
				// if $file_upload_error_messages is still empty
				if(empty($file_upload_error_messages)){
					// it means there are no errors, so try to upload the file
					if(move_uploaded_file($_FILES["secondimage"]["tmp_name"], $target_file)){
						// it means photo was uploaded
					}else{
						$result_message.="<div class='alert alert-danger'>";
							$result_message.="<div>Unable to upload photo two.</div>";
							$result_message.="<div>Update the record to upload photo two.</div>";
						$result_message.="</div>";
					}
				}
				 
				// if $file_upload_error_messages is NOT empty
				else{
					// it means there are some errors, so show them to user
					$result_message.="<div class='alert alert-danger'>";
						$result_message.="{$file_upload_error_messages}";
						$result_message.="<div>Update the record to upload photo two.</div>";
					$result_message.="</div>";
				}
						 
			}
		 
			return $result_message;
		}
		// will upload third image file to server
		function uploadPhoto3(){
		 
			$result_message="";
		 
			// now, if image is not empty, try to upload the image
			if($this->thirdimage){
		 
				// sha1_file() function is used to make a unique file name
				$target_directory = "uploads/";
				$target_file = $target_directory . $this->thirdimage;
				$file_type = pathinfo($target_file, PATHINFO_EXTENSION);
		 
				// error message is empty
				$file_upload_error_messages="";
				
				// make sure that file is a real image
				$check = getimagesize($_FILES["thirdimage"]["tmp_name"]);
				if($check!==false){
					// submitted file is an image
				}else{
					$file_upload_error_messages.="<div>Submitted file is not an image.</div>";
				}
				 
				// make sure certain file types are allowed
				$allowed_file_types=array("jpg", "jpeg", "png", "gif");
				if(!in_array($file_type, $allowed_file_types)){
					$file_upload_error_messages.="<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
				}
				 
				// make sure file does not exist
				if(file_exists($target_file)){
					$file_upload_error_messages.="<div>Image 3 already exists. Try to change file name.</div>";
				}
				 
				// make sure submitted file is not too large, can't be larger than 1 MB
				if($_FILES['thirdimage']['size'] > (1024000)){
					$file_upload_error_messages.="<div>Image 3 must be less than 1 MB in size.</div>";
				}
				 
				// make sure the 'uploads' folder exists
				// if not, create it
				if(!is_dir($target_directory)){
					mkdir($target_directory, 0777, true);
				}
				
				// if $file_upload_error_messages is still empty
				if(empty($file_upload_error_messages)){
					// it means there are no errors, so try to upload the file
					if(move_uploaded_file($_FILES["thirdimage"]["tmp_name"], $target_file)){
						// it means photo was uploaded
					}else{
						$result_message.="<div class='alert alert-danger'>";
							$result_message.="<div>Unable to upload photo three.</div>";
							$result_message.="<div>Update the record to upload photo three.</div>";
						$result_message.="</div>";
					}
				}
				 
				// if $file_upload_error_messages is NOT empty
				else{
					// it means there are some errors, so show them to user
					$result_message.="<div class='alert alert-danger'>";
						$result_message.="{$file_upload_error_messages}";
						$result_message.="<div>Update the record to upload photo three.</div>";
					$result_message.="</div>";
				}
						 
			}
		 
			return $result_message;
		}
		
		
		// read all products
		function read($from_record_num, $records_per_page){
		 
			// select all products query
			$query = "SELECT
						id, name, description, price  ,image
					FROM
						" . $this->table_name . "
					ORDER BY
						created DESC
					LIMIT
						?, ?";
		 
			// prepare query statement
			$stmt = $this->conn->prepare( $query );
		 
			// bind limit clause variables
			$stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
			$stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
		 
			// execute query
			$stmt->execute();
		 
			// return values
			return $stmt;
		}
		
		// read all lastest products
		function readLate($from_record_num, $records_per_page){
			$from_record_num = 0;
			$records_per_page =4;
			// select all products query
			$query = "SELECT
						id, name, description, price  ,image
					FROM
						" . $this->table_name . "
					ORDER BY
						created DESC
					LIMIT
						?, ?";
		 
			// prepare query statement
			$stmt = $this->conn->prepare( $query );
		 
			// bind limit clause variables
			$stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
			$stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
		 
			// execute query
			$stmt->execute();
		 
			// return values
			return $stmt;
		}
		 
		 // read all picked products
		function readHot($from_record_num, $records_per_page){
			$from_record_num = 0;
			$records_per_page =4;
			// select all products query
			$query = "SELECT
						id, name, description, price  ,image
					FROM
						" . $this->table_name . "
					ORDER BY
						RAND( )
					LIMIT
						?, ?";
		 
			// prepare query statement
			$stmt = $this->conn->prepare( $query );
		 
			// bind limit clause variables
			$stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
			$stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
		 
			// execute query
			$stmt->execute();
		 
			// return values
			return $stmt;
		}
		
		 // read all best products
		function readBest($from_record_num, $records_per_page){
			
			// select all products query
			
			$from_record_num = 0;	
			$records_per_page =4;
		
			$query = "SELECT
						*   
					FROM
						" . $this->table_name . "
					WHERE noviews !=0 
					
					GROUP BY 
						noviews
					LIMIT
						?, ?";
						
			// prepare query statement
			$stmt = $this->conn->prepare( $query );
			
			// bind limit clause variables
			$stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
			$stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
		 
			// execute query
			$stmt->execute();
		 
			// return values
			return $stmt;
		}
		 
		// used for paging products
		public function count(){
		 
			// query to count all product records
			$query = "SELECT count(*) FROM " . $this->table_name;
		 
			// prepare query statement
			$stmt = $this->conn->prepare( $query );
		 
			// execute query
			$stmt->execute();
		 
			// get row value
			$rows = $stmt->fetch(PDO::FETCH_NUM);
		 
			// return count
			return $rows[0];
		}
		
		// read all product based on product ids included in the $ids variable
		
		public function readByIds($ids){
		 
			$ids_arr = str_repeat('?,', count($ids) - 1) . '?';
		 
			// query to select products
			$query = "SELECT id, name, price,image FROM " . $this->table_name . " WHERE id IN ({$ids_arr}) ORDER BY name";
		 
			// prepare query statement
			$stmt = $this->conn->prepare($query);
		 
			// execute query
			$stmt->execute($ids);
		 
			// return values from database
			return $stmt;
		}
		
		
	function updateViews($id ){
	
		global $conn;
		$query = "UPDATE
					" . $this->table_name . "
				SET
					noviews = (noviews +1)
					
				WHERE
					id = {$id}";
	 
		$r = @mysqli_multi_query($conn, $query);
		 
	}
}
?>