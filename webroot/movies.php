 <?php
/**
 * This is a Alpha pagecontroller.
 *
 */
	// Include the essential config-file which also creates the $alpha variable with its defaults.
	include (__DIR__ . '/config.php');
	
	// Add the style sheet
	$alpha ['stylesheets'] [] = 'css/tables.css';
	// Add the style sheet
	$alpha ['stylesheets'] [] = 'css/product.css';
	//breadcrumb navigation
	$alpha ['stylesheets'] [] = 'css/breadcrumb.css';

	
	$html = null;
	
	// Connect to a MySQL database using PHP PDO
	$db = new CDatabase ( $alpha ['database'] );
	
	// cart
	$basket = new CMyShoppingCart ( $db );
	
	// instantiate the film class
	$films = new CFilms ( $db );
	
	$specialActions = new CSpecialActions();
	
	
	
	// Do it and store it all in variables in the Alpha container.
	$alpha ['title'] = "Movies";
	
	// Do it and store it all in variables in the Alpha container.
	$alpha ['title'] = "Me";
	
	$alpha ['above'] = <<<EOD

<a href="http://www.student.bth.se/~gani13/oophp/Kmom01/webroot/me.php">Kmom1</a> 

EOD;
	
	// the header
	$alpha ['header'] = <<<EOD
<img class='sitelogo' src='img.php?src=reel_logo.jpg&amp;width=120&amp;height=120' alt='Picture' />
<span class='sitetitle'>REALREEL</span>
<span class='siteslogan'>Your movie partner</span>
EOD;
	
	$html1 = null;
	
	$html1 .= '<h1> DB Control Panel</h1>';
	
	// Get parameters
	
	$all = isset ( $_GET ['listAll'] ) ? $_GET ['listAll'] : null;
	$title = isset ( $_GET ['title'] ) ? $_GET ['title'] : null;
	$genre = isset ( $_GET ['genre'] ) ? $_GET ['genre'] : null;
	$hits = isset ( $_GET ['hits'] ) ? $_GET ['hits'] : 8;
	$page = isset ( $_GET ['page'] ) ? $_GET ['page'] : 1;
	$year1 = isset ( $_GET ['year1'] ) && ! empty ( $_GET ['year1'] ) ? $_GET ['year1'] : null;
	$year2 = isset ( $_GET ['year2'] ) && ! empty ( $_GET ['year2'] ) ? $_GET ['year2'] : null;
	$orderby = isset ( $_GET ['orderby'] ) ? strtolower ( $_GET ['orderby'] ) : 'id';
	$order = isset ( $_GET ['order'] ) ? strtolower ( $_GET ['order'] ) : 'asc';
	$showall = isset ( $_GET ['showall'] ) ? $_GET ['showall'] : null;
	$newfilm = isset ( $_GET ['newfilm'] ) ? $_GET ['newfilm'] : null;
	$buy = isset ( $_GET ['buy'] ) ? $_GET ['buy'] : null;
	
	
	// initialize
	$myId = null;
	$myPicture = null;
	$myTitle = null;
	$myYear = null;
	$myGenre = null;
	$myPrice = null;
	
	$id = 0;
	
	$productsTobuy = 0;
	function movieToBuy($id) {
		$productsTobuy = $id;
	}
	
	$output = null;
	
	if (isset ( $_GET ['id'] )) {
		
		$_SESSION ['id'] = $id = strip_tags ( $_GET ['id'] );
		
		$productsTobuy = $_SESSION ['id'];
	}
	
	
	
	if ($showall) {
		
		header ( 'Location: movies.php' );
	}
	
	if ($newfilm) {
		
		header ( 'Location: movie_create.php' );
	}
	
	if ($buy) {
		
		echo "movieto buy: " . $productsTobuy;
		
		$sql = "SELECT * FROM aMovie WHERE id = ?";
		$params = array (
				$productsTobuy 
		);
		
		$res = $db->ExecuteSelectQueryAndFetchAll ( $sql, $params );
		
		foreach ( $res as $key => $val ) {
			
			// sanitize before assignment
			$myId = strip_tags ( $val->id );
			$myPicture = strip_tags ( $val->img_name );
			$myTitle = strip_tags ( $val->title );
			$myYear = strip_tags ( $val->YEAR );
			$myGenre = strip_tags ( $val->genre );
			$myPrice = strip_tags ( $val->price );
		}
		
		// add to cart
		$output = $basket->addItem ( $myId, $myTitle, $myYear, $myPicture, $myGenre, $myPrice );

	}
	
	in_array ( $orderby, array (
			'id',
			'title',
			'artist',
			'year' 
	) ) or die ( 'Check: Not valid column' );
	in_array ( $order, array (
			'asc',
			'desc' 
	) ) or die ( 'Check: Not valid sort order.' );
	
	// Check that incoming parameters are valid
	is_numeric ( $hits ) or die ( 'Check: Hits must be numeric.' );
	is_numeric ( $page ) or die ( 'Check: Page must be numeric.' );
	is_numeric ( $year1 ) || ! isset ( $year1 ) or die ( 'Check: Year must be numeric or not set.' );
	is_numeric ( $year2 ) || ! isset ( $year2 ) or die ( 'Check: Year must be numeric or not set.' );
	
	// Get max pages for current query, for navigation
	$sql = "SELECT COUNT(id) AS rows FROM aMovie";
	
	$res = $db->ExecuteSelectQueryAndFetchAll ( $sql );
	$rows = $res [0]->rows;
	$max = ceil ( $rows / $hits );
	
	// var_dump($res);
	
	// Do SELECT from a table
	if ($title) {
		$sql = "SELECT * FROM aMovie WHERE title LIKE '%{$title}%' ORDER BY $orderby $order LIMIT $hits OFFSET " . (($page - 1) * $hits);
		$params = array (
				$title 
		);
	} elseif ($year1 && $year2) {
		$sql = "SELECT * FROM aMovie WHERE YEAR >= ? AND YEAR <= ? ORDER BY $orderby $order LIMIT $hits OFFSET " . (($page - 1) * $hits);
		$params = array (
				$year1,
				$year2 
		);
	} elseif ($year1) {
		$sql = "SELECT * FROM aMovie WHERE YEAR >= ? ORDER BY $orderby $order LIMIT $hits OFFSET " . (($page - 1) * $hits);
		$params = array (
				$year1 
		);
	} elseif ($year2) {
		$sql = "SELECT * FROM aMovie WHERE YEAR <= ? ORDER BY $orderby $order LIMIT $hits OFFSET " . (($page - 1) * $hits);
		$params = array (
				$year2 
		);
	} 

	elseif ($all) {
		$sql = "SELECT * FROM aMovie;";
		$params = array (
				$all 
		);
	} elseif ($genre) {
		echo $genre;
		$sql = "SELECT * FROM aMovie WHERE genre LIKE '%{$genre}%' ORDER BY $orderby $order LIMIT $hits OFFSET " . (($page - 1) * $hits);
		$params = array (
				$genre 
		);
	} else {
		$sql = "SELECT * FROM aMovie ORDER BY $orderby $order LIMIT $hits OFFSET " . (($page - 1) * $hits);
		$params = null;
	}
	
