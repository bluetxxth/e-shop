<?php 
/**
 * This is an Alpha pagecontroller.
 *
 */
// Include the essential config-file which also creates the $alpha variable with its defaults.
include(__DIR__.'/config.php'); 


// Define what to include to make the plugin to work
$alpha['stylesheets'][]        = 'css/slideshow.css';
$alpha['javascript_include'][] = 'js/slideshow.js';

$alpha['header'] = <<<EOD
<img class='sitelogo' src='img.php?src=reel_logo.jpg&amp;width=120&amp;height=120' alt='Picture' />
<span class='sitetitle'>REALREEL</span>
<span class='siteslogan'>Your movie partner</span>
EOD;

$alpha['above'] = <<<EOD

<a href="http://www.student.bth.se/~gani13/oophp/Kmom01/webroot/me.php">Kmom1</a> 

EOD;

// Do it and store it all in variables in the Alpha container.
$alpha['title'] = "Slideshow of myself";

$alpha['main'] = <<<EOD
<div id="slideshow" class='slideshow' data-host="" data-path="img/me/" data-images='["me1.jpg", "me2.jpg", "me3.jpg", "me4.jpg", 
																					"me5.jpg", "me6.jpg", "me7.jpg", "me8.jpg", 
																					"me9.jpg", "me10.jpg", "me11.jpg", "me12.jpg",
																					"me13.jpg","me14.jpg", "me15.jpg"], "me16.jpg"
																					"me17.jpg", "me18.jpg", "me19.jpg" ,"me20.jpg", 
																					"me21.jpg","me22.jpg", "me23.jpg", "me24.jpg", 
																					"me25.jpg", "me26.jpg", "me27.jpg", "me28.jpg", 
																					"me29.jpg", "me30.jpg", "me31.jpg", "me32.jpg", 
																					"me33.jpg"]'>
																																									
<img src='img/me/me1.jpg' width='950px' height='190px' alt='Me'/>

</div>

<h1>En slideshow med JavaScript</h1>
<p>Detta är en exempelsida som visar hur Alpha fungerar tillsammans med JavaScript.</p>
EOD;

$alpha['footer1'] = <<<EOD
<footer><span class='sitefooter'>Copyright (c) Gabriel Nieva (bluetxxth@gmail.com) | <a href='https://github.com/mosbth/Alpha-base'>Alpha på GitHub</a> | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;
$alpha['footer2'] = <<<EOD
<footer></footer>
EOD;

$alpha['footer'] = <<<EOD
<footer><span class='sitefooter'>Copyright (c) Gabriel Nieva (bluetxxth@gmail.com) | <a href='https://github.com/mosbth/Alpha-base'>Alpha på GitHub</a> | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;

// Finally, leave it all to the rendering phase of Alpha.
include(ALPHA_THEME_PATH);