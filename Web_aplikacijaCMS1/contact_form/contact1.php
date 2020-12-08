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

<div class="form">
<h1 class="subject-2">CONTACT US !</h1>

<?php 

  $name = "";
  $email = "";
  $message =""; 
 
  
  $nameErr = "";
  $emailErr = "";
  $messageErr =""; 
  
  
  if(isset($_POST['submit'])) {
	  
	  
	  if(!empty($_POST['name'])) {
		  
		  $name = $_POST['name'];
		  
	  }
	  else {
		  
		  
		  $nameErr .= "You must enter your full name! <br>";
	  }
	  
	   if(!empty($_POST['email'])) {
		  
		  $email = $_POST['email'];
		  
	  }
	  else {
		  
		  
		  $emailErr .= "You must enter your email adress! <br>";
	  }
	  
	   if(!empty($_POST['message'])) {
		  
		  $message = $_POST['message'];
		  
	  }
	  else {
		  
		  
		  $messageErr .= "You must enter your question! <br>";
	  }
	  
	  $attachment = "attachment/" . basename($_FILES['file']['name']);
	  move_uploaded_file($_FILES['file']['tmp_name'] , $attachment);

	  if($nameErr == "" && $emailErr == "" && $messageErr == "") {
		  
		  require "PHPMejl/PHPMailerAutoload.php";
		  
		  $mejl = new PHPMailer(); 
		  
		  $mejl->isSMTP(); 
		  $mejl->SMTPDebug = 0;
          $mejl->Debugoutput = "html"; 

          $mejl->Host = "smtp.gmail.com"; 
          $mejl->Port = 587; 
          $mejl->SMTPAuth = true; 
          $mejl->SMTPSecure = "tls"; 
  
          $mejl->Username = "youremail";
          $mejl->Password = "yourpassword"; 

          $mejl->setFrom($email , $name);
          $mejl->addAddress("youremail","yourfirstname");
          $mejl->addReplyTo("youremail","yourfirstname");
		  $mejl->addAttachment($attachment);

          $mejl->Subject = "Pitanje sa kontakt forme";
          $mejl->Body = $message; 
          $mejl->isHTML(true);

         if($mejl->send()) {
			 
			 echo "Your question is successfuly send <br>";
			 
		 }	  
          else {
			  
			  echo "Your question is not send <br>";
		  }		 
		  
		  
		  
	  }
	  
  }

?> 
<div class="form-1">
<form method="POST" action="index.php?file=contact1" enctype="multipart/form-data">
<table>

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
  <td><textarea name="message" cols="40" rows="10" placeholder=" Message.."></textarea>
  <?php 
  if($message == "") {
	  
	echo $messageErr;   
	  
	  
	  
  } 
  ?>
  </td>
  </tr> 
  
  <tr>
  <td>Send picture or file: <br>
  <input type="file" name="file"/></td>
  </tr>
  
  <tr>
  <td><input type="submit" name="submit" value="SEND QUESTION"/></td>
  </tr>

</table>
</form>

</div>
</div>

</body>
</html>
