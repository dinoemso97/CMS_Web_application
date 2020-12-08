<?php 

if(isset($_SESSION['id'])) {
	
	
	if(isset($_GET['id']) && isset($_GET['vijestiId'])) {
		
	$sql = "DELETE FROM `komentari` WHERE `id` = :id";
    $komentari = $connect->prepare($sql);
    $komentari->execute(array(
	
	':id' => $_GET['id']
	
	));	
		
		
	header("Location: index.php?file=news&id=". $_GET['vijestiId']);	
		
	}
	
	
	
	
	
	
	
}
else {
	
	?>
		<h2 class="error">WARNING!! That page is not available for you!</h2>
		<?php
	
	
}