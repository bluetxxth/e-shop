<?php
/**
 * Config-file for Alpha. Change settings here to affect installation.
 *
 */
 
/**
 * Set the error reporting.
 *
 */
error_reporting(-1);              // Report all type of errors
ini_set('display_errors', 1);     // Display all errors 
ini_set('output_buffering', 0);   // Do not buffer outputs, write directly
 
 
/**
 * Define Alpha paths.
 *
 */
define('ALPHA_INSTALL_PATH', __DIR__ . '/..');
define('ALPHA_THEME_PATH', ALPHA_INSTALL_PATH . '/theme/render.php');

 
/**
 * Include bootstrapping functions.
 *
 */
include(ALPHA_INSTALL_PATH . '/src/bootstrap.php');
 
/**
 * Start the session.
 *
 */
session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
session_start();


/**
 * Create the Alpha variable.
 *
 */
$alpha = array();
 
/**
 * Site wide settings.
 *
 */
$alpha['lang']         = 'sv';
$alpha['title_append'] = ' | Alpha en webbtemplate';

/**
 * Theme related settings.
 *
 */
//$alpha['stylesheet'] = 'css/style.css';
$alpha['stylesheets'] = array('css/style.css');
$alpha['favicon']    = './img/favicon.ico';



/*
 *Navigation bar 1
*/
$alpha['navbar1'] = array(
//  'login' => array('text' => 'Login', 'url' => 'login.php?p=login')
//     'logout' => array('text' => 'Logout', 'url' => 'logout.php?p=logout')
//  	'create' => array('text' => 'Create', 'url' => 'user_create.php?p=createUser'),
//  		'admin' => array('text' => 'Admin', 'url' => 'admin.php?p=admin')
//   'source' => array('text'=>'Source', 'url'=>'source.php?p=source')

);


//create the create menu links for menu 1
$alpha['user_create'] = array('text' => 'Create', 'url' => 'user_create.php?p=user_create');
$alpha['admin'] = array('text' => 'Admin', 'url' => 'admin.php?=p=admin');
$alpha['login'] = array('text' => 'Logout', 'url' => 'logout.php?p=logout');
$alpha['logout'] = array('text' => 'Login', 'url' => 'login.php?p=login');


 //append create and admin menu links
 $acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;
 
 if($acronym){
  
 	array_push($alpha['navbar1'], $alpha['admin']);
 	array_push($alpha['navbar1'], $alpha['login']);
 	array_push($alpha['navbar1'], $alpha['user_create']);
 	
 }else{

 	array_push($alpha['navbar1'], $alpha['user_create']);
 	array_push($alpha['navbar1'], $alpha['logout']);
 }

 
 /**
  * Settings for the database.
  *
  */
 $alpha['database']['dsn']            = 'mysql:host=localhost;dbname=gani13;';
 $alpha['database']['username']       = '';
 $alpha['database']['password']       = '';
 $alpha['database']['driver_options'] = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");
 
$db = new CDatabase($alpha['database']);
$basket = new CMyShoppingCart($db);
 

//create shopping cart menu link
$alpha['shopping_cart']  = array('text' =>'Shopping cart', 'url' => 'shopping_cart.php?n=shopping_cart');

 /*
  *Navigation bar 2
 */
 $alpha['navbar2'] = array(
 		'home'  => array('text'=>'Home',  'url'=>'index.php?n=home'),
 		'movies' => array('text' => 'Movies', 'url' => 'movies.php?n=movies'),
 		'news' => array('text' => 'News', 'url' => 'blog_view.php?n=news'),
 		'about' => array('text' =>'About us', 'url' => 'about.php?n=about'),
//  	'source' => array('text'=>'Source', 'url'=>'source.php?p=source')
 
 );
 
 //append cart menu link
 if(!$basket-> isEmpty()){
 	array_push($alpha['navbar2'], $alpha['shopping_cart']);
 }
 

/**
 * Settings for JavaScript.
 */
 //for modernizr
$alpha['modernizr'] = './js/modernizr.js';

//for jquery
$alpha['jquery'] = '//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js';
//$alpha['jquery'] = null; // To disable jQuery

//For my own javascript files
$alpha['javascript_include'] = array();
//$alpha['javascript_include'] = array('js/main.js'); // To add extra javascript

// Add js/main.js for inklusion
$alpha['javascript_include'][] = 'js/main.js';
$alpha['javascript_include'][] = 'js/other.js';

/**
 * Google analytics.
 *
 */
$alpha['google_analytics'] = 'UA-22093351-1'; // Set to null to disable google analytics