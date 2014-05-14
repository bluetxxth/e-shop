<?php
/**
 * This is a Alpha pagecontroller.
 *
 */
// Include the essential config-file which also creates the $alpha variable with its defaults.
include (__DIR__ . '/config.php');

$db = new CDatabase ($alpha['database']);
$content = new CContent ( $db );

///get the id
$id = strip_tags($_GET['id']);



//user
$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;

isset($acronym) or header('Location: login.php');

// get parameters
$delete = isset ( $_POST ['delete'] ) ? $_POST ['delete'] : null;

//output string
$output="";


// check if delete is set
if ($delete) {
	
	//set title
	$title = isset($_POST['delete']);
	
	try {
		
		$output=$content->deleteFromDB($id);
		$title = isset($_POST['delete']);
		
	} catch ( Exception $ex ) {
		
		$output = "database error";
	}
	
} else if(!$delete) {
	$output = "deleting !!!";
}



if (!isset($_POST['delete']))
{
	$c=$content->selectFromDB($id);
	$title  = htmlentities($c->title, null, 'UTF-8');
}
else
{
	$output=$content->deleteFromDB($id);
	$title="";
	if ($output==null)
		$output="Det fungerade inte!";
}

// Do it and store it all in variables in the Alpha container.
$alpha ['title'] = "Delete";

$alpha ['above'] = <<<EOD

<a href="http://www.student.bth.se/~gani13/oophp/Kmom01/webroot/me.php">Kmom1</a> 

EOD;

$alpha ['header'] = <<<EOD
<img class='sitelogo' src='img.php?src=reel_logo.jpg&amp;width=120&amp;height=120' alt='Picture' />
<span class='sitetitle'>REALREEL</span>
<span class='siteslogan'>Your movie partner</span>
EOD;

$alpha ['main'] = <<<EOD
<article>
<header>
<h1>{$title}</h1>
</header>
<form method=post>
<p><input type='submit' name='delete' value='Delete'/></p>
</form>
<p1>{$output}</p1>

<footer>
<p><a href='blog_view.php'>Show all</a></p>
</footer
</article> 
		

EOD;

$alpha ['footer1'] = <<<EOD
<footer><span class='sitefooter'>Copyright (c) Gabriel Nieva (bluetxxth@gmail.com) | <a href='https://github.com/bluetxxth'>Alpha on GitHub</a> | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;
$alpha ['footer2'] = <<<EOD
<footer></footer>
EOD;

// Finally, leave it all to the rendering phase of Alpha.
include (ALPHA_THEME_PATH);