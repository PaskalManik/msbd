<?php
	
	session_start();
	
	include './inc/db_connect.php';

	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {

		?>
		<script type="text/javascript">
			alert('You are Already Logged in.');

			// redirect to index page
			window.location.href = "index.php";
		</script>>
		<?php
	}

	$ref = $_SESSION["ref"];

		
	if (isset($_GET['ref'])) {

		$ref = $_GET['ref'];
	
	}


	// if ($ref === 'checkout') {
	// 	$_SESSION['ref'] = 'cart';
	// 	header("Location: checkout.php");
	// }


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>Login/Signup - E-CART</title>

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
					<!-- Login Form-->

					<div id="login" class="py-2">
					<h6 class="text-center text-orange">Login</h6>
					<form action="" method="POST" class="text-center">
						<div class="py-3">
						      <div class="input-group">
						        <div class="input-group-prepend">
						          <span class="input-group-text"> <i class="fa fa-envelope-o" aria-hidden="true"></i> </span>
						        </div>
						        <input type="email" class="form-control" name="lemail" placeholder="Email" aria-describedby="inputGroupPrepend" required>
        					</div>
						</div>
						<div class="py-3">
						      <div class="input-group">
						        <div class="input-group-prepend">
						          <span class="input-group-text"> <i class="fa fa-key" aria-hidden="true"></i> </span>
						        </div>
						        <input type="password" class="form-control" name="lpassword" placeholder="Password" required>
        					</div>
        					<p class="ml-2 mt-1 text-left"> <a href="reset-password.php"><small>Forgot Password?</small></a></p>
						</div>
						<button type="submit" class="btn btn-block custom-btn mt-3" name="login-btn">Login</button>
						<div class="text-center pt-4 pb-1">
							<a onclick="ShowSignupForm();" href="javascript:(void);">Create an account?</a>
						</div>
					</form>
					</div>

					<?php 
						if(isset($_POST["login-btn"]))
						{

							$pwd = hash('sha1',$_POST['lpassword']);

							$res = mysqli_query($conn, "SELECT * FROM users WHERE email='$_POST[lemail]' && password='$pwd' ");
							
							if ($row = mysqli_fetch_array($res)) {
								
								$_SESSION['loggedin'] = true;
								$_SESSION["user_id"]=$row["user_id"];
								$_SESSION['user_email'] = $row['email'];
								$_SESSION['firstname'] = $row['firstname'];
								$_SESSION['lastname'] = $row['lastname'];


								if ($ref === 'checkout') {
									?>
									<script type="text/javascript">
										alert("Login Successfull. You will be redirected to Cart.")
										window.location.href = "checkout.php";
									</script>
									<?php
								} 
								else{

									?>
								<script type="text/javascript">
									alert("Login Successfull. You will be redirected to Homepage.")
									window.location.href = "index.php";
								</script>
									<?php
								 
								// header('Location: index.php');
								}
							} else{

								?>
	
							<script type="text/javascript">
								alert("Opps! Email/Password is incorrect. Please try again.")
							</script>

								<?php
							}

							
						} 
					?>

			<!-- Sign Up form -->
						
				<div id="signup" class="py-2 hide">
					<h6 class="text-center text-orange">Create an account</h6>
					<form action="" method="POST" oninput='pass2.setCustomValidity(pass2.value != pass1.value ? "Passwords do not match." : "")'>
						<div class="py-3">
						      <div class="input-group">
						        <div class="input-group-prepend">
						          <span class="input-group-text" id="inputGroupPrepend"> <i class="fa fa-user" aria-hidden="true"></i> </span>
						        </div>
						        <input type="text" class="form-control" name="firstname" placeholder="First Name" aria-describedby="inputGroupPrepend" required>
        					</div>
						</div>
						<div class="py-3">
						      <div class="input-group">
						        <div class="input-group-prepend">
						          <span class="input-group-text" id="inputGroupPrepend"> <i class="fa fa-user" aria-hidden="true"></i> </span>
						        </div>
						        <input type="text" class="form-control" name="lastname" placeholder="Last Name" aria-describedby="inputGroupPrepend" required>
        					</div>
						</div>
						<div class="py-3">
						      <div class="input-group">
						        <div class="input-group-prepend">
						          <span class="input-group-text" id="inputGroupPrepend"> <i class="fa fa-envelope-o" aria-hidden="true"></i> </span>
						        </div>
						        <input type="email" class="form-control" name="email" placeholder="Email" aria-describedby="inputGroupPrepend" required>
        					</div>
						</div>
						<div class="py-3">
						      <div class="input-group">
						        <div class="input-group-prepend">
						          <span class="input-group-text"> <i class="fa fa-key" aria-hidden="true"></i> </span>
						        </div>
						        <input type="password" class="form-control" name="pass1" placeholder="Password" required>
        					</div>
						</div>
						<div class="py-3">
						      <div class="input-group">
						        <div class="input-group-prepend">
						          <span class="input-group-text"> <i class="fa fa-key" aria-hidden="true"></i> </span>
						        </div>
						        <input type="password" class="form-control" name="pass2" placeholder="Confirm Password" required>
        					</div>
						</div>
						<div class="py-3">
						      <div class="input-group">
						        <div class="input-group-prepend">
						          <span class="input-group-text"> <i class="fa fa-phone" aria-hidden="true"></i> </span>
						        </div>
						        <input type="text" class="form-control" name="contact_no" placeholder="Contact No." required>
        					</div>
						</div>
						<!-- <small id="otpHelp" class="form-text ml-2 mt-1 text-danger">* Email Verification Required</small> -->
						<button type="submit" name="signup-btn" class="btn btn-block custom-btn mt-3">Sign up</button>
						<div class="text-center pt-3">
							<a onclick="ShowLoginForm();" href="javascript:(void);">Login Now</a>
						</div>
					</form>
				</div>

			<?php 


			if (isset($_POST['signup-btn'])) {
				
				$fname = htmlspecialchars($_POST['firstname']);
				$lname = htmlspecialchars($_POST['lastname']);
				$email = htmlspecialchars($_POST['email']);
				$pwd = hash('sha1', $_POST['pass2']);
				$contact_no = htmlspecialchars($_POST['contact_no']);


				$res = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' ");

				if ($row = mysqli_fetch_array($res)) {
					
					?>
				<script type="text/javascript">
					alert("Email Already in use. Please try another");
				</script>
					<?php
				} else{

					mysqli_query($conn, " INSERT INTO users(firstname, lastname, email, password, contact_no) VALUES('$fname', '$lname', '$email', '$pwd', '$contact_no' ) ");


					?>
				<script type="text/javascript">
					alert("Your account was succesfully created. Login in to Proceed");
				</script>
					<?php
				}


				
			}

			 ?>


				</div>
			</div>

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