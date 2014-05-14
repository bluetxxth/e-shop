<?php 
/**
 * This is a Alpha pagecontroller.
 *
 */
// Include the essential config-file which also creates the $alpha variable with its defaults.
include(__DIR__.'/config.php'); 


//send unauthenticied user to the login page
isset($_SESSION['user']) or header('Location: login.php');




// Do it and store it all in variables in the Alpha container.
$alpha['title'] = "Administration";
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

		<div id = 'optionWrapper'>
		
			<div id = 'movieAdmin'>
				<a href='movies.php?p=movies'><img src='img.php?src=film_reel.jpg&amp;width=110&amp;height=100' alt='Picture'/> </a>
		
				<div id = 'title'>
					Movies
				</div>
			</div>
		
		
			<div id = 'blogAdmin'>
				<a href='blog_edit_multi.php'><img src='img.php?src=blog.jpg&amp;width=100&amp;height=100' alt='Picture' /> </a>
		
				<div id = 'title'>
					Blog
				</div>
			</div>
		

			<div id = 'userAdmin'>
				<a href='user_admin.php'><img src='img.php?src=admin.jpg&amp;width=100&amp;height=100' alt='Picture' /> </a>
		
				<div id = 'title'>
					User
				</div>		
			</div>
		
	
		
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