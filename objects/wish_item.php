<?php
// 'cart item' object
class WishItem{
 
    // database connection and table name
    private $conn;
    private $table_name = "wish";
 
    // object properties
    public $id;
    public $product_id;
	public $product_name;   
    public $user_id;
    public $created;
  
	
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }
	
	
	// check if a cart item exists
	public function exists(){
	 
		// query to count existing cart item
		$query = "SELECT count(*) FROM " . $this->table_name . " WHERE product_id=:product_id AND user_id=:user_id";
	 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
	 
		// sanitize
		$this->product_id=htmlspecialchars(strip_tags($this->product_id));
		$this->user_id=htmlspecialchars(strip_tags($this->user_id));
	 
		// bind category id variable
		$stmt->bindParam(":product_id", $this->product_id);
		$stmt->bindParam(":user_id", $this->user_id);
	 
		// execute query
		$stmt->execute();
	 
		// get row value
		$rows = $stmt->fetch(PDO::FETCH_NUM);
	 
		// return
		if($rows[0]>0){
			return true;
		}
	 
		return false;
	}
	
	
	// count user's items in the cart
	public function count(){
	 
		// query to count existing cart item
		$query = "SELECT count(*) FROM " . $this->table_name . " WHERE user_id=:user_id";
	 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
	 
		// sanitize
		$this->user_id=htmlspecialchars(strip_tags($this->user_id));
	 
		// bind category id variable
		$stmt->bindParam(":user_id", $this->user_id);
	 
		// execute query
		$stmt->execute();
	 
		// get row value
		$rows = $stmt->fetch(PDO::FETCH_NUM);
	 
		// return
		return $rows[0];
	}

	
	// create cart item record
	function create(){
	 
		// to get times-tamp for 'created' field
		$this->created=date('Y-m-d H:i:s');
	 
		// query to insert cart item record
		$query = "INSERT INTO
					" . $this->table_name . "
				SET
					product_id = :product_id,					
					user_id = :user_id,					
					created = :created,
					product_name= :product_name
					";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->product_id=htmlspecialchars(strip_tags($this->product_id));	
		$this->user_id=htmlspecialchars(strip_tags($this->user_id));		
		$this->product_name=htmlspecialchars(strip_tags($this->product_name));
	 
		// bind values
		$stmt->bindParam(":product_id", $this->product_id);		
		$stmt->bindParam(":user_id", $this->user_id);		
		$stmt->bindParam(":created", $this->created);
		$stmt->bindParam(":product_name", $this->product_name);
	 
		// execute query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}
	function readAll($from_record_num, $records_per_page){
		 
			$query = "SELECT
						id, product_id,product_name, user_id, created
					FROM
						" . $this->table_name . "
					ORDER BY
						product_name ASC
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
							id, product_id,product_name, user_id, created
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
			 
				$this->product_name = $row['product_name'];
				$this->product_id = $row['product_id'];
				$this->user_id = $row['user_id'];				
				$this->created = $row['created'];
				
				
			}
	// read items in the cart
	public function read(){
	 
		$query="SELECT p.id, p.name, p.price,p.image,ci.product_id
				FROM " . $this->table_name . " ci
					LEFT JOIN products p
						ON ci.product_id = p.id
				WHERE ci.user_id=:user_id";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->user_id=htmlspecialchars(strip_tags($this->user_id));
	 
		// bind value
		$stmt->bindParam(":user_id", $this->user_id, PDO::PARAM_INT);
	 
		// execute query
		$stmt->execute();
	 
		// return values
		return $stmt;
	}
	
	// read items in the cart
	public function readWish(){
	 
		$query="SELECT p.id, p.name, p.price,p.image,p.description,ci.product_id
				FROM " . $this->table_name . " ci
					LEFT JOIN products p
						ON ci.product_id = p.id
				ORDER BY user_id";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		
		// execute query
		$stmt->execute();
	 
		// return values
		return $stmt;
	}
	
	
	
	

	
	// remove cart item by user and product
	public function delete(){
	 
		// delete query
		$query = "DELETE FROM " . $this->table_name . " WHERE product_id=:product_id AND user_id=:user_id";
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->product_id=htmlspecialchars(strip_tags($this->product_id));
		$this->user_id=htmlspecialchars(strip_tags($this->user_id));
	 
		// bind ids
		$stmt->bindParam(":product_id", $this->product_id);
		$stmt->bindParam(":user_id", $this->user_id);
	 
		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}




}