// 	// show only a portion of the text
// 	function truncate_string($str, $length) {
// 		if (! (strlen ( $str ) <= $length)) {
// 			$str = substr ( $str, 0, strpos ( $str, ' ', $length ) ) . '...';
// 		}
		
// 		return $str;
// 	}

	
	$res = $db->ExecuteSelectQueryAndFetchAll ( $sql, $params );
	
	$purchase_icon = '<button type="submit" name="buy" value="Purchase"><img src="img.php?src=shoppingcart_icon.png&amp;width=50&amp;height=50" alt="Picture" id ="shoppingIcon" /></button>';
	
	if (isset ( $_SESSION ['user'] )) {
		
		// Put results into a HTML-table (table header) - WITH edit and delete options
		$tr = "<tr><th>Buy " . "</th><th>Picture</th><th>Title " . $films->orderby ( 'title' ) . "</th><th>Year " . $films->orderby ( 'YEAR' ) . "</th><th>Genre" . " </th><th>Synopsis</th><th>Price</th><th>edit</th><th>delete</th></tr>";
		
		foreach ( $res as $key => $val ) {
			
			// $synopsis = truncate_string ( $val->synopsis, 50 );

			// show only a portion of the text
			$synopsis = $specialActions->truncate_string($val->synopsis, 50);
			
			 // // as a vbutton
			// <form method 'get'>{$purchase_icon}</form>
			
			 // // with picture
			// <a href='movie.php?id={$val->id}'><img src='img.php?src=shoppingcart_icon.png&amp;width=35&amp;height=35' alt='Picture' id='cartIconImg'/></a>
			
			// // with picture as an input type
			// <input type='image' name='buy'src='img.php?src=shoppingcart_icon.png&amp;width=35&amp;height=35' alt='Picture' id='cartIconImg' />
			
			// Put results into a HTML-table (table cells) - WITH edit and delete options
			$tr .= "<tr><td>  <a href='movie.php?id={$val->id}'><img src='img.php?src=shoppingcart_icon.png&amp;width=35&amp;height=35' alt='Picture' id='cartIconImg'/></a></td><td><a href='movie.php?id={$val->id}'><img src='img.php?src={$val->img_name}&amp;width=150&amp;height=150' alt='Picture' id='movieimg'/> </a></td><td><a href='movie.php?id={$val->id}'>{$val->title}</a></td><td>{$val->YEAR}</td><td>{$val->genre}</td><td>{$synopsis} <a href='movie.php?id={$val->id}'> (more)</a></td> <td>{$val->price}Kr.</td><td><a href='movie_edit.php?id={$val->id}'><img src='img.php?src=edit_icon_.png&amp;width=30&amp;height=30' alt='Picture'/></a></td><td><a href='movie_delete.php?id={$val->id}'> <img src='img.php?src=remove_icon.png&amp;width=35&amp;height=35' alt='Picture'/></a></td></tr>";
		}
	} else {
		
		// Put results into a HTML-table (table header) - WITHOUT edit and delete options
		$tr = "<tr><th>Buy " . "</th><th>Picture</th><th>Title " . $films->orderby ( 'title' ) . "</th><th>Year " . $films->orderby ( 'YEAR' ) . "</th><th>Genre" . " </th><th>Synopsis</th></tr>";
		
		foreach ( $res as $key => $val ) {
			
			// show only a portion of the text
			$synopsis = $specialActions->truncate_string($val->synopsis, 50);
			
			// Put results into a HTML-table (table cells) - WITHOUT edit and delete options
			$tr .= "<tr><td><a href='movie.php?id={$val->id}'><img src='img.php?src=shoppingcart_icon.png&amp;width=35&amp;height=35' alt='Picture' class='cartIconImg'/></a></td><td><a href='movie.php?id={$val->id}'><img src='img.php?src={$val->img_name}&amp;width=150&amp;height=150' alt='Picture' /></a></td><td><a href='movie.php?id={$val->id}'>{$val->title}</a></td><td>{$val->YEAR}</td><td>{$val->genre}</td><td>{$synopsis}</td></tr>";
		}
	}
	
	$hitsPerPage = $films->getHitsPerPage ( array (
			2,
			4,
			8 
	), $hits );
	
	
	$navigatePage = $films->getPageNavigation ( $hits, $page, $max );
	$sqlDebug = $db->Dump ();
	
	// verify vars
	$title = htmlentities ( $title );
	$year1 = htmlentities ( $year1 );
	$year2 = htmlentities ( $year2 );
	$orderby = htmlentities ( $orderby );
	$paramsPrint = htmlentities ( print_r ( $params, 1 ) );
	
	

	
	
	// the main body
	$alpha ['main'] = <<<EOD
