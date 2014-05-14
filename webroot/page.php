<?php 
/**
 * This is a Alpha pagecontroller.
 *
 */
// Include the essential config-file which also creates the $alpha variable with its defaults.
include(__DIR__.'/config.php'); 
//include(__DIR__.'/filter.php'); 

//connect to database
$db = new CDatabase($alpha['database']);
//instantiate page
$page = new CPage($db);
//instantiate filter
$filter= new CTextFilter(); 




// Get parameters
$url     = isset($_GET['url']) ? $_GET['url'] : null;

//set slug


//set pagecontent
$page-> setUrl($url);

//get content
$c = $page-> getContent();

//Sanitize  content before using it.
$title  = htmlentities($c->title, null, 'UTF-8');

//filter text and show data
$data   = $filter->doFilter((htmlentities($c->DATA, null, 'UTF-8')), ($c->FILTER));

// Prepare content and store it all in variables in the Alpha container.
$alpha['title'] = $title;
$alpha['debug'] = $db-> Dump();

// $editLink = $acronym ? "<a href='edit.php?id={$c->id}'>Update page</a>" : null;

$alpha['above'] = <<<EOD

<a href="http://www.student.bth.se/~gani13/oophp/Kmom01/webroot/me.php">Kmom1</a> 

EOD;


$alpha['header'] = <<<EOD
<img class='sitelogo' src='img.php?src=reel_logo.jpg&amp;width=120&amp;height=120' alt='Picture' />
<span class='sitetitle'>REALREEL</span>
<span class='siteslogan'>Your movie partner</span>
EOD;

$alpha['main'] = <<<EOD
<article>
<header>
<h1>{$title}</h1>
</header>
{$data}
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