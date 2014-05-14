<?php
	//this shows the times the page is viewed
		if(isset($_SESSION['views']))
		$_SESSION['views']=$_SESSION['views']+1;
		else
		$_SESSION['views']=1;
	?> 

	<?php if(isset($pageTimeGeneration)) : ?>
	Page generated in <?php echo round(microtime(true)-$pageTimeGeneration, 5); ?> seconds
	<?php endif; ?>
	
	<?php echo "Views:". $_SESSION['views']; ?> 