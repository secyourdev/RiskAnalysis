<?php 
// Demonstrate how to declare 
// global variable 

// Declaring global variable 
$x = "Geeks"; 
$y = "for"; 
$z = "Geeks"; 
$a = 5; 
include('Test2.php');

function concatenate() { 
	// Using global keyword 
	global $x, $y, $z; 
	return $x.$y.$z; 
} 

function add() { 
	// Using GLOBALS['var_name'] 
	$GLOBALS['b'] = $GLOBALS['a'] + $GLOBALS['b']; 
} 

// Print result 
echo concatenate(); 
echo"\n"; 
add(); 
echo $GLOBALS['b']; 
?> 
