<?php
class CContent {
	
	// private $sqlQuery;
	private $db;
	private $url;
	private $slug;
	private $slugSql;
	
	/**
	 * Constructs an object of type CContent
	 */
	public function __construct($db) {
		// $this->sqlQuery = null;
		$this->db = $db;
	}
	
	/**
	 * Get the database
	 *
	 * @return CDatabase - the database
	 */
	function getDatabase() {
		return $this->db;
	}
	
	/**
	 * Creates and inserts info into tables
	 */
	function resetDatabase() {
		$output = null;
		$strOut = null;
		$sqlQuery = '
	
	--
	-- Create table for aContent
	--
		DROP TABLE IF EXISTS aContent;
	    CREATE TABLE aContent
	    (
	    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	    slug CHAR(80) UNIQUE,
	    url CHAR(80) UNIQUE,
	    user char(20),
	    TYPE CHAR(80),
	    title VARCHAR(80),
	    DATA TEXT,
	    FILTER CHAR(80),
	 
	    published DATETIME,
	    created DATETIME,
	    updated DATETIME,
	    deleted DATETIME ) ENGINE INNODB CHARACTER SET utf8; 
	
	';
		
		try {
			// create database tables
			$this->db->ExecuteQuery ( $sqlQuery );
		} catch ( Exception $ex ) {
			
			$strOut = "Database error";
		}
		
		$strOut = "Database has been reset";
		
		$sqlQuery = "INSERT INTO aContent (user,slug, url, TYPE, title, DATA, FILTER, published, created) VALUES
					    ('admin', 'hem','hem', 'page', 'Hem', 'Detta är min hemsida. Den är skriven i [url=http://en.wikipedia.org/wiki/BBCode]bbcode[/url] vilket innebär att man kan formattera texten till [b]bold[/b] och [i]kursiv stil[/i] samt hantera länkar.\n\nDessutom finns ett filter nl2br som lägger in <br>-element istället för \\n, det är smidigt, man kan skriva texten precis som man tänker sig att den skall visas, med radbrytningar.', 'bbcode,nl2br', NOW(), NOW()),
					    ('admin','om', 'om', 'page', 'Om', 'Detta är en sida om mig och min webbplats. Den är skriven i [Markdown](http://en.wikipedia.org/wiki/Markdown). Markdown innebär att du får bra kontroll över innehållet i din sida, du kan formattera och sätta rubriker, men du behöver inte bry dig om HTML.\n\nRubrik nivå 2\n-------------\n\nDu skriver enkla styrtecken för att formattera texten som **fetstil** och *kursiv*. Det finns ett speciellt sätt att länka, skapa tabeller och så vidare.\n\n###Rubrik nivå 3\n\nNär man skriver i markdown så blir det läsbart även som textfil och det är lite av tanken med markdown.', 'markdown', NOW(), NOW()),
					    ('admin','blogpost-1', NULL, 'post', 'Välkommen till min blogg!', 'Detta är en bloggpost.\n\nNär det finns länkar till andra webbplatser så kommer de länkarna att bli klickbara.\n\nhttp://dbwebb.se är ett exempel på en länk som blir klickbar.', 'link,nl2br', NOW(), NOW()),
					    ('admin','blogpost-2', NULL, 'post', 'Nu har sommaren kommit', 'Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost.', 'nl2br', NOW(), NOW()),
					    ('admin','blogpost-3', NULL, 'post', 'Nu har hösten kommit', 'Detta är en bloggpost som berättar att hösten har kommit, ett budskap som kräver en bloggpost', 'nl2br', NOW(), NOW());
						";
		try {
			// insert to database tables
			$this->db->ExecuteQuery ( $sqlQuery );
		} catch ( Exception $ex ) {
			
			$strOut = "unable to insert to database";
		}
		
		$output = "Successfully updated database";
		
		return $strOut;
	}
	
