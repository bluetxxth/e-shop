<?php 

class CImage{
	
	
	public function __construct(){
		
	}
	

	
	public function calculateDimension($width, $height, $newWidth, $newHeight, $cropToFit, $verbose){
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
	}
	
	/**
	 * Display error message.
	 *
	 * @param string $message the error message to display.
	 */
	public function errorMessage($message) {
		header("Status: 404 Not Found");
		die('img.php says 404 - ' . htmlentities($message));
	}
	
	
	
	/**
	 * Display log message.
	 *
	 * @param string $message the log message to display.
	 */
	public function verbose($message) {
		echo "<p>" . htmlentities($message) . "</p>";
	}
	
	
	
	/**
	 * Output an image together with last modified header.
	 *
	 * @param string $file as path to the image.
	 * @param boolean $verbose if verbose mode is on or off.
	 */
	public function outputImage($file, $verbose) {
		$info = getimagesize($file);
		!empty($info) or $this->errorMessage("The file doesn't seem to be an image.");
		$mime   = $info['mime'];
	
		$lastModified = filemtime($file);
		$gmdate = gmdate("D, d M Y H:i:s", $lastModified);
	
		if($verbose) {
			verbose("Memory peak: " . round(memory_get_peak_usage() /1024/1024) . "M");
			verbose("Memory limit: " . ini_get('memory_limit'));
			verbose("Time is {$gmdate} GMT.");
		}
	
		if(!$verbose) header('Last-Modified: ' . $gmdate . ' GMT');
		if(isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == $lastModified){
			if($verbose) { verbose("Would send header 304 Not Modified, but its verbose mode."); exit; }
			header('HTTP/1.0 304 Not Modified');
		} else {
			if($verbose) { verbose("Would send header to deliver image with modified time: {$gmdate} GMT, but its verbose mode."); exit; }
			header('Content-type: ' . $mime);
			readfile($file);
		}
		exit;
	}
	
	
	
	/**
	 * Sharpen image as http://php.net/manual/en/ref.image.php#56144
	 * http://loriweb.pair.com/8udf-sharpen.html
	 *
	 * @param resource $image the image to apply this filter on.
	 * @return resource $image as the processed image.
	 */
	public function sharpenImage($image) {
		$matrix = array(
				array(-1,-1,-1,),
				array(-1,16,-1,),
				array(-1,-1,-1,)
		);
		$divisor = 8;
		$offset = 0;
		imageconvolution($image, $matrix, $divisor, $offset);
		return $image;
	}
	
	
	
	/**
	 * Create new image and keep transparency
	 *
	 * @param resource $image the image to apply this filter on.
	 * @return resource $image as the processed image.
	 */
	public function createImageKeepTransparency($width, $height) {
		$img = imagecreatetruecolor($width, $height);
		imagealphablending($img, false);
		imagesavealpha($img, true);
		return $img;
	}
	

}
