
<?php 
    include './inc/header.php';
    include './inc/db_connect.php';

    $id = $_GET["id"];

    $res = mysqli_query($conn,"SELECT * FROM products WHERE id=$id");

    while($row=mysqli_fetch_array($res))
    {

    ?>

    <!-- Beardcumb -->     
    <div class="custom-card p-0 card-shadow">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb container">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="category.php?cat=<?php echo $row["product_category"] ?>"><?php echo $row["product_category"] ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $row["product_name"] ?></li>
            </ol>
        </nav>
    </div>

    <div class="container py-3">
        <div class="row">
            <div class="col-md-6">
                <div id="product-main-view" class="m-0">
                            <div class="product-view">
                                <img src="./img/main-product01.jpg" alt="">
                            </div>
                            <div class="product-view">
                                <img src="./img/main-product02.jpg" alt="">
                            </div>
                            <div class="product-view">
                                <img src="./img/main-product03.jpg" alt="">
                            </div>
                            <div class="product-view">
                                <img src="./img/main-product04.jpg" alt="">
                            </div>
                        </div>
                        <div id="product-view" class="m-5">
                            <div class="product-view">
                                <img src="./img/thumb-product01.jpg" alt="">
                            </div>
                            <div class="product-view">
                                <img src="./img/thumb-product02.jpg" alt="">
                            </div>
                            <div class="product-view">
                                <img src="./img/thumb-product03.jpg" alt="">
                            </div>
                            <div class="product-view">
                                <img src="./img/thumb-product04.jpg" alt="">
                            </div>
                    </div>
            </div>
            <div class="col-md-6">
                <div class="product-detail">
                    <div class="product-label">
                        <span class="badge custom-badge-light">NEW</span>
                        <span class="badge custom-badge-light bg-dark">- 50%</span>
                    </div>

                    <h2 class="product-name pt-4 pb-3"><?php echo $row["product_name"] ?></h2>
                            <h3 class="product-price">₹<?php echo $row["product_price"] ?> <del class="product-old-price">‎₹<?php echo $row["product_old_price"] ?></del></h3>
                            <div>
                                <div class="product-rating d-inline-block">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o empty"></i>
                                </div>
                                | &nbsp; <a href="#">3 Review(s) / Add Review</a>
                            </div>
                            <p class="pt-4"><strong>Availability :</strong>
                                <?php 
                                if ($row["product_qty"] > 0) {
                                   echo '<span class="text-success">In Stock</span>';
                                } else{
                                   echo '<span class="text-danger">Out of Stock</span>';
                                }
                                

                                ?>
                            </p>
                            <p><strong>Brand :</strong>  <?php echo $row["product_brand"] ?> </p>
                            <p> 
                                <?php echo $row["product_description"] ?>
                            </p>
                        <hr class="py-2">
                        <div class="product-options">
                            <ul class="p-0 size-option">
                                <li><span class="text-uppercase">Size:</span></li>
                                <li class="active"><a href="#">S</a></li>
                                <li><a href="#">XL</a></li>
                                <li><a href="#">SL</a></li>
                            </ul>
                            <ul class="p-0 color-option">
                                <li><span class="text-uppercase">Color:</span></li>
                                <li class="active"><a href="#" style="background-color:#475984;"></a></li>
                                <li><a href="#" style="background-color:#8A2454;"></a></li>
                                <li><a href="#" style="background-color:#BF6989;"></a></li>
                                <li><a href="#" style="background-color:#9A54D8;"></a></li>
                            </ul>
                        </div>
                        <div class="d-inline-block my-3">
                            <button class="btn custom-btn"><i class="fa fa-cart-plus text-white"></i> ADD TO CART</button>
                        </div>
                        <div class="d-inline-block float-right my-3">
                            <button class="btn custom-btn"><i class="fa fa-heart text-white"></i></button>
                            <button class="btn custom-btn"><i class="fa fa-share-alt text-white"></i></button>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Description Section -->
    
    <div>
        <div class="container">
            <div class="col-md-12">
                    <div class="list-group my-5 py-2 position-relative" id="product-desc-list" role="tablist">
                        <a class="list-group-item-action active d-inline-block" data-toggle="list" href="#description" role="tab">DESCRIPTION</a>
                        <a class="list-group-item-action d-inline-block" data-toggle="list" href="#details" role="tab">DETAILS</a>
                        <a class="list-group-item-action d-inline-block" data-toggle="list" href="#reviews" role="tab">REVIEWS (3)</a>
                    </div>

                    
                    <div class="tab-content" class="mt-4">
                    <div class="tab-pane active" id="description" role="tabpanel">
                        <P>DESCRIPTION :</P>
                            <p>  <?php echo $row["product_description"] ?> </p>
                    </div>
                    <div class="tab-pane" id="details" role="tabpanel">
                        <P>DETAILS :</P>
                        <p>  <?php echo $row["product_description"] ?> </p>
                    </div>
                    <div class="tab-pane" id="reviews" role="tabpanel">
                        <div class="row">
                                        <div class="col-md-6">
                                            <div class="product-reviews">
                                                <div class="single-review">
                                                    <div class="review-heading">
                                                        <div><a href="#"><i class="fa fa-user-o"></i> John</a></div>
                                                        <div><a href="#"><i class="fa fa-clock-o"></i> 27 DEC 2017 / 8:0 PM</a></div>
                                                        <div class="review-rating pull-right">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o empty"></i>
                                                        </div>
                                                    </div>
                                                    <div class="review-body">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute
                                                            irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                                    </div>
                                                </div>

                                                <div class="single-review">
                                                    <div class="review-heading">
                                                        <div><a href="#"><i class="fa fa-user-o"></i> Michel</a></div>
                                                        <div><a href="#"><i class="fa fa-clock-o"></i> 27 DEC 2017 / 8:0 PM</a></div>
                                                        <div class="review-rating pull-right">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o empty"></i>
                                                        </div>
                                                    </div>
                                                    <div class="review-body">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute
                                                            irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                                    </div>
                                                </div>

                                                <div class="single-review">
                                                    <div class="review-heading">
                                                        <div><a href="#"><i class="fa fa-user-o"></i> Jennie</a></div>
                                                        <div><a href="#"><i class="fa fa-clock-o"></i> 27 DEC 2017 / 8:0 PM</a></div>
                                                        <div class="review-rating pull-right">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o empty"></i>
                                                        </div>
                                                    </div>
                                                    <div class="review-body">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute
                                                            irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                                    </div>
                                                </div>

                                                <ul class="reviews-pages">
                                                    <li class="active">1</li>
                                                    <li><a href="#">2</a></li>
                                                    <li><a href="#">3</a></li>
                                                    <li><a href="#"><i class="fa fa-caret-right"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h4 class="text-uppercase">Write Your Review</h4>
                                            <p>Your email address will not be published.</p>
                                            <form class="review-form">
                                                 <div class="form-group">
                                                     <input type="text" class="form-control" id="name" placeholder="Name">
                                                </div>
                                                <div class="form-group">
                                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                                </div>
                                                <div class="form-group">
                                                   <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-rating">
                                                        <strong class="text-uppercase">Your Rating: </strong>
                                                        <div class="stars">
                                                            <input type="radio" id="star5" name="rating" value="5" /><label for="star5"></label>
                                                            <input type="radio" id="star4" name="rating" value="4" /><label for="star4"></label>
                                                            <input type="radio" id="star3" name="rating" value="3" /><label for="star3"></label>
                                                            <input type="radio" id="star2" name="rating" value="2" /><label for="star2"></label>
                                                            <input type="radio" id="star1" name="rating" value="1" /><label for="star1"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn primary-btn custom-btn">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                            </div>
                        </div>



            </div>
        </div>
    </div>
    
    <?php

    }

    ?>


    

    <!-- Picked for you  -->

    <section class="pt-5">
            <div class="container">
                <div class="text-left">
                        <div class="" style="border-bottom: 1px solid #000;">
                            <h3 class="badge badge-primary custom-badge-light" style="margin-bottom: 0px;">PICKED FOR YOU</h3>
                        </div>
                        <section class="picks-slider slider">
                                <div class="product position-relative">
                                    <div class="badge product-badge custom-badge-light">NEW</div>
                                    <div class="custom-card p-0">
                                        <img src="img/banner10.jpg">
                                        <div class="p-2">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="py-2">$30.00</h5>
                                                </div>
                                                <div class="col">
                                                    <div class="rating py-2 m-0">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <h6 class="py-1"> <a href="">Product Name Here</a> </h6>
                                            <div class="row py-3">
                                               <div class="col-4 text-center">
                                                    <button class="btn custom-btn font-sm"><i class="fa fa-heart text-white" aria-hidden="true"></i></button>
                                                </div>
                                                <div class="col-8 text-center">
                                                    <button class="btn custom-btn font-sm"><i class="fa fa-cart-plus text-white" aria-hidden="true"></i> ADD TO CART</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product position-relative">
                                  <div class="badge product-badge custom-badge-light">-50%</div>
                                    <div class="custom-card p-0">
                                        <img src="img/banner12.jpg">
                                        <div class="p-2">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="py-2">$34.00</h5>
                                                </div>
                                                <div class="col">
                                                    <div class="rating py-2 m-0">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <h6 class="py-1"> <a href="">Product Name Here</a> </h6>
                                            <div class="row py-3">
                                                <div class="col-4 text-center">
                                                    <button class="btn custom-btn font-sm"><i class="fa fa-heart text-white" aria-hidden="true"></i></button>
                                                </div>
                                                <div class="col-8 text-center">
                                                    <button class="btn custom-btn font-sm"><i class="fa fa-cart-plus text-white" aria-hidden="true"></i> ADD TO CART</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product position-relative">
                                  <div class="badge product-badge custom-badge-light">NEW</div>
                                    <div class="custom-card p-0">
                                        <img src="img/banner10.jpg">
                                        <div class="p-2">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="py-2">$30.00</h5>
                                                </div>
                                                <div class="col">
                                                    <div class="rating py-2 m-0">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <h6 class="py-1"> <a href="">Product Name Here</a> </h6>
                                            <div class="row py-3">
                                                <div class="col-4 text-center">
                                                    <button class="btn custom-btn font-sm"><i class="fa fa-heart text-white" aria-hidden="true"></i></button>
                                                </div>
                                                <div class="col-8 text-center">
                                                    <button class="btn custom-btn font-sm"><i class="fa fa-cart-plus text-white" aria-hidden="true"></i> ADD TO CART</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product position-relative">
                                  <div class="badge product-badge custom-badge-light">-50%</div>
                                    <div class="custom-card p-0">
                                        <img src="img/banner13.jpg">
                                        <div class="p-2">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="py-2">$34.00</h5>
                                                </div>
                                                <div class="col">
                                                    <div class="rating py-2 m-0">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <h6 class="py-1"> <a href="">Product Name Here</a> </h6>
                                            <div class="row py-3">
                                                <div class="col-4 text-center">
                                                    <button class="btn custom-btn font-sm"><i class="fa fa-heart text-white" aria-hidden="true"></i></button>
                                                </div>
                                                <div class="col-8 text-center">
                                                    <button class="btn custom-btn font-sm"><i class="fa fa-cart-plus text-white" aria-hidden="true"></i> ADD TO CART</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product position-relative">
                                  <div class="badge product-badge custom-badge-light">NEW</div>
                                    <div class="custom-card p-0">
                                        <img src="img/banner12.jpg">
                                        <div class="p-2">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="py-2">$34.00</h5>
                                                </div>
                                                <div class="col">
                                                    <div class="rating py-2 m-0">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <h6 class="py-1"> <a href="">Product Name Here</a> </h6>
                                            <div class="row py-3">
                                                <div class="col-4 text-center">
                                                    <button class="btn custom-btn font-sm"><i class="fa fa-heart text-white" aria-hidden="true"></i></button>
                                                </div>
                                                <div class="col-8 text-center">
                                                    <button class="btn custom-btn font-sm"><i class="fa fa-cart-plus text-white" aria-hidden="true"></i> ADD TO CART</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product position-relative">
                                  <div class="badge product-badge custom-badge-light">-20%</div>
                                    <div class="custom-card p-0">
                                        <img src="img/banner12.jpg">
                                        <div class="p-2">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="py-2">$34.00</h5>
                                                </div>
                                                <div class="col">
                                                    <div class="rating py-2 m-0">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <h6 class="py-1"> <a href="">Product Name Here</a> </h6>
                                            <div class="row py-3">
                                                <div class="col-4 text-center">
                                                    <button class="btn custom-btn font-sm"><i class="fa fa-heart text-white" aria-hidden="true"></i></button>
                                                </div>
                                                <div class="col-8 text-center">
                                                    <button class="btn custom-btn font-sm"><i class="fa fa-cart-plus text-white" aria-hidden="true"></i> ADD TO CART</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </section>
                    </div>
            </div>
        </section>

    <!-- End Picked for you -->

    
    <!-- footer included-->
    <?php 
        include './inc/footer.php';
    ?>