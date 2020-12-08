<?php 
if(isset($_SESSION['id'])) {
	
$connection = "connect.php";
if(file_exists($connection)) {
	
	
	include_once($connection);
	
}

else {
	
	
	die("FATAL ERROR! There wan an error in system, soon we will be available! <br>");
	
	
}

include_once("news.php");


$error = ""; 

if(isset($_POST['submit'])) {
	
	if(!empty($_POST['comment'])) {
		
		
		$comment = $_POST['comment']; 
		
		
	}
	else {
		
		
		$error .= "For post you must have comment! <br>";
	}
	
    $sql = "SELECT * FROM `korisnici` WHERE `id` = :id";
	$korisnici = $connect->prepare($sql);
	$korisnici->execute(array(
	
	':id' => $_SESSION['id']
	
	));
	$fkorisnici = $korisnici->fetchAll(PDO::FETCH_OBJ);
	foreach($fkorisnici as $kor){
	
	 $username = $kor->username ; 
	 $user_id = $kor->id; 
	
		
	}
	$qVijesti = "SELECT * FROM `vijesti`";
	$vijesti = $connect->query($qVijesti);
	$fvijesti = $vijesti->fetchAll(PDO::FETCH_OBJ);
	foreach($fvijesti as $v) {
		
		$vijesti_id = $v->id; 
		
	}
	
	
	
	
	
	
	
	$datum = date("y-m-d");
	if($error == "") {
		
		
		$query = "SELECT * FROM `vijesti` WHERE `id` = :id";
		$komentari = $connect->prepare($query);
		$komentari->execute(array(
		
		':id' => 
		
		));
		$fkomentari = $komentari->fetchAll(PDO::FETCH_OBJ);
		foreach($fkomentari as $kom) {
			
			$id = $kom->id; 
			
			
		}

		
		
		
		
		$sql = "INSERT INTO `komentari` SET 
		
		`user_id` = :userid , 
		`user_name` = :username , 
		`tekst` = :komentar ,
        `datum` = :datum ,
		`vijesti_id` = :vijesti_id
      	

		";
		$komentar = $connect->prepare($sql);
		$komentar->execute(array(
		
		':userid' => $user_id , 
		':username' =>$username , 
		':komentar' => $comment ,
		':datum' => $datum  , 
		':vijesti_id' => 
		

		));
		
		$sql = "SELECT * FROM `vijesti` WHERE `id` = :id";
		$vijesti = $connect->prepare($sql);
		$vijesti->execute(array(
		
		':id' => $_SESSION['id']
		
		));
		$fvijesti = $vijesti->fetchAll(PDO::FETCH_OBJ);
		foreach($fvijesti as $v) {
			
			$id = $v->id; 
			
		}
		


		//header("Location: index.php?file=news&id='". $_GET['id'] ."'");
		
		
	}
	
	
	
	
}























}
else {
	
	
	echo "ERROR! <br>";
	
}