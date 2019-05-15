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
                <h3 class="text-orange text-center py-1">All Users</h3>


                <div class="order px-3 my-4 custom-card">
                  <div class="row my-5 mx-5 table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                        <tr>
                            <th>Ticket no</th> 
                            <th>Name</th> 
                            <th>Status</th>
                              <th>Date</th>
                        </tr>
                        </thead>
                        <tr>
                            <td>#001</td>
                            <td>Abc</td> 
                            <td>abc</td>
                            <td>1/1/19</td>
                        </tr>
                </thead> 
                </table>

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