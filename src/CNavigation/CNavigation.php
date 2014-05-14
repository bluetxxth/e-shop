 <?php

 //----------------------------------------------
 //
 //
 //----------------------------------------------
class CNavigation {
	
	
  public static function GenerateMenu1($items, $class) {
    $html = "<nav class='$class'>\n";
    foreach($items as $key => $item) {
      $selected = (isset($_GET['p'])) && $_GET['p'] == $key ? 'selected' : null; 
      $html .= "<a href='{$item['url']}' class='{$selected}'>{$item['text']}</a>\n";
    }
    $html .= "</nav>\n";
    return $html;
  }
  
  
//   /**
//    * Create HTML for a navbar.
//    */
//   public static function GenerateMenu1($items, $id) {
//   	$p = basename($_SERVER['SCRIPT_NAME'], '.php');
//   	foreach($items as $key => $item) {
//   		$selected = ($p == $key) ? " class='selected'" : null;
//   		@$html .= "<a href='{$item['url']}'{$selected}>{$item['text']}</a>\n";
//   	}
//   	return "<nav id='$id'>\n{$html}</nav>\n";
//   }
  
  
  
  
  public static function GenerateMenu2($items, $class) {
  	$html = "<nav class='$class'>\n";
  	foreach($items as $key => $item) {
  		$selected = (isset($_GET['n'])) && $_GET['n'] == $key ? 'selected' : null;
  		$html .= "<a href='{$item['url']}' class='{$selected}'>{$item['text']}</a>\n";
  	}
  	$html .= "</nav>\n";
  	return $html;
  }
  
  
  
};