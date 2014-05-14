<?php 

/**
 * This is a Alpha pagecontroller.
 *
 */
// Include the essential config-file which also creates the $alpha variable with its defaults.
include(__DIR__.'/config.php'); 
// include(__DIR__.'/filter.php'); 

$alpha['stylesheets'][] = 'css/blog.css';


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

//truncation
$specialActions= new CSpecialActions();


// Get parameters 
$slug    = isset($_GET['slug']) ? $_GET['slug'] : null;
$slugSql = $slug ? 'slug = ?' : '1';
$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;
$update   = isset($_GET['update']) ? $_GET['update'] : null;
$create    = isset($_GET['create']) ? $_GET['create'] : null;
$delete = isset($_GET['delete']) ? $_GET['delete'] : null;
$editall   = isset($_GET['editall']) ? $_GET['editall'] : null;
$id     = isset($_POST['id'])    ? strip_tags($_POST['id']) : (isset($_GET['id']) ? strip_tags($_GET['id']) : null);
$btnUpdate   = isset($_GET['update']) ? $_GET['update'] : null;
$btnCreate   = isset($_GET['create']) ? $_GET['create'] : null;
$btnEditall   = isset($_GET['editall']) ? $_GET['editall'] : null;
$btnDelete   = isset($_GET['delete']) ? $_GET['delete'] : null;


// Get parameters for sorting
$hits  = isset($_GET['hits']) ? $_GET['hits'] : 8;
$page  = isset($_GET['page']) ? $_GET['page'] : 1;

//get parameters for order
$orderby  = isset($_GET['orderby']) ? strtolower($_GET['orderby']) : 'updated';
$order    = isset($_GET['order'])   ? strtolower($_GET['order'])   : 'desc';


// Check that incoming is valid
is_numeric($hits) or die('Check: Hits must be numeric.');
is_numeric($page) or die('Check: Page must be numeric.');

// Get max pages for current query, for navigation
//$sql = "SELECT COUNT(id) AS rows FROM aContent";
// Get all content
$sql = 'SELECT *, (published <= NOW()) AS rows FROM aContent;';

$res = $db->ExecuteSelectQueryAndFetchAll($sql);
$rows = $res[0]->rows;
$max = ceil($rows / $hits);


//set blogContent
$blog-> setSlug($slug);
$blog-> setSlugSql($slugSql);

//query result
$res = $blog -> getPaginatedBlogContent($hits, $page, $orderby, $order);
$hitsPerPage = $content->getHitsPerPage(array(2, 4, 8), $hits);
$navigatePage = $content->getPageNavigation($hits, $page, $max);


  



// $form = '		 <form method="get"> 
				  // <p><input type="submit" name="update" value="Update" class="button"/></p>
			  	  // <p><input type="submit" name="editall" value="Edit all" class="button"/></p>
			  	  // <p><input type="submit" name="create" value="Create" class="button"/></p>
				  // <p><input type="submit" name="delete" value="Delete" class="button"/></p>
				// </form>';
				
$btnUpdate = '<input type="submit" name="update" value="Update" class="button"/>';
$btnEditAll= '<input type="submit" name="editall" value="Edit all" class="button"/>';
$btnCreate = '<input type="submit" name="create" value="Create" class="button"/>';
$btnDelete = '<input type="submit" name="delete" value="Delete" class="button"/>';
						
				


$output = null;
  foreach($res as $key  => $c) {
  	
    // Sanitize content before using it.
    $title  = htmlentities($c->title, null, 'UTF-8');
    $author = htmlentities($c->user, null, 'UTF-8');
    $created=htmlentities($c->created, null, 'UTF-8'); 
    $data   = $filter->doFilter(htmlentities($c->DATA, null, 'UTF-8'), $c->FILTER);
    $published = htmlentities($c->published, null, 'UTF-8');
    $created = htmlentities($c->created, null, 'UTF-8');
    $updated = htmlentities($c->updated, null, 'UTF-8');
	$content_id    = htmlentities($c->id, null, 'UTF-8');
	
	//truncate text string
	$excerpt = $specialActions->truncate_string($c->DATA, 200);
	

	$output .= " <div class = 'newsResult'><div class = 'title'><a href = 'blog_view_full.php?slug={$c -> slug}'>{$title}</a></div> <div class='updated'>{$updated}</div> <div class  ='user'><a href='user.php?id={$id}'> {$author}</a></div><div class = 'data'>{$excerpt} <a href = 'blog_view_full.php?slug={$c -> slug}'>...(more)</a></div> <div class = 'blogButton' ><a href='blog_edit_single.php?id={$c->id}'>Update</a></div> <div class = 'blogButton' ><a href='create.php?id={$c->id}'>Create</a> </div><div class = 'blogButton' ><a href='blog_edit_multi.php?id={$c->id}'>Edit all</a></div><div class = 'blogButton' ><a href='delete.php?id={$c->id}'>Delete </a></div></div> ";
	
}

 
// Do it and store it all in variables in the Alpha container.
$alpha['title'] = "News";
$alpha['debug'] = $db -> Dump();


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

			<section>	
		<article class="justify border" style="width:80%">
				 {$hitsPerPage} 
					{$output}
					{$navigatePage}		
				</article>
					
			</section>
			
EOD;
					
 
$alpha['footer1'] = <<<EOD
<footer><span class='sitefooter'>Copyright (c) Gabriel Nieva (bluetxxth@gmail.com) | <a href='https://github.com/bluetxxth'>Alpha på GitHub</a> | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;

$alpha['footer2'] = <<<EOD
<footer></footer>
EOD;


// Finally, leave it all to the rendering phase of Alpha.
include(ALPHA_THEME_PATH);