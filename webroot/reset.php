<?php 
/**
 * This is a Alpha pagecontroller.
 *
 */
// Include the essential config-file which also creates the $alpha variable with its defaults.
include(__DIR__.'/config.php'); 

// Connect to a MySQL database using PHP PDO
$db = new CDatabase($alpha['database']);
$content= new CContent($db);

$output = null;

if (isset ( $_POST ['restore'] ) || isset ( $_GET ['restore'] )) {
	// $cmd = "$mysql -h{$host} -u{$login} -p{$password} < $sql";
	// exec($cmd);
	// $output = "<p>Databasen är återställd via kommandot<br/><code>{$cmd}</code></p>";
	
	try {
		$output = $content->resetDatabase();
	} catch ( Exception $ex ) {
		$output = "reset did not work";
	}
}
 
// Do it and store it all in variables in the Alpha container.
$alpha['title'] = "Me";

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
<input type=submit name=restore value='Reset database'/>
<output>{$output}</output>
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