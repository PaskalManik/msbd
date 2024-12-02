<?php
session_start();
require './inc/db_connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    echo "<script>alert('You are already logged in. Redirecting to homepage.');</script>";
    header('Location: index.php');
    exit();
}

if (isset($_POST['signup-btn'])) {
    $fname = htmlspecialchars($_POST['firstname']);
    $lname = htmlspecialchars($_POST['lastname']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['pass2'], PASSWORD_BCRYPT);
    $contact_no = htmlspecialchars($_POST['contact_no']);
    $role = htmlspecialchars($_POST['role']);

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_fetch_array($result)) {
        echo "<script>alert('Email already in use. Please try another.');</script>";
    } else {
        $verification_code = rand(100000, 999999);

        $insert_query = "INSERT INTO users (firstname, lastname, email, password, contact_no, is_verified, verification_code, role) 
                         VALUES ('$fname', '$lname', '$email', '$password', '$contact_no', 0, '$verification_code', '$role')";
        mysqli_query($conn, $insert_query);

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '982d6f7babef0b';
            $mail->Password = '5fef16045dce69';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('noreply@ecart.com', 'E-Cart');
            $mail->addAddress($email, "$fname $lname");

            $mail->isHTML(true);
            $mail->Subject = 'Verify your account with OTP';
            $mail->Body = "
                <html>
                    <head>
                        <title>Hi $fname - ECART</title>
                    </head>
                    <body style='text-align: center;'>
                        <div>
                            <h1 class='text-center'>
                                <span style='color: #F8694A'>E-</span><span>CART</span>
                            </h1>
                        </div>
                        <br>
                        <div>
                            <h1>Your OTP is : <br> <br> <span style='color: #F8694A'> $verification_code </span></h1>
                            <br>
                            * In case you have not register your account, ignore this mail.
                            <br>
                            <br>
                            <strong>Note: Please don't share OTP with others.</strong>
                        </div>
                    </body>
                </html>
            ";

            $mail->send();
            echo "<script>alert('Account created! Check your email for the OTP to verify your account.');</script>";
            header('Location: verify.php?email=' . urlencode($email));
        } catch (Exception $e) {
            echo "<script>alert('Error sending verification email. Please try again later.');</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Signup - E-CART</title>

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <section class="container">
        <div class="row py-4 my-3">
            <div class="col-md-4"></div>
            <div class="col-md-4 py-4">
                <div class="card p-3">
                    <h3 class="text-center py-1"><span class="text-orange">E-</span><span class="text-custom-1">CART</span></h3>

                    <!-- Sign Up form -->
                    <div id="signup" class="py-2">
                        <h6 class="text-center text-orange">Create an account</h6>
                        <form action="" method="POST" oninput='pass2.setCustomValidity(pass2.value != pass1.value ? "Passwords do not match." : "")'>
                            <div class="py-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-user" aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" name="firstname" placeholder="First Name" required>
                                </div>
                            </div>
                            <div class="py-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-user" aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" name="lastname" placeholder="Last Name" required>
                                </div>
                            </div>
                            <div class="py-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-envelope-o" aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="py-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-phone" aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" name="contact_no" placeholder="Contact Number" required>
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
                                <select name="role" id="role" class="form-control">
                                    <option value="customer">Customer</option>
                                    <option value="employee">Employee</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-block custom-btn mt-3" name="signup-btn">Sign Up</button>
                            <div class="text-center pt-4 pb-1">
                                <a href="login.php">Already have an account?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </section>
</body>

</html>