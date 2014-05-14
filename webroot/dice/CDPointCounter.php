<?php

class CDPointCounter{

	private static $points;

	/**
	* Constructor
	*
	*/
	  public function __construct() {
		;
	  }

	  public function AddPoints($value){
		 CDPOintCounter::$points += $value;
	  }
	  
	  public function getTotalPoints(){
		return CDPOintCounter::$points;
	  }
  
}