<?php
/**
 * This is a PHP skript to process images using PHP GD.
 *
 */

// Ensure error reporting is on
error_reporting(-1);              // Report all type of errors
ini_set('display_errors', 1);     // Display all errors 
ini_set('output_buffering', 0);   // Do not buffer outputs, write directly




// Define some constant values, append slash
// Use DIRECTORY_SEPARATOR to make it work on both windows and unix.
//
define('IMG_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR);



/**
 * Display error message.
 *
 * @param string $message the error message to display.
 */
function errorMessage($message) {
  header("Status: 404 Not Found");
  die('img.php says 404 - ' . htmlentities($message));
}



/**
 * Display log message.
 *
 * @param string $message the log message to display.
 */
function verbose($message) {
  echo "<p>$message</p>";
}



// Get the incoming arguments
$src      = isset($_GET['src'])     ? $_GET['src']      : null;
$verbose  = isset($_GET['verbose']) ? true              : null;

$pathToImage = realpath(IMG_PATH . $src);



// Validate incoming arguments
isset($src) or errorMessage('Must set src-attribute.');
preg_match('#^[a-z0-9A-Z-_\.\/]+$#', $src) or errorMessage('Filename contains invalid characters.');
substr_compare(IMG_PATH, $pathToImage, 0, strlen(IMG_PATH)) == 0 or errorMessage('Security constraint: Source image is not directly below the directory IMG_PATH.');



// Start displaying log if verbose mode & create url to current image
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



// Get information on the image
$imgInfo = list($width, $height, $type, $attr) = getimagesize($pathToImage);
!empty($imgInfo) or errorMessage("The file doesn't seem to be an image.");
$mime = $imgInfo['mime'];

if($verbose) {
  verbose("Image file: {$pathToImage}");
  verbose("Image information: " . print_r($imgInfo, true));
  verbose("Image width x height (type): {$width} x {$height} ({$type}).");
  verbose("Image file size: " . filesize($pathToImage) . " bytes.");
  verbose("Image mime type: {$mime}.");
}



// Output the resulting image
if($verbose) {
  verbose("Memory peak: " . round(memory_get_peak_usage() /1024/1024) . "M");
  verbose("Memory limit: " . ini_get('memory_limit'));
}
else {
  header('Content-type: ' . $mime);  
  readfile($pathToImage);
}
