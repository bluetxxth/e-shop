<?php 
/**
 * This is a Alpha pagecontroller.
 *
 */
// Include the essential config-file which also creates the $alpha variable with its defaults.
include(__DIR__.'/config.php'); 


// Connect to a MySQL database using PHP PDO
$db = new CDatabase($alpha['database']);


// Get parameters
$id     = isset($_POST['id'])    ? strip_tags($_POST['id']) : (isset($_GET['id']) ? strip_tags($_GET['id']) : null);
$delete = isset($_POST['delete'])  ? true : false;
$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;

// Check that incoming parameters are valid
isset($acronym) or die('Check: You must login to delete.');


// Check if form was submitted
$output = null;
if($delete) {
	$sql = 'DELETE FROM aCart WHERE id = ?';
	$db->ExecuteQuery($sql, array($id));
	$db->SaveDebug("Deleted " . $db->RowCount() . " rows from the database.");
	header('Location: movies.php');
}


// Select information on the movie
$sql = 'SELECT * FROM aCart WHERE id = ?';
$params = array($id);
$res = $db->ExecuteSelectQueryAndFetchAll($sql, $params);

if(isset($res[0])) {
	$cartItem = $res[0];
}
else {
	die('Failed: There is no item with that id');
}


 
// Do it and store it all in variables in the Alpha container.
$alpha['title'] = "Delete shopping car item";

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
  <legend>Delete Movie: {$cartItem->title}</legend>
  <input type='hidden' name='id' value='{$id}'/>
  <p><input type='submit' name='delete' value='Delete Movie'/></p>
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