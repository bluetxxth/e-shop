<?php 
/**
 * This is a Alpha pagecontroller.
 *
 */
// Include the essential config-file which also creates the $alpha variable with its defaults.
include(__DIR__.'/config.php'); 

//Connect to a MySQL database using PHP PDO
$db = new CDatabase($alpha['database']);

//instantiate the film class
$films = new CFilms($db);



// Get parameters 
$id     = isset($_POST['id'])    ? strip_tags($_POST['id']) : (isset($_GET['id']) ? strip_tags($_GET['id']) : null);
$title  = isset($_POST['title']) ? strip_tags($_POST['title']) : null;
$year   = isset($_POST['year'])  ? strip_tags($_POST['year'])  : null;
$image  = isset($_POST['image']) ? strip_tags($_POST['image']) : null;
$genre  = isset($_POST['genre']) ? $_POST['genre'] : array();
$synopsis = isset($_POST['synopsis']) ? strip_tags($_POST['synopsis'])  : null;
$price   = isset($_POST['price'])  ? strip_tags($_POST['price'])  : null;
$img_name  = isset($_POST['img_name']) ? strip_tags($_POST['img_name']) : null;
$save   = isset($_POST['save'])  ? true : false;
$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;
$showall = isset($_POST['showall']) ? strip_tags($_POST['showall']) : null;


// Check that incoming parameters are valid
isset($acronym) or die('Check: You must login to edit.');
is_numeric($id) or die('Check: Id must be numeric.');
//is_array($genre) or die('Check: Genre must be array.');


// Check if form was submitted
$output = null;

$output = null;
if($save){
	
	$output=$films->editMovie();
	 
}

if($showall){
	header('Location: movies.php');
}


// Select information on the movie
$sql = 'SELECT * FROM aMovie WHERE id = ?';
$params = array($id);
$res = $db->ExecuteSelectQueryAndFetchAll($sql, $params);

if(isset($res[0])) {
	$movie = $res[0];
}
else {
	die('Failed: There is no movie with that id');
}

// Do it and store it all in variables in the Alpha container.
$alpha['title'] = "Edit movie";

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

<form method=post>
  <fieldset>
  <legend>Update movie info</legend>
  <input type='hidden' name='id' value='{$id}'/>
  <p><label>Price:<br/><input type='text' name='price' value='{$movie->price}'/></label></p>
  <p><label>Title:<br/><input type='text' name='title' value='{$movie->title}'/></label></p>
  <p><label>Year:<br/><input type='text' name='year' value='{$movie->YEAR}'/></label></p>
  <p><label>Genre:<br/><input type='text' name='genre' value='{$movie->genre}'/></label></p>
  <p><label>Picture path:<br/><input type='text' name='image' value='{$movie->image}'/></label></p>
  <p><label>Image name:<br/><input type='text' name='img_name' value='{$movie->img_name}'/></label></p>
  <p><label>Review Link:<br/><input type='text' name='img_name' value='{$movie->reviewlink}'/></label></p>
  <p><label>Video:<br/><input type='text' name='img_name' value='{$movie->video}'/></label></p>
  <p><label>Synopsys:<br/><textarea name='synopsis'>{$movie ->synopsis}</textarea></label></p> 
  <p><input type='submit' name='save' value='Save' class ='button'/> <input type='reset' value='Reset' class ='button'/></p>
  <p><input type='submit' name='showall' value='Show all' class ='button'/> </p>
  <output>{$output}</output>
  </fieldset>
</form>

EOD;
 
$alpha['footer1'] = <<<EOD
<footer><span class='sitefooter'>Copyright (c) Gabriel Nieva (bluetxxth@gmail.com) | <a href='https://github.com/bluetxxth'>Alpha på GitHub</a> | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;
$alpha['footer2'] = <<<EOD
<footer></footer>
EOD;


// Finally, leave it all to the rendering phase of Alpha.
include(ALPHA_THEME_PATH);