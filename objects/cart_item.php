<?php
// 'cart item' object
class CartItem{
 
    // database connection and table name
    private $conn;
    private $table_name = "cart_items";
 
    // object properties
    public $id;
    public $product_id;
	public $product_name;
    public $quantity;
    public $user_id;
    public $created;
    public $modified;
	public $totalprice;
 
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
					quantity = :quantity,
					user_id = :user_id,					
					created = :created,
					product_name= :product_name,
					totalprice = :totalprice";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->product_id=htmlspecialchars(strip_tags($this->product_id));
		$this->quantity=htmlspecialchars(strip_tags($this->quantity));
		$this->user_id=htmlspecialchars(strip_tags($this->user_id));
		$this->totalprice=htmlspecialchars(strip_tags($this->totalprice));
		$this->product_name=htmlspecialchars(strip_tags($this->product_name));
	 
		// bind values
		$stmt->bindParam(":product_id", $this->product_id);
		$stmt->bindParam(":quantity", $this->quantity);
		$stmt->bindParam(":user_id", $this->user_id);
		$stmt->bindParam(":totalprice", $this->totalprice);
		$stmt->bindParam(":created", $this->created);
		$stmt->bindParam(":product_name", $this->product_name);
	 
		// execute query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}
	
	// read items in the cart
	public function read(){
	 
		$query="SELECT p.id, p.name, p.price,p.image, ci.totalprice,ci.quantity, ci.quantity * p.price AS subtotal
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
	
	
	
	// create cart item record
	function update(){
	 
		// query to insert cart item record
		$query = "UPDATE " . $this->table_name . "
				SET quantity=:quantity,totalprice=:totalprice
				WHERE product_id=:product_id AND user_id=:user_id";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->quantity=htmlspecialchars(strip_tags($this->quantity));
		$this->product_id=htmlspecialchars(strip_tags($this->product_id));
		$this->totalprice=htmlspecialchars(strip_tags($this->totalprice));
		$this->user_id=htmlspecialchars(strip_tags($this->user_id));
		
	 
		// bind values
		$stmt->bindParam(":quantity", $this->quantity);
		$stmt->bindParam(":product_id", $this->product_id);
		$stmt->bindParam(":totalprice", $this->totalprice);
		$stmt->bindParam(":user_id", $this->user_id);
	
	 
		// execute query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
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
