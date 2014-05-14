<?php


$str = "Aliquam odio eros, consectetur eu euismod faucibus, venenatis lobortis nulla. Pellentesque libero massa, bibendum in tempus ut, pretium et ante. In bibendum volutpat porta. ";

echo substr($str, 0, 150);


function truncate_string($str, $length) {
	if (!(strlen($str) <= $length)) {
		$str = substr($str, 0, strpos($str, ' ', $length)) . '...';
	}

	return $str;
}

echo truncate_string($str, 100);


//
//encryption with md5 and salt
//


//encrypt first password

$salt = 1385042948;

$password1 = "test";

$encrytedPassword1 = md5($password1.$salt);

echo " encrtypted password1: " . $encrytedPassword1;

//encrypt second password

$password2 = "test";

$encrytedPassword2 = md5($password2.$salt);

echo " encrtypted password2: " . $encrytedPassword2;


//encrypt third password

$password3 = "test";

$encrytedPassword3 = md5($password3.$salt);

echo " encrtypted password3: " . $encrytedPassword3;


//encrypt fourth password

$password4 = "test";

$encrytedPassword4 = md5($password4.$salt);

echo " encrtypted password4: " . $encrytedPassword4;
