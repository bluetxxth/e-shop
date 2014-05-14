<?php 
/**
 * This is a Alpha pagecontroller.
 *
 */
// Include the essential config-file which also creates the $alpha variable with its defaults.
include(__DIR__.'/config.php'); 

// Connect to a MySQL database using PHP PDO
$db = new CDatabase($alpha['database']);

//Add the style sheet
$alpha['stylesheets'][] = 'css/user.css';

//instantiate user
$user = new CUser($db);


if(isset($_GET['id'])){


	$id = strip_tags($_GET['id']);

}

//check if id is a numeric value

is_numeric($id) or die('ID must be numeric!');

$val = $user->selectUserID($id);

if(!($val-> img_name == "" || $val->img_path == "")){
	
	$avatar = "<img src='img.php?src={$val->img_name}&amp;width=350&amp;height=350' alt='Picture with img' />";
}else
{
	if ($val->salute == strtolower ( "mr" )) {
		$avatar = "<img src='img.php?src=male_user_icon.jpg&amp;width=350&amp;height=350' alt='Picture with img' />";
	} else {
		$avatar = "<img src='img.php?src=female_user_icon.jpg&amp;width=350&amp;height=350' alt='Picture with img' />";
	}
}
	
	

 
// Do it and store it all in variables in the Alpha container.
$alpha['title'] = "User profile";
//Add the style sheet
$alpha['stylesheets'][] = 'css/style.css';

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


	<div id = 'userDataWrapper'>
		<div id ='userItem'>{$avatar}</div> 
	
		<table border="1" width="350">
		 <caption>User Data</caption>
		<tr>
		<td>Acronym</td>
		<td>{$val->acronym}</td>
		</tr>
		<tr>
		<td>Name</td>
		<td>{$val->name}</td>
		</tr>	
		<tr>
		<td>Credit</td>
		<td>{$val->credit}</td>		
		</tr>
		</table> 	
					
	</div>
			
<div id= 'userEntry'>
 


</div>

EOD;
 
$alpha['footer1'] = <<<EOD
<footer><span class='sitefooter'>Copyright (c) Gabriel Nieva (bluetxxth@gmail.com) | <a href='https://github.com/bluetxxth'>Alpha på GitHub</a> | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;
$alpha['footer2'] = <<<EOD
<footer></footer>
EOD;


// Finally, leave it all to the rendering phase of Alpha.
include(ALPHA_THEME_PATH);