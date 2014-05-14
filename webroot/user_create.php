<?php 
/**
 * This is a Alpha pagecontroller.
 *
 */
// Include the essential config-file which also creates the $alpha variable with its defaults.
include(__DIR__.'/config.php'); 

$db = new CDatabase($alpha['database']);
$cuser = new CUser($db);



//get parameters
$acronym = isset($_POST['user']) ? $_POST['user'] : null;
$name = isset($_POST['name']) ? $_POST['name'] : null;
$password1 = isset($_POST['password1']) ? $_POST['password1'] : null;
$password2 = isset($_POST['password2']) ? $_POST['password2'] : null;


$submittedValue = "";
$value0 = " ";
$value1 = "mr";
$value2 = "ms";
$value3 = "mrs";
if (isset($_POST["salute"])) {
	$submittedValue = $_POST["salute"];
	
}


$html =null;
$output=null;



$ouput = null;
$encryptedPassword = null;
if($password1 && $password2){
	
	if($password1 == $password2){
		
		//$encryptedPassword = md5($password1);
		
		$output = $cuser->createUser($acronym, $name, $password1, $submittedValue);		
	}else {
		$output = "Passwords do not match try again!";
	}
}


 
// Do it and store it all in variables in the Alpha container.
$alpha['title'] = "Create user";

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



			<form name = 'salute' method = 'post'>
				Salute: <select project='salute' id='salute' name='salute'>
			        <option value = '$value0'($value0 == $submittedValue)?' SELECTED':''>$value0</option>
			        <option value = '$value1'($value0 == $submittedValue)?' SELECTED':''>$value1</option>
			        <option value = '$value2'($value0 == $submittedValue)?' SELECTED':''>$value2</option>
			        <option value = '$value3'($value0 == $submittedValue)?' SELECTED':''>$value3</option>
		        </select>
		
				<p>User name: <input type='text' name='user' placeholder = 'acronym'></p>
				<p>First name: <input type='text' name='name' placeholder = 'name'></p>
				<p>Password: <input type='password' name='password1' placeholder = 'password'></p>
				<p>Password: <input type='password' name='password2' placeholder = 're-enter password'></p>
				
				<input type='submit' value='Submit' class='button'/>
		 </form>

<h4>{$output}</h4>
		
		

<article class="justify border" style="width:80%">
	

</article>


EOD;
 
$alpha['footer1'] = <<<EOD
<footer><span class='sitefooter'>Copyright (c) Gabriel Nieva (bluetxxth@gmail.com) | <a href='https://github.com/bluetxxth'>Alpha på GitHub</a> | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;
$alpha['footer2'] = <<<EOD
<footer></footer>
EOD;


// Finally, leave it all to the rendering phase of Alpha.
include(ALPHA_THEME_PATH);