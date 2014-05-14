<?php
class CMyShoppingCart {
	private $db;
	private $product_to_increase;
	private $output;
	
	// Connect to MySQL database using PHP PDO
	
	// constructor accepts the session variable to create cart object
	function __construct($db) {
		$this->db = $db;
		
		// $id = $_SESSION['id'] ;
	}
	
	/**
	 * Creates table
	 */
	public function createTable() {
		$sql = '	
	--
	-- Create table for Content
	--
	CREATE TABLE IF NOT EXISTS `aCart` (
	   `id` int(11) NOT NULL AUTO_INCREMENT,
	  `product_id` int(11) NOT NULL,
	  `title` varchar(100) NOT NULL,
	  `YEAR` int(11) NOT NULL,
	  `image` varchar(100) DEFAULT NULL,
	  `genre` char(50) DEFAULT NULL,
	  `price` double DEFAULT NULL,
	  `Qty` int DEFAULT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;
			
	';
		
		try {
			// create database tables
			$this->db->ExecuteQuery ( $sql );
		} catch ( Exception $ex ) {
			
			$strOut = "Database error";
		}
		
		$strOut = "Shopping has been created";
		
		return $strOut;
	}
	
	/**
	 * Add item to the shopping cart
	 * 
	 * @param unknown $product_id        	
	 * @param unknown $title        	
	 * @param unknown $year        	
	 * @param unknown $img        	
	 * @param unknown $genre        	
	 * @param unknown $price        	
	 * @return Ambigous <NULL, string>
	 */
	public function addItem($product_id, $title, $year, $img, $genre, $price, $qty = 1) {
		$output = null;
		$lastId = null;
		
		// echo $product_id;
		
		if (! ($this->isInCart ( $product_id ))) {
			
			$sql = 'INSERT INTO aCart (product_id, title, YEAR, image, genre, price, Qty) VALUES (?,?,?,?,?,?,?)';
			
			$params = array (
					$product_id,
					$title,
					$year,
					$img,
					$genre,
					$price,
					$qty 
			);
			
			$isExecuted = $res = $this->db->ExecuteQuery ( $sql, $params );
			
			$output = null;
			
			if ($isExecuted) {
				
				$output = "Item added successfully at insert";
			} else {
				
				$output = "Failed adding item at insert";
			}
		} else {
			
			// update the Qty instead of inserting a new line item
			$sql = 'UPDATE aCart SET Qty = Qty+1  WHERE product_id =' . $product_id;
			
			$params = array (
					$qty 
			);
			
			$isExecuted = $res = $this->db->ExecuteQuery ( $sql, $params );
			
			$output = null;
			
			if ($isExecuted) {
				$output = "Item added successfuly at update";
			} else {
				
				$output = "Failed adding item at update";
			}
		}
		
		return $output;
	}
	
	/**
	 * Empties the shopping cart
	 */
	public function emptyCart() {
		$sql = '	
	--
	-- Create table for Content
	--
	DROP TABLE IF EXISTS aCart;
	CREATE TABLE IF NOT EXISTS `aCart` (
	   `id` int(11) NOT NULL AUTO_INCREMENT,
	  `product_id` int(11) NOT NULL,
	  `title` varchar(100) NOT NULL,
	  `YEAR` int(11) NOT NULL,
	  `image` varchar(100) DEFAULT NULL,
	  `genre` char(50) DEFAULT NULL,
	  `price` double DEFAULT NULL,
	  `Qty` int DEFAULT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;
			
	';
		
		try {
			// create database tables
			$this->db->ExecuteQuery ( $sql );
		} catch ( Exception $ex ) {
			
			$strOut = "Database error";
		}
		
		$strOut = "Shopping cart has been reset";
	}
	
	/**
	 * Creates order when clicking confirm button.
	 */
	public function createOrder($name, $qty, $subtotal, $vat, $total) {
		$sql = 'INSERT INTO aOrder (name, quantity, subtotal, vat, total, created) VALUES (?,?,?,?,?, NOW())';
		
		$params = array (
				
				$name,
				$qty,
				$subtotal,
				$vat,
				$total 
		);
		
		$isExecuted = $res = $this->db->ExecuteQuery ( $sql, $params );
		
		$output = null;
		
		if ($isExecuted) {
			
			$output = "Order added successfully";
		} else {
			
			$output = "Failed adding order" . print_r ( $this->db->ErrorInfo (), 1 );
		}
		
		return $output;
	}
	
	/**
	 * Check if item is in cart
	 * 
	 * @param unknown $id        	
	 * @return boolean - true or false depending if it is in cart or not
	 */
	public function isInCart($id) {
		$movieArray;
		
		// echo $id . " from isInCart ";
		$inCart = false;
		
		try {
			// create database tables
			
			// get all the contents of the aCart
			$sql = "SELECT product_id FROM aCart";
			$params = array ();
			
			$res = $this->db->ExecuteSelectQueryAndFetchAll ( $sql, $params );
		} catch ( Exception $ex ) {
			
			echo "Database error";
		}
		
		$myId = null;
		
		$n = 0;
		
		// parse the database contents
		foreach ( $res as $val ) {
			
			$movieArray [$n] = $val->product_id;
			
			if ($movieArray [$n] == $id) {
				
				$inCart = true;
				
				$this->product_to_increase = $id;
				
				break;
			}
			
			$n ++;
		}
		
		return $inCart;
	}
	
	/**
	 * Check if cart is empty
	 */
	public function isEmpty() {
		$isEmpty = false;
		
		try {
			// create database tables
			
			// get all the contents of the ACart
			$sql = "SELECT SUM(id) AS items FROM aCart";
			
			$params = array ();
			
			$res = $this->db->ExecuteSelectQueryAndFetchAll ( $sql, $params );
		} catch ( Exception $ex ) {
			
			echo "Database error";
		}
		
		$rows = 0;
		foreach ( $res as $val ) {
			// check if there are any rows
			$items = $val->items ;
		}
		
	
		if ($items == 0) {
			$isEmpty = true;
		} else {
			$isEmpty = false;
		}
		
		return $isEmpty;
	}
	
	/**
	 * Count the unique items that there are on the shopping cart.
	 * 
	 * @return unknown the number of unique items
	 */
	public function countUniqueItems() {
		$uniqueItems = null;
		
		// to place the result in a Qty use AS keyword then the Qty will show up
		$sql = "SELECT SUM(Qty) AS 'Qty'  FROM aCart";
		
		try {
			
			$params = array ();
			
			$res = $this->db->ExecuteSelectQueryAndFetchAll ( $sql, $params );
			
			foreach ( $res as $key => $val ) {
				
				$uniqueItems = $val->Qty;
			}
		} catch ( Exception $ex ) {
			
			$this->output = "Database error";
		}
		
		return $uniqueItems;
	}
	
	
	/**
	 * 
	 */
	public function editOrder(){
		
		
		
	}
	
	
	/**
	 * 
	 */
	public function deleteLineItem(){
		
		
		
	}
	
	
	/**
	 * Get user credit
	 * 
	 * @param unknown $acronym
	 *        	- the user in question
	 */
	public function getUserCredit($acronym) {
		
		$credit = null;
		
		$sql = "SELECT credit FROM aUSER WHERE acronym =?";
		
		$params = array (
			$acronym
		);
		
		$res = $this->db->ExecuteSelectQueryAndFetchAll ( $sql, $params );
		
		foreach ( $res as $key => $val ) {
			
			$credit = $val->credit;
			
			echo $credit;
		}
		
		return $credit;
	}
	
	/**
	 * Remove credit from user
	 * 
	 * @return string string showing if success or not
	 */
	public function removeUserCredit($acronym, $order_total) {
		echo $acronym;
		echo $order_total;
		
		$sql = 'UPDATE aUSER SET credit = credit -(' . $order_total . ') WHERE acronym = ?';
		
		$params = array (
				
				$acronym 
		)
		;
		
		$isExecuted = $this->db->ExecuteQuery ( $sql, $params );
		
		if ($isExecuted) {
			
			$output = 'Movie was updated successfully.';
			
			header ( 'Location: movies.php' );
		} else {
			
			$output = 'Error decreasing credit!' . print_r ( $this->db->ErrorInfo (), 1 );
		}
		
		return $output;
	}
	
	/**
	 * Outputs info messages
	 *
	 * @return string with the information message
	 */
	public function outputMessage() {
		return $this->output;
	}
}