	/**
	 * Create blog entry
	 */
	public function createBlogEntry() {
		try {
			
			// Get parameters ad set to null if iset returns false
			$acronym = isset ( $_SESSION ['user'] ) ? $_SESSION ['user']->acronym : null;
// 			$slug = isset ( $_POST ['slug'] ) ? $_POST ['slug'] : null;
// 			$url = isset ( $_POST ['url'] ) ? strip_tags ( $_POST ['url'] ) : "";
// 			$type = isset ( $_POST ['type'] ) ? strip_tags ( $_POST ['type'] ) : array ();
			$title = isset ( $_POST ['title'] ) ? $_POST ['title'] : null;
// 			$data = isset ( $_POST ['data'] ) ? $_POST ['data'] : array ();
// 			$filter = isset ( $_POST ['filter'] ) ? $_POST ['filter'] : array ();
// 			$published = isset ( $_POST ['published'] ) ? strip_tags ( $_POST ['published'] ) : array ();
// 			$created = isset ( $_POST ['created'] ) ? strip_tags ( $_POST ['created'] ) : array ();
			
			$sql = 'INSERT INTO aContent (title, user) VALUES (?,?)';
			
			
			$params = array (
					$title,
					$acronym 
			);
			
			$this->db->ExecuteQuery ( $sql, $params );
			
			header ( 'Location: blog_edit_single.php?id=' . $this->db->LastInsertId () );
			
		} catch ( PDOException $e ) {
			print "Error!: " . $e->getMessage () . "</br>";
		}
	}
	
	/**
	 * Add data to the database
	 */
	function addToDatabase() {
		
		
		try {
			
			// Get parameters ad set to null if iset returns false
			$acronym = isset ( $_SESSION ['user'] ) ? $_SESSION ['user']->acronym : null;
			$slug = isset ( $_POST ['slug'] ) ? $_POST ['slug'] : null;
			$url = isset ( $_POST ['url'] ) ? strip_tags ( $_POST ['url'] ) : "";
			$type = isset ( $_POST ['type'] ) ? strip_tags ( $_POST ['type'] ) : array ();
			$title = isset ( $_POST ['title'] ) ? $_POST ['title'] : null;
			$data = isset ( $_POST ['data'] ) ? $_POST ['data'] : array ();
			$filter = isset ( $_POST ['filter'] ) ? $_POST ['filter'] : array ();
			$published = isset ( $_POST ['published'] ) ? strip_tags ( $_POST ['published'] ) : array ();
			$created = isset ( $_POST ['created'] ) ? strip_tags ( $_POST ['created'] ) : array ();
					
			
// 			sql statement
			$sql = 'INSERT INTO aContent ( slug, title, data, type, filter, published, created, user) VALUES (?,?,?,?,?,?,?,?)';
		
						// put parameters in an array
						$params = array (
								
								$slug,
			// 					$url,
								$title,
								$data,
								$type,
								$filter,
								$published,
								$created,
								$acronym
						);
			
			
			// execute query
			$isExecuted = $this->db->ExecuteQuery ( $sql, $params );
				
			
			$id = $this ->db -> LastInsertId();
			
			//send it to the edit page
			header ( 'Location: blog_edit.php?id=' . $id );

		} catch ( PDOException $e ) {
			print "Error!: " . $e->getMessage () . "</br>";
		}
		
	}
	
	
	/**
	 * Delete database
	 */
	function deleteFromDB($id) {
		$sql = 'DELETE FROM aContent WHERE id = ? LIMIT 1';
		$params = array (
				$id 
		);
		$this->db->ExecuteQuery ( $sql, $params );
		$output = "Deleted " . $this->db->RowCount () . " rows from the database.";
		return $output;
	}
	
	/**
	 * Update database
	 */
	function updateDatabase() {
		
		// Get parameters ad set to null if iiset returns false
		$id = isset ( $_POST ['id'] ) ? strip_tags ( $_POST ['id'] ) : (isset ( $_GET ['id'] ) ? strip_tags ( $_GET ['id'] ) : null);
		$title = isset ( $_POST ['title'] ) ? $_POST ['title'] : null;
		$slug = isset ( $_POST ['slug'] ) ? $_POST ['slug'] : null;
		$url = isset ( $_POST ['url'] ) ? $_POST ['url'] : null;
		$data = isset ( $_POST ['data'] ) ? $_POST ['data'] : array ();
		$type = isset ( $_POST ['type'] ) ? strip_tags ( $_POST ['type'] ) : array ();
		$filter = isset ( $_POST ['filter'] ) ? $_POST ['filter'] : array ();
		$published = isset ( $_POST ['published'] ) ? strip_tags ( $_POST ['published'] ) : array ();
		$save = isset ( $_POST ['save'] ) ? true : false;
		$acronym = isset ( $_SESSION ['user'] ) ? $_SESSION ['user']->acronym : null;
			

		
		// sql statement
		$sql = '
	    UPDATE aContent SET
		  title    = ?,
		  slug   = ?,
	      url    = ?,
	      type     = ?,	
	      data    = ?,
	      filter  = ?,
	      published = ?,
		  created = NOW(),
	      updated = NOW()
	    WHERE 
	      id = ?
	  ';
		
		
		// put parameters in an array
		$params = array (
				$title,
				$slug,
				$url,
				$type,
				$data,
				$filter,
				$published,
				$id
		);
		
		$isSaved = ($this->db->ExecuteQuery ( $sql, $params ));
		
		if($isSaved){
		
		$output = 'Information was saved.';
		}else {
			$output = 'Information was NOT saved.' . print_r($this->db->ErrorInfo(), 1) ;
		}
		return $output;
	}
	
