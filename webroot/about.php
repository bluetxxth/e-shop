<?php 
/**
 * This is a Alpha pagecontroller.
 *
 */
// Include the essential config-file which also creates the $alpha variable with its defaults.
include(__DIR__.'/config.php'); 
 
// Do it and store it all in variables in the Alpha container.
$alpha['title'] = "About";

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

	
		
<article class="justify border" style="width:80%">
	
	<figure class="right top">
		<img src='img.php?src=camera_icon.png&amp;height=350' alt='Picture with img' id='movieimg'/>
		<figcaption>
			<p>ReelReel</p>
		</figcaption>
	</figure>

<p>Real Reel  is a fictitious company founded in 2014. We are a group of movie enthusiasts and 
professionals of the movie industry that provide  Avant-guard entertainment and make the latest 
movies available at the click of your mouse at very reasonable prices. We provide you with forums 
and a possibility to post your ideas and critics on the movies.</p>

<p>Our ability to provide you with the best possible service resides in the ability to utilize the 
latest technology, combined with a strong desire to make a long term commitment and a significant 
bottom line contribution to  our clients and partners.</p>

<p>At Real Reel we endeavor to provide you the best possible service. We focus on attention to 
detail dedication to excellence and hard work in order to comply with the most demanding movie 
enthusiasts. </p> 
		
<p>We sincerely welcome you aboard and look forwards to live up to your expectations</p>

<p>RealReel</p>
		

		
		
		
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