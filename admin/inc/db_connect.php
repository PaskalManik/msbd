

    <?php 
		
		include '../config.php';
		
		// Database Connection
		
       $conn = mysqli_connect("localhost", $db_username, $db_password);
       mysqli_select_db($conn, $db_name);
	   
    ?>