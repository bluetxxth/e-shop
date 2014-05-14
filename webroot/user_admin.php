<?php 
/**
 * This is a Alpha pagecontroller.
 *
 */
// Include the essential config-file which also creates the $alpha variable with its defaults.
include(__DIR__.'/config.php'); 

//Add the style sheet
$alpha['stylesheets'][] = 'css/tables.css';
$alpha['stylesheets'][] = 'css/style.css';

// Connect to a MySQL database using PHP PDO
$db = new CDatabase($alpha['database']);
//instantiate blog
$blog = new CBlog($db);
//instantiate user
$user = new CUser($db);
//instantiate text filter
$filter = new CTextFilter();
//instantiate content class for pagination
$content = new CContent($db);


// Get parameters for sorting
$hits  = isset($_GET['hits']) ? $_GET['hits'] : 8;
$page  = isset($_GET['page']) ? $_GET['page'] : 1;
$orderby  = isset($_GET['orderby']) ? strtolower($_GET['orderby']) : 'id';
$order    = isset($_GET['order'])   ? strtolower($_GET['order'])   : 'asc';

// Check that incoming is valid
is_numeric($hits) or die('Check: Hits must be numeric.');
is_numeric($page) or die('Check: Page must be numeric.');


// Get max pages for current query, for navigation
$sql = "SELECT COUNT(id) AS rows FROM aUSER";

$res = $db->ExecuteSelectQueryAndFetchAll($sql);
$rows = $res[0]->rows;
$max = ceil($rows / $hits);

//query result
$res = $blog -> getPaginatedBlogContent($hits, $page, $orderby, $order);

$hitsPerPage = $content->getHitsPerPage(array(2, 4, 8), $hits);
$navigatePage = $content->getPageNavigation($hits, $page, $max);


// Get max pages for current query, for navigation
$sql = "SELECT * FROM aUSER ORDER BY $orderby $order LIMIT $hits OFFSET " .(($page - 1) * $hits);

$res = $db->ExecuteSelectQueryAndFetchAll($sql);


if(isset($_SESSION['user'])){


	// Put results into a HTML-table (table header) - WITH edit and delete options
	$tr = "<tr><th>Id " . $user->orderby('id') . "</th><th>Acronym" . $user->orderby('acronym') . "</th><th>Name" . $user->orderby('name') . "</th><th>edit</th><th>delete</th></tr>";

	foreach($res AS $key => $val) {
			
		//$synopsis = truncate_string($val->synopsis, 50);

		// Put results into a HTML-table (table cells) - WITH edit and delete options
		$tr .= "<tr><td>{$val->id}</td><td>{$val->acronym}</td><td>{$val->name}</td><td><a href='user_edit.php?id={$val->id}'>edit </a></td><td><a href='user_delete.php?id={$val->id}'> remove</a></td></tr>";
	}

}else {
	header('Location: login.php');
}


// Do it and store it all in variables in the Alpha container.
$alpha['title'] = "User Administration";
//Add the style sheet
$alpha['stylesheets'][] = 'css/style.css';

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

<article class="justify border" style="width:80%">
		
	<div class='dbtable'>
  <div class='rows'>{$rows} Hits. {$hitsPerPage}</div>
  <table>
  {$tr}
  </table>
  

</div>

 </article>
  		  		  <div class='pagination'>{$navigatePage}</div>

EOD;
 
$alpha['footer1'] = <<<EOD
<footer><span class='sitefooter'>Copyright (c) Gabriel Nieva (bluetxxth@gmail.com) | <a href='https://github.com/bluetxxth'>Alpha på GitHub</a> | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;
$alpha['footer2'] = <<<EOD
<footer></footer>
EOD;


// Finally, leave it all to the rendering phase of Alpha.
include(ALPHA_THEME_PATH);