<?php 
/**
 * This is a Alpha pagecontroller.
 *
 */
// Include the essential config-file which also creates the $alpha variable with its defaults.
include(__DIR__.'/config.php'); 

$alpha['stylesheets'][] = 'css/product.css'; 


$db = new CDatabase($alpha['database']);
$film = new CFilms($db); 

//cart variables
$basket = new CMyShoppingCart($db);


//get some parameters
$small   = isset($_GET['small']) ? $_GET['small'] : null;
$medium  = isset($_GET['medium']) ? $_GET['medium'] : null;
$large  = isset($_GET['large']) ? $_GET['large'] : null;
$buy = isset($_GET['buy']) ? $_GET['buy'] : null;
$cart= isset($_GET['cart']) ? $_GET['cart'] : null;
$continue= isset($_GET['continue']) ? $_GET['continue'] : null;


$output = null;

if(isset($_GET['id'])){
	
	$_SESSION['id'] = $id = strip_tags($_GET['id']);

}

$movieTobuy = $_SESSION['id'];


//Different sizes for the pictures
if($small){
	header('Location: ../webroot/img.php?src=pulp-fiction.jpg&width=100&height=100');
}

if($medium){
	header('Location: ../webroot/img.php?src=pulp-fiction.jpg&width=200&height=200');
}

if($large){
	header('Location: ../webroot/img.php?src=pulp-fiction.jpg&width=350&height=350');
}

if($cart){
	
	header('Location: shopping_cart.php?id='.$movieTobuy);
}

if($continue){
	
	header('Location: movies.php');
}

if($buy){
	
	
	//Do SELECT from a table
//	if($movieTobuy) {
		
		$sql = "SELECT * FROM aMovie WHERE id = ?";
		
		$params = array(
				$movieTobuy,
		);
	//}
	
	$res = $db->ExecuteSelectQueryAndFetchAll($sql, $params);
	
	foreach($res AS $key => $val) {
	
		//sanitize before assignment
		$myId= strip_tags($val->id);
		$myPicture = strip_tags($val->img_name);
		$myTitle = strip_tags($val->title);
		$myYear = strip_tags($val->YEAR);
		$myGenre = strip_tags($val->genre);
		$myPrice = strip_tags($val->price);
		
	}
	
	//add to cart
	$output = $basket->addItem($myId,$myTitle, $myYear,  $myPicture, $myGenre, $myPrice );
	
// 	header('Location: '.$_SERVER['PHP_SELF']);
// 	die;
	
header('Location: shopping_cart.php');
}

//check if id is a numeric value
is_numeric($movieTobuy) or die('ID must be numeric!');


$val = $film->selectMovieID($movieTobuy);




// Do it and store it all in variables in the Alpha container.
$alpha['title'] = "Movie";

$alpha['above'] = <<<EOD

<a href="http://www.student.bth.se/~gani13/oophp/Kmom01/webroot/me.php">Kmom1</a> 

EOD;

$alpha['header'] = <<<EOD
<img class='sitelogo' src='img.php?src=reel_logo.jpg&amp;width=120&amp;height=120' alt='Picture' />
<span class='sitetitle'>REALREEL</span>
<span class='siteslogan'>Your movie partner</span>
EOD;
 
$alpha['main'] = <<<EOD
<h1>{$alpha['title']}</h1>
<hr/>


<div><img src='img.php?src={$val->img_name}&amp;width=350&amp;height=350' alt='Picture with img' id='movieimg'/></div> 


<hr/>
	<form method="get">
			<input type ="submit" name='small' value ="Small" class="button" /> 
			<input type ="submit" name='medium'  value ="Medium" class="button" /> 
			<input type ="submit" name='large' value ="Large" class="button" /> 
     </form>


<div id ="productinfo">

	
	<h4>{$val->title} {$val->YEAR}</h4> 
   
	<hr class = "top"/>
	
	<h4>{$val->genre}</h4>
	<div id = 'synopsis'>{$val->synopsis}</div>
	<hr/>
	<h2>{$val->price}Kr.</h2>
			
</div>	

		<form method="get">
			<input type ="submit" name="buy" value ="Buy" class="button" /> 
			<input type ="submit" name="cart" value ="Cart" class="button" />
			<input type ="submit" name="continue" value ="Continue" class="button" />  
		</form>
		
		<input type="button" value="Trailer" class ="button" onclick="window.open('$val->video')"> 
		<input type="button" value="IMDB" class ="button" onclick="window.open('$val->reviewlink')"> 
				
			<br/><br/><h3>{$output}</h3>
			
EOD;
 
$alpha['footer1'] = <<<EOD
<footer><span class='sitefooter'>Copyright (c) Gabriel Nieva (bluetxxth@gmail.com) | <a href='https://github.com/bluetxxth'>Alpha på GitHub</a> | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;
$alpha['footer2'] = <<<EOD
<footer></footer>
EOD;


// Finally, leave it all to the rendering phase of Alpha.
include(ALPHA_THEME_PATH);