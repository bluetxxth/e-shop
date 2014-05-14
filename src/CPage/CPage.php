<?php 

/**
 * 
 * @author  Gabriel Nieva
 *
 */
class CPage extends CContent {
	
	private $c;
	
	/**
	 * Constructs an object of type CPage
	 */
	function __construct($db){
		
		parent::__construct($db);
		
	}
	
	
	/**
	 * gets the content from the parent
	 */
	public function getContent(){
		
		$this-> c = parent::getPageContent();
		
		return $this-> c;
		
	}

}
