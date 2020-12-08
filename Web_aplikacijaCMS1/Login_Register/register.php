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
<h2 class="subject">SIGN UP FOR FREE !</h2>

<?php 
  
   $username = "";
   $pass = "";
   $repass = "";
   $email = "";
   $name = "";
   $user_code = ""; 
   
   $usernameErr = "";
   $passErr = "";
   $repassErr = "";
   $emailErr = "";
   $nameErr = "";

   
    if(isset($_POST['submit'])) {
		
		if(!empty($_POST['username'])) {
			
			$sql = "SELECT * FROM `korisnici` WHERE `username` = :username";
			$korisnici = $connect->prepare($sql);
			$korisnici->execute(array(
			
			':username' => $_POST['username']
			
			));
			
			if($korisnici->rowCount()) {
				
				$usernameErr .= "That username is already selected, please pick another one <br>";
				
			}
			else {
				
				
				$username = $_POST['username'];
			}
			
			
		}
		else {
			
			$usernameErr .= "You must have username for registration!! <br>";
			
		}
		
		if(!empty($_POST['pass'])) {
			
			
			if(strlen($_POST['pass']) > 5) {
				
				//Kod se izvrsava
				
				
			}
			else {
				
				$passErr .= "Password is weak, must be stronger than 5 characters! <br>";
				
			}
			
		}
		else {
			
			
			$passErr .= "You must have password! <br>";
		}
		
		if(!empty($_POST['repass'])) {
			
			if($_POST['pass'] == $_POST['repass']) {
				
				$pass = md5($_POST['pass']); 
				$repass = $_POST['repass'];
				
			}	
                else {
					
					
					$repassErr .= "Your password's is not matching! <br>";
				}			
		}
		else {
			
			
			$repassErr .= "You must repeat your password! <br>";
		}
		
		
		
		if(!empty($_POST['name'])) {
			
			$name = $_POST['name'];
			
			
		}
		else {
			
			
			$nameErr .= "You must have name for registration! <br>";
		}
		
		if(!empty($_POST['email'])) {
			
		if(filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL)) {
			$sql = "SELECT * FROM `korisnici` WHERE `email` = :email";
			$korisnici = $connect->prepare($sql);
			$korisnici->execute(array(
			
			':email' => $_POST['email']
			
			));
			
			if($korisnici->rowCount()) {
				
				$emailErr .= "That email is already selected, try to use another one <br>";
				
			}
			else {
				
				
				$email = $_POST['email'];
			}
			
		}
           else {
			   
			   $emailErr .= "That email adress is not valid! <br>";
		   }		
		}
		else {
			
			$emailErr .= "You must have Email adress for registration!! <br>";
			
		}
		
		$variable1 = rand(1,1000000);
		$variable2 = rand(1,1000000);
		$variable3 = rand(1,1000000);
		
		$code = $variable1 . "-" . $variable2 . "-" . $variable2; 
		
		if($usernameErr == "" && $passErr == "" && $repassErr == "" && $nameErr == "" && $emailErr == "") {
			
			$qkor = "INSERT INTO `korisnici` SET 
			
			`username` = :username , 
			`password` = :pass , 
			`name` = :name , 
			`email` = :email , 
			`user_code` = :code , 
			`email_confirm` = :email_c
	
			";
			$korisnici = $connect->prepare($qkor);
			$korisnici->execute(array(
			
			':username' => $username , 
			':pass' => $pass , 
			':name' => $name , 
			':email' => $email , 
			':code' => $code , 
			':email_c' => 0
			
			
			));
			
			echo "Your registration is successfully";
			
			
			
			require "PHPMejl/PHPMailerAutoload.php";
		  
		  $mejl = new PHPMailer(); 
		  
		  $mejl->isSMTP(); 
		  $mejl->SMTPDebug = 0;
          $mejl->Debugoutput = "html"; 

          $mejl->Host = "smtp.gmail.com"; 
          $mejl->Port = 587; 
          $mejl->SMTPAuth = true; 
          $mejl->SMTPSecure = "tls"; 
  
          $mejl->Username = "emsodino07@gmail.com";
          $mejl->Password = "softver12345"; 

          $mejl->setFrom("emsodino07@gmail.com","Dino");
          $mejl->addAddress($email , $name);
          $mejl->addReplyTo($email , $name);

          $mejl->Subject = "Validacija email adrese";
          $mejl->Body = "
		  
		     Postovani,kako bi nastavili sa validnom registracijom molimo vas potvrdite Email adresu:
			 <a href='localhost/Web_aplikacija/confirm.php?email=$email&code=$code'>Potvrda E-maila</a>
		  
		  
		  
		  
		  "; 
          $mejl->isHTML(true);

         if($mejl->send()) {
			 
			 echo ", please confirm email adress <br>";
			 
		 }	  
          else {
			  
			  echo "but is not valid, please check your email adress or try again with registration <br>";
		  }		 
			
			
			
			
			
			
		}
		
		
	}

?>
<div class="form-1">
<form method="POST" action="index.php?file=register">
<table>

  <tr>
  <td><input type="text" name="username" placeholder=" Username..."/>
  <?php 
  if($username == "") {
	  
	  
	  
	echo $usernameErr;   
	  
  }
  ?>
  </td>
  </tr>
  
    <tr>
  
  <td><input type="password" name="pass" placeholder=" Password (min 6 char)"/>
  <?php 
  if($pass == "") {
	  
	  
	  
	echo $passErr;   
	  
  }
  ?>
  </td>
  </tr>
  
  <tr>
  
  <td><input type="password" name="repass" placeholder=" Repeat password.."/>
  <?php 
  if($repass == "") {
	  
	  
	  
	echo $repassErr;   
	  
  }
  ?>
  </td>
  </tr>
  
   <tr>
 
  <td><input type="text" name="name" placeholder=" Full name.."/>
  <?php 
  if($name == "") {
	  
	  
	  
	echo $nameErr;   
	  
  }
  ?>
  </td>
  </tr>
  
  
  <tr>
 
  <td><input type="text" name="email" placeholder=" Email adress.."/>
  <?php 
  if($email == "") {
	  
	  
	  
	echo $emailErr;   
	  
  }
  ?>
  </td>
  </tr>
  
  <tr>
 
  <td><input type="submit" name="submit" value="SIGN UP"/>

  </td>
  </tr>




</table>
</form>

</div>
</div>


</body>
</html>