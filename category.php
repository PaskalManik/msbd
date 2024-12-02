    <?php 
    include './inc/header.php';
    include './inc/db_connect.php';

    
    if (isset($_GET['cat'])) {
         
         $cat = $_GET["cat"];
    }
       
    if (isset($_GET['subcat'])) {
        
        $subcat = $_GET["subcat"];
    }
   
    ?>

    <!-- Beardcumb --> 

    <div class="custom-card p-0 card-shadow">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb container">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php if(!isset($_GET['subcat'])){ echo $cat;} else{ echo $subcat; } ?> </li>
            </ol>
        </nav>
    </div>
    
    <!-- End Breadcumbs -->

    <div class="container">
        <div class="my-5 py-3">
            <h3 class="text-left text-orange"> <span class="text-dark">Category: <?php if(!isset($_GET['subcat'])){ echo $cat;} else{ echo $subcat; } ?> </span> </h3>
            <hr class="py-3">
         
        <!-- Product List start -->
                <div class="row">
                    
                <?php  
                
                if (!isset($_GET['subcat'])) {
                    $res = mysqli_query($conn, "SELECT * FROM products WHERE product_category='$cat' ");
                } 
                else{

                $res = mysqli_query($conn, "SELECT * FROM products WHERE product_category='$cat' AND product_subcategory='$subcat' ");
                }
                

                // $res = mysqli_query($conn, "SELECT * FROM products WHERE product_category='$cat' AND product_subcategory='$subcat' ");

                while ($row=mysqli_fetch_array($res)) {
                
                ?>

                <div class="col-sm-6 col-lg-4 col-xl-3 py-3">
                        <div class="product position-relative">
                            <div class="badge product-badge custom-badge-light"><?php echo $row["product_tag"] ?></div>
                            <div class="custom-card p-0">
                                <img class="product-img img-fluid" src="./admin/<?php echo $row["product_img"] ?>" class="img-fluid">
                                <div class="p-2">
                                    <div class="row">
                                        <div class="col-7">
                                            <h5 class="py-2">Rp<?php echo $row["product_price"] ?></h5>
                                        </div>
                                        <div class="col-5">
                                            <div class="rating py-2 m-0">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="py-1"> <a href="product_details.php?id=<?php echo $row["id"] ?>"><?php echo $row["product_name"] ?></a> </h6>
                                    <div class="row py-3">
                                        <div class="col-12 text-center">
                                            <a href="product_details.php?id=<?php echo $row["id"] ?>" class="btn custom-btn btn-block font-sm"><i class="fa fa-eye text-white" aria-hidden="true"></i> QUICK LOOK </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php

                }

                ?>  

                </div>
            </div>
        </div>


    <?php 
        include './inc/footer.php';
    ?>