<?php

	session_start();

	include './inc/db_connect.php';
// $_SESSION['otp'] = 0;

	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>Reset Password - AxmMart</title>

	<!-- Google fonts -->
	<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Custom Styles-->
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	

</head>
<body>
	
	<section class="container">
		<div class="row py-4 my-3">

			<div class="col-md-4"></div>

			<div class="col-md-4 py-4">
				
				<div class="card p-3">
					<div class="logo">
					<h3 class="text-center py-1"><span class="text-orange">E-</span><span class="text-custom-1">CART</span> </h3>
					</div>
					<p class="text-center pt-4 text-custom-1">Reset Password</p>
					<form action="" method="POST">
						<div class="py-3">
						      <div class="input-group">
						        <div class="input-group-prepend">
						          <span class="input-group-text"> <i class="fa fa-envelope-o" aria-hidden="true"></i> </span>
						        </div>
						        <input type="email" class="form-control" id="password" placeholder="Email" name="email" 

						        <?php if (isset($_SESSION['otp_email'])){ echo 'disabled'; } ?> 
						        	required value="<?php if (isset($_SESSION['otp_email'])){
						        	echo $_SESSION['otp_email']; } ?> ">
        					</div>
						</div>
						
					
						<?php 

							// show new password field only if otp sent
							
							if ( isset($_SESSION['otp'])) {

								?>

								<div class="py-3">
								      <div class="input-group">
								        <div class="input-group-prepend">
								          <span class="input-group-text"> <i class="fa fa-eye" aria-hidden="true"></i> </span>
								        </div>
								        <input type="text" class="form-control" id="password" placeholder="Enter OTP" name="otp" required>
		        					</div>
								</div>

								<div class="py-3">
								      <div class="input-group">
								        <div class="input-group-prepend">
								          <span class="input-group-text"> <i class="fa fa-key" aria-hidden="true"></i> </span>
								        </div>
								        <input type="password" class="form-control" id="password" placeholder="New Password" name="pass1" required>
		        					</div>
								</div>
								<div class="py-3">
								      <div class="input-group">
								        <div class="input-group-prepend">
								          <span class="input-group-text"> <i class="fa fa-key" aria-hidden="true"></i> </span>
								        </div>
								        <input type="password" class="form-control" id="password" placeholder="Confirm Password" name="pass2" required>
		        					</div>
								</div>

	
								<?php
								
							}

						 ?>

						


						<button type="submit" name="reset-pwd" class="btn btn-block custom-btn mt-4 mb-5">Reset Password</button>
						<small class="text-primary text-center">** Enter email we'll send you an OTP.</small>
					</form>
				</div>
			</div>

			<?php 

				if (isset($_SESSION['otp'])) {

					// if (isset($_POST['reset-pwd'])) {

					// 	$otp = $_POST['otp'];
					// 	$uemail = $_POST['email'];

					// 	if ($_SESSION['otp'] === $otp && $_SESSION['otp_email'] === $uemail) {
							

					// 	}
					// }
					
				} else {

					if (isset($_POST['reset-pwd'])) {

						$uemail = $_POST['email'];

						$res = mysqli_query($conn, "SELECT * from users where email='$uemail' ");

						if ( $row = mysqli_fetch_array($res)){

							// if email exists in database
							
						

						$_SESSION['otp_email'] = $_POST['email'];
						
						$otp = mt_rand(100000, 999999);

						$_SESSION['otp'] = $otp;


						// sending otp 
						// 
						
						$to = $_SESSION['otp_email'];
						$subject = "Password Reset - ECART";

						$message = "
						<html>
						<head>
						<title>Password Reset - ECART</title>
						</head>
						<body style='text-align: center;'>
						<div>
						<h1 class='text-center'><span style='color: #F8694A'>E-</span><span>CART</span> </h1>
						</div>
						<br>
						<div>
							<h1>Your OTP for password reset is : <br> <br> <span style='color: #F8694A'>782630 </span> </h1>
							<br>
							
							* Incase you have not requested for password reset ignore this mail.
							<br>
							<br>
							<strong>Note: Please don't share OTP with others.</strong>
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

					} else {

						?>

					<script type="text/javascript">
						alert('Email not registered.');
					</script>

						<?php
					}

						
					}

				}

			 ?>

		
		<?php 
	

				// $to = $_SESSION['otp_email'];
				// $subject = "Password Reset - ECART";

				// $message = "
				// <html>
				// <head>
				// <title>Password Reset - ECART</title>
				// </head>
				// <body style='text-align: center;'>
				// <div>
				// <h1 class='text-center'><span style='color: #F8694A'>E-</span><span>CART</span> </h1>
				// </div>
				// <br>
				// <div>
				// 	<h1>Your OTP for password reset is : <br> <br> <span style='color: #F8694A'>782630 </span> </h1>
				// 	<br>
					
				// 	* Incase you have not requested for password reset ignore this mail.
				// 	<br>
				// 	<br>
				// 	<strong>Note: Please don't share OTP with others.</strong>
				// </div>
				// </body>
				// </html>
				// ";

				// // Always set content-type when sending HTML email
				// $headers = "MIME-Version: 1.0" . "\r\n";
				// $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				// // More headers
				// $headers .= 'From: admin@ecart.cf' . "\r\n";
				// // $headers .= 'Cc: myboss@example.com' . "\r\n";

				// mail($to,$subject,$message,$headers);

 		?>




			<div class="col-md-4"></div>

		</div>
	</section>
	
	<footer class="text-center pt-3">
		<p class="text-muted"> <small> Copyright &copy; <script>document.write(new Date().getFullYear());</script> | All rights reserved </small> </p>
	</footer>

	<!-- Scripts -->

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	<script src="./js/script.js"></script>

</body>
</html>