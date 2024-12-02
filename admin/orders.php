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

    ?>
      


  <!-- main content here -->

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        
        <nav aria-label="breadcrumb ">
         
          <ol class="breadcrumb arr-right bg-light ">
         
            <li class="breadcrumb-item "><a href="index.php">Dashboard</a></li>

            <li class="breadcrumb-item active" aria-current="page">All Orders</li>
         
          </ol>
         
        </nav>


        <!-- Page Content -->

      <section>
        <div class="container-fluid">
           <div class="row">
              <div class="col-md-1">
              </div>

              <div class="col-md-10 my-3">
                <h3 class="text-orange text-center py-1">All Orders</h3>

                <!-- all Orders -->

                <?php 

                 $res = mysqli_query($conn, "SELECT * FROM orders JOIN users ON orders.user_id = users.user_id ORDER BY order_id DESC");
                            
                    while($row = mysqli_fetch_array($res)) {

                      ?>
            
                      <div class="order px-3 my-4 custom-card">
                          <div class="row my-2">
                              <div class="col-md-3">
                                  <span class="d-inline-block align-middle"><img class="img-fluid product-img p-2 d-inline-block" src="<?php echo $row['product_img'] ?>"></span>
                              </div>
                              <div class="col-md-7">
                                  <a class="py-2" href="">
                                      <h5 class="my-3"><?php echo $row['product_name'] ?></h5>
                                    </a>
                                      <p>Order ID: #<?php echo $row['order_id'] ?></p>
                                      <p>Qty: <?php echo $row['product_qty']  ?></p>
                                      <p>Total: Rp<?php echo $row['order_total'] ?></p>
                                      <p>Ordered by: <?php echo $row['firstname'].' '.$row['lastname'] ?> </p>
                                      <p>Status: <span class="text-orange"><?php echo $row['order_status'] ?> </span></p>
                              </div>
                              <div class="col-md-2">
                                    <a href="order-details.php?id=<?php echo $row['order_id'] ?>" class="btn custom-btn my-4"> <i class="fa fa-eye"></i> View</a>
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