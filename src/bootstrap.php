<?php
/**
 * Bootstrapping functions, essential and needed for Alpha to work together with some common helpers. 
 *
 */
 
/**
 * Default exception handler.
 *
 */
function myExceptionHandler($exception) {
  echo "Alpha: Uncaught exception: <p>" . $exception->getMessage() . "</p><pre>" . $exception->getTraceAsString(), "</pre>";
}
set_exception_handler('myExceptionHandler');
 
 
/**
 * Autoloader for classes.
 *
 */
function myAutoloader($class) {  
  $path = ALPHA_INSTALL_PATH . "/src/{$class}/{$class}.php";
  $path2 = ALPHA_INSTALL_PATH . "/src/CDice/{$class}.php";
  $path3 = "{$class}.php";
  //$path = "{$class}.php";  
  if(is_file($path)) {
    include($path);
  } else if (is_file($path2)) {
    include($path2);
  } else if (is_file($path3)) {
    include($path3);
  } else {
    throw new Exception("Classfile '{$class}' does not exists.");
  }
} 
spl_autoload_register('myAutoloader');