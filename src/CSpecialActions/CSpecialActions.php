<?php

class CSpecialActions {
	
	
	function __construct(){
		
	}
	
	
	/**
	 * Create a breadcrumb of the gallery query path.
	 *
	 * @param string $path to the current gallery directory.
	 * @return string html with ul/li to display the thumbnail.
	 */
	function createBreadcrumb($path) {
		$parts = explode('/', trim(substr($path, strlen(GALLERY_PATH) + 1), '/'));
		$breadcrumb = "<ul class='breadcrumb'>\n<li><a href='?'>Movies</a> >></li>\n";
	
		if(!empty($parts[0])) {
			$combine = null;
			foreach($parts as $part) {
				$combine .= ($combine ? '/' : null) . $part;
				$breadcrumb .= "<li><a href='?path={$combine}'>$part</a> » </li>\n";
			}
		}
	
		$breadcrumb .= "</ul>\n";
		return $breadcrumb;
	}
	
	
	// show only a portion of the text
	public function truncate_string($str, $length) {
		if (! (strlen ( $str ) <= $length)) {
			$str = substr ( $str, 0, strpos ( $str, ' ', $length ) ) . '...';
		}
	
		return $str;
	}
	
	
}
