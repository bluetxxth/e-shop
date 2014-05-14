<?php  

//declarations
$str = "this var containing a string";

$newLine = "\n";

//built in functions
$float = pi();
$date = date('r');
$time = time();
$encryptedStringRot13 = str_rot13($str);
$encryptedStringMd5 = md5($str);


//use of dump()
echo "<pre>";
var_dump($str);
var_dump($float);
var_dump($date);
var_dump($time);
echo "</pre>";

echo "<pre>";
//use os strlen()
echo "the length of the string var is: ";
echo strlen($str);
echo $newLine;
//use of str_rot13();
echo 'the string variable with rot13 encryption: ' . $encryptedStringRot13;
echo $newLine;
//use of md5();
echo "the string variable with md5 encryption: " . $encryptedStringMd5;

echo "</pre>";

// require() and the constants __DIR__ and __FILE__
echo "<p>Constant __DIR__ (available from PHP 5.3) is: " . __DIR__ . "</p>";
echo "<p>Constant __FILE__ is: " . __FILE__ . "</p>";
echo "<p>Filename-part of __FILE__ is: " . basename(__FILE__) . "</p>";
echo "<p>Directory-part of __FILE__ is: " . dirname(__FILE__) . "</p>";
 
echo "<p>Lets include a file by using __FILE__ and __DIR__ to create the absolute path.</p>";
// include(dirname(__FILE__) . "/empty_file.php");
// include(__DIR__ . "/empty_file.php");

$a = 42;     // Tilldela talet 42 till en variabel
 
$a = $a + 7; // Värdet på variabeln $a + 7 tilldelas $a
$a += 7;     // Samma sak igen fast ett kortare sätt att skriva.
 
$a = $a - 7; // Värdet på variabeln $a - 7 tilldelas $a
$a -= 7;     // Samma sak igen fast ett kortare sätt att skriva.
 
$a = "<p>the magic number is: " . $a;
$a .= "</p>";
echo $a;