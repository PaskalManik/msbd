<!-- header include -->
    <?php  
      
      session_start();

      if($_SESSION["admin"]==""){
        header('Location: admin-login.php');
      }

      include './inc/header.php';
      include './inc/sidebar.php';

    ?>
      
  
  <!-- Database Connection -->
    <?php 
       $conn = mysqli_connect("localhost", "root", "");
       mysqli_select_db($conn, "eshop");
    ?>


  <!-- main content here -->

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        
        <nav aria-label="breadcrumb ">
         
          <ol class="breadcrumb arr-right bg-light ">
         
            <li class="breadcrumb-item "><a href="index.php">Dashboard</a></li>
         
            <li class="breadcrumb-item active" aria-current="page">Add Products</li>
         
          </ol>
         
        </nav>


        <!-- Page Content -->

      <section>
        <div class="container-fluid">
           <div class="row">
              <div class="col-md-1">
              </div>

              <div class="col-md-10 my-3">
                <h3 class="text-orange text-center py-1">All Product</h3>
                <!-- All products  -->
                <div class="order px-3 my-4 custom-card">
                  <div class="row my-5">
                      <div class="col-3">
                          <span class="d-inline-block align-middle"><img class="img-fluid p-2 d-inline-block" src="./product_img/8d76722e605cfebf181b46759e9abef9banner11.jpg"></span>
                      </div>
                      <div class="col-7">
                          <a class="py-2" href="">
                              <h5 class="my-3">Product Name Here</h5>
                          </a>
                      </div>
                      <div class="col-2">
                            <button class="btn custom-btn my-4"> <i class="fa fa-eye"></i> View</button>
                           </div>
                  </div>
                </div>

                <div class="order px-3 my-4 custom-card">
                  <div class="row my-5">
                      <div class="col-3">
                          <span class="d-inline-block align-middle"><img class="img-fluid p-2 d-inline-block" src="./product_img/8d76722e605cfebf181b46759e9abef9banner11.jpg"></span>
                      </div>
                      <div class="col-7">
                          <a class="py-2" href="">
                              <h5 class="my-3">Product Name Here</h5>
                          </a>
                      </div>
                      <div class="col-2">
                            <button class="btn custom-btn my-4"> <i class="fa fa-eye"></i> View</button>
                           </div>
                  </div>
                </div>

                <div class="order px-3 my-4 custom-card">
                  <div class="row my-5">
                      <div class="col-3">
                          <span class="d-inline-block align-middle"><img class="img-fluid p-2 d-inline-block" src="./product_img/8d76722e605cfebf181b46759e9abef9banner11.jpg"></span>
                      </div>
                      <div class="col-7">
                          <a class="py-2" href="">
                              <h5 class="my-3">Product Name Here</h5>
                          </a>
                      </div>
                      <div class="col-2">
                            <button class="btn custom-btn my-4"> <i class="fa fa-eye"></i> View</button>
                           </div>
                  </div>
                </div>

              </div>

              <div class="col-md-1">
              </div>
           </div>
        </div>
      </section>
        
      <?php 
        
        if (isset($_POST["add_product"])) {
          
          $v1 = rand(1111,9999);
          $v2 = rand(1111,9999);
          $v3 = $v1.$v2;

          $v3 = md5($v3);

          $fnm = $_FILES["pimage"]["name"];
          $destn = "./product_img/".$v3.$fnm;
          $destn1 = "product_img/".$v3.$fnm;
          move_uploaded_file($_FILES["pimage"]["tmp_name"],$destn);


          mysqli_query($conn, " INSERT INTO products(product_name, product_price, product_qty, product_img, product_category, product_description) values('$_POST[pname]', $_POST[pprice], $_POST[pqty], '$destn1', '$_POST[pcategory]', '$_POST[pdesc]')"); 



        }

       ?> 
        
        <!-- / Page Content -->

      <!-- /.container-fluid -->

      
      <?php 
        include './inc/footer.php';
       ?>