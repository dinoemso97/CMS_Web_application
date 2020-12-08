<?php 

try {
	
	$connect = new PDO('mysql: host=localhost; dbname=web-aplikacija','root','');
	$connect->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	
	
}
catch(PDOException $e) {
	
	echo $e->getMessage(); 
	die();
	
	
}