	/**
	 * Select from database with specific id
	 */
	function selectFromDB($id) {
		
		// Select from database
		$sql = 'SELECT * FROM aContent WHERE id = ?';
		$res = $this->db->ExecuteSelectQueryAndFetchAll ( $sql, array (
				$id 
		) );
		
		// verifty if it is set
		if (isset ( $res [0] )) {
			$c = $res [0];
			return $c;
		} else {
			die ( 'Error: there is no content with that id.' );
			return null;
		}
	}
	
	/**
	 * Set url
	 * 
	 * @param unknown $url        	
	 */
	function setUrl($url) {
		$this->url = $url;
	}
	
	/**
	 * set slug
	 * 
	 * @param unknown $slug        	
	 */
	function setSlug($slug) {
		$this->slug = $slug;
	}
	
	/**
	 * set slugSql
	 * 
	 * @param unknown $slug        	
	 */
	function setSlugSql($slugSql) {
		$this->slugSql = $slugSql;
	}
	
	/**
	 * get url
	 * 
	 * @return unknown
	 */
	function getUrl() {
		return $this->url;
	}
	
	/**
	 * get slug
	 * 
	 * @return unknown
	 */
	function getSlug() {
		return $this->slug;
	}
	
	/**
	 * get slugSql
	 * 
	 * @return unknown
	 */
	function getSlugSql() {
		return $this->slugSql;
	}
	
	
	/**
	 * Get page content
	 */
	function getPageContent() {
		
		// Get content
		$sql = "
				SELECT *
				FROM aContent
				WHERE
				type = 'page' AND
				url = ? AND
				published <= NOW();
				";
		$res = $this->db->ExecuteSelectQueryAndFetchAll ( $sql, array (
				$this->getUrl () 
		) );
		
		if (isset ( $res [0] )) {
			$c = $res [0];
			return $c;
		} else {
			die ( 'Fail: there is no content.' );
			return null;
		}
	}
	
//	$sql = "SELECT * FROM VMovie LIMIT $hits OFFSET " . (($page - 1) * $hits);
	
	/**
	 * get blog content
	 */
	function getBlogContent() {
		
		// Get content
		$slugSql = $this->slug ? 'slug = ?' : '1';
		
		
		$sql = "
	SELECT *
	FROM aContent
	WHERE
	type = 'post' AND
	$slugSql AND
	published <= NOW()
	ORDER BY updated DESC
	;
	";
		$res = $this->db->ExecuteSelectQueryAndFetchAll ($sql, array (
				$this->getSlug () 
		) );
		
		return $res;
	}
	
	
	/**
	 * Use the current querystring as base, modify it according to $options and return the modified query string.
	 *
	 * @param array $options to set/change.
	 * @param string $prepend this to the resulting query string
	 * @return string with an updated query string.
	 */
	function getQueryString($options=array(), $prepend='?') {
		// parse query string into array
		$query = array();
		parse_str($_SERVER['QUERY_STRING'], $query);
	
		// Modify the existing query string with new options
		$query = array_merge($query, $options);
	
		// Return the modified querystring
		return $prepend . htmlentities(http_build_query($query));
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
	
	
	function getPaginatedBlogContent($hits, $page, $orderby, $order){
		
		// Get content
		$slugSql = $this->slug ? 'slug = ?' : '1';
		
		// Get max pages from table, for navigation
		$sql = "SELECT COUNT(id) AS rows FROM aContent";
		
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql, array($this->getSlug()));
		

		$sql = "
		SELECT *
		FROM aContent
		WHERE
		type = 'post' AND
		$slugSql AND
		published <= NOW()
		ORDER BY $orderby $order
		LIMIT $hits OFFSET " .(($page - 1) * $hits);
		
		$params = array($this->getSlug());
		
		$res = $this->db -> ExecuteSelectQueryAndFetchAll($sql, $params);
		

		return $res;
	}
	
	
	function selectLatestBlogEntries()
	{
		$sql='SELECT * FROM aContent
    ORDER BY updated DESC
    LIMIT 3';
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql, array());
		return $res;
	
	}
}
