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
         
            <li class="breadcrumb-item active" aria-current="page">Tickets</li>
         
          </ol>
         
        </nav>


        <!-- Page Content -->

      <section>
                <h3 class="text-orange text-center py-1">Tickets</h3>
                <div class="order px-3 my-4 custom-card">
                  <div class="row my-5 mx-5 ">
         <table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Ticket ID</th>
            <th scope="col">Order ID</th>
            <th scope="col">User ID</th>
            <th scope="col">Subject</th>
            <th scope="col">Message</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
                            
                <!--insert query-->
                <?php
                  $disp = "SELECT * FROM tickets";
                  //mysqli_query($conn,$query);
                    $data = mysqli_query($conn,$disp);
                       while( $result = mysqli_fetch_assoc($data))
              {  
                ?>

                 <tr>
               
                            <td> <?php echo $result['ticket_id']; ?> </td>
                            <td> <?php echo $result['order_id']; ?> </td>
                            <td> <?php echo $result['user_id']; ?> </td>
                            <td> <?php echo $result['subject']; ?> </td>
                            <td> <?php echo $result['message']; ?> </td>
                            <td> <?php echo $result['status']; ?> </td>
                           
                        </tr>
            
                <?php
              }
                ?>
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