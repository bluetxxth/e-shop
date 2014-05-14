<?php 

/**
 * This is a Alpha pagecontroller.
 *
 */
// Include the essential config-file which also creates the $alpha variable with its defaults.
include(__DIR__.'/config.php'); 

$db = new CDatabase($alpha['database']);
$content = new CContent($db);


// Get parameters
$acronym = isset ( $_SESSION ['user'] ) ? $_SESSION ['user']->acronym : null;
$created = isset ( $_POST ['created'] ) ? strip_tags ( $_POST ['created'] ) : array ();

$create = isset($_POST['create']) ? $_POST['create'] : null;

isset($acronym) or header('Location: login.php');

$output = null;
//check if create is set
if($create){
	
	try{

	//add to database
   $output =  $content -> createBlogEntry();
	
	}catch(Exception $ex){
		
		$output = "database error";
	}

}else{
	$output = "post is unset";
}




 
// Do it and store it all in variables in the Alpha container.
$alpha['title'] = "Create content";
$alpha['debug'] = $db->Dump();

$alpha['above'] = <<<EOD

<a href="http://www.student.bth.se/~gani13/oophp/Kmom01/webroot/me.php">Kmom1</a> 

EOD;

$alpha['header'] = <<<EOD
<img class='sitelogo' src='img.php?src=reel_logo.jpg&amp;width=120&amp;height=120' alt='Picture' />
<span class='sitetitle'>REALREEL</span>
<span class='siteslogan'>Your movie partner</span>
EOD;

$html = null;

$html .= "<form method = 'post' action = 'create.php'><fieldset>
	  <legend>Create content</legend>
	  <p><label>Title:<br/><input type='text' name='title'/></label></p>
	  <p><label>Slug:<br/><input type='text' name='slug'/></label></p>
	  <p><label>Url:<br/><input type='text' name='url'/></label></p>
	  <p><label>Text:<br/><textarea name='data'></textarea></label></p>
	  <p><label>Type:<br/><input type='text' name='type'/></label></p>
	  <p><label>Filter:<br/><input type='text' name='filter'/></label></p>
	  <p><label>Publishing date:<br/><input type='text' name='published'/></label></p>
	  <p><label>Creation date:<br/><input type='text' name='created'/></label></p>	
	  <p><input type='submit' name='create' value='Create'/></p>
  	  </fieldset></form> ";


$alpha['main'] = <<<EOD
<h1>{$alpha['title']}</h1>

<form method=post>
  <fieldset>
  <legend>Create new content</legend>
  <p><label>Title:<br/><input type='text' name='title'/></label></p>
  <p><input type='submit' name='create' value='Create'/></p>
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