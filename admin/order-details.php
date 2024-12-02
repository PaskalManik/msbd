<!-- header include -->
    <?php  
      
      session_start();

      if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== 'admin') {
        // Jika tidak login atau bukan admin, arahkan ke login
        echo "<script>alert('Unauthorized access! Please log in as admin.');</script>";
        header('Location: ../login.php'); // Arahkan ke halaman login utama
        exit();
    }

      include './inc/header.php';
      include './inc/sidebar.php';

      include './inc/db_connect.php';

      $oid = $_GET['id'];

    ?>
      


  <!-- main content here -->

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        
        <nav aria-label="breadcrumb ">
         
          <ol class="breadcrumb arr-right bg-light ">
         
            <li class="breadcrumb-item "><a href="index.php">Dashboard</a></li>

            <li class="breadcrumb-item "><a href="orders.php">All Orders</a></li>
         
            <li class="breadcrumb-item active" aria-current="page">Order Information</li>
         
          </ol>
         
        </nav>


        <!-- Page Content -->

      <section>
        <div class="container-fluid">
           <div class="row">
              <div class="col-md-1">
              </div>

              <div class="col-md-10 my-3">
                <h3 class="text-orange text-center py-1">Order Information</h3>

               

<div class="container">
        <div class="custom-card my-4 py-3">
           
        <div class="order px-3 my-4">

            <?php 

                 $res = mysqli_query($conn, "SELECT * FROM orders WHERE order_id=$oid ");
                            
                    while($row = mysqli_fetch_array($res)) {

                    ?>

                        <div class="row mt-4">
                <div class="col-4">
                    <span class="d-inline-block align-middle"><img class="img-fluid product-img p-2 d-inline-block" src="./<?php echo $row["product_img"]; ?>"></span>
                </div>
                <div class="col-8">
                  <div class="ml-2">
                    <h4 class="text-orange"> Shipment details </h4> 
                    <h4 class="my-3"> <?php echo $row["product_name"]; ?></h4>
                    <p> Price: Rp<?php echo $row["product_price"]; ?> </p>
                    <p> Date: <?php echo $row["order_date"]; ?> </p>
                    <p> Qty: <?php echo $row["product_qty"]; ?> </p>
                    <p> Total: Rp<?php echo $row["product_price"]*$row["product_qty"]; ?> </p>
                    <p class="text-orange">Status: <?php echo $row["order_status"]; ?> 
                      <a href="javascript:void(0);" class="btn custom-btn ml-4" data-toggle="modal" data-target="#statusChangeModal">Change</a>
                    </p>
                  </div>
                </div>
            </div>
            <div class="row mb-3 pl-5">
                <div class="col-12">
                    <hr class="py-2">
                    <h4 class="text-orange"> Payment information </h4>
                    <h6 class="my-3"><?php echo $row["payment_mode"]; ?></h6>
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
                    <h6>Contact the user? <a href="javascript:void(0);" class="text-orange btn custom-btn"><i class="fa fa-envelope-o"></i> Email Now</a></h6>
                </div>
            </div>
        </div>
        </div>
    </div>

                <!-- Update Status Modal -->
            
              <div class="modal fade" id="statusChangeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Change Order Status?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                     <p class="text-danger"> Warning: This Status will be visible to the user. Make sure the status is correct.</p>
                      <div class="row py-3">
                    <div class="col-6 pl-5 m-0">
                      <span class="text-orange">Select the Status:</span>
                    </div>
                    <div class="col-6 pl-0 m-0"> 
                      <form action="" method="POST" name="order-status">
                      <select class="form-control" name="status" required>
                      <option value="In-Process">In-Process</option>
                      <option value="Approved">Approved</option>
                      <option value="Cancelled">Cancelled</option>
                      <option value="Shipped">Shipped</option>
                      <option value="Delivered">Delivered</option>
                      <option value="Returned">Returned</option>
                    </select>
                    </div>
                  </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" name="submit-btn" class="btn custom-btn">Save changes</button>
                    </form>
                    <?php

                      if (isset($_POST["submit-btn"])) {

                        if (!mysqli_query($conn, " UPDATE orders SET order_status='$_POST[status]' WHERE order_id=$oid ")) {

                        echo("Error description: " . mysqli_error($conn));
                        
                        } else{

                          ?>
                          <script type="text/javascript">
                            alert('Order status updated successfuly!');
                            window.location.href =  window.location.href;
                          </script>
                          <?php
                        }
                                
                      }

                    ?>
                    </div>
                  </div>
                </div>
              </div>


                    <?php

                }

             ?>

                
              </div>

              <div class="col-md-1">
              </div>
           </div>
        </div>
      </section>
        
     
        
        <!-- / Page Content -->

      <!-- /.container-fluid -->

      
      <?php 
        include './inc/footer.php';
       ?>