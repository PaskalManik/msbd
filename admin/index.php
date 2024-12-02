
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
      include './inc/db_connect.php';
    ?>
      
  
  <!-- sidebar include -->
    <?php 
      include './inc/sidebar.php';
    ?>

<!-- Main Page content  -->

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
    
        <nav aria-label="breadcrumb ">
         
          <ol class="breadcrumb arr-right bg-light ">
         
            <li class="breadcrumb-item "><a href="#">Dashboard</a></li>
         
            <li class="breadcrumb-item active" aria-current="page">Overview</li>
         
          </ol>
         
        </nav>

        <!-- Icon Cards-->

        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-user"></i>
                </div>
                <div class="mr-5">
                <?php 
              
                $result = mysqli_query($conn,"SELECT count(*) FROM users");
                $rows = mysqli_fetch_array($result);

                echo  $rows[0];

                ?> 
                Registered Users</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="users.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fa fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-list"></i>
                </div>
                <div class="mr-5"><?php 
              
                $result = mysqli_query($conn,"SELECT count(*) FROM products");
                $rows = mysqli_fetch_array($result);

                echo  $rows[0];

                ?>  Products</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="all_products.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fa fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-shopping-cart"></i>
                </div>
                <div class="mr-5"><?php 
              
                $result = mysqli_query($conn,"SELECT count(*) FROM orders");
                $rows = mysqli_fetch_array($result);

                echo  $rows[0];

                ?>  Orders!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="orders.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fa fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-ticket"></i>
                </div>
                <div class="mr-5"><?php 
              
                $result = mysqli_query($conn,"SELECT count(*) FROM tickets");
                $rows = mysqli_fetch_array($result);

                echo  $rows[0];

                ?>  Tickets!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="tickets.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fa fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>

        <!-- Recent Orders-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-shopping-cart text-dark"></i>
           Recent Orders</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Ordered by</th>
                    <th>Total</th>
                    <th>View</th>
                  </tr>
                </thead>
                <tbody>

                 <?php 

                 $res = mysqli_query($conn, " SELECT * FROM orders JOIN users ON orders.user_id = users.user_id  ORDER BY order_id DESC LIMIT 5 ");
                            
                    while($row = mysqli_fetch_array($res)) {

                      ?>
                  <tr>
                    <td><?php echo $row['order_date'] ?></td>
                    <td><?php echo $row['product_name'] ?></td>
                    <td> <?php echo $row['product_qty'] ?> </td>
                    <td><?php echo $row['firstname'].' '.$row['lastname'] ?></td>
                    <td>Rp <?php echo $row['order_total'] ?> </td>
                    <td><a href="order-details.php?id=<?php echo $row['order_id'] ?>" style="text-decoration: none;"> <i class="fa text-dark fa-eye"></i> View</a> </td>
                  </tr>
                  <?php
                    }
                  ?>
                </tbody>
              </table>
          </div>
          <div class="card-footer small text-muted">Updated Today at  <?php echo date("h:i:sa"); ?> </div>
        </div>

        <!-- Recently Registered users-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-user text-dark"></i>
           Recently Registered Users</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>User id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Contact</th>

                  </tr>
                </thead>
                <tbody>

                 <?php 

                 $res = mysqli_query($conn, " SELECT * FROM users ORDER BY user_id DESC LIMIT 5 ");
                            
                    while($row = mysqli_fetch_array($res)) {

                      ?>
                  <tr>
                    <td><?php echo $row['user_id'] ?></td>
                    <td><?php echo $row['firstname'] ?></td>
                    <td> <?php echo $row['lastname'] ?> </td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['contact_no'] ?> </td>
                  
                  <?php
                    }
                  ?>
                </tbody>
              </table>
          </div>
          <div class="card-footer small text-muted">Updated Today at  <?php echo date("h:i:sa"); ?> </div>
        </div>

        <!-- Recent Tickets -->
         <div class="card mb-3">
          <div class="card-header">
           <i class="fa fa-fw fa-ticket text-dark"></i>
           Recent Tickets</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Ticket id</th>
                    <th>Created On</th>
                    <th>Order id</th>
                    <th>Subject</th>
                    <th>Status</th>

                  </tr>
                </thead>
                <tbody>

                 <?php 

                 $res = mysqli_query($conn, " SELECT * FROM tickets ORDER BY ticket_id DESC LIMIT 5 ");
                            
                    while($row = mysqli_fetch_array($res)) {

                      ?>
                  <tr>
                    <td><?php echo $row['ticket_id'] ?></td>
                    <td><?php echo $row['ticket_date'] ?></td>
                    <td> 
                      <a style="text-decoration: none;" href="order-details.php?id=<?php echo $row['order_id']; ?> ">
                          <i class="fa text-dark fa-eye"></i> View
                      </a>
                     </td>
                    <td><?php echo $row['subject'] ?></td>
                    <td><?php echo $row['status'] ?> </td>
                  
                  <?php
                    }
                  ?>
                </tbody>
              </table>
          </div>
          <div class="card-footer small text-muted">Updated Today at  <?php echo date("h:i:sa"); ?> </div>
        </div>

      </div>
      <!-- /.container-fluid -->


 
  <!-- footer include -->

    <?php 
      include './inc/footer.php';
    ?>