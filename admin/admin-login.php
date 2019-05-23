
<?php 

	session_start();
	
	include './inc/db_connect.php';

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
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	

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
					<h6 class="text-center text-orange">Admin Login</h6>
					<form class="text-center" name="admin_login" action="" method="POST">
						<div class="py-3">
						      <div class="input-group">
						        <div class="input-group-prepend">
						          <span class="input-group-text" id="inputGroupPrepend"> <i class="fa fa-envelope-o" aria-hidden="true"></i> </span>
						        </div>
						        <input type="text" name="username" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required>
        					</div>
						</div>
						<div class="py-3">
						      <div class="input-group">
						        <div class="input-group-prepend">
						          <span class="input-group-text"> <i class="fa fa-key" aria-hidden="true"></i> </span>
						        </div>
						        <input type="password" name="pwd" class="form-control" id="password" placeholder="Password" required>
        					</div>
        					<p class="ml-2 mt-1 text-left"> <a href="#"><small>Forgot Password?</small></a></p>
						</div>
						<button type="submit" name="submit-btn" class="btn btn-block custom-btn mt-3">Login</button>
					</form>
					</div>
					</form>
				</div>
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
	
<?php 
	if(isset($_POST["submit-btn"]))
	{
		$res = mysqli_query($conn, "SELECT * FROM admin_login WHERE username='$_POST[username]' && password='$_POST[pwd]'");
		while ($row = mysqli_fetch_array($res)) {
			
			$_SESSION["admin"]=$row["username"];
			 
			header('Location: index.php');
		}
	} 
?>


</body>
</html>