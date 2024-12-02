<?php
      session_start();

      include './inc/db_connect.php';

      if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== 'admin') {
        // Jika tidak login atau bukan admin, arahkan ke login
        echo "<script>alert('Unauthorized access! Please log in as admin.');</script>";
        header('Location: ../login.php'); // Arahkan ke halaman login utama
        exit();
    }

      $pid = $_GET['id'];

        // delete product

       

        if(mysqli_query($conn, "DELETE FROM products WHERE id=$pid")){
        
          // redirect to products page after delete successfully
        
          header('Location: all_products.php'); 
          
        }

 ?>