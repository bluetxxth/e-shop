<?php
/**
 * This is a Alpha pagecontroller.
 *
 */
// Include the essential config-file which also creates the $alpha variable with its defaults.
include (__DIR__ . '/config.php');

$db = new CDatabase ( $alpha ['database'] );
$films = new CFilms ( $db );
$content = new CContent ( $db );
$user = new CUser ( $db );
$textFilter = new CTextFilter ();

$genre = isset ( $_GET ['genre'] ) ? $_GET ['genre'] : null;

/*
 * Category
 */
// $category = $films->selectCategory($genre);

if($genre){
	echo $genre;
	$sql = "SELECT * FROM aMovie WHERE genre LIKE '%{$genre}%' ORDER BY $orderby $order LIMIT $hits OFFSET " .(($page - 1) * $hits);
	$params = array(
			$genre,
	);
}

/*
 * Here the movie section
 */

$res = $films->selectLatestMovies ();

// show only a portion of the text
function truncate_string($str, $length) {
	if (!(strlen ( $str ) <= $length)) {
		$str = substr ( $str, 0, strpos ( $str, ' ', $length ) ) . '...';
	}
	
	return $str;
}

// Put results into a HTML-table
// $tr = "<tr><th>Row</th><th>Id " . $films->orderby('id') . "</th><th>Picture</th><th>Title " . $films->orderby('title') . "</th><th>Year " . $films->orderby('YEAR') . "</th><th>Genre</th></tr>";

$movieHtml = null;
$synopsys = null;
// $tr1 = "<p><tr><th>Latest Films</th><th></p>";

foreach ( $res as $key => $val ) {
	
	// trunkate the synopsys parameter
	$synopsis = truncate_string ( $val->synopsis, 20 );
	// here will go the orderby statement
	
	// $image.="<a href='movie_single.php?id={$movie->id}'><img src='img.php?src={$movie->image}&amp;width=200&amp;height=200&amp;crop-to-fit' alt='Bild'/></a>";
	
	$movieHtml .= "<div class ='movieItems'>		
	
 				<!-- here using image -->
				<p><a href='movie.php?id={$val->id}'><img src='img.php?src={$val->img_name}&amp;width=250&amp;height=250' alt='Picture' /></a></p>
			
			 </div>";
}

/*
 * Here the Blogg section
 */

$res = $content->selectLatestBlogEntries();

// Put results into a HTML-table
// $tr = "<tr><th>Row</th><th>Id " . $films->orderby('id') . "</th><th>Picture</th><th>Title " . $films->orderby('title') . "</th><th>Year " . $films->orderby('YEAR') . "</th><th>Genre</th></tr>";

$blogEntry = null;
$blogHtml = null;

$tr2 = "<p><tr><th>Latest Blog Entries</th><th></p>";

foreach ( $res as $key => $val ) {
	
	$blogEntry = $textFilter->doFilter ( htmlentities ( $val->DATA, null, 'UTF-8' ), $val->FILTER );
	
	// truncate
	// $blogEntry = truncate_string($val -> DATA, 100);
	
	$filteredBlogEntry = truncate_string ($blogEntry, 150 );
	
	$blogHtml .= "
	<div class ='postItems'>
	<h3><a href ='blog_view.php?slug={$val -> slug}'>{$val->title}</a></h3>
	<p><b> {$val-> user}</b>
    {$val-> updated}</p>
	<div>{$filteredBlogEntry}<a href ='blog_view_full.php?slug={$val -> slug}'>(more)</a></div>

	</div>";
}

$res = $user->selectLatestUsers ();

$userHtml = null;
$img = null;

/*
 * Here the user part
 */
foreach ( $res as $key => $val ) {
	
	/* present male or female icon according to salute */
	$salute = $val->salute;

	if ($val->salute == strtolower ( "mr" )) {
		$avatar = "<img src='img.php?src=male_user_icon.jpg&amp;width=50&amp;height=50' alt='Picture with img' />";
	} else {
		$avatar = "<img src='img.php?src=female_user_icon.jpg&amp;width=50&amp;height=50' alt='Picture with img' />";
	}
	
	
	$userHtml .= "<div class ='userItems'>
	<p><a href='user.php?id={$val->id}'>$avatar</a></p>
	 {$val -> acronym}<br/>

	</div>";
}

// Do it and store it all in variables in the Alpha container.
$alpha ['title'] = "Home";

$alpha ['above'] = <<<EOD

<a href="http://www.student.bth.se/~gani13/oophp/Kmom01/webroot/me.php">Kmom1</a> 

EOD;

$alpha ['header'] = <<<EOD
<img class='sitelogo' src='img.php?src=reel_logo.jpg&amp;width=120&amp;height=120' alt='Picture' />
<span class='sitetitle'>REALREEL</span>
<span class='siteslogan'>Your movie partner</span>
EOD;

$alpha ['main'] = <<<EOD
	
	<div id = 'mainWrapper'>
	
			<!--categories-->
			<div class ='categories'>
				<div id = 'category'>
					<h3>Categories</h3>
					<!-- provide the ?genre=Action -->
					<a href="movies.php?genre=Action" style="color:#000;"> Action </a>
					<a href="movies.php?genre=Adventure" style="color:#000;">| Adventure </a>
					<a href="movies.php?genre=Animation" style="color:#000;">| Animation </a>
					<a href="movies.php?genre=Biography" style="color:#000;">| Biography </a>
					<a href="movies.php?genre=Comedy" style="color:#000;">| Comedy </a>
					<a href="movies.php?genre=Crime" style="color:#000;">| Crime </a>
					<a href="movies.php?genre=Drama" style="color:#000;">| Drama </a>
					<a href="movies.php?genre=Fantasy" style="color:#000;">| Fantasy </a>
					<a href="movies.php?genre=Horror" style="color:#000;">| Horror </a>
					<a href="movies.php?genre=Mystery" style="color:#000;">| Mystery </a>
					<a href="movies.php?genre=Romance" style="color:#000;">| Romance </a>
					<a href="movies.php?genre=Sci-fi" style="color:#000;">| Sci-fi </a>
					<a href="movies.php?genre=Thriller" style="color:#000;">| Thriller </a>
				</div>
			</div>
		
		<div class ='categories'>
			<h3>Users</h3>
			<div id = 'userWrapper'>
			<div id = 'mainUsers'>
				<p>{$userHtml}</p>
			 </div>	
			 </div>
		</div>	
			
		<div class ='categories'>
			<!-- movies-->	
			<div id = 'categoryWrapper'>
				<div id = 'mainMovies'>
						<h3>Movies</h3>
						 {$movieHtml}
				</div>
			</div>
		 </div> 	
					
			<!-- posts-->
		<div class ='categories'>
		
				<h3>Posts</h3>
				{$blogHtml}
			
		</div>
	
</div>
					
	
EOD;

$alpha ['footer1'] = <<<EOD
<footer><span class='sitefooter'>Copyright (c) Gabriel Nieva (bluetxxth@gmail.com) | <a href='https://github.com/bluetxxth'>Alpha på GitHub</a> | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;
$alpha ['footer2'] = <<<EOD
<footer></footer>
EOD;

// Finally, leave it all to the rendering phase of Alpha.
include (ALPHA_THEME_PATH);