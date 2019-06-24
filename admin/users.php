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
         
            <li class="breadcrumb-item active" aria-current="page">Users</li>
         
          </ol>
         
        </nav>


        <!-- Page Content -->

      <section>
                <h3 class="text-orange text-center py-1">All Users</h3>


                <div class="order px-3 my-4 custom-card">
                  <div class="row my-5 mx-5 ">
                        <table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#User ID</th>
            <th scope="col">Username</th>
            <th scope="col">View user details</th>
           
        </tr>
    </thead>

                    <?php 


                    $res = mysqli_query($conn, "SELECT * FROM users");
                            
                    while($row = mysqli_fetch_array($res)) {

                      ?>
                          <tr>
                              <td>#<?php echo $row['user_id'];  ?></td>
                              <td><?php echo $row['firstname'].' '.$row['lastname']  ?></td> 
                              <td> 
                              <button class="btn custom-btn my-4"> <i class="fa fa-eye"></i> View</button>
                              </div></td> 
                         </tr>


                      <?php

                        }

                      ?>
                        
                        
                         <!-- <tr>
                            <td>#002</td>
                            <td>Abc</td> 
                                 <td> 
                            <button class="btn custom-btn my-4"> <i class="fa fa-eye"></i> View</button>
                           </div></td> 
                        </tr>
                         <tr>
                            <td>#003</td>
                            <td>Abc</td> 
                                 <td> 
                            <button class="btn custom-btn my-4"> <i class="fa fa-eye"></i> View</button>
                           </div></td> 
                        </tr> -->
                    </table>

                  </div>
                </div>  
            
            </tr>
                            
          </table>
        </div>
      </div>
</section>
        
            
        <!-- / Page Content -->

      <!-- /.container-fluid -->

      
      <?php 
        include './inc/footer.php';
       ?>