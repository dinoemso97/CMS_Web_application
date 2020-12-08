<?php

if(isset($_SESSION['id'])){
?>
<!DOCTYPE html>
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
  <section class="section2">
		<h2>TENNIS NEWS:</h2>
  <?php
       echo "<div class='news'>";
       $sql = "SELECT * FROM `vijesti`";
	   $vijesti = $connect->query($sql);
	   $fvijesti = $vijesti->fetchAll(PDO::FETCH_OBJ);
	   foreach($fvijesti as $v) {
		   if($vijesti->rowCount() > 0) {
		$type = $v->type; 
       if($type == "tennis") {
		   
		 
		echo "<div class='box-news'>";
		echo "<a href='index.php?file=news&id=". $v->id ."'>";
		echo "<img src='news/". $v->image ."'/>";
        echo "<h2>". $v->subject ."</h2>";	
        echo "</a>"; 	
        echo "</div>"; 
 
	   }
            
		  
		   
	   }
	   else {
		   

          ?>
		<h2 class="error">NO NEWS!</h2>
		<?php
		   
	   }
	   
	   }
	   
	   echo "</div>";  
		
	   ?>
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