<form>
  <fieldset>
  <legend>Search</legend>
  <input type=hidden name=hits value='{$hits}'/>
  <input type=hidden name=page value='1'/>
  <p><label>Title (Wildcards, use % as *): <input type='search' name='title' value='{$title}'/></label></p>
  <p><label>Year range: 
      <input type='text' name='year1' value='{$year1}'/></label>
      - 
      <label><input type='text' name='year2' value='{$year2}'/></label>
      
      <label>Search by genre</label><input type= 'text' name=genre value='{$genre}'/>
  </p>

  <p><input type='submit' name='submit' value='Search' class='button'/></p>
  <p><input type='submit' name='showall' value='Show all' class='button'/></p>
  <p><input type='submit' name='newfilm' value='New film' class='button'/> </p>
  </fieldset>
</form>


  <br/><div class='rows'>{$rows} Hits. {$hitsPerPage}</div>
  
<div class='dbtable'>

  <table>
  {$tr}
  </table>
  

</div>
  		  <div class='pagination'>{$navigatePage}</div>
EOD;
	
	// the footer
	$alpha ['footer1'] = <<<EOD
<footer><span class='sitefooter'>Copyright (c) Gabriel Nieva (bluetxxth@gmail.com) | <a href='https://github.com/bluetxxth'>Alpha på GitHub</a> | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;
	$alpha ['footer2'] = <<<EOD
<footer></footer>
EOD;
	
	// Finally, leave it all to the rendering phase of Alpha.
	include (ALPHA_THEME_PATH); 