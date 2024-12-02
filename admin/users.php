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
         
            <li class="breadcrumb-item active" aria-current="page">Users</li>
         
          </ol>
         
        </nav>


        <!-- Page Content -->

      <section>
                <h3 class="text-orange text-center py-1">All Users</h3>


                <div class="order px-3 my-3 custom-card">
                  <div class="row my-2 mx-5 ">
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
                              <button class="btn custom-btn my-4" data-toggle="modal" data-target="#userInfoModal<?php echo $row['user_id'];  ?>"> <i class="fa fa-eye"></i> View</button>
                              </div></td> 
                         </tr>
						<!-- Modal -->
						<div class="modal fade" id="userInfoModal<?php echo $row['user_id'];  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLabel"><?php echo $row['firstname']?>'s Info</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						        <p>User id: <?php echo $row['user_id'];  ?></p>
						        <p>Firstname: <?php echo $row['firstname']?></p>
						        <p>Lastname: <?php echo $row['lastname']?></p>
						        <p>Email: <?php echo $row['email']?></p>
						        <p>Contact No.: <?php echo $row['contact_no']?></p>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fa fa-close"></i> Close</button>
						        <button type="button" class="btn custom-btn"> <i class="fa fa-envelope-o"></i> Email</button>
						      </div>
						    </div>
						  </div>
						</div>

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