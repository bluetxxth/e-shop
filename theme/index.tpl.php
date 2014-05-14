<!doctype html>
<html class='no-js' lang='<?= $lang ?>'>


<head>
<!-- gral <head> code -->
<meta charset='utf-8' />
<title><?= get_title($title) ?></title>

<!-- favicon -->
<?php

if (isset ( $favicon )) :
	?><link rel='shortcut icon' href='<?= $favicon?>' />

<?php
endif;
?>

<!-- extract from array of stylesheets -->
<?php
foreach ( $stylesheets as $val ) :
	?>
<link rel='stylesheet' type='text/css' href='<?= $val ?>' />
<?php
endforeach
;
?>

<!-- modernizr-->
<script src='<?= $modernizr ?>'></script>

</head>

<body>
	<div id='pagewrapper'>

		<!-- menu section-->
		<div id='menuwrapper'>

			<!-- above menu removed below -->

			<!-- Header -->
			<div id='header'><?= $header?>
    
       <!-- Search field and separator -->
				<div id='menuHolder'></div>
				<nav class='navbar1'><?= CNavigation::GenerateMenu1($navbar1, $above)?></nav>

			</div>
			<!--navigation-->
			<div id='searchwrapper'>
				<nav class='navbar2'><?= CNavigation::GenerateMenu2($navbar2, $above)?> 
			
				</nav>


				<div id='searchHolder'>
				
				<!-- set up parameter -->
				<?php $title = isset ( $_GET ['title'] ) ? $_GET ['title'] : null;?>
				
					<!-- pass parameter with form -->
					<form method="get" action="movies.php">
						<input type='search' name='title' value='<?php $title?>'/> 
					</form>
					
					
				</div>
				<!-- end searchHolder -->
			</div>


			<!-- end searchwrapper-->

		</div>
		<!-- end menu section-->


		<!-- main section-->
		<div id='main'><?=$main?></div>

		<!-- footer section-->
		<div id='footerwraper'>

			<!-- include by line removed below -->


			<div id='footer1'><?= $footer1 ?></div>
			<div id='footer2'><?= $footer2 ?></div>
			<div id='footer3'>
			
				<span class='footer'>REALREEL</span>
			
		
	 <!--Counter-->
	 <br/>
       <?php  include("../incl/counter.php");?>
        </div>
	
		<!--end footer section -->

	</div>

	<!-- jquery-->
  <?php
		if (isset ( $jquery )) :
			?><script src='<?= $jquery ?>'></script>
		
		<?php
endif;
		?>

  
  <!-- misc javascript files-->
  <?php
		if (isset ( $javascript_include )) :
			foreach ( $javascript_include as $val ) :
				?>
       <script src='<?= $val ?>'></script>
  <?php
			endforeach
			;
		
		
endif;
		?>
 
  <!-- google analytics-->
  <?php
		if (isset ( $google_analytics )) :
			?>
       <script>
          var _gaq=[['_setAccount','<?= $google_analytics ?>'],['_trackPageview']];
          (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
          g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
          s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
  
		
		<?php
endif;
		?>

 </div>
  </body>
</html>