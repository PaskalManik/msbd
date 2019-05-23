
<?php
    ob_start();

    
    include './inc/header.php';

    $_SESSION["ref"] = "cart";


    if (!empty($_COOKIE['item'])){

        foreach ($_COOKIE['item'] as $name1 => $value) {

            if(isset($_POST["delete$name1"])) {

                setcookie("item[$name1]", "", time()-1800);

                ?>
                
                <script type="text/javascript">
                    window.location.href = window.location.href;
                </script>

                <?php
            }
        }
    }


?>

<!-- Beardcumb -->     
    <div class="custom-card p-0 card-shadow">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb container">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cart</li>
            </ol>
        </nav>
    </div>

<!-- End Beardcumb -->  

    <div class="container">
        <div class="row my-4">
            <div class="col-md-12">
                <div class="order-summary clearfix custom-card">
                        


            <?php
                
                $d = 0;

                if(!empty($_COOKIE['item']))
                {
                    $d=$d+1;
                }

                if($d==0){

                    ?>
                    <div class="py-5 my-5 text-center">
                        <img src="img/opps-icon.png" alt="placeholder+image">
                        <h4 class="text-center text-dark  my-2">Opps! No items in cart </h4>
                        <a href="index.php" class="btn custom-btn mt-5">Let's add some items</a>
                    </div>
                    <?php
                }
                else {


                    ?>
                    <div class="section-title">
                        <h3 class="text-orange py-3 text">Order Review</h3>
                    </div>
                    <table class="shopping-cart-table table py-5">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th></th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Total</th>
                            <th class="text-right"></th>
                        </tr>
                    </thead>
                    <tbody>

                            <?php 

                            // getting items from cookie
                            
                              
                                foreach ($_COOKIE['item'] as $name1 => $value1) // looping in cookie
                                {
                                    
                                    $values11 = explode("__", $value1);

                                    ?>

                                    <tr>
                                        <td class="thumb img-fluid"><img src="./admin/<?php echo $values11[0]?>" alt=""></td>
                                        <td class="details">
                                            <h5><?php echo $values11[1]?></h5>
                                        </td>
                                        <td class="price text-center"><strong>₹<?php echo $values11[2]?></strong></td>
                                        <td class="qty text-center"><input class="input" type="number" value="<?php echo $values11[3]?>" readonly></td>
                                        <td class="total text-center"><strong class="primary-color">₹<?php echo $values11[4]?></strong></td>
                                        <td class="text-right">
                                            <form method="POST" action="">
                                                <button class="btn custom-btn" name="delete<?php echo $name1; ?>"><i class="fa fa-close text-white"></i></button>
                                            </form>
                                        </td>
                                    </tr>


                                    <?php
                                }

                             ?>

                    
                    </tbody>
                    <tfoot>
                        
                        <?php 

                            // Making Grand Total
                            
                                $g_total = 0;

                                foreach ($_COOKIE['item'] as $name1 => $value1) // looping in cookie
                                {
                                    
                                    $values11 = explode("__", $value1);

                                    $g_total =  $g_total + $values11[4];
                                }

                                $_SESSION["total"] =  $g_total;

                                ?>
                            <tr>
                            <th class="empty" colspan="3"></th>
                            <th>SUBTOTAL</th>
                            <th colspan="2" class="sub-total">₹<?php echo $g_total?></th>
                             </tr>
                            <tr>
                            <th class="empty" colspan="3"></th>
                            <th>SHIPING</th>
                            <td colspan="2">Free Shipping</td>
                                </tr>
                                <tr>
                                    <th class="empty" colspan="3"></th>
                                    <th>TOTAL</th>
                                    <th colspan="2" class="total">₹ <?php echo $g_total?></th>
                                </tr>
                            </tfoot>
                            </table>
                            <div class="pull-right">
                                <a href="checkout.php?ref=<?php echo $_SESSION['ref'] ?>" class="btn custom-btn primary-btn">Place Order</a>
                            </div>

                            <?php

                            }

                        ?>


                </div>

            </div>
        </div>
    </div>


    <?php 
        include './inc/footer.php';
        ob_end_flush();
    ?>