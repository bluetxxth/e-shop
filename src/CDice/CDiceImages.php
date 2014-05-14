<?php

class CDiceImages{

  private $one = './img/dice/one.JPG';
  private $two = './img/dice/two.JPG';
  private $three = './img/dice/three.JPG';
  private $four = './img/dice/four.JPG';
  private $five = './img/dice/five.JPG';
  private $six = './img/dice/six.JPG';
  
  
  
    /*
   *@author: Gabriel Nieva
   *Get image path for the dice
   *@param - $value the value of the dice
   *@return -$the path to the picture to be applied according to value
   */
  public function ApplyImages($value){
   
	switch($value){
	
	case 1:  
		$this->imgPath = $this->one;
	break;
	
	case 2:
		$this->imgPath = $this->two;
	break;

	case 3:
		$this->imgPath = $this->three;
	break;
	
	case 4:
		$this->imgPath = $this->four;
	break;
	
	case 5:
		$this->imgPath = $this->five;
	break;
	
	case 6:
		$this->imgPath = $this->six;
	break;
	}
    return $this->imgPath;
  }

}
