<?php 

if(isset($_SESSION['id'])) {
	
	
	if(isset($_GET['id'])) {
		
	$sql = "DELETE FROM `vijesti` WHERE `id` = :id";
    $komentari = $connect->prepare($sql);
    $komentari->execute(array(
	
	':id' => $_GET['id']
	
	));	
		
		
	header("Location: index.php");	
		
	}
	
	
	
	
	
	
	
}
else {
	
	?>
		<h2 class="error">WARNING!! That page is not available for you!</h2>
		<?php
	
	
}