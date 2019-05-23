<?php
ob_start();


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
			    <input type="text" class="form-control" placeholder="First Name" name="fname" required>
			  </div>
			  <div class="form-group">
			   <label>Last Name</label>
			    <input type="text" class="form-control" placeholder="Last Name" name="lname" required>
			  </div>
			  <div class="form-group">
			    <label>Email</label>
			    <input type="email" class="form-control" autocomplete="off" placeholder="Enter email" name="email" required>
			  </div>
			  <div class="form-group">
			   <label>Address</label>
			    <input type="text" class="form-control" placeholder="Address" name="address" required>
			  </div>
			  <div class="form-group">
			   <label>City</label>
			    <input type="text" class="form-control" placeholder="City" name="city" required>
			  </div>
			  <div class="form-group">
			   <label>PIN Code</label>
			    <input type="text" class="form-control" placeholder="PIN Code" name="pin" required>
			  </div> 
			  <div class="form-group">
			   <label>Contact No.</label>
			    <input type="text" class="form-control" placeholder="Contact No." name="contact_no" required>
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

			mysqli_query($conn, "INSERT INTO orders(user_id, product_name, product_price, product_qty, product_img, order_total, address, firstname, lastname, email, contact_no, city, pincode, payment_mode, order_date, order_status) VALUES($user_id, '$values11[1]', '$values11[2]', '$values11[3]', '$values11[0]', '$values11[4]', '$_POST[address]', '$_POST[fname]', '$_POST[lname]', '$_POST[email]', '$_POST[contact_no]', '$_POST[city]', '$_POST[pin]', '$_POST[payment_mode]', '$date', 'Approved' ) ");
		}

			$_SESSION['order_placed'] = true;

			for($i=1;$i<=$d; $i++) {

				setcookie("item[$i]","",time() - 3600);

			}


				// send order confirmation in mail
				
				
				

						$to = $_SESSION['user_email'];

						$subject = "Your Recent Order was Successful - ECART";

						$message = "
						<html>
						<head>
						<title>Your Recent Order was Successful - ECART</title>
							<style>
							.text-center{
							text-align: center;
							}
							.text-orange{
								color: #F8694A;
							}
							</style>

							</head>
							<body class='text-center' style='background-color: #F7F7F7'>
							<div>
							<h1 class='text-center'><span style='color: #F8694A'>E-</span><span>CART</span> </h1>
							</div>
							<br>
							<div>

								<div class='container'>
								<div class='order custom-card px-3 my-4'>
									<h2>Hello, $_SESSION[firstname]</h2>
									<h1>Your Order at <span style='color: #F8694A'>E-</span>CART was Successful. </h1>
								</div>
								<div>
								</div>
							</div>
								
								<strong> <p class='my-4'> Your order is currently under processing and will soon be dispatched.</p> </strong>
								<br>
								<br>
								<h4 class='text-orange'>Happy Shopping!</h4>
								
							</div>
							</body>
							</html>
						";

						// Always set content-type when sending HTML email
						$headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

						// More headers
						$headers .= 'From: admin@ecart.cf' . "\r\n";
						// $headers .= 'Cc: myboss@example.com' . "\r\n";

						mail($to,$subject,$message,$headers);

				
				// redirect user to order success page
				header('Location: order-success.php?ref=checkout');
			}

			?>

<?php
ob_end_flush();
include './inc/footer.php'
?>