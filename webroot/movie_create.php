<?php 
/**
 * This is a Alpha pagecontroller.
 *
 */
// Include the essential config-file which also creates the $alpha variable with its defaults.
include(__DIR__.'/config.php'); 

$db = new CDatabase($alpha['database']);


// Get parameters 
$title  = isset($_POST['title']) ? strip_tags($_POST['title']) : null;
$create = isset($_POST['create'])  ? true : false;
$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;


// Check that incoming parameters are valid
// isset($acronym) or die('Check: You must login to edit.');

	isset($acronym) or header('Location: login.php');
	
// Check if form was submitted
if($create) {
	$sql = 'INSERT INTO aMovie (title) VALUES (?)';
	$db->ExecuteQuery($sql, array($title));
	$db->SaveDebug();
	header('Location: movie_edit.php?id=' . $db->LastInsertId());
	exit;
}
 
// Do it and store it all in variables in the Alpha container.
$alpha['title'] = "Create Movie";

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
  <legend>Create new Movie</legend>
  <p><label>Title:<br/><input type='text' name='title'/></label></p>
  <p><input type='submit' name='create' value='Create' id='button'/></p>
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