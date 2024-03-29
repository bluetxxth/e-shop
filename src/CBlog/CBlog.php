<?php 

class CBlog extends CContent{
	
	private $res;
	
	/**
	 * Constructs an object of type CConent
	 */
	function __construct($db){
		parent::__construct($db);
	}
	
	
	
	/**
	 * Create links for hits per page.
	 *
	 * @param array $hits a list of hits-options to display.
	 * @param array $current value.
	 * @return string as a link to this page.
	 */
	function getHitsPerPage($hits, $current=null) {
		$nav = "Hits per page: ";
		foreach($hits AS $val) {
			if($current == $val) {
				$nav .= "$val ";
			}
			else {
				$nav .= "<a href='" . $this->getQueryString(array('hits' => $val)) . "'>$val</a> ";
			}
		}
		return $nav;
	}
	
	
	/**
	 * Create navigation among pages.
	 *
	 * @param integer $hits per page.
	 * @param integer $page current page.
	 * @param integer $max number of pages.
	 * @param integer $min is the first page number, usually 0 or 1.
	 * @return string as a link to this page.
	 */
	function getPageNavigation($hits, $page, $max, $min=1) {
		$nav  = ($page != $min) ? "<a href='" . $this->getQueryString(array('page' => $min)) . "'>&lt;&lt;</a> " : '&lt;&lt; ';
		$nav .= ($page > $min) ? "<a href='" . $this->getQueryString(array('page' => ($page > $min ? $page - 1 : $min) )) . "'>&lt;</a> " : '&lt; ';
	
		for($i=$min; $i<=$max; $i++) {
			if($page == $i) {
				$nav .= "$i ";
			}
			else {
				$nav .= "<a href='" . $this->getQueryString(array('page' => $i)) . "'>$i</a> ";
			}
		}
	
		$nav .= ($page < $max) ? "<a href='" . $this->getQueryString(array('page' => ($page < $max ? $page + 1 : $max) )) . "'>&gt;</a> " : '&gt; ';
		$nav .= ($page != $max) ? "<a href='" . $this->getQueryString(array('page' => $max)) . "'>&gt;&gt;</a> " : '&gt;&gt; ';
		return $nav;
	}
	
	
	/**
	 * get the blog's content
	 */
	public function getContent(){
		
		$this-> res = parent::getBlogContent();	
		
		return $this->res;
	}
	
}