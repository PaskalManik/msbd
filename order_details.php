<?php

    ob_start();
    
    include "./inc/header.php";
    include "./inc/db_connect.php";

   
    // check if user logged in
    
    if(!isset($_SESSION['loggedin'])){
        
         header('Location: login.php');
    }

    $oid = $_GET['id'];

    
?>

    <div class="container">
        <div class="custom-card my-4 py-3">
            <h3 class="text-left text-orange">Order Information </h3>
            <hr class="py-2">
        <div class="order px-3 my-4">

            <?php 

                 $res = mysqli_query($conn, "SELECT * FROM orders WHERE order_id=$oid ");
                            
                    while($row = mysqli_fetch_array($res)) {

                        $uid = $row['user_id'];

                    ?>

                        <div class="row mt-4">
                <div class="col-4">
                    <span class="d-inline-block align-middle"><img class="img-fluid product-img p-2 d-inline-block" src="./admin/<?php echo $row["product_img"]; ?>"></span>
                </div>
                <div class="col-8">
                    <h4 class="text-orange"> Shipment details </h4> 
                    <h4 class="my-3"> <?php echo $row["product_name"]; ?></h4>
                    <p> Price: ₹<?php echo $row["product_price"]; ?> </p>
                    <p>Status: <?php echo $row["order_status"]; ?></p>
                    <p> Date: <?php echo $row["order_date"]; ?> </p>
                    <p> Qty: <?php echo $row["product_qty"]; ?> </p>
                </div>
            </div>
            <div class="row mb-3 pl-5">
                <div class="col-12">
                    <hr class="py-2">
                    <h4 class="text-orange"> Payment information </h4>
                    <h6 class="my-3"><?php echo $row["payment_mode"]; ?></h6>
                    <p> * COD - Cash on Delivery</p>
                    <hr class="py-2">
                    
                </div>
                <div class="col-md-6 py-3">
                    <h4 class="text-orange"> Billing Address </h4>
                    <p> <?php echo $row["firstname"].' '.$row['lastname']; ?></p>
                    <p> <?php echo $row["address"]; ?> </p>
                    <p> <?php echo $row["city"]; ?> </p>
                    <p> <?php echo $row["pincode"]; ?> </p>
                </div>
                <div class="col-md-6 py-3">
                    <h4 class="text-orange"> Shipping Address </h4>
                    <p> <?php echo $row["firstname"].' '.$row['lastname']; ?></p>
                    <p> <?php echo $row["address"]; ?> </p>
                    <p> <?php echo $row["city"]; ?> </p>
                    <p> <?php echo $row["pincode"]; ?> </p>
                </div>
                </div>
                <div class="text-center my-5">
                    <h6>Need help with your order? <a href="javascript:void(0);" class="text-orange btn custom-btn"  data-toggle="modal" data-target="#exampleModal">Need Help</a></h6>
                   <!-- Button trigger modal -->
                </div>
            </div>
        </div>
        </div>
    </div>

    <?php

        }

    ?>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Need Help: Submit your issue</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST">
            <div class="form-group">
                <label>Subject</label>
                <select class="form-control" name="subject" required>
                <option>Select your issue</option>
                <option value="Cancel Order">Cancel Order</option>
                <option value="Size Issue">Size Issue</option>
                <option value="Item not Received">Item not Received</option>
                <option value="Defect Item Received">Defect Item Received</option>
                <option value="Color Issue">Color Issue</option>
                <option value="Others">Others(Describe it below)</option>
                </select>
            </div>
            <div class="form-group">
                <label>Message</label>
                <textarea class="form-control" rows="3" name="message" placeholder="Enter Message.." required></textarea>
            </div>  
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn custom-btn" name="submit-btn">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php  



// submiting user issue to db


if(isset($_POST["submit-btn"])) {

            $msg = htmlentities($_POST['message']);
            $date = date("d-m-y");

         if(! mysqli_query($conn, " INSERT INTO tickets (order_id,user_id,subject,message,status,ticket_date) VALUES($oid, $uid, '$_POST[subject]','$msg', 'In Process', '$date') ") ) {

            echo("Error description: " . mysqli_error($conn));
            ?>
            <script type="text/javascript">
                alert("Opps! Some error occured.");
            </script>
            <?php
            } 
            else{
            ?>
                <script type="text/javascript">
                    alert("Issue successfully submitted. We'll contact you soon.");
                </script>
            <?php
         
         }

        }

       ?>

<!--end modal-->

            


    
    <?php
    
        include "./inc/footer.php";

        ob_end_flush();
    
    ?>