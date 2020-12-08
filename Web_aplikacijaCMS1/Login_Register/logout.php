<?php 
if(isset($_SESSION['id']))
	{
session_destroy(); 
header("Location: index.php");

}
else {
	
	echo "Warning!!! For you that page is not available! <br>";
}

