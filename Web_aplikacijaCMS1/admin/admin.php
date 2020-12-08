<?php 
if(isset($_SESSION['id'])) {
	
	   $sql = "SELECT * FROM `korisnici` WHERE `id` = :id";
   $korisnici = $connect->prepare($sql);
   $korisnici->execute(array(
   
   ':id' => $_SESSION['id']
   
   ));
   
   $fkorisnici = $korisnici->fetchAll(PDO::FETCH_OBJ);
   foreach($fkorisnici as $kor) {
	   
	  $username = $kor->username;
      $email = $kor->email; 	   
	   
   }
	if($username == "admin89") {
	
?>

<!DOCTYPE html>
<html>
<head>
  <head>

   <meta charset="utf-8"/>
   <meta name="viewport" content="width= device-width , initial-scale=1.0"/>
   
   <link rel="stylesheet" type="text/css" href="style.css"/>
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Open+Sans"/>
</head>
<body>
   
     <h1 class="subject-3">Administration</h1>
	 <h3 class="subject-4">POST NEWS ON SITE:</h3>
	 
    <div class="form-2">

 <?php
		
	 $error = "";

    if(isset($_POST['submit'])) {
		
	   
		$subjectnews = $_POST['subject'];
		$namenews = $_POST['name'];
		$textnews = $_POST['text'];
		$file = $_FILES['file'];
		
		if(empty($subjectnews)) {
			
			$subjectnews = "news/";
			
		}
		else {
			
			$subjectnews = strtolower(str_replace("","-",$subjectnews));
			
		}
		
		$fileName = $file['name'];
		$fileType = $file['type'];
		$fileError = $file['error'];
		$fileSize = $file['size'];
		$fileTmp = $file['tmp_name'];
		
		$fileExt = explode('.' , $fileName);
		$extension = strtolower(end($fileExt));
		
		$allowed = array("jpg","png","jpeg");
		
		if(in_array($extension , $allowed)) {
			
			if($fileError == 0) {
				
             if($fileSize < 10000000) {
				 
				 $newName = $namenews . "." . uniqid("", true) . " ." . $extension;
				 $fileDest = "news/" . $newName; 
				 move_uploaded_file($fileTmp , $fileDest);
				 
			 }
			 else {
				 
				 echo "Size of picture is not allowed! <br>";
			 }
				
				
			}
			else {
				
				
				echo "You have an error! <br>";
			}
			
		}
		else {
			
			
			
			echo "Extension is not allowed <br>";
		}
		
		if(empty($subjectnews)) {
			
			$error .= "Please enter subject news <br>";
			
		}
	
		if(empty($namenews)) {
			
			$error .= "Please enter name news <br>";
			
		}
		
		if(empty($textnews)) {
			
			$error .= "Please enter text news <br>";
			
		}
		if(empty($_POST['type'])) {
			
			$error .= "Please pick type of news <br>";
			
		}
		else {
			
			$typenews = $_POST['type'];
		}
		
		if($error == "") {
			
			       $qOrder = "SELECT * FROM `vijesti`";
					$vijest = $connect->query($qOrder);
					$rowCount = $vijest->rowCount(); 
					$order = $rowCount + 1;
			
			
			$sql = "INSERT INTO `vijesti` SET 
			
			`subject` = :subject , 
			`name` = :name , 
			`tekst` = :tekst , 
			`type` = :type , 
			`image` = :image , 
			`order_news` = :order
			
			
			
			";
			$news = $connect->prepare($sql);
			$news->execute(array(
			
			':subject' => $subjectnews , 
			':name' => $namenews , 
			':tekst' => $textnews ,
			':type' => $typenews , 
			':image' => $newName , 
			':order' => $order
			
			
			
			));
			
			echo "Successfully updated news <br>";
			
		}
		else {
			
			
			echo $error; 
		}
		
		
		
		
	}	 
		
		
		
		
    ?>
	<div class="form-3">
	
	<form method="POST" action="index.php?file=admin" enctype="multipart/form-data">
	<table>
	   
	   <tr>
	      <td>
		  Picture about news:   
		  <input type="file" name="file"/>
		  </td>
	   </tr>
	
	
	   <tr>  
		  <td><input type="text" name="subject" placeholder=" News subject"/></td>
	   </tr>
	   
	     <tr>  
		  <td><input type="text" name="name" placeholder=" News name"/></td>
	   </tr>
	   
	   <tr>
	      <td><textarea name="text" cols="60" rows="7" placeholder=" News text"></textarea></td>
	   </tr>
	
	   
	
	   <tr>
	   <td>
	   News about football 
	   <input type="radio" name="type" value="football"/>
	   </td>
	   </tr>
	   
	   <tr>
	   <td>
	   News about basketball 
	   <input type="radio" name="type" value="basketball"/>
	   </td>
	   </tr>
	   
	    <tr>
	   <td>
	   News about tennis 
	   <input type="radio" name="type" value="tennis"/>
	   </td>
	   </tr>
	   
	   
	   <tr>
	   <td><input type="submit" name="submit" value="Post news"/></td>
	   </tr>
	
	</table>
	</form>
	</div>
	</div>
	
	</body>
	</html>
	<?php	
   
		
	}
	else {
		
		
		echo "You are not admin of this site! <br>";
	}
	
	
}
else {
	
	
	?>
		<h2 class="error">WARNING!! That page is not available for you!</h2>
		<?php
}

?>