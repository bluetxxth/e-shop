<?php 
/**
 * This is a Alpha pagecontroller.
 *
 */
// Include the essential config-file which also creates the $alpha variable with its defaults.
include(__DIR__.'/config.php'); 

$db = new CDatabase($alpha['database']);
$user = new CUser($db);

$html = null;

   if(isset($_POST['logout'])):  
		$user->logoutUser();
   
   header('Location: '.$_SERVER['PHP_SELF']);
   die;
   
   endif;
   
   $output=$user->myOutput(); 

$html.=  '<form method=post>
			  <fieldset>
			  <legend>Logout</legend>
			  <p><input type="submit" name="logout" value="Logout" class="button"/></p>
			<br/><br/>
			  <output><b>'.$output.'</b></output>
			  </fieldset>
		</form>';
		  
 
// Do it and store it all in variables in the Alpha container.
$alpha['title'] = "Logout";

$alpha['above'] = <<<EOD

<a href="http://www.student.bth.se/~gani13/oophp/Kmom01/webroot/me.php">Kmom1</a> 

EOD;

$alpha['header'] = <<<EOD
<img class='sitelogo' src='img.php?src=reel_logo.jpg&amp;width=120&amp;height=120' alt='Picture' />
<span class='sitetitle'>REALREEL</span>
<span class='siteslogan'>Your movie partner</span>
EOD;
 
$alpha['main'] = <<<EOD
{$html}
EOD;
 
$alpha['footer1'] = <<<EOD
<footer><span class='sitefooter'>Copyright (c) Gabriel Nieva (bluetxxth@gmail.com) | <a href='https://github.com/bluetxxth'>Alpha på GitHub</a> | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;
$alpha['footer2'] = <<<EOD
<footer></footer>
EOD;


// Finally, leave it all to the rendering phase of Alpha.
include(ALPHA_THEME_PATH);