<?php 


/**
 * This is a Alpha pagecontroller.
 *
 */
// Include the essential config-file which also creates the $alpha variable with its defaults.
include(__DIR__.'/config.php'); 
$alpha['stylesheets'][] = 'css/style.css';
$alpha['stylesheets'][] = 'css/figure.css';
$alpha['stylesheets'][] = 'css/gallery.css';
$alpha['stylesheets'][] = 'css/breadcrumb.css';

//instantiate gallery
$gallery = new CGallery();
//instantiate image
$img = new CImage();

$breadcrumb = null;
$myGallery = null;



// Define the basedir for the gallery
define('GALLERY_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'img/gallery');
define('GALLERY_BASEURL', '');

// Get incoming parameters
$path = isset($_GET['path']) ? $_GET['path'] : null;
$pathToGallery = realpath(GALLERY_PATH . DIRECTORY_SEPARATOR . $path);

// Validate incoming arguments
is_dir ( GALLERY_PATH ) or errorMessage ( 'The gallery dir is not a valid directory.' );
substr_compare ( GALLERY_PATH, $pathToGallery, 0, strlen ( GALLERY_PATH ) ) == 0 or errorMessage ( 'Security constraint: Source gallery is not directly below the directory GALLERY_PATH.' );

//create the breadcrubm
$breadcrumb = $gallery-> createBreadcrumb($pathToGallery);


// Read and present images in the current directory
if(is_dir($pathToGallery)) {
	$myGallery = $gallery -> readAllItemsInDir($pathToGallery);
}

else if(is_file($pathToGallery)) {
	$myGallery = $gallery -> readItem($pathToGallery);
}

 
// Do it and store it all in variables in the Alpha container.
$alpha['title'] = "gallery";

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


      {$breadcrumb}
      {$myGallery}	
	



EOD;
 
$alpha['footer1'] = <<<EOD
<footer><span class='sitefooter'>Copyright (c) Gabriel Nieva (bluetxxth@gmail.com) | <a href='https://github.com/bluetxxth'>Alpha på GitHub</a> | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;
$alpha['footer2'] = <<<EOD
<footer></footer>
EOD;


// Finally, leave it all to the rendering phase of Alpha.
include(ALPHA_THEME_PATH);