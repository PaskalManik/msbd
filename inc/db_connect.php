<?php 
	
	include './config.php';
	
	
	// connecting to database
	
	$conn = mysqli_connect("localhost",$db_username,$db_password);
    mysqli_select_db($conn, $db_name);

 ?>