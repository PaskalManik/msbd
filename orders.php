
<?php
    ob_start();

    include './inc/header.php';
    include './inc/db_connect.php';

    if(!isset($_SESSION['loggedin'])){
        
         header('Location: login.php');
    }

     
     $uid = $_SESSION['user_id'];



?>

    <div class="container">
        <div class="my-4 py-3">
            <h3 class="text-left text-orange">My Orders</h3>
            <hr class="py-2">

            <?php 

                $res = mysqli_query($conn, "SELECT * FROM orders WHERE user_id=$uid ");
                            
                    while($row = mysqli_fetch_array($res)) {

                        ?>

                        <div class="order custom-card px-3 my-4">
                            <div class="row my-5">
                                <div class="col-3">
                                    <span class="d-inline-block align-middle"><img class="img-fluid p-2 d-inline-block product-img" src="./admin/<?php echo $row["product_img"]; ?>"></span>
                                </div>
                                <div class="col-9">
                                    <a href="">
                                        <h4 class="my-3"><?php echo $row["product_name"]; ?></h4>
                                    </a>
                                    <p> Date: <?php echo $row["order_date"]; ?> </p>
                                    <p> Status: <?php echo $row["order_status"]; ?> </p>
                                    <a href="order_details.php?id=<?php echo $row["order_id"]; ?>" class="btn custom-btn">Order Details</a>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
             ?>
            
            
<!-- 
            <div class="order custom-card px-3 my-4">
                <div class="row my-5">
                    <div class="col-3">
                        <span class="d-inline-block align-middle"><img class="img-fluid p-2 d-inline-block" src="img/banner11.jpg"></span>
                    </div>
                    <div class="col-9">
                        <a href="">
                            <h4 class="my-3">Product Name Here</h4>
                        </a>
                        <p> Date: 12/07/18</p>
                        <p>Status: Delivered</p>
                        <button class="btn custom-btn">Order Details</button>
                    </div>
                </div>
            </div>

            <div class="order custom-card px-3 my-4">
                <div class="row my-5">
                    <div class="col-3">
                        <span class="d-inline-block align-middle"><img class="img-fluid p-2 d-inline-block" src="img/banner11.jpg"></span>
                    </div>
                    <div class="col-9">
                        <a href="">
                            <h4 class="my-3">Product Name Here</h4>
                        </a>
                        <p> Date: 12/07/18</p>
                        <p>Status: Delivered</p>
                        <button class="btn custom-btn">Order Details</button>
                    </div>
                </div>
            </div> -->

        </div>
    </div>


   
<?php

    include './inc/footer.php';

    ob_end_flush();

?>