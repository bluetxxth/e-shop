<?php

class CUser{

protected $db; 

	/**
	 *Constructs an object of type CUser
	 */
	public function __construct($db){
		$this->db = $db;
	}

	/**
	 *Check wether the user is loged in
	 */
	public function isAuthenticated(){
		
		$isLogedIn = false;
		
		if(isset($_SESSION['user'])){
			$isLogedIn = true;
		}else {
			$isLogedIn = false;
		}
		return $isLogedIn;
	}

	/**
	 *Gets output
	 */
	public function myOutput(){
	
			// Check if user is authenticated.
			$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;
			 
			if($acronym) {
			  $output = "You are logged in as: $acronym ({$_SESSION['user']->name})";
			}
			else {
			  $output = "You are not logged in.";
			}
		return $output;
	}
	
	
	/**
	 *Check user password
	 */
	public function checkUserAndPassword($user, $password){
			// Check if user and password is okey
            $sql = "SELECT acronym, name FROM aUSER WHERE acronym = ? AND password = md5(concat(?, salt))";
            
            $params = array(); 
            $params=[htmlentities($user),  htmlentities($password)]; 
            
      
            $res=$this->db->ExecuteSelectQueryAndFetchAll($sql, $params); 
      
            if(isset($res[0])) { 
                $_SESSION['user'] = $res[0]; 
                
              // echo  var_dump($res[0]) ;

                return true; 
            } 
            else{  
                return false; 
            } 
	}
	

	/**
	 *Log user out
	 */
	public function logoutUser(){
		
		// Logout the user
		  unset($_SESSION['user']);
	
	}
	
	
	/**
	 * Get user name
	 * @param unknown $acronym
	 * @return unknown|NULL
	 */
	function getUserName($acronym)
	{
		$sql = "SELECT name FROM aUser WHERE acronym = ?";
		$params = array(htmlentities($acronym));
		$res=$this->db->ExecuteSelectQueryAndFetchAll($sql, $params);
		if(isset($res[0])) {
			$name = $res[0]->name;
			return  $name;
		}
		else{
			return null;
		}
	}
	
	
	/**
	 * Create user
	 * @param unknown $acronym
	 * @param unknown $name
	 * @param unknown $password
	 * @return Ambigous <NULL, string>
	 */
	public function createUser($acronym, $name, $password, $salute){
		
		
		$salt = 1385042948;
		
		$encrytedPassword = md5($password.$salt);
		
		//echo "encrypted password: " . $encrytedPassword;
		
		
		$sql = 'INSERT INTO aUSER (acronym, name, password, salt, salute, updated) VALUES (?,?,?,?,?, NOW())';
		
	
		
		// put parameters in an array
		$params = array (
		
			$acronym,
			$name,
			$encrytedPassword,
			$salt,
			$salute
		);
		
		$isExecuted = $res = $this-> db -> ExecuteQuery($sql, $params);
		
		$output = null;
		
		if($isExecuted){
			$output = "User added successfuly";
		}else {
			
			$output = "Failed creating user";
		}
		
		return $output;
	}
	
	
	/**
	 * Create user
	 * @param unknown $acronym
	 * @param unknown $name
	 * @param unknown $password
	 * @return Ambigous <NULL, string>
	 */
	public function updateUser($acronym, $name, $password, $id){
			//echo $acronym . " ";
			//echo $name;
		
		
		$salt = 1385042948;
	
		$encrytedPassword = md5($password.$salt);
	
	//	echo " encrypted password: " . $encrytedPassword;
	
	
			$sql = '
    UPDATE aUSER SET
      acronym = ?,
	  name = ?,
	  password = ?,
	  salt = ?,
	  updated = NOW()		
    WHERE
      id = ?
  ';
	

		// put parameters in an array
		$params = array (
				$acronym,
				$name,
				$encrytedPassword,
				$salt,
				$id
		
		);
	
		$isExecuted = $res = $this-> db -> ExecuteQuery($sql, $params);
	
		$output = null;
	
		if($isExecuted){
			
			$output = "User updated successfully";
		}else {
				
			$output = "Failed creating user". print_r($this->db->ErrorInfo(), 1);
		}
	
		return $output;
	}
	
	/**
	 * Edits movie
	 */
	public function editUser($acronym,  $name, $password){

		$output = null;
	
// 		// Get parameters
// 		$password = isset($_POST['password']) ? $_POST['password'] : array();
// 		$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;
// 		$name = isset($_POST['name']) ? strip_tags($_POST['name'])  : null;
// 		$img_path  = isset($_POST['image_path'])  ? strip_tags($_POST['price'])  : null;
// 		$img_name  = isset($_POST['img_name']) ? strip_tags($_POST['img_name']) : null;

		
	
		$sql = '
    UPDATE aUSER SET
      user = ?,
	  name = ?,
	  password = ?,
	  updated = NOW()
    WHERE
      id = ?
  ';
	
		$params = array (
				
				$acronym,
				$name,
				$password
		);
	
		$isExecuted = $this->db->ExecuteQuery ( $sql, $params );
	
		if ($isExecuted) {
	
			$output = 'Movie was updated successfully.';
	
			header ( 'Location: user_admin.php' );
				
		} else {
	
			$output = 'Error updating user! ' . print_r($this->db->ErrorInfo(), 1);
		}
	
		return $output;
	}
	
	/**
	 * Use the current querystring as base, modify it according to $options and return the modified query string.
	 *
	 * @param array $options to set/change.
	 * @param string $prepend this to the resulting query string
	 * @return string with an updated query string.
	 */
	function getQueryString($options=array(), $prepend='?') {
		// parse query string into array
		$query = array();
		parse_str($_SERVER['QUERY_STRING'], $query);
	
		// Modify the existing query string with new options
		$query = array_merge($query, $options);
	
		// Return the modified querystring
		return $prepend . htmlentities(http_build_query($query));
	}
	
	/**
	 * Function to create links for sorting
	 *
	 * @param string $column the name of the database column to sort by
	 * @return string with links to order by column.
	 */
	function orderby($column) {
		$nav  = "<a href='" . $this->getQueryString(array('orderby'=>$column, 'order'=>'asc')) . "'>&darr;</a>";
		$nav .= "<a href='" . $this->getQueryString(array('orderby'=>$column, 'order'=>'desc')) . "'>&uarr;</a>";
		return "<span class='orderby'>" . $nav . "</span>";
	}
	
	
	/**
	 *
	 * @return unknown
	 */
	function selectLatestUsers()
	{
		$sql='SELECT * FROM aUSER
    ORDER BY updated DESC
    LIMIT 6';
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql, array());
		return $res;
	
	}
	
	/**
	 *
	 * @param unknown $id
	 * @return unknown|NULL
	 */
	function selectUserID($id){
	
		$sql = 'SELECT * FROM aUSER WHERE id = ?';
	
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql, array($id));
	
	
		if(isset($res[0])) {
			$c = $res[0];
			return $c;
		}
		else {
			die('Error: no  content with id '.$id);
			return null;
		}
	
	}
	
}
