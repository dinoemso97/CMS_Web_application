<!DOCTYPE html>
<html>
<head>

   <meta charset="utf-8"/>
   <meta name="viewport" content="width= device-width , initial-scale=1.0"/>
   
   <link rel="stylesheet" type="text/css" href="style.css"/>
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Open+Sans"/>
</head>
<body>

<div class="form">
<h1 class="subject-1">LOG IN !</h1>
<?php 
  
   $username = "";
   $pass = "";

   
   $usernameErr = "";
   $passErr = "";
   

   
    if(isset($_POST['submit'])) {
		
		if(!empty($_POST['username'])) {
			
			$sql = "SELECT * FROM `korisnici` WHERE `username` = :username";
			$korisnici = $connect->prepare($sql);
			$korisnici->execute(array(
			
			':username' => $_POST['username']
			
			));
			
			if($korisnici->rowCount() == 1) {
			
				$username = $_POST['username'];
			}
			else if($korisnici->rowCount() >= 2	){
				
				$usernameErr .= "There was an mistake in system, please contact admin! <br>";
			}
			else {
				
				$usernameErr .= "That username does not exists! <br>";
			}
			
			
		}
		else {
			
			$usernameErr .= "Please, put in username! <br>";
			
		}
		
		if(!empty($_POST['pass'])) {
			
			$sql = "SELECT * FROM `korisnici` WHERE `username` = :username AND 
			`password` = :pass";
			$korisnici = $connect->prepare($sql);
			$korisnici->execute(array(
			
			':username' => $_POST['username'] , 
			':pass' => md5($_POST['pass'])
			
			));
			
			if($korisnici->rowCount()== 1) {
				
				$pass = $_POST['pass'];
				
			}
			else if($korisnici->rowCount() >= 2){
				
				
				
				$passErr .= "There was an mistake in system, please contact admin! <br>";
			}
			else {
				
				
				$passErr .= "Password is not correct! <br>";
			}
			
		}
		else {
			
			$passErr .= "Please, put in password!! <br>";
			
		}
		
		if($usernameErr == "" && $passErr == "") {
			
			$fkorisnici = $korisnici->fetchAll(PDO::FETCH_OBJ);
			foreach($fkorisnici as $k) {
				
				$nalog = $k->id; 
				
			}
			
			$_SESSION['id'] = $nalog; 
			header("Location: index.php");
			
		}
		
		
		
	}

?>
<div class="form-1"> 
<form method="POST" action="index.php?file=login">
<table>

  <tr>
  <td><input type="text" name="username" placeholder=" Your username.."/>
  <?php 
  if($username == "") {
	  
	  
	  
	echo $usernameErr;   
	  
  }
  ?>
  </td>
  </tr>
  
    <tr>

  <td><input type="password" name="pass" placeholder=" Your password.."/>
  <?php 
  if($pass == "") {
	  
	  
	  
	echo $passErr;   
	  
  }
  ?>
  </td>
  </tr>
  
  
  <tr>
 
  <td><input type="submit" name="submit" value="LOG IN"/>

  </td>
  </tr>




</table>
</form>

</div>
</div>

</body>
</html>
