<?php
/**
 * This is a Alpha pagecontroller.
 *
 */
// Include the essential config-file which also creates the $alpha variable with its defaults.
include (__DIR__ . '/config.php');

// Add the style sheet
$alpha ['stylesheets'] [] = 'css/tables.css';

// Connect to MySQL database using PHP PDO
$db = new CDatabase ( $alpha ['database'] );
// shopping cart
$basket = new CMyShoppingCart ( $db );

// instantiate the film class
$films = new CFilms ( $db );

// get some parameters
$acronym = isset ( $_SESSION ['user'] ) ? $_SESSION ['user']->acronym : null;
$proceed = isset ( $_GET ['proceed'] ) ? strip_tags ( $_GET ['proceed'] ) : null;
$cancel = isset ( $_GET ['cancel'] ) ? strip_tags ( $_GET ['cancel'] ) : null;
$continue = isset ( $_GET ['continue'] ) ? strip_tags ( $_GET ['continue'] ) : null;

// intitialize calculation variables

$vat = 0;
$total = 0;
$subtotal = 0;
$qty = 0;

// intitialize database variables
$myProductId = null;
$myName = null;
$myQty = null;
$mySubtotal = null;
$myVat = null;
$myTotal = null;
$output = null;
$tr_totals = null;


$cartIsEmpty = $basket -> isEmpty();

if($cartIsEmpty){
	header('Location: shopping_cart_empty.php ');
}

// get all the contents of the ACart
$sql = "SELECT * FROM aCart";
$params = array ();

$res = $db->ExecuteSelectQueryAndFetchAll ( $sql, $params );


if (isset ( $_SESSION ['user'] )) {
	
	// Put results into a HTML-table (table header) - WITH edit and delete options
	$tr = "<tr><th>Id " . "</th><th>Picture</th><th>Title " . $films->orderby ( 'title' ) . "</th><th>Year " . $films->orderby ( 'YEAR' ) . "</th><th>Genre" . " </th><th>Price</th><th>Qty</th><th>Remove</th></tr>";
	
	foreach ( $res as $key => $val ) {
		
		// Put results into a HTML-table (table cells) - WITH edit and delete options
		$tr .= "<tr><td>{$val->product_id} </td><td><a href='movie.php?id={$val->product_id}'><img src='img.php?src={$val->image}&amp;width=50&amp;height=50' alt='Picture'/> </a></td><td><a href='movie.php?id={$val->product_id}'>{$val->title}</a></td><td>{$val->YEAR}</td><td>{$val->genre}</td> <td>{$val->price}Kr.</td><td>{$val->Qty}</td><td><a href='shopping_cart_delete_item.php?id={$val->id}'> <img src='img.php?src=remove_icon.png&amp;width=35&amp;height=35' alt='Picture'/></a></td></tr>";
		
		// calculate total
		$subtotal += ($val->price * $val->Qty);
		$qty = $val->Qty;
		$myQty += $qty;
	}
	
	$vat = ($subtotal * 0.25);
	$total = ($subtotal * 0.25) + $subtotal;
	
	//$tr .= "<tr><th id='tableDivider'></th><th id='tableDivider'></th><th id='tableDivider'></th><th id='tableDivider'></th><th id='tableDivider'></th><th id='tableDivider'></th><th id='tableDivider'></th><th id='tableDivider'></th></tr>";
	 
	$tr_totals = "<tr><th>Order Summary</th><th>Ammounts</th></tr>";
	$tr_totals .= "<tr><td><b>Sub-total</b></td><td>$subtotal</td></tr>";
	$tr_totals .= "<tr><td><b>VAT</td></b><td>$vat</td></tr>";
	$tr_totals .= "<tr><td><b>Total</b></td><td>$total</td></tr>";

	
} else {
	
	// Put results into a HTML-table (table header) - WITHOUT edit and delete options
	$tr = "<tr><th>Id " . "</th><th>Picture</th><th>Title " . $films->orderby ( 'title' ) . "</th><th>Year " . $films->orderby ( 'YEAR' ) . "</th><th>Genre" . " </th><th>Price</th><th>Qty</th><th>Remove</th></tr>";
	
	$subtotal = 0;
	foreach ( $res as $key => $val ) {
		
		// Put results into a HTML-table (table cells) - WITHOUT edit and delete options
		$tr .= "<tr><td>{$val->product_id} </td><td><a href='movie.php?id={$val->product_id}'><img src='img.php?src={$val->image}&amp;width=50&amp;height=50' alt='Picture' /></a></td><td><a href='movie.php?id={$val->product_id}'>{$val->title}</a></td><td>{$val->YEAR}</td><td>{$val->genre}</td><td>{$val->price}Kr.</td><td>{$val->Qty}</td><td>delete</td></tr>";
		
		// calculate total
		$subtotal += ($val->price * $val->Qty);
	}
	$tr_totals = "<tr><th>Order Summary</th><th>Ammounts</th></tr>";
	$tr_totals .= "<tr><td><b>Sub-total</b></td><td>$subtotal</td></tr>";
	
	$tr .= "<tr><th id='total'></th><th id='total'></th><th id='total'></th><th id='total'></th><th id='total'></th><th id='total'></th><th id='total'></th><th id='total'></th></tr>";
}

if ($cancel) {
	
	$output = $basket->emptyCart ();
		header('Location: '.$_SERVER['PHP_SELF']);
		die;
}

if ($continue) {
	
	header ( 'Location: movies.php?p=movies' );
}

if ($proceed) {
	
	// get all the contents of the ACart
	$sql = "SELECT * FROM aOrder";
	$params = array ();
	
	$res = $db->ExecuteSelectQueryAndFetchAll ( $sql, $params );
	
	if ($acronym) {
		
		foreach ( $res as $key => $val ) {
			
			// $myProductId= $val->id;
			$myName = $acronym;
			$myQty = $qty;
			$mySubtotal = $subtotal;
			$myVat = $vat;
			$myTotal = $total;
		}
		
		// find out the total quatntity of items bought
		$myQty = $basket->countUniqueItems();
		
		// check the user credit
		$MyUserCredit = $basket->getUserCredit( $acronym );
		
		// check if the order surpases the use's credit
		if ($total < $MyUserCredit) {
			
			// create the order
			$output = $basket->createOrder ( $myName, $myQty, $mySubtotal, $myVat, $myTotal );
			
			// remove user credit
			$output = $basket->removeUserCredit ( $myName, $myTotal );
			
			// clear the cart
			$basket->emptyCart ();
			
			header ( 'Location: shopping_cart_order.php' );
		} else {
			
			$output = "Unable to process the order - Insuficient credit";
		}
	} else {
		header ( 'Location: login.php?p=login ' );
	}
}

// Do it and store it all in variables in the Alpha container.
$alpha ['title'] = "Your shopping-cart";

$alpha ['above'] = <<<EOD

<a href="http://www.student.bth.se/~gani13/oophp/Kmom01/webroot/me.php">Kmom1</a> 

EOD;

$alpha ['header'] = <<<EOD
<img class='sitelogo' src='img.php?src=reel_logo.jpg&amp;width=120&amp;height=120' alt='Picture' />
<span class='sitetitle'>REALREEL</span>
<span class='siteslogan'>Your movie partner</span>
EOD;

$alpha ['main'] = <<<EOD
<h1>{$alpha['title']}</h1>
 
<div id ="shoppingtable">
  <table>
	{$tr}
  </table>
</div>

<div id ="shoppingtable">
  <table id = "total">
	{$tr_totals}
  </table>
</div>

  <div id = "shoppingActions">
	  <form method="get">
		<input type ="submit" name = "proceed" value = "Proceed"  class ="button">
		<input type ="submit" name = "cancel" value = "Cancel" class ="button">
		<input type ="submit" name = "continue" value = "Continue" class ="button">		
	  </form>
  </div>
			
<br/><br/>
<h4>{$output}</h4>
 
EOD;

$alpha ['footer1'] = <<<EOD
<footer><span class='sitefooter'>Copyright (c) Gabriel Nieva (bluetxxth@gmail.com) | <a href='https://github.com/bluetxxth'>Alpha på GitHub</a> | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;
$alpha ['footer2'] = <<<EOD

EOD;

// Finally, leave it all to the rendering phase of Alpha.
include (ALPHA_THEME_PATH);