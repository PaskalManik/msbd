<!-- header include -->
    <?php  
      
      session_start();

      if($_SESSION["admin"]==""){
        header('Location: admin-login.php');
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
         
            <li class="breadcrumb-item active" aria-current="page">Products</li>
         
          </ol>
         
        </nav>


        <!-- Page Content -->

      <section>
        <div class="container-fluid">
           <div class="row">
              <div class="col-md-1">
              </div>

              <div class="col-md-10 my-3">
                <h3 class="text-orange text-center py-1">Products</h3>
                <!-- All products  -->

              <?php 

                 $res = mysqli_query($conn, "SELECT * FROM products");
                            
                    while($row = mysqli_fetch_array($res)) {

                      ?>
                <div class="order px-3 my-4 custom-card">
                  <div class="row my-3">
                      <div class="col-3">
                          <span class="d-inline-block align-middle"><img class="img-fluid product-img p-2 d-inline-block" src="<?php echo $row['product_img']; ?> "></span>
                      </div>
                      <div class="col-7">
                          <a class="py-2" href="">
                              <h5 class="my-3"> <?php echo $row['product_name']; ?> </h5>
                            </a>
                            <p>Price: <?php echo $row['product_price']; ?></p>
                            <p>Category: <?php echo $row['product_category']; ?></p>
                            <p>Qty: <?php echo $row['product_qty'].' (<span class=text-orange>Left</span>)'; ?></p>
                      </div>
                      <div class="col-2">
                            <a href="product-edit.php?id=<?php echo $row['id']?>" class="btn custom-btn my-5"> <i class="fa fa-pencil"></i> Edit</a>
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