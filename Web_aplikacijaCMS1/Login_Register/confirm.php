<?php 


$connection = "connect.php";
if(file_exists($connection)) {
	
	
	include_once($connection);
	
}
else {
	
	
	die("FATAL ERROR! There wan an error in system, soon we will be available! <br>");
	
	
}


if(!isset($_GET['email']) && !isset($_GET['code'])) {
	
	echo "Your confirmed is unseccessful <br>";
	
}
else {
	
	$email = $_GET['email'];
	$code = $_GET['code'];
	
	$sql = "SELECT * FROM `korisnici` WHERE `email` = :email AND 
	`user_code` = :code AND `email_confirm` = :zero";
	$confirm = $connect->prepare($sql);
	$confirm->execute(array(
	
	':email' => $email , 
	':code' => $code , 
	':zero' => 0
	
	
	));
	if($confirm->rowCount() > 0) {
		
		$sql = "UPDATE `korisnici` SET `email_confirm` = :one WHERE `email` = :email
		AND `user_code` = :code";
		$confirmed = $connect->prepare($sql);
		$confirmed->execute(array(
		
		':one' => 1 , 
		':email' => $email , 
		':code' => $code
		
		
		));
		
		echo "Successfully confirmed email adress, please:<a href='index.php?file=login'>LOG IN</a>";
		
	}
	else {
		
		echo "Your confirmed is unseccessful <br>";
		
	}
	
}
