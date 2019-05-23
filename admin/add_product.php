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
         
            <li class="breadcrumb-item active" aria-current="page">Add Products</li>
         
          </ol>
         
        </nav>


        <!-- Page Content -->

      <section>
        <div class="container-fluid">
           <div class="row">
              <div class="col-md-1">
              </div>

              <div class="col-md-10 custom-card my-4 p-5">
                <h3 class="text-orange text-center py-1">Add Product</h3>
                <form name="form1" action="" method="POST" enctype="multipart/form-data">
                  <div class="row">
                  <div class="col-md-6 form-group py-2">
                    <label>Product Name:</label>
                    <input type="text" class="form-control" placeholder="Product Name" name="pname" required>
                  </div>
                  <div class="col-md-6 form-group py-2">
                    <label>Product Category:</label>
                    <select class="form-control" name="pcategory" required>
                      <option value="Men">Men Clothing</option>
                      <option value="Women">Women Clothing</option>
                      <option value="Accessories">Accessories</option>
                      <option value="Electronics">Electronics</option>
                      <option value="Phones">Phones</option>
                      <option value="Shoes">Shoes</option>
                    </select>
                  </div>
                  <div class="col-md-6 form-group py-2">
                    <label>Product Featured Image:</label>
                    <input type="file" class="form-control-file" name="pimage" required>
                  </div>
                  <div class="col-md-6 form-group py-2">
                    <label>Product Preview Images (Max 4):</label>
                    <input type="file" class="form-control-file" name="pimg1" required>
                    <input type="file" class="form-control-file" name="pimg2" required>
                    <input type="file" class="form-control-file" name="pimg3" required>
                    <input type="file" class="form-control-file" name="pimg4" required>
                  </div>
                  <div class="col-md-6 form-group py-2">
                    <label>Product Price:</label>
                    <input type="text" class="form-control" placeholder="Product Price" name="pprice" required>
                  </div>
                  <div class="col-md-6 form-group py-2">
                    <label>Product Old Price:</label>
                    <input type="text" class="form-control" placeholder="Product Old Price" name="poldprice" required>
                  </div>
                  <div class="col-md-6 form-group py-2">
                    <label>Product Brand:</label>
                    <input type="text" class="form-control" placeholder="Product Brand" name="pbrand" required>
                  </div>
                  <div class="col-md-6 form-group py-2">
                    <label>Product Quantity:</label>
                    <input type="text" class="form-control" placeholder="Product Quantity" name="pqty" required>
                  </div>
                  <div class="col-md-6 form-group py-2">
                    <label>Slider(Appears on):</label>
                    <select class="form-control" name="pslider" required>
                      <option value="todays_deal">Todays Deals Slider</option>
                      <option value="new">Latest Products SLider</option>
                      <option value="no-slider">No Slider</option>
                    </select>
                  </div>
                  <div class="col-md-6 form-group py-2">
                    <label>Product Tag:</label>
                    <input type="text" class="form-control" placeholder="Eg: New, -50%, -30%, etc" name="ptag" required>
                  </div>
                  <div class="col-md-6 form-group py-2">
                    <label>Product Description:</label>
                    <textarea class="form-control" name="pdesc" rows="3" required></textarea>
                  </div>
                  <button type="submit" name="add_product" class="btn custom-btn btn-block my-2" value="upload">Add Product</button>
                </div>
                </form>
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

          // uploading preview images
          // pre img 1
          $pre_fnm1 = $_FILES["pimg1"]["name"];
          $pre_destn = "./product_img/preview_img/".$v3.$pre_fnm1;
          $pre_destn1 = "product_img/preview_img/".$v3.$pre_fnm1; // store it in db
          move_uploaded_file($_FILES["pimg1"]["tmp_name"],$pre_destn);

          //pre img 2
          $pre_fnm2 = $_FILES["pimg2"]["name"];
          $pre_destn = "./product_img/preview_img/".$v3.$pre_fnm2;
          $pre_destn2 = "product_img/preview_img/".$v3.$pre_fnm2; // store it in db
          move_uploaded_file($_FILES["pimg2"]["tmp_name"],$pre_destn);

          //pre img 3
          $pre_fnm3 = $_FILES["pimg3"]["name"];
          $pre_destn = "./product_img/preview_img/".$v3.$pre_fnm3;
          $pre_destn3 = "product_img/preview_img/".$v3.$pre_fnm3; // store it in db
          move_uploaded_file($_FILES["pimg3"]["tmp_name"],$pre_destn);

          //pre img 4
          $pre_fnm4 = $_FILES["pimg4"]["name"];
          $pre_destn = "./product_img/preview_img/".$v3.$pre_fnm4;
          $pre_destn4 = "product_img/preview_img/".$v3.$pre_fnm4; // store it in db
          move_uploaded_file($_FILES["pimg4"]["tmp_name"],$pre_destn);

          $img_arr = array($pre_destn1,$pre_destn2,$pre_destn3,$pre_destn4);
          $img_arr = serialize($img_arr);
        

          if (!mysqli_query($conn, " INSERT INTO products(product_name, product_slider, product_price, product_old_price, product_qty, product_img, product_preview, product_tag, product_brand, product_category, product_description) VALUES('$_POST[pname]', '$_POST[pslider]', $_POST[pprice], $_POST[poldprice], $_POST[pqty], '$destn1', '$img_arr', '$_POST[ptag]', '$_POST[pbrand]', '$_POST[pcategory]', '$_POST[pdesc]')") ) 

          {
            echo("Error description: " . mysqli_error($conn));
          } 

          else {

          ?>
          <script type="text/javascript">
            alert('Product added successfuly!');
          </script>
          <?php
        }

        }

       ?> 
        
        <!-- / Page Content -->

      <!-- /.container-fluid -->

      
      <?php 
        include './inc/footer.php';
       ?>