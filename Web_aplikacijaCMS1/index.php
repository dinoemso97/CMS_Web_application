<?php 

$connection = "connect.php";
if(file_exists($connection)) {
	
	
	include_once($connection);
	
}
else {
	
	
	die("FATAL ERROR! There wan an error in system, soon we will be available! <br>");
	
	
}


session_start();
?>
<!DOCTYPE html>
<html>
<head>
   <title>Web-page about sports</title>
   <meta charset="utf-8"/>
   <meta name="viewport" content="width= device-width , initial-scale=1.0"/>
   
   <link rel="stylesheet" type="text/css" href="style.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Open+Sans"/>
</head>
<body>
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
		
	}
	if($username == "admin89") {
	
	
	?>
	<header class="header1">
	<a href="index.php">
	<div class="logo">
	<h3>Web-page about sports</h3>
	<h5>Football, tennis, basketball...</h5>
	</div>
	</a>
	<nav>
	<ul>
	<li><a href="index.php">Home page</a></li>
	<li><a href="#">News<?php echo "  " ;  ?><i style="font-size:14px" class=" fa">&#xf0d7;</i></a>
	<ul>
	<li><a href="index.php?file=football">Football news</a></li>
	<li><a href="index.php?file=basketball">Basketball news</a></li>
	<li><a href="index.php?file=tennis">Tennis news</a></li>
	</ul>	
	</li>	
    <li><a href="index.php?file=admin">Administration</a></li>
	<li><a href="index.php?file=logout">Log out</a></li>
	</ul>
	</nav>
	</header>
	<?php 
	}
	else {
		
?>
  <header class="header1">
 <a href="index.php">
	<div class="logo">
	<h3>Web-page about sports</h3>
	<h5>Football, tennis, basketball...</h5>
	</div>
	</a>
	<nav>
	<ul>
	<li><a href="index.php">Home page</a></li>
	<li><a href="#">News<?php echo "  " ;  ?><i style="font-size:14px" class=" fa">&#xf0d7;</i></a>
	<ul>
	<li><a href="index.php?file=football">Football news</a></li>
	<li><a href="index.php?file=basketball">Basketball news</a></li>
	<li><a href="index.php?file=tennis">Tennis news</a></li>
	</ul>
	</li>	
	<li><a href="index.php?file=contact2">Contact us</a></li>
	<li><a href="index.php?file=logout">Log out</a></li>
	
	</ul>
	</nav>
	</header>
	<?php
		
		
	}
	
	if(isset($_GET['file'])) {
		
	$file = $_GET['file'] . ".php";
    if(file_exists($file)) {
		
		include_once($file);
		
	}	
	else {
		?>
		<h2 class="error">Ups! That page is not available!!</h2>
		<?php
	}
		
	}
	else {
		
		?>
		<section class="section2">
		<h2>ALL NEWS:</h2>
		<?php 
		echo "<div class='news'>";
		$sql = "SELECT * FROM `vijesti`";
		$vijesti = $connect->query($sql);
		$fvijesti = $vijesti->fetchAll(PDO::FETCH_OBJ);
		foreach($fvijesti as $v) {
			
		echo "<div class='box-news'>";
		echo "<a href='index.php?file=news&id=". $v->id ."'>";	
		echo "<img src='news/". $v->image ."'/>";
        echo "<h2>". $v->subject ."</h2>";	
        echo "</a>"; 	
        echo "</div>";		
			
		}
		echo "</div>";	
		?>
		</section>
		<?php
	}
	
	
}
else {
	
		?>
	<header class="header1">
	<a href="index.php">
	<div class="logo">
	<h3>Web-page about sports</h3>
	<h5>Football, tennis, basketball...</h5>
	</div>
	</a>
	<nav>
	<ul>
	<li><a href="index.php">Home page</a></li>
	<li><a href="index.php?file=register">Sign up</a></li>	
	<li><a href="index.php?file=login">Log in</a></li>
	<li><a href="index.php?file=contact1">Contact us</a></li>
	
	</ul>
	</nav>
	</header>
	<?php 
		
	
	
	if(isset($_GET['file'])) {
		
	$file = $_GET['file'] . ".php";
    if(file_exists($file)) {
		
		include_once($file);
		
	}	
	else {
		
		?>
		<h2 class="error">Ups! That page is not available!!</h2>
		<?php
	}
		
	}
	else {
		
		?>
		<section class="section1">
		<h1 class="jumbotron">WELCOME TO NEW SPORTS PAGE</h1>
		</section>
		<?php
	}
	
}

?>
</body>
</html>
