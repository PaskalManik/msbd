<?php
      session_start();

      include './inc/db_connect.php';

      if($_SESSION["admin"]==""){
        header('Location: admin-login.php');
      }

      $pid = $_GET['id'];

        // delete product

       

        if(mysqli_query($conn, "DELETE FROM products WHERE id=$pid")){
        
          // redirect to products page after delete successfully
        
          header('Location: all_products.php'); 
          
        }

 ?>