<?php
/**
 * This is a Alpha page controller.
 *
 */
// Include the essential config-file which also creates the $alpha variable with its defaults.
include (__DIR__ . '/config.php');

isset($_SESSION['user']) or header('Location: login.php');

/**
 * Create a link to the content, based on its type.
 *
 * @param object $content
 *        	to link to.
 * @return string with url to display content.
 */
function getUrlToContent($content) {
	switch ($content->TYPE) {
		case 'page' :
			return "page.php?url={$content->url}";
			break;
		case 'post' :
			return "blog.php?slug={$content->slug}";
			break;
		default :
			return null;
			break;
	}
}

// Connect to a MySQL database using PHP PDO
$db = new CDatabase ( $alpha ['database'] );

// Get all content
$sql = '
  SELECT *, (published <= NOW()) AS available FROM aContent;';

$res = $db->ExecuteSelectQueryAndFetchAll ( $sql );


// Put results into a list
$items = null;
foreach ($res as $key => $val ){
	$items .= "<li>{$val->TYPE} (" . (! $val->available ? 'not ' : null) . "published): " . htmlentities ($val->title, null, 'UTF-8') . 
	" (<a href='blog_edit_single.php?id={$val->id}'>edit</a> <a href='" . getUrlToContent ( $val ) . "'>show</a>
		 <a href='delete.php?id={$val->id}'>delete</a>) </li>\n" ;
}



// Do it and store it all in variables in the Alpha container.
$alpha ['title'] = "Edit blog content";

$alpha ['debug'] = $db->Dump ();

$alpha ['above'] = <<<EOD

<a href="http://www.student.bth.se/~gani13/oophp/Kmom01/webroot/me.php">Kmom1</a> 
<a href="http://www.student.bth.se/~gani13/oophp/Kmom02/webroot/me.php">Kmom2</a> 
<a href="http://www.student.bth.se/~gani13/oophp/Kmom03/webroot/me.php">Kmom3</a> 
<a href="http://www.student.bth.se/~gani13/oophp/Kmom04/webroot/me.php">Kmom4</a> 
<a href="http://www.student.bth.se/~gani13/oophp/Kmom05/webroot/me.php">Kmom5</a> 
<a href="http://www.student.bth.se/~gani13/oophp/Kmom06/webroot/me.php">Kmom6</a> 
<a href="http://www.student.bth.se/~gani13/oophp/Kmom07/webroot/me.php">Kmom7</a> 

EOD;

$alpha ['header'] = <<<EOD
<img class='sitelogo' src='img.php?src=reel_logo.jpg&amp;width=120&amp;height=120' alt='Picture' />
<span class='sitetitle'>REALREEL</span>
<span class='siteslogan'>Your movie partner</span>
EOD;


// //get some parameters
// $showAll = isset($_POST['showAll']) ? $_POST['showAll']: null;
// $reset = isset($_POST['resetdb']) ? $_POST['resetdb']: null;
// $create = isset($_POST['create']) ? $_POST['create']: null;

// if($showAll){
	
// }

// $htmlButtons = null;

// $htmlButtons .='<p><form method="post">
//     <input type="submit" name="showAll" value="show all" onclick= window.location ="blog.php">
//     <input type="submit" name="resetdb" value="reset" onclick= window.location ="reset.php>
// 	<input type="submit" name="create new" value="new" onclick= window.location ="create.php>
//     </form></p>';

$alpha ['main'] = <<<EOD
<h1>{$alpha['title']}</h1>

<p>A list of all the content in the database</p>

<ul>
	{$items}
</ul>

<p><a href ='blog_view.php'>Show all the blog posts. </a></p>
<p><a href ='reset.php'>Reset. </a></p>
<p><a href ='create.php'>Create a new page </a></p>
			
EOD;

$alpha ['footer1'] = <<<EOD
<footer><span class='sitefooter'>Copyright (c) Gabriel Nieva (bluetxxth@gmail.com) | <a href='https://github.com/bluetxxth'>Alpha på GitHub</a> | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;
$alpha ['footer2'] = <<<EOD
<footer></footer>
EOD;

// Finally, leave it all to the rendering phase of Alpha.
include (ALPHA_THEME_PATH);