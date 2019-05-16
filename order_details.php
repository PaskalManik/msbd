<?php
    ob_start();
    session_start();

    include "./inc/header.php";
    include "./inc/db_connect.php";

   
    // check if user logged in
    
    if(!isset($_SESSION['loggedin'])){
        
         header('Location: login.php');
    }

    $oid = $_GET['id'];

    
?>

    <div class="container">
        <div class="custom-card my-4 py-3">
            <h3 class="text-left text-orange">Order Information </h3>
            <hr class="py-2">
        <div class="order px-3 my-4">

            <?php 

                 $res = mysqli_query($conn, "SELECT * FROM orders WHERE order_id=$oid ");
                            
                    while($row = mysqli_fetch_array($res)) {

                    ?>

                        <div class="row mt-4">
                <div class="col-4">
                    <span class="d-inline-block align-middle"><img class="img-fluid product-img p-2 d-inline-block" src="./admin/<?php echo $row["product_img"]; ?>"></span>
                </div>
                <div class="col-8">
                    <h4 class="text-orange"> Shipment details </h4> 
                    <h4 class="my-3"> <?php echo $row["product_name"]; ?></h4>
                    <p> Price: ₹<?php echo $row["product_price"]; ?> </p>
                    <p>Status: <?php echo $row["order_status"]; ?></p>
                    <p> Date: <?php echo $row["order_date"]; ?> </p>
                    <p> Qty: <?php echo $row["product_qty"]; ?> </p>
                </div>
            </div>
            <div class="row mb-3 pl-5">
                <div class="col-12">
                    <hr class="py-2">
                    <h4 class="text-orange"> Payment information </h4>
                    <h6 class="my-3"><?php echo $row["payment_mode"]; ?></h6>
                    <p> * COD - Cash on Delivery</p>
                    <hr class="py-2">
                    
                </div>
                <div class="col-md-6 py-3">
                    <h4 class="text-orange"> Billing Address </h4>
                    <p> <?php echo $row["firstname"].' '.$row['lastname']; ?></p>
                    <p> <?php echo $row["address"]; ?> </p>
                    <p> <?php echo $row["city"]; ?> </p>
                    <p> <?php echo $row["pincode"]; ?> </p>
                </div>
                <div class="col-md-6 py-3">
                    <h4 class="text-orange"> Shipping Address </h4>
                    <p> <?php echo $row["firstname"].' '.$row['lastname']; ?></p>
                    <p> <?php echo $row["address"]; ?> </p>
                    <p> <?php echo $row["city"]; ?> </p>
                    <p> <?php echo $row["pincode"]; ?> </p>
                </div>
                </div>
                <div class="text-center my-5">
                    <h6>Need help with your order? <a href="javascript:void(0);" class="text-orange btn custom-btn">Contact us</a></h6>
                </div>
            </div>
        </div>
        </div>
    </div>


                    <?php

                }

             ?>

            


    
    <?php
    
        include "./inc/footer.php";

        ob_end_flush();
    
    ?>