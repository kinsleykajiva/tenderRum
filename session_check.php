<?php  
ob_start();

session_start();


if (!isset($_SESSION['userId'])) {
	
	header("location:login.php");
}
 ?>