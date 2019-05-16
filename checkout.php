<?php
ob_start();

session_start();

include './inc/header.php';
include './inc/db_connect.php';


// getting cookie no. used to remove cookies
// upon order complete 

if (isset($_SESSION['d'])) {
	
	$d = $_SESSION['d'];

}


//checking page reffer

$ref= $_GET["ref"]; 


if ($ref != 'cart') {
	header('Location: cart.php');
}


$total = $_SESSION["total"]; // order total



if (!isset($_SESSION['loggedin'])) {
	
	header("Location: login.php?ref=checkout");
} 


?>

<!-- Beardcumb -->     
    <div class="custom-card p-0 card-shadow">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb container">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="cart.php">Cart</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </nav>
    </div>

<!-- End Beardcumb -->  

<div class="container py-4">



	<div class="row">
			
		<div class="col-md-6 my-2">
			<div class="alert alert-info" role="alert">
			  	<i class="fa fa-info-circle"> </i> Please fill the details below.
			</div>

			<h4 class="">Delivery Address</h4>

			<form method="POST" action="" class="my-4">
				<div class="form-group">
			    <label>First Name</label>
			    <input type="text" class="form-control" placeholder="First Name" name="fname">
			  </div>
			  <div class="form-group">
			   <label>Last Name</label>
			    <input type="text" class="form-control" placeholder="Last Name" name="lname">
			  </div>
			  <div class="form-group">
			    <label>Email</label>
			    <input type="email" class="form-control" autocomplete="off" placeholder="Enter email" name="email">
			  </div>
			  <div class="form-group">
			   <label>Address</label>
			    <input type="text" class="form-control" placeholder="Address" name="address">
			  </div>
			  <div class="form-group">
			   <label>City</label>
			    <input type="text" class="form-control" placeholder="City" name="city">
			  </div>
			  <div class="form-group">
			   <label>PIN Code</label>
			    <input type="text" class="form-control" placeholder="PIN Code" name="pin">
			  </div> 
			  <div class="form-group">
			   <label>Contact No.</label>
			    <input type="text" class="form-control" placeholder="Contact No." name="contact_no">
			  </div>
			  
		</div>

		
		<div class="col-md-6 my-2">
			<div class="alert alert-info" role="alert">
			  	<i class="fa fa-info-circle"></i> Select payment method.
			</div>

			<h4>Payment Method</h4>
			<div class="form-check">
			  <input class="form-check-input" type="checkbox" value="Card" disabled>
			  <label class="form-check-label" for="defaultCheck1">
			    Credit/Debit Card
			  </label>
			</div>

			<div class="form-check">
			  <input class="form-check-input" type="checkbox" value="Card" disabled>
			  <label class="form-check-label" for="defaultCheck1">
			    Net Banking
			  </label>
			</div>

			<div class="form-check">
			  <input class="form-check-input" type="checkbox" value="Card" disabled>
			  <label class="form-check-label" for="defaultCheck1">
			    UPI/Wallets (Paytm, Google Pay, etc)
			  </label>
			</div>

			<div class="form-check">
			  <input class="form-check-input" name="payment_mode" type="checkbox" value="COD" checked>
			  <label class="form-check-label" for="defaultCheck1">
			    Cash on delivery (COD)
			  </label>
			</div>

			<div class="py-5">
				<h4>Total Payable amount:</h4>
				<h4 class="mx-3"><?php echo '₹'.$total ?></h4>
			<p class="text-primary py-4">
			  	<strong> * You are required to pay the amount upon delivery. </strong>
			</p>
			</div>
			<div class="text-center">
			<input type="submit" name="confirm_order" class="btn custom-btn my-2 btn-lg" value="Confirm Order">
			</div>
			</form>
		</div>

	</div>

</div>

	<?php 


		$user_id = $_SESSION['user_id'];

		if (isset($_POST["confirm_order"])) {

			$date = date("d-m-y");

		foreach ($_COOKIE['item'] as $name1 => $value) {


			$values11 = explode("__", $value);

			mysqli_query($conn, "INSERT INTO orders(user_id, product_name, product_price, product_qty, product_img, order_total, address, firstname, lastname, email, contact_no, city, pincode, payment_mode, order_date, order_status) VALUES($user_id, '$values11[1]', '$values11[2]', '$values11[3]', '$values11[0]', '$values11[4]', '$_POST[address]', '$_POST[fname]', '$_POST[lname]', '$_POST[email]', '$_POST[contact_no]', '$_POST[city]', '$_POST[pin]', '$_POST[payment_mode]', '$date', 'new' ) ");
		}

			$_SESSION['order_placed'] = true;

			for($i=1;$i<=$d; $i++) {

				setcookie("item[$i]","",time() - 3600);

			}

				
				// redirect user to order success page
				header('Location: order-success.php?ref=checkout');
			}

			?>

<?php
ob_end_flush();
include './inc/footer.php'
?>