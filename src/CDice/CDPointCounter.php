<?php

class CDPointCounter{

	private  $points;
	private  $hands;
	private  $totalPoints;
	private $handArray;
	private $arraySum;

	/**
	* Constructor
	*
	*/
	  public function __construct() {
	  
	  $this -> points = 0;
	  $this -> hands = 0;
	  $this -> totalPoints = 0;
	  $this -> handArray[] = 0; 
	  $this -> arraySum = 0;
		
	  }

	  /*
	   *Add points
	   */
	  public function AddPoints($value){
		 $this -> points += $value;
	  }
	    
	  /*
	   *Get  points
	   */
	  public function GetPoints(){
		
		return $this -> points;
	  }  
	  	  
	  /*
	   *Reset to 0
	   */
	  public function Reset(){
		$this->points = 0;
	  }
	  
	  /*
	   *Add Hands
	   */
	  public function AddHands(){
		$this -> hands++;
	  } 
	  
	  /*
	   *Get the number of hands played
	   */
	  public function GetHands(){
	  
		return $this -> hands;
	  }
	  
	  /*
	   *Insert the result of each hand in an array
	   */
	  public function AddToHandArray($hand, $points ){
	  
		$myHandArray = $this-> handArray;
	   
		foreach($myHandArray as $hand){
			
			$handArray[$hand] = $points ;
		}
	
	  }
	  
	  /*
	   *Get the sum of the hand array
	   */
	  public function GetHandArraySum(){
	  
			$this -> arraySum =  array_sum($this->handArray); 
			 
			 return $this -> arraySum;
	  }
	  
	  /*
	   *Get a hand array
	   */
	  public function GetHandArray(){
	  
		return $this -> handArray;
	  }
	  
	  /*
	   *Add total points
	   */
	  public function AddTotalPoints($points){
		$this -> totalPoints +=  $points; 
	  }
	  
	  /*
	   *Get total points
	   */
	  public function GetTotalPoints(){
		
		return $this->totalPoints;
	  } 
  
}