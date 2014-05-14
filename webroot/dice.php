<?php
/**
 * This is an Alpha pagecontroller.
 *
 */
// Include the essential config-file which also creates the $alpha variable with its defaults.
include(__DIR__ . '/config.php');


$alpha['header'] = <<<EOD
<img class='sitelogo' src='img.php?src=reel_logo.jpg&amp;width=120&amp;height=120' alt='Picture' />
<span class='sitetitle'>REALREEL</span>
<span class='siteslogan'>Your movie partner</span>
EOD;

$alpha['above'] = <<<EOD

<a href="http://www.student.bth.se/~gani13/oophp/Kmom01/webroot/me.php">Kmom1</a> 


EOD;

//Add the style sheet
$alpha['stylesheets'][] = 'css/dice.css';

// Do it and store it all in variables in the Alpha container.
$alpha['title'] = "Throw dice";

// Create an object of the CDice class
$dice      = new CDice();
$diceImage = new CDiceImages();

$html = null;

if (isset($_SESSION['pointCounter'])) {
    
    $pointCounter = $_SESSION['pointCounter'];
    
} else {
    $pointCounter = new CDPointCounter();
    
}

//Throw button pressed
if (isset($_POST['throw'])):
// Roll the dice
    $dice->Roll(1);
    $roll        = $dice->GetResults();
    $resultArray = $dice->GetResults();
    
    
    //if it is just one roll
    if ($roll[0] == 1) {
        
        //traverse the array and append the html output
        foreach ($resultArray as $value) {
            $img     = $diceImage->ApplyImages($value);
            $myImage = '<img src ="' . $img . '">';
            
            //reset if get 1
            if ($value == 1) {
                //$html .= "<p>you reached " . $dice->GetTotal() . " you win</p>";
                $html .= "<p><div id ='gotOne'> You got a one! ... sorry resetting to 0 </div></p>";
                $pointCounter->Reset();
                
            }
        }
    }
    //if more than one roll
    else {
        
        //add points
        $pointCounter->AddPoints($roll[0]);
        
        //traverse result array and get index then set image according to index	
        foreach ($resultArray as $value) {
            
            $img     = $diceImage->ApplyImages($value);
            $myImage = '<img src ="' . $img . '">';
            
        }
        
        //Append dice image to html output
        $html .= '<img src ="' . $img . '">';
        //output accumulated points
        $html .= "<p><div id ='totalPointsText'> Points : </div>" . "<div id = 'totalPointsNumber'>" . $pointCounter->GetPoints() . "</div> </p>";
        
        
        //set session
        $_SESSION['pointCounter'] = $pointCounter;
    }
endif;

//save button pressed
if (isset($_POST['save'])):
    $resultArray = $dice->GetResults();
//increase hands
    $pointCounter->AddHands();
    
    //append html string with hands
    $html .= "<p> <div id ='totalPointsText'>Hand No.</div>" . "<div id = 'totalPointsNumber'>" . $pointCounter->GetHands() . "</div> </p>";

    //traverse array and add points
    foreach ($resultArray as $value) {
        
        $pointCounter->AddPoints($resultArray);
        $pointCounter->Reset();
        
        //fill the hand array
        foreach ($myHandArray as $hand) {
            $handArray[$pointCounter->AddHands()] = $pointCounter->AddPoints($dice->GetResults());
            //	$html .= "<p> hand array is: ". array_sum ($handArray)."</p>";		
        }
    }
    
    
    //$html .= "<p> hand array is: ". $pointCounter -> GetHandArraySum() . "</p>";
    $_SESSION['pointCounter'] = $pointCounter;
    
    //$pointCounter -> AddToHandArray( $pointCounter -> GetHands() , $pointCounter -> GetPoints());  
    
    // echo "addHands: " . $pointCounter -> GetHands() . "\n";
    // echo "points: " .  $pointCounter -> GetPoints(). "\n";
    // echo "hand array is: " . array_sum($pointCounter -> GetHandArray());
    
    $html .= "<p> <div id = 'totalPointsText'> You have saved: </div>" . "<div id = 'totalPointsNumber'>" . $pointCounter->GetPoints() . "</div> </p>";
    
    $pointCounter->AddTotalPoints($pointCounter->GetPoints());
    
    $pointCounter->Reset();
    
    $html .= "<p> <div  id = 'totalPointsText'>Total points: </div> <div id = 'totalPointsNumber'>" . " " . $pointCounter->GetTotalPoints()."</div></p>";

	    //Establish when the game is won
    if ($pointCounter->GetTotalPoints() >= 100) {
        $html .= "<p><div id ='youWin'> You have won!! </div></p>";
        $pointCounter = new CDPointCounter();
        $dice         = new CDice();
    }
	
	endif;

//reset button pressed
if (isset($_POST['reset'])):
    
    $pointCounter->Reset();
    $html .= "<p>New game started</p>";
    $pointCounter = new CDPointCounter();
    $dice         = new CDice();
    $_SESSION['pointCounter'] = $pointCounter;
endif;


//$html .= "<p>Total points " . $dice->GetTotal() . " on the round.</p>";

$html .= '<p><form method="post" action = "dice.php" >
    <input type="submit" name="throw" value="Throw">
    <input type="submit" name="save" value="Save">
	<input type="submit" name="reset" value="Reset">
    </form></p>';
	

$alpha['main'] = <<<EOD
<h1>Black One Hundredth</h1>
<p>A dice game which consists on reaching number 100 if you throw and you reach it you win!</p>
<div id ='gameWrapper'>{$html}</div>
EOD;

$alpha['footer1'] = <<<EOD
<footer><span class='sitefooter'>Copyright (c) Gabriel Nieva (bluetxxth@gmail.com) | <a href='https://github.com/mosbth/Alpha-base'>Alpha på GitHub</a> | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;
$alpha['footer2'] = <<<EOD
<footer></footer>
EOD;

$alpha['footer'] = <<<EOD
<footer><span class='sitefooter'>Copyright (c) Gabriel Nieva (bluetxxth@gmail.com) | <a href='https://github.com/mosbth/Alpha-base'>Alpha på GitHub</a> | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;

// Finally, leave it all to the rendering phase of Alpha.
include(ALPHA_THEME_PATH);