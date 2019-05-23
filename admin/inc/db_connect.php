
<!-- Database Connection -->
    <?php 
       $conn = mysqli_connect("localhost", "root", "");
       mysqli_select_db($conn, "eshop");
    ?>