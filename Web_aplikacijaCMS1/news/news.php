<?php
if(isset($_SESSION['id'])) {
	
$connection = "connect.php";
if(file_exists($connection)) {
	
	
	include_once($connection);
	
}
else {
	
	
	die("FATAL ERROR! There wan an error in system, soon we will be available! <br>");
	
	
}
	
	
?>
<!DOCTYPE htmk>
<html>

  <head>
        <title>Web-aplikacija</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width= device-width , initial-scale=1.0"/>
   
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Open+Sans"/>
  </head>
  
  <body>
  <section class="section3">
    <div class="news1">
	<?php
	
	
	$qKor = "SELECT * FROM `korisnici` WHERE `id` = :id";
	$korisnici = $connect->prepare($sql);
	$korisnici->execute(array(
	
	':id' => $_SESSION['id']
	
	));
	$fkorisnici = $korisnici->fetchAll(PDO::FETCH_OBJ);
	foreach($fkorisnici as $kor) {
		
		$username = $kor->username; 
		
	}
	
   		
	
		
	
	if(isset($_GET['id'])) {
		
	$sql = "SELECT * FROM `vijesti` WHERE `id` = :id";
	$vijesti = $connect->prepare($sql);
	$vijesti->execute(array(
	
	':id' => $_GET['id']
	
	));
	$fvijesti = $vijesti->fetchAll(PDO::FETCH_OBJ);
	foreach($fvijesti as $v){
		
		$news_id = $v->id; 
		
		echo "<div class='news2'>";
		echo "<img src='news/". $v->image."'/>";
		echo "<h2>". $v->subject ."</h2>"; 
		
			//Kreiranje parametara za brisanje vijesti
	 
		
		$qKor = "SELECT * FROM `korisnici` WHERE `id` = :id";
		$korisnici = $connect->prepare($qKor);
		$korisnici->execute(array(
		
		':id' => $_SESSION['id']
		
		));
		$fkorisnici = $korisnici->fetchAll(PDO::FETCH_OBJ);
		foreach($fkorisnici as $kor) {
			
			$username = $kor->username; 
			
			
		}
	
		
		if($username == "admin89") {
			

		echo "<a href='index.php?file=deletenews&id=" . $news_id ."'><button type='submit' name='submit' class='submit1'>Delete news</button></a>";
		
		
		}
		
		
		
		
		
		
		echo "<p>" . $v->tekst ."</p>";		
		echo "<hr>";
		echo "<p><small>Dodaj svoj komentar: </small></p>"; 

	
	  
	
		 
		//Kreiranje parametara za ispisivanje komentara 
		
		 $query = "SELECT * FROM `komentari` WHERE `vijesti_id` = :id";
         $komentari = $connect->prepare($query);
         $komentari->execute(array(
		 
		 ':id' => $_GET['id']
		 
		 ));	
     
        $fkomentari = $komentari->fetchAll(PDO::FETCH_OBJ);
        foreach($fkomentari as $kom) {
			
			$vijesti_id = $kom->id; 
			
		}		

		
		
		$query = "SELECT 
		 
		  `komentari`.`id` as `komentari_id` , 
		  `komentari`.`user_id` as `komentari_user_id` , 
		  `komentari`.`user_name` as `komentari_user_name` , 
		  `komentari`.`tekst` as `komentari_tekst` , 
          `komentari`.`datum` as `komentari_datum` , 
		  `komentari`.`vijesti_id` as `komentari_vijesti_id` ,

          `korisnici`.`id` as `korisnici_id` , 
    	  `korisnici`.`username` as `korisnici_username` ,
		  
		  `vijesti`.`id` as `vijesti_id`

          FROM `korisnici` , `komentari` , `vijesti` 

          WHERE `korisnici`.`id` = `komentari`.`user_id`  
          AND 	`korisnici`.`username` = `komentari`.`user_name`
		  AND   `vijesti`.`id` = `komentari`.`vijesti_id`

          GROUP BY `komentari`.`id`
          ORDER BY `komentari`.`datum` ASC		  

		";
		$komentari = $connect->query($query);
		$fkomentari = $komentari->fetchAll(PDO::FETCH_OBJ);
		foreach($fkomentari as $kom) {
		$vijesti_id = $kom->komentari_vijesti_id;
		$user_id = $kom->komentari_user_id; 
		$kom_id = $kom->komentari_id; 
		$user_name = $kom->korisnici_username;
		
		if($vijesti_id == $_GET['id']) {	
		echo "<div class='comment-box'>";	
		echo "<b>". $kom->komentari_user_name ."</b>";
        echo "<p>". $kom->komentari_tekst ."</p>";
        echo "<small>". $kom->komentari_datum ."</small>";	
		

		//Kreiranje parametara za brisanje komentara 
		
		$qKor = "SELECT * FROM `korisnici` WHERE `id` = :id";
		$korisnici = $connect->prepare($qKor);
		$korisnici->execute(array(
		
		':id' => $_SESSION['id']
		
		));
		$fkorisnici = $korisnici->fetchAll(PDO::FETCH_OBJ);
		foreach($fkorisnici as $kor) {
			
			$username = $kor->username; 
			
			
		}
	
		
		if($user_id == $_SESSION['id'] || $username == "admin89") {
			

		echo "<a href='index.php?file=deletecom&id=" . $kom_id ."&vijestiId=". $vijesti_id ."'><button type='submit' name='submit' class='submit1'>Delete</button></a>";
		
		
		}
		
        echo "</div>";
		}
        }		

		
		
		
		//Ucitavanje komentara u bazu podataka 
		
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
		
		':id' => $_GET['id']
		
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
		':vijesti_id' => $_GET['id']
		

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
		echo "<div class='refresh'>";
		echo "<p> Refresh your page if you want to see your comment</p>";
		echo "</div>"; 
			
	}
	
	
	
	
}
	
		?>
		<form method="POST" action="">
		<textarea name="comment" cols="77" rows="4" placeholder=" Do you have comment about this?"required></textarea>
		<br>
		<br>
		<input type="submit" value="Post comment" name="submit" class="submit"/>
		</form>
	
		<?php
		echo "</div>";
	  
	
	
	
	}
	}
	
	else {
		
		
		
	}

	?>
    </div>
  </section>
  
     
  
  </body>


</html>
<?php
}
else {
	
	
	?>
		<h2 class="error">WARNING!! That page is not available for you!</h2>
		<?php
}

