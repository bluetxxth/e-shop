<?php 
/**
 * This is a Alpha pagecontroller.
 *
 */
// Include the essential config-file which also creates the $alpha variable with its defaults.
include(__DIR__.'/config.php'); 
 
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
<h1>About me</h1>

<article class="justify border" style="width:80%">
	
	<figure class="left top">
		<img src="img/me.jpg"  height="150">
		<figcaption>
			<p>Recent picture of me</p>
		</figcaption>
	</figure>


<p>My name is Gabriel I am originally from Spain I lived the US for greate part of my life and now I live in Sweden.</p>
  
<p>I have a degree in public accountancy by the City University of New York, Bernard Baruch College.
I currently live in Sweden with my wife and I study computer science.</p>
<p>Back in New York I worked as an accountant in a couple of cpa firms. When I met my wife I came to Europe and started a computer hardware importing company in Madrid Spain. We imported container loads from china and
other material, mainly semiconductors to make memory from the US. The exposure to this type of activity made me interested in the Internet and more particularly in Web programming. </p>
<p>It was essential to manage, market and deal with such large quantities of references. Due to the rapidly changing prices for these products and their short life cycle, this undertaking required managing a large inventory in an orderly, efficient and effective way. In addition, working with different departments, logistics, accounting, legal, marketing amongst other,  and being involved in large logistic
operations, brought about the need to structure an intranet and a public web, in order to deal with all these matters in a more or less automatic way.</p>
<p>In many ways all this was a big challenge, and it is something which fascinated me and has impacted my perception of the business world out there. Despite that I no longer work in such field I am aware that the same needs are applicable to many other companies in the market regardless of their activity.
This is the reason why I study computer science and in particular, now, I take this course. I hope that in the foreseeable future I can streamline the things I already know and the experience which I have gained together with the knowledge that I will hopefully acquire, in this course, into a successful enterprise. </p>

<p>So long...</p>

<p>Gabriel</p>

 
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