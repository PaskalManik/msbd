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
              <div class="col-md-2">
              </div>

              <div class="col-md-8 card my-4 p-5">
                <h3 class="text-orange text-center py-1">Add Product</h3>
                <form name="form1" action="" method="POST" enctype="multipart/form-data">
                  <div class="form-group py-2">
                    <label>Product Name:</label>
                    <input type="text" class="form-control" placeholder="Product Name" name="pname">
                  </div>
                  <div class="form-group py-2">
                    <label>Product Category:</label>
                    <select class="form-control" name="pcategory">
                      <option value="Mens_Clothing">Mens_Clothing</option>
                      <option value="Womens_Clothing">Womens_Clothing</option>
                      <option value="Accessories">Accessories</option>
                      <option value="Electronics">Electronics</option>
                      <option value="Phones">Phones</option>
                      <option value="Bags_And_Shoes">Bags_And_Shoes</option>
                    </select>
                  </div>
                  <div class="form-group py-2">
                    <label>Product Image:</label>
                    <input type="file" class="form-control-file" name="pimage">
                  </div>
                  <div class="form-group py-2">
                    <label>Product Price:</label>
                    <input type="text" class="form-control" placeholder="Product Price" name="pprice">
                  </div>
                  <div class="form-group py-2">
                    <label>Product Quantity:</label>
                    <input type="text" class="form-control" placeholder="Product Quantity" name="pqty">
                  </div>
                  <div class="form-group py-2">
                    <label>Product Description:</label>
                    <textarea class="form-control" name="pdesc" rows="3"></textarea>
                  </div>
                  <button type="submit" name="add_product" class="btn custom-btn btn-block my-2" value="upload">Add Product</button>
                </form>
              </div>

              <div class="col-md-2">
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