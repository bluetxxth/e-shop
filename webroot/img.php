<?php 

/**
 * This is a PHP skript to process images using PHP GD.
 *
 */


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


//
// Ensure error reporting is on
//
error_reporting(-1);              // Report all type of errors
ini_set('display_errors', 1);     // Display all errors 
ini_set('output_buffering', 0);   // Do not buffer outputs, write directly


//
// Define some constant values, append slash
// Use DIRECTORY_SEPARATOR to make it work on both windows and unix.
//
define('IMG_PATH', __DIR__ . DIRECTORY_SEPARATOR . '/img/movie' . DIRECTORY_SEPARATOR );
define('CACHE_PATH', __DIR__ . '/cache/');
$maxWidth = $maxHeight = 2000;

$gallery = new CGallery();
$img = new CImage();



//
// Get the incoming arguments
//
$src        = isset($_GET['src'])     ? $_GET['src']      : null;
$verbose    = isset($_GET['verbose']) ? true              : null;
$saveAs     = isset($_GET['save-as']) ? $_GET['save-as']  : null;
$quality    = isset($_GET['quality']) ? $_GET['quality']  : 60;
$ignoreCache = isset($_GET['no-cache']) ? true           : null;
$newWidth   = isset($_GET['width'])   ? $_GET['width']    : null;
$newHeight  = isset($_GET['height'])  ? $_GET['height']   : null;
$cropToFit  = isset($_GET['crop-to-fit']) ? true : null;
$sharpen    = isset($_GET['sharpen']) ? true : null;

$pathToImage = realpath(IMG_PATH . $src);


//
// Validate incoming arguments
//
is_dir(IMG_PATH) or $img->errorMessage('The image dir is not a valid directory.');
is_writable(CACHE_PATH) or $img->errorMessage('The cache dir is not a writable directory.');
isset($src) or $img->errorMessage('Must set src-attribute.');
preg_match('#^[a-z0-9A-Z-_\.\/]+$#', $src) or $img->errorMessage('Filename contains invalid characters.');
//security constraint
//substr_compare(IMG_PATH, $pathToImage, 0, strlen(IMG_PATH)) == 0 or errorMessage('Security constraint: Source image is not directly below the directory IMG_PATH.');

is_null($saveAs) or in_array($saveAs, array('png', 'jpg', 'jpeg')) or $img->errorMessage('Not a valid extension to save image as');
is_null($quality) or (is_numeric($quality) and $quality > 0 and $quality <= 100) or $img->errorMessage('Quality out of range');
is_null($newWidth) or (is_numeric($newWidth) and $newWidth > 0 and $newWidth <= $maxWidth) or $img->errorMessage('Width out of range');
is_null($newHeight) or (is_numeric($newHeight) and $newHeight > 0 and $newHeight <= $maxHeight) or $img->errorMessage('Height out of range');
is_null($cropToFit) or ($cropToFit and $newWidth and $newHeight) or $img->errorMessage('Crop to fit needs both width and height to work');



//
// Start displaying log if verbose mode & create url to current image
//
if($verbose) {
  $query = array();
  parse_str($_SERVER['QUERY_STRING'], $query);
  unset($query['verbose']);
  $url = '?' . http_build_query($query);


  echo <<<EOD
<html lang='en'>
<meta charset='UTF-8'/>
<title>img.php verbose mode</title>
<h1>Verbose mode</h1>
<p><a href=$url><code>$url</code></a><br>
<img src='{$url}' /></p>
EOD;
}



//
// Get information on the image
//
$imgInfo = list($width, $height, $type, $attr) = getimagesize($pathToImage);
!empty($imgInfo) or $img->errorMessage("The file doesn't seem to be an image.");
$mime = $imgInfo['mime'];

if($verbose) {
  $filesize = filesize($pathToImage);
  $img->verbose("Image file: {$pathToImage}");
  $img->verbose("Image information: " . print_r($imgInfo, true));
  $img->verbose("Image width x height (type): {$width} x {$height} ({$type}).");
  $img->verbose("Image file size: {$filesize} bytes.");
  $img-> verbose("Image mime type: {$mime}.");
}



//
// Calculate new width and height for the image
//
$aspectRatio = $width / $height;

if($cropToFit && $newWidth && $newHeight) {
  $targetRatio = $newWidth / $newHeight;
  $cropWidth   = $targetRatio > $aspectRatio ? $width : round($height * $targetRatio);
  $cropHeight  = $targetRatio > $aspectRatio ? round($width  / $targetRatio) : $height;
  if($verbose) { $img->verbose("Crop to fit into box of {$newWidth}x{$newHeight}. Cropping dimensions: {$cropWidth}x{$cropHeight}."); }
}
else if($newWidth && !$newHeight) {
  $newHeight = round($newWidth / $aspectRatio);
  if($verbose) { $img->verbose("New width is known {$newWidth}, height is calculated to {$newHeight}."); }
}
else if(!$newWidth && $newHeight) {
  $newWidth = round($newHeight * $aspectRatio);
  if($verbose) { $img->verbose("New height is known {$newHeight}, width is calculated to {$newWidth}."); }
}
else if($newWidth && $newHeight) {
  $ratioWidth  = $width  / $newWidth;
  $ratioHeight = $height / $newHeight;
  $ratio = ($ratioWidth > $ratioHeight) ? $ratioWidth : $ratioHeight;
  $newWidth  = round($width  / $ratio);
  $newHeight = round($height / $ratio);
  if($verbose) { $img->verbose("New width & height is requested, keeping aspect ratio results in {$newWidth}x{$newHeight}."); }
}
else {
  $newWidth = $width;
  $newHeight = $height;
  if($verbose) { $img->verbose("Keeping original width & heigth."); }
}


//
// Creating a filename for the cache
//
$parts          = pathinfo($pathToImage);
$fileExtension  = $parts['extension'];
$dirName        = preg_replace('/\//', '-', dirname($src));
$saveAs         = is_null($saveAs) ? $fileExtension : $saveAs;
$quality_       = is_null($quality) ? null : "_q{$quality}";
$cropToFit_     = is_null($cropToFit) ? null : "_cf";
$sharpen_       = is_null($sharpen) ? null : "_s";


$cacheFileName = CACHE_PATH . "-{$dirName}-{$parts['filename']}_{$newWidth}_{$newHeight}{$quality_}{$cropToFit_}{$sharpen_}.{$saveAs}";
$cacheFileName = preg_replace('/^a-zA-Z0-9\.-_/', '', $cacheFileName);

if ($verbose) {
	$img->verbose ( "Cache file is: {$cacheFileName}" );
}


//
// Is there already a valid image in the cache directory, then use it and exit
//
$imageModifiedTime = filemtime($pathToImage);
$cacheModifiedTime = is_file($cacheFileName) ? filemtime($cacheFileName) : null;

// If cached image is valid, output it.
if(!$ignoreCache && is_file($cacheFileName) && $imageModifiedTime < $cacheModifiedTime) {
  if($verbose) { $img->verbose("Cache file is valid, output it."); }
  $img->outputImage($cacheFileName, $verbose);
}

if($verbose) { $img->verbose("Cache is not valid, process image and create a cached version of it."); }
	
	//
	// Open up the original image from file
	//
if ($verbose) {
	$img->verbose ( "File extension is: {$fileExtension}" );
}


//
// Open up the original image from file 
//
switch ($fileExtension) {
	case 'jpg' :
	case 'jpeg' :
		$image = imagecreatefromjpeg ( $pathToImage );
		if ($verbose) {
			$img->verbose ( "Opened the image as a JPEG image." );
		}
		break;
	
	case 'png':
		$image = imagecreatefrompng ( $pathToImage );
		if ($verbose) {
			$img->verbose ( "Opened the image as a PNG image." );
		}
		break;
	
	default :
		$img->errorPage ( 'No support for this file extension.' );
}




//
// Resize the image if needed
//
if($cropToFit) {
  if($verbose) { $img->verbose("Resizing, crop to fit."); }
  $cropX = round(($width - $cropWidth) / 2);  
  $cropY = round(($height - $cropHeight) / 2);    
  $imageResized = $img->createImageKeepTransparency($newWidth, $newHeight);
  imagecopyresampled($imageResized, $image, 0, 0, $cropX, $cropY, $newWidth, $newHeight, $cropWidth, $cropHeight);
  $image = $imageResized;
  $width = $newWidth;
  $height = $newHeight;
}
else if(!($newWidth == $width && $newHeight == $height)) {
  if($verbose) { vgerbose("Resizing, new height and/or width."); }
  $imageResized = $img->createImageKeepTransparency($newWidth, $newHeight);
  imagecopyresampled($imageResized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
  $image  = $imageResized;
  $width  = $newWidth;
  $height = $newHeight;
}



//
// Apply filters and postprocessing of image
//
if($sharpen) {
  $image = $img->sharpenImage($image);
}




//
// Save the image
//
switch($saveAs) {
  case 'jpeg':
  case 'jpg':
    if($verbose) {$img->verbose("Saving image as JPEG to cache using quality = {$quality}."); }
    imagejpeg($image, $cacheFileName, $quality);
  break;  

  case 'png':  
    if($verbose) { $img->verbose("Saving image as PNG to cache."); }
    // Turn off alpha blending and set alpha flag
    imagealphablending($image, false);
    imagesavealpha($image, true);
    imagepng($image, $cacheFileName);  
  break;  

  default:
    $img->errorMessage('No support to save as this file extension.');
  break;
}


if($verbose) { 
  clearstatcache();
  $cacheFilesize = filesize($cacheFileName);
  $img->verbose("File size of cached file: {$cacheFilesize} bytes."); 
  $img->verbose("Cache file has a file size of " . round($cacheFilesize/$filesize*100) . "% of the original size.");
}


//
// Output the resulting image
//
$img->outputImage($cacheFileName, $verbose);
