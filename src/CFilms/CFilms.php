<?php


class CFilms{

private $db;
	

   /**
   * Constructor
   *
   */
   public function __construct($db) {
    
   	$this->db=$db;
   	
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
	
	/**
	 *Restore database to original state
	 */
	 public function resetDBToOriginal(){
		// Restore the database to its original settings
		$sql      = 'movie.sql';
		$mysql    = '/usr/local/bin/mysql';
		$host     = 'localhost';
		$login    = '';
		$password = '';
		$output = null;
		
		if(isset($_POST['restore']) || isset($_GET['restore'])) {
		  $cmd = "$mysql -h{$host} -u{$login} -p{$password} < $sql";
		  exec($cmd);
		  $output = "<p>Database has been reset via command<br/><code>{$cmd}</code></p>";
		}
	}
	
	
	/**
	 * Edits movie
	 */
	public function editMovie(){
		
		$output = null;
		
		// Get parameters
		$id     = isset($_POST['id'])    ? strip_tags($_POST['id']) : (isset($_GET['id']) ? strip_tags($_GET['id']) : null);
		$title  = isset($_POST['title']) ? strip_tags($_POST['title']) : null;
		$year   = isset($_POST['year'])  ? strip_tags($_POST['year'])  : null;
		$image  = isset($_POST['image']) ? strip_tags($_POST['image']) : null;
		$genre  = isset($_POST['genre']) ? $_POST['genre'] : array();
		$synopsis = isset($_POST['synopsis']) ? strip_tags($_POST['synopsis'])  : null;
		$price   = isset($_POST['price'])  ? strip_tags($_POST['price'])  : null;
		$img_name  = isset($_POST['img_name']) ? strip_tags($_POST['img_name']) : null;
		$save   = isset($_POST['save'])  ? true : false;
		$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;
		
		
		$sql = '
    UPDATE aMovie SET
      title = ?,
	  YEAR = ?,
	  image = ?,
	  genre = ?,
	  synopsis = ?,
	  price = ?,
	  img_name = ?,
	  updated = NOW()
    WHERE
      id = ?
  ';
		
		$params = array (
				$title,
				$year,
				$image,
				$genre,
				$synopsis,
				$price,
				$img_name,
				$id
		);
		
		$isExecuted = $this->db->ExecuteQuery ( $sql, $params );
		
		if ($isExecuted) {
		
			$output = 'Movie was updated successfully.';
		
			header ( 'Location: movies.php' );
			
		} else {
		
			$output = 'Error updating movie!' . print_r($this->db->ErrorInfo(), 1);
		}
		
		return $output;
	}
	
	
	public function deleteMovie(){
		
		
		
	}
	
	
	/**
	 * Function to create links for sorting
	 *
	 * @param string $column the name of the database column to sort by
	 * @return string with links to order by column.
	 */
	function orderby($column) {
	  $nav  = "<a href='" . $this->getQueryString(array('orderby'=>$column, 'order'=>'asc')) . "'>&darr;</a>";
	  $nav .= "<a href='" . $this->getQueryString(array('orderby'=>$column, 'order'=>'desc')) . "'>&uarr;</a>";
	  return "<span class='orderby'>" . $nav . "</span>";
	}
	
	
	/**
	 * 
	 * @return unknown
	 */
	function selectLatestMovies()
	{
		$sql='SELECT * FROM aMovie
    ORDER BY updated DESC
    LIMIT 4';
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql, array());
		return $res;
	
	}
	
	
	/**
	 * 
	 * @param unknown $id
	 * @return unknown|NULL
	 */
	function selectMovieID($id){
		
		$sql = 'SELECT * FROM aMovie WHERE id = ?';
		
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql, array($id));
		
		
		if(isset($res[0])) {
	            $c = $res[0];
	            return $c;
	        }
	        else {
	        die('Error: no  content with id '.$id);
	            return null;
	        } 
		
	}
	
	
	/**
	 *
	 * @param unknown $id
	 * @return unknown|NULL
	 */
	function selectCategory($name){
	
		$sql = 'SELECT * FROM aMovie WHERE genre LIKE ? ORDER BY ASC';
	
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql, array($name));
	
	
		if(isset($res[0])) {
			$c = $res[0];
			return $c;
		}
		else {
			die('Error: no  content with that category '.$name);
			return null;
		}
	
	}

}

