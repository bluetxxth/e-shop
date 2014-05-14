<?php 
/**
 * This is a Alpha pagecontroller.
 *
 */
// Include the essential config-file which also creates the $alpha variable with its defaults.
include(__DIR__.'/config.php'); 

$db = new CDatabase($alpha['database']);
$user = new CUser($db);
$isLogin = true;
$html = null;

$logout = isset ( $_POST ['btnLogout'] ) ? $_POST ['btnLogout'] : null;
$login = isset ( $_POST ['btnLogin'] ) ? $_POST ['btnLogin'] : null;

if(!$user->isAuthenticated()){
	if(isset($_POST['acronym'] , $_POST['password'])){
		//$isLogin = $user->myLogin($_POST['acronym'], $_POST['password']);
		
		$isLogin = $user->checkUserAndPassword($_POST['acronym'], $_POST['password']);
	}
}

if(!$isLogin){
	
	$output = "Login failed!";

}else {

	$output = $user->myOutput();
}

if($logout){
	
	header('Location: logout.php');
}

if($login){
	header('Location: '.$_SERVER['PHP_SELF']);
	die;
}

$html .=   '<form method=post>
	  <fieldset>
		  <legend>Login</legend>
		  <p><em>You can login with doe:doe or admin:admin.</em></p>
		  <p><label>User:<br/><input type="text" name="acronym" value=""/></label></p>
		  <p><label>Password:<br/><input type="text" name="password" value=""/></label></p>
		  <p><input type="submit" name="btnLogin" value="Login" class="button"/></p>
		  <p><input type="submit" name="btnLogout" value="Logout" class="button"/></p>
		<br/>
		  <p><b>'.$output.'</b></p>
	  </fieldset>
   </form> ';
 
// Do it and store it all in variables in the Alpha container.
$alpha['title'] = "Login";